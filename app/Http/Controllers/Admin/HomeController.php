<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Alert;
use App\Models\WhatsappMessage;
use DB;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Http\Controllers\Admin\CommonController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->common = new CommonController();
    }

    public function index(Request $request)
    {
        $this->referral = [];
        $userIds = $this->fetchAllReferral(Auth::user()->id);
        $campaigns = DB::table('whatsapp_messages as wm')->join('admins as a', 'a.id', '=', 'wm.login_id', 'left')->select('wm.id', 'wm.number_count', 'a.username', 'wm.status')->where("wm.is_active", "Yes")->whereIn('wm.login_id', $userIds)->orderBy('wm.id', 'DESC')->limit(5)->get();

        $total_recharges = DB::table('transactions')->select([DB::raw('SUM(credit) as total_credit')])->where('user_unique_id', Auth::user()->user_unique_id)->where('type', 'user')->where('txn_type', 'credit')->value('total_credit');

        $total_usages = DB::table('transactions')->select([DB::raw('SUM(credit) as total_credit')])->where('login_user_unique_id', Auth::user()->user_unique_id)->value('total_credit');

        $total_campaigns = WhatsappMessage::where("is_active", "Yes")->whereDate('created_at', date('Y-m-d'))->whereIn('login_id', $userIds)->get()->count();

        $total_resellers = Admin::where("is_active", "Yes")->where("status", "Active")->where('user_type', 'reseller')->whereIn('id', $userIds)->where('id', '!=', Auth::user()->id)->get()->count();
        $total_users = Admin::where("is_active", "Yes")->where("status", "Active")->where('user_type', 'user')->whereIn('id', $userIds)->where('id', '!=', Auth::user()->id)->get()->count();

        $total_numbers = WhatsappMessage::select([DB::raw('SUM(number_count) as number_count')])->where("is_active", "Yes")->whereIn('login_id', $userIds)->whereDate('created_at', date('Y-m-d'))->value('number_count');

        // $startDateTime = date("Y-m-d H:i:s", strtotime('-24 hours', time()));
        // $endDateTime = date("Y-m-d H:i:s");
        // $data['alerts'] = Alert::where("is_active", "Yes")->where("status", "Active")->orderBy('id', 'DESC')->where('created_at', '>=', $startDateTime)->where('created_at', '<=', $endDateTime)->first();

        $data['alerts'] = Alert::where("is_active", "Yes")->where("status", "Active")->orderBy('id', 'DESC')->get();

        $data['campaigns'] = $campaigns;
        $data['total_recharges'] = $total_recharges;
        $data['total_usages'] = $total_usages;
        $data['total_campaigns'] = $total_campaigns;
        $data['total_resellers'] = $total_resellers;
        $data['total_users'] = $total_users;
        $data['total_numbers'] = $total_numbers;

        return view('admin.home')->with($data);
    }

    protected $referral = [];

    public function fetchAllReferral($userid)
    {
        array_push($this->referral, $userid);
        $referral = Admin::where('is_active', 'Yes')->where('parent_id', $userid)->pluck("id");

        if ($referral)
        {
            foreach($referral as $ref)
            {
                if(!in_array($ref, $this->referral))
                {
                    $this->fetchAllReferral($ref);
                }
            }
        }

        $this->referral = array_unique($this->referral);

        return $this->referral;
    }

    public function fetchDayWiseUsagesGraph(Request $request)
    {
        $this->referral = [];
        $userIds = $this->fetchAllReferral(Auth::user()->id);
        $query = DB::table("whatsapp_messages")->whereIn('login_id', $userIds);

        if(!empty($request->date_range))
        {
            $dates = collect();
            $dateRange = explode(" - ", $request->date_range);
            $fromDate = date("Y-m-d", strtotime($dateRange[0]));
            $toDate = date("Y-m-d", strtotime($dateRange[1]));

            $period = CarbonPeriod::create($fromDate, $toDate);

            foreach ($period as $date2) {
                $date = $date2->format('Y-m-d');
                $dates->put( $date, 0);
            }

            $posts = $query->whereDate('created_at', '>=', $dates->keys()->first())
                ->whereDate('created_at', '<=', $dates->keys()->last())
                ->groupBy('date')
                ->orderBy('date')
                ->get([
                    DB::raw( 'DATE(created_at) as date' ),
                    DB::raw( 'SUM(number_count) as "count"' )
                ])
                ->pluck('count', 'date');
        }
        else
        {
            $dates = collect();
            foreach( range( -6, 0 ) AS $i ) {
                $date = Carbon::now()->addDays( $i )->format( 'Y-m-d' );
                $dates->put( $date, 0);
            }

            $posts = $query->whereDate('created_at', '>=', $dates->keys()->first())
                ->groupBy('date')
                ->orderBy('date')
                ->get([
                    DB::raw( 'DATE( created_at ) as date' ),
                    DB::raw( 'SUM(number_count) as "count"' )
                ])
                ->pluck('count', 'date');
        }


        $dates = $dates->merge($posts);

        $campaign_dates = [];
        $campaignCounts = [];

        foreach ($dates as $date => $count) 
        {
            $campaign_dates[] = date("d-M-Y", strtotime($date));
            $campaignCounts[] = $count;
        }

        $data = [
            "campaign_dates" => $campaign_dates,
            "campaign_counts" => $campaignCounts
        ];

        // dd($data);

        return response()->json($data);
    }
}
