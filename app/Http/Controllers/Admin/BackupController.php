<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Transaction;
use App\Models\Setting;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\CommonController;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\WhatsappMessage;
use App\Models\MobileListing;
use Image;
use DB;
use DateTime;

class BackupController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $common;
    protected $userIds;
    public function __construct()
    {
        $this->middleware('auth');

        $this->common = new CommonController;
        $this->middleware(function ($request, $next) {
            $this->userIds = $this->common->fetchAllReferralWithParent(Auth::user()->id);  
            return $next($request);
        });
    }

    public function index(Request $request)
    {
        $data['users'] = Admin::select('id', 'user_unique_id', 'username')->where('is_active', 'Yes')->where('status', 'Active')->orderBy('username', 'ASC')->get();
        return view("admin.backup.index")->with($data);
    }

    public function serverSideDataTable(Request $request)
    {
    	if($request->ajax())
        {
    		$whatsapp = WhatsappMessage::query();

            $whatsapp->select('id', 'campaign_unique_id', 'campaign_name', 'number_count', 'created_at', 'login_id', 'status');

            if(!empty($request->date_range))
            {
                $dateRange = explode(" - ", $request->date_range);
                $fromDate = date("Y-m-d", strtotime($dateRange[0]));
                $toDate = date("Y-m-d", strtotime($dateRange[1]));

                $whatsapp->where("sort_date_wise", ">=", $fromDate);
                $whatsapp->where("sort_date_wise", "<=", $toDate);
            }

            if($request->user!='' && $request->user!='All')
            {
                $whatsapp->where("login_id", $request->user);
            }

            $rows = $whatsapp->whereIn('login_id', $this->userIds)->where('is_active', 'Yes')->orderBy('id', 'DESC')->get();

	    	return datatables()->of($rows)->addIndexColumn()
	    	->addColumn('id', function($data){
                return '<label>'.$data->id.'</label>';
	        })           
            ->addColumn('unique_id', function($data){
                return $data->campaign_unique_id;
            })
            ->addColumn('caption', function($data){
                return $data->campaign_name;
            })
            ->addColumn('total_mobile', function($data){
                return isset($data->number_count) ? $data->number_count : 0;
            })
            ->addColumn('created_at', function($data){
                return date('d-M-Y h:i A', strtotime($data->created_at));
            })
            ->addColumn('created_by', function($data){
                $user = Admin::where('id', $data->login_id)->select('user_unique_id', 'username')->first();
                return $user->username.(isset($user->user_unique_id) ? ' ('.$user->user_unique_id.')' : '');
            })
            ->addColumn('created_usertype', function($data){
                return Admin::where('id', $data->login_id)->value('user_type');
            })
            ->addColumn('status', function($data){
                if($data->status=="sent")
                {
                    $status = '<span class="badge badge-pill badge-success">Sent</span>';
                }
                else if($data->status=="pending")
                {
                    $status = '<span class="badge badge-pill badge-info">Pending</span>';
                }
                else if($data->status=="process")
                {
                    $status = '<span class="badge badge-pill badge-primary">Process</span>';
                }
                else
                {
                    $status = '<span class="badge badge-pill badge-danger">Discard</span>';
                }

                return $status;
            })
	        ->addColumn('actions', function($data){
	            $buttons = '<div class="ui" style="width: 100px;">';

                    $buttons .= ' <a href="'.url("").'/admin/export-mobile-listing/'.$data->id.'" class="btn btn-sm btn-warning export-mobile-listing-btn" style="margin-bottom: 5px;" data-toggle="tooltip" data-placement="top" title="Export mobile listing"><i class="bx bx-download"></i></a>';

                    $buttons .= ' <a href="javascript:void(0);" data-id="'.$data->id.'" class="btn btn-sm btn-danger delete-campaign-btn" style="margin-bottom: 5px;" data-toggle="tooltip" data-placement="top" title="Delete Campaign"><i class="bx bx-trash"></i></a>';
                $buttons .= '</div>';
                return $buttons;
	        })
	        
	        ->rawColumns(['id', 'unique_id', 'caption', 'total_mobile', 'created_at', 'created_by', 'created_usertype', 'status', 'actions'])
            ->make(true);
	    }
    }

    public function deleteCampaign(Request $request)
    {
        if(isset($request->id))
        {
            $del = WhatsappMessage::find($request->id);
            $del->is_active = "No";
            $dc = $del->save();

            if($dc)
            {
                $query = DB::table('mobile_listings')->where('send_wp_msgs_id', $request->id)->delete();
            
                if ($query)
                {
                    return response()->json([
                        "status" => true,
                        'message' => 'Campaign deleted successfully !'
                    ]);
                }
                else
                {
                    return response()->json([
                        "status" => false,
                        'message' => 'Campaign not deleted !'
                    ]);
                }
            }
            else
            {
                return response()->json([
                    "status" => false,
                    'message' => 'Campaign not deleted !'
                ]);
            }
        }
        else
        {
            return response()->json([
                "status" => false,
                'message' => 'Campaign not found !'
            ]);
        }
    }

}
