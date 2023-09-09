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

class ReportController extends Controller
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
        $data['users'] = Admin::select('id', 'user_unique_id', 'username')->where('is_active', 'Yes')->where('status', 'Active')->orderBy('username', 'ASC')->whereIn('id', $this->userIds)->get();
        return view("admin.reports.index")->with($data);
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

            if($request->status!='' && $request->status!='All')
            {
                $whatsapp->where("status", $request->status);
            }

            $rows = $whatsapp->whereIn('login_id', $this->userIds)->where('is_active', 'Yes')->orderBy('id', 'DESC')->get();

            foreach($rows as $key => $row)
            {
                $row->index = $key;
                $row->estimated_time = date('Y-m-d H:i:s', strtotime('+2 hours', strtotime( $row->created_at )));
                $row->estimate_time = date('Y-m-d H:i:s', strtotime('+2 hours', strtotime( $row->created_at )));
            }

	    	return datatables()->of($rows)->addIndexColumn()
	    	->addColumn('id', function($data){
                return '<div class="checkbox">
                    <input type="checkbox" class="checkbox-input select-ids" id="select-id-'.$data->id.'" name="select_ids[]" value="'.$data->id.'" />
                    <label for="select-id-'.$data->id.'">'.$data->id.'</label>
                  </div>';
	        })
            ->addColumn('estimate_time', function($data){
                if(date('Y-m-d H:i:s')>=$data->estimate_time)
                {
                    $estimatedTime = '<b><p>2 Hours Expired</p></b>';
                }
                else
                {
                    $estimatedTime = '<b><p>'.date('d-m-Y h:i A', strtotime($data->estimate_time)).'</p></b>';
                }
                return $estimatedTime;
                // return '<b><p id="timer'.$data->index.'"> 00:00:00 </p></b>';
            })            
            ->addColumn('unique_id', function($data){
                return $data->campaign_unique_id;
            })
            // ->addColumn('caption', function($data){
            //     return $data->campaign_name;
            // })
            ->addColumn('total_mobile', function($data){
                return isset($data->number_count) ? $data->number_count : 0;
            })
            ->addColumn('created_at', function($data){
                return date('d-M-Y h:i A', strtotime($data->created_at));
            })
            ->addColumn('created_by', function($data){
                return Admin::where('id', $data->login_id)->value('full_name');
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

                    if(Auth::user()->user_type=='admin')
                    {
                        $urluser = '/admin/';
                    }
                    else
                    {
                        $urluser = '/';
                    }

                    $buttons .= '<a href="'.url("").$urluser.'view-campaign/'.$data->campaign_unique_id.'" class="btn btn-sm btn-info" style="margin-bottom: 5px;" data-toggle="tooltip" data-placement="top" title="View Details"><i class="bx bx-dots-horizontal"></i></a>';

                    $buttons .= ' <a href="'.url("").$urluser.'export-mobile-listing/'.$data->id.'" class="btn btn-sm btn-warning export-mobile-listing-btn" style="margin-bottom: 5px;" data-toggle="tooltip" data-placement="top" title="Export mobile listing"><i class="bx bx-download"></i></a>';
                    // $buttons .= ' <a href="javascript:void(0);" data-id="'.$data->id.'" class="btn btn-sm btn-warning export-mobile-listing-btn" style="margin-bottom: 5px;" data-toggle="tooltip" data-placement="top" title="Export mobile listing"><i class="bx bx-download"></i></a>';

                    // if($data->status=="Active")
                    // {
                    //     $buttons .= ' <a href="javascript:void(0);" data-id="'.$data->id.'" class="btn btn-sm btn-danger deactivate-reseller-btn" style="margin-bottom: 5px;" data-toggle="tooltip" data-placement="top" title="Block Reseller"><i class="bx bx-block"></i></a>';
                    // }
                    // else
                    // {
                    //     $buttons .= ' <a href="javascript:void(0);" data-id="'.$data->id.'" class="btn btn-sm btn-success activate-reseller-btn" style="margin-bottom: 5px;" data-toggle="tooltip" data-placement="top" title="Activate Reseller"><i class="bx bx-check"></i></a>';
                    // }
                $buttons .= '</div>';
                return $buttons;
	        })
	        
            // ->rawColumns(['id', 'estimate_time', 'unique_id', 'caption', 'total_mobile', 'created_at', 'created_by', 'created_usertype', 'status', 'actions'])
	        ->rawColumns(['id', 'estimate_time', 'unique_id', 'total_mobile', 'created_at', 'created_by', 'created_usertype', 'status', 'actions'])
            ->make(true);
	    }
    }

    public function saveUpdateStatus(Request $request)
    {
        $ids = explode(',', $request->rows);
        $status = $request->status;

        $data = [
            'status' => $status,
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        DB::table('whatsapp_messages')->whereIn('id', $ids)->update($data);
        $updated = DB::table('mobile_listings')->whereIn('send_wp_msgs_id', $ids)->update($data);
        if($updated)
        {
            $result = ['status' => true, 'message' => 'Status updated successfully !'];
        }
        else
        {
            $result = ['status' => false, 'message' => 'Status not updated !'];
        }
        return response()->json($result);
    }

    public function view(Request $request, $id)
    {
        $whatsapp = WhatsappMessage::where('campaign_unique_id', $id)->first();
        if(isset($whatsapp->id))
        {
            if(in_array($whatsapp->login_id, $this->userIds))
            {
                $whatsapp->created_by = Admin::where('id', $whatsapp->login_id)->value('full_name');
                $whatsapp->creator_type = Admin::where('id', $whatsapp->login_id)->value('user_type');
                $data['whatsapp'] = $whatsapp;
                $data['listings'] = MobileListing::where('send_wp_msgs_id', $whatsapp->id)->get();
                return view("admin.whatsapp.view")->with($data);
            }
            else
            {
                abort(404);
            }
        }
        else
        {
            abort(404);
        }
    }

    public function mobileListDataTable(Request $request)
    {
        if($request->ajax())
        {
            $whatsapp = DB::table('mobile_listings as ml');
            $whatsapp->join('whatsapp_messages as wm', 'wm.id', '=', 'ml.send_wp_msgs_id', 'left');
            $whatsapp->join('admins as a', 'wm.login_id', '=', 'a.id', 'left');
            $whatsapp->select('ml.id', 'ml.send_wp_msgs_id', 'ml.mobile_no', 'ml.country_code', 'ml.mobile_no', 'ml.status', 'ml.created_at', 'wm.campaign_unique_id', 'a.username');
            $whatsapp->where("ml.send_wp_msgs_id", $request->send_wp_msgs_id);
            $rows = $whatsapp->orderBy('ml.id', 'ASC')->get();
            foreach($rows as $key => $row)
            {
                $row->sn = $key+1;
            }

            return datatables()->of($rows)->addIndexColumn()
            ->addColumn('id', function($data){
                return '<div class="checkbox">
                    <input type="checkbox" class="checkbox-input select-ids" id="select-id-'.$data->id.'" name="select_ids[]" value="'.$data->id.'" />
                    <label for="select-id-'.$data->id.'">'.$data->sn.'</label>
                </div>';
            })
            ->addColumn('unique_id', function($data){
                return $data->campaign_unique_id;
            })
            ->addColumn('mobile_no', function($data){
                $mobile_no = (isset($data->country_code) ? $data->country_code : '').(isset($data->mobile_no) ? $data->mobile_no : '');
                if(!empty($mobile_no))
                {
                    return $mobile_no;
                }
                else
                {
                    return '-';
                }
            })
            ->addColumn('username', function($data){
                return $data->username;
            })
            ->addColumn('status', function($data){
                if($data->status=="sent")
                {
                    $status = '<span class="badge badge-pill badge-success">'.ucfirst($data->status).'</span>';
                }
                else if($data->status=="pending")
                {
                    $status = '<span class="badge badge-pill badge-info">'.ucfirst($data->status).'</span>';
                }
                else if($data->status=="process")
                {
                    $status = '<span class="badge badge-pill badge-primary">'.ucfirst($data->status).'</span>';
                }
                else
                {
                    $status = '<span class="badge badge-pill badge-danger">'.ucfirst($data->status).'</span>';
                }

                return $status;
            })
            ->addColumn('created_at', function($data){
                return date('d-m-Y h:i A', strtotime($data->created_at));
            })
            
            ->rawColumns(['id', 'unique_id', 'mobile_no', 'username', 'status', 'created_at'])
            ->make(true);
        }
    }

    public function updateMobileStatus(Request $request)
    {
        $ids = explode(',', $request->rows);
        $status = $request->status;

        $data = [
            'status' => $status,
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $updated = DB::table('mobile_listings')->whereIn('id', $ids)->update($data);
        if($updated)
        {
            $result = ['status' => true, 'message' => 'Status updated successfully !'];
        }
        else
        {
            $result = ['status' => false, 'message' => 'Status not updated !'];
        }
        return response()->json($result);
    }

    public function resellerReport(Request $request)
    {
        if(Auth::user()->user_type=='admin' || Auth::user()->user_type=='reseller')
        {
            $data['users'] = Admin::select('id', 'user_unique_id', 'username')->where('is_active', 'Yes')->whereIn('id', $this->userIds)->where('status', 'Active')->where('user_type', 'reseller')->orderBy('username', 'ASC')->get();
            return view("admin.reports.reseller")->with($data);
        }
        else
        {
            abort(404);
        }
    }

    public function resellerReportDatatable(Request $request)
    {
        if($request->ajax())
        {
            $table = DB::table('transactions as t')->join('admins as a', 'a.user_unique_id', '=', 't.user_unique_id', 'left')->select('t.*', 'a.username', 'a.user_type');

            if(!empty($request->date_range))
            {
                $dateRange = explode(" - ", $request->date_range);
                $fromDate = date("Y-m-d", strtotime($dateRange[0]));
                $toDate = date("Y-m-d", strtotime($dateRange[1]));

                $table->whereDate("t.created_at", ">=", $fromDate);
                $table->whereDate("t.created_at", "<=", $toDate);
            }

            if($request->user!='' && $request->user!='All')
            {
                $table->where("t.user_unique_id", $request->user);
            }

            $rows = $table->whereIn('a.id', $this->userIds)->where('a.user_type', 'reseller')->orderBy('t.id', 'DESC')->get();

            return datatables()->of($rows)->addIndexColumn()
            ->addColumn('id', function($data){
                return $data->id;
            })
            ->addColumn('username', function($data){
                $username = '';
                if(isset($data->user_unique_id))
                {
                    $username = $data->username.' ('.$data->user_unique_id.')';
                }
                return $username;
            })
            ->addColumn('user_type', function($data){
                return $data->user_type;
            })
            ->addColumn('no_of_sms', function($data){
                if($data->txn_type=="credit")
                {
                    $credit = '<span class="text-success">+ '.$data->credit.'</span>';
                }
                else
                {
                    $credit = '<span class="text-danger">- '.$data->credit.'</span>';
                }
                return $credit;
            })
            ->addColumn('per_sms_price', function($data){
                $per_sms_price = 0;
                if(floatval($data->per_sms_price)>0)
                {
                    $per_sms_price = floatval($data->per_sms_price)/100;
                }
                return number_format($per_sms_price, 2);
            })
            ->addColumn('description', function($data){
                return isset($data->description) ? $data->description : '-';
            })
            ->addColumn('tax_status', function($data){
                if($data->tax_status=="Yes")
                {
                    $status = '<span class="badge badge-pill badge-success">Yes</span>';
                }
                else
                {
                    $status = '<span class="badge badge-pill badge-danger">No</span>';
                }

                return $status;
            })
            ->addColumn('tax_percent', function($data){
                return $data->tax_percentage;
            })
            ->addColumn('tax_amount', function($data){
                // return $data->tax_amount;
                $tax_amount = 0;
                if(floatval($data->tax_amount)>0)
                {
                    $tax_amount = floatval($data->tax_amount)/100;
                }
                return number_format($tax_amount, 2);
            })
            ->addColumn('txn_type', function($data){
                if($data->txn_type=="credit")
                {
                    $status = '<span class="badge badge-pill badge-success">'.ucfirst($data->txn_type).'</span>';
                }
                else
                {
                    $status = '<span class="badge badge-pill badge-danger">'.ucfirst($data->txn_type).'</span>';
                }

                return $status;
            })
            ->addColumn('total_amount', function($data){
                // return $data->total_amount;
                $total_amount = 0;
                if(floatval($data->total_amount)>0)
                {
                    $total_amount = floatval($data->total_amount)/100;
                }
                return number_format($total_amount, 2);
            })
            ->addColumn('created_by', function($data){
                $username = '';
                if(isset($data->login_user_unique_id))
                {
                    $user = Admin::where('user_unique_id', $data->login_user_unique_id)->select('user_type', 'username')->first();

                    if(isset($user))
                    {
                        $username = $user->username.' ('.$user->user_type.')';
                    }
                }
                return $username;
            })
            ->addColumn('created_at', function($data){
                return date('d-M-Y h:i A', strtotime($data->created_at));
            })
            
            ->rawColumns(['id', 'username', 'user_type', 'no_of_sms', 'description', 'tax_status', 'tax_percent', 'tax_amount', 'txn_type', 'total_amount', 'tax_percent', 'created_by', 'created_at'])
            ->make(true);
        }
    }

    public function userReport(Request $request)
    {
        if(Auth::user()->user_type=='admin' || Auth::user()->user_type=='reseller')
        {
            $data['users'] = Admin::select('id', 'user_unique_id', 'username')->where('is_active', 'Yes')->whereIn('id', $this->userIds)->where('status', 'Active')->where('user_type', 'user')->orderBy('username', 'ASC')->get();
            return view("admin.reports.user")->with($data);
        }
        else
        {
            abort(404);
        }
    }

    public function userReportDatatable(Request $request)
    {
        if($request->ajax()){
            $table = DB::table('transactions as t')->join('admins as a', 'a.user_unique_id', '=', 't.user_unique_id', 'left')->select('t.*', 'a.username', 'a.user_type');

            if(!empty($request->date_range))
            {
                $dateRange = explode(" - ", $request->date_range);
                $fromDate = date("Y-m-d", strtotime($dateRange[0]));
                $toDate = date("Y-m-d", strtotime($dateRange[1]));

                $table->whereDate("t.created_at", ">=", $fromDate);
                $table->whereDate("t.created_at", "<=", $toDate);
            }

            if($request->user!='' && $request->user!='All')
            {
                $table->where("t.user_unique_id", $request->user);
            }

            $rows = $table->whereIn('a.id', $this->userIds)->where('a.user_type', 'user')->orderBy('t.id', 'DESC')->get();

            return datatables()->of($rows)->addIndexColumn()
            ->addColumn('id', function($data){
                return $data->id;
            })
            ->addColumn('username', function($data){
                $username = '';
                if(isset($data->user_unique_id))
                {
                    $username = $data->username.' ('.$data->user_unique_id.')';
                }
                return $username;
            })
            ->addColumn('user_type', function($data){
                return $data->user_type;
            })
            ->addColumn('no_of_sms', function($data){
                if($data->txn_type=="credit")
                {
                    $credit = '<span class="text-success">+ '.$data->credit.'</span>';
                }
                else
                {
                    $credit = '<span class="text-danger">- '.$data->credit.'</span>';
                }
                return $credit;
            })
            ->addColumn('per_sms_price', function($data){
                // return $data->per_sms_price;
                $per_sms_price = 0;
                if(floatval($data->per_sms_price)>0)
                {
                    $per_sms_price = floatval($data->per_sms_price)/100;
                }
                return number_format($per_sms_price, 2);
            })
            ->addColumn('description', function($data){
                return isset($data->description) ? $data->description : '-';
            })
            ->addColumn('tax_status', function($data){
                if($data->tax_status=="Yes")
                {
                    $status = '<span class="badge badge-pill badge-success">Yes</span>';
                }
                else
                {
                    $status = '<span class="badge badge-pill badge-danger">No</span>';
                }

                return $status;
            })
            ->addColumn('tax_percent', function($data){
                return $data->tax_percentage;
            })
            ->addColumn('tax_amount', function($data){
                // return $data->tax_amount;
                $tax_amount = 0;
                if(floatval($data->tax_amount)>0)
                {
                    $tax_amount = floatval($data->tax_amount)/100;
                }
                return number_format($tax_amount, 2);
            })
            ->addColumn('txn_type', function($data){
                if($data->txn_type=="credit")
                {
                    $status = '<span class="badge badge-pill badge-success">'.ucfirst($data->txn_type).'</span>';
                }
                else
                {
                    $status = '<span class="badge badge-pill badge-danger">'.ucfirst($data->txn_type).'</span>';
                }

                return $status;
            })
            ->addColumn('total_amount', function($data){
                // return $data->total_amount;
                $total_amount = 0;
                if(floatval($data->total_amount)>0)
                {
                    $total_amount = floatval($data->total_amount)/100;
                }
                return number_format($total_amount, 2);
            })
            ->addColumn('created_by', function($data){
                $username = '';
                if(isset($data->login_user_unique_id))
                {
                    $user = Admin::where('user_unique_id', $data->login_user_unique_id)->select('user_type', 'username')->first();

                    if(isset($user))
                    {
                        $username = $user->username.' ('.$user->user_type.')';
                    }
                }
                return $username;
            })
            ->addColumn('created_at', function($data){
                return date('d-M-Y h:i A', strtotime($data->created_at));
            })
            
            ->rawColumns(['id', 'username', 'user_type', 'no_of_sms', 'description', 'tax_status', 'tax_percent', 'tax_amount', 'txn_type', 'total_amount', 'tax_percent', 'created_by', 'created_at'])
            ->make(true);
        }
    }

    public function addCredit(Request $request, $type)
    {
        if(Auth::user()->user_type=='admin' || Auth::user()->user_type=='reseller')
        {
            $data['users'] = Admin::select('id', 'user_unique_id', 'username')->where('is_active', 'Yes')->where('status', 'Active')->whereIn('id', $this->userIds)->where('user_type', $type)->where('id', '!=', Auth::user()->id)->orderBy('username', 'ASC')->get();
            $data['type'] = $type;
            return view("admin.reports.add_credit")->with($data);     
        }
        else
        {
            abort(404);
        }
    }

    public function saveCredit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user' => 'required',
            'no_of_sms' => 'required',
            'per_sms_price' => 'required'
        ]);

        if ($validator->fails())
        {
            $msg = $this->common->chkValidator($validator);
            $result = [ 'status' => false, 'message' => $msg ];
        }
        else
        {
            $users_unique_id = Admin::where('id', $request->user)->value('user_unique_id');

            $tax_percentage = Setting::where('is_active', 'Yes')->where('key_name', 'gst_rate')->value('key_value');

            $login_unique_id = Auth::user()->user_unique_id;
            $credit = Auth::user()->credit;

            if(intval($credit)<=0 || empty($credit))
            {
                $result = [ 'status' => false, 'message' => 'Insufficient balance !' ];
            }
            else if(intval($request->no_of_sms)>intval($credit))
            {
                $result = [ 'status' => false, 'message' => 'Insufficient balance !' ];
            }
            else if(intval($request->no_of_sms)<=0)
            {
                $result = [ 'status' => false, 'message' => 'Invalid Number of SMS !' ];
            }
            else
            {
                $debit = Admin::find(Auth::user()->id);
                $debit->credit = intval($credit)-intval($request->no_of_sms);
                $debit->save();

                $cred = Admin::find($request->user);
                $cred->credit = intval($cred->credit)+intval($request->no_of_sms);
                $cred->save();

                $trans = new Transaction;
                $trans->credit = $request->no_of_sms;
                $trans->per_sms_price = $request->per_sms_price;
                $trans->tax_status = $request->tax_status;

                $trans->tax_percentage = $tax_percentage;

                if($request->tax_status=='Yes')
                {
                    $total_sms_amt = intval($request->no_of_sms)*floatval($request->per_sms_price);
                    $total_tax_amt = (floatval($total_sms_amt)*floatval($tax_percentage))/100;
                    $total_amount = floatval($total_sms_amt)+floatval($total_tax_amt);
                }
                else
                {
                    $total_tax_amt = 0;
                    $total_amount = intval($request->no_of_sms)*floatval($request->per_sms_price);
                }

                $trans->tax_amount = $total_tax_amt;
                $trans->total_amount = $total_amount;
                $trans->description = $request->description;
                $trans->login_user_unique_id = $login_unique_id;
                $trans->user_unique_id = $users_unique_id;
                $trans->txn_type = 'credit';
                $query = $trans->save();
                
                if ($query)
                {
                    $result = [
                        "status" => true,
                        'message' => 'Credit added successfully !'
                    ];
                }
                else
                {
                    $result = [
                        "status" => false,
                        'message' => 'Credit not added !'
                    ];
                }
            }   
        }

        return response()->json($result);
    }

    public function credits(Request $request)
    {
        $users1 = Admin::select('id', 'user_unique_id', 'username', 'user_type')->where('is_active', 'Yes')->where('status', 'Active')->whereIn('id', $this->userIds)->orderBy('username', 'ASC')->get();
        $users2 = WhatsappMessage::select('id', 'campaign_unique_id as user_unique_id', 'campaign_name as username')->where('is_active', 'Yes')->whereIn('login_id', $this->userIds)->orderBy('campaign_name', 'ASC')->get();

        foreach($users2 as $user2)
        {
            $user2->user_type = 'campaign';
        }

        $merged = $users1->merge($users2);
        $users = $merged->all();

        $data['users'] = $users;
        return view("admin.reports.credits")->with($data);
    }

    public function creditsDatatable(Request $request)
    {
        if($request->ajax()){
            $table = DB::table('transactions as t')->join('admins as a', 'a.user_unique_id', '=', 't.user_unique_id', 'left')->select('t.*', 'a.username', 'a.user_type');

            if(!empty($request->date_range))
            {
                $dateRange = explode(" - ", $request->date_range);
                $fromDate = date("Y-m-d", strtotime($dateRange[0]));
                $toDate = date("Y-m-d", strtotime($dateRange[1]));

                $table->whereDate("t.created_at", ">=", $fromDate);
                $table->whereDate("t.created_at", "<=", $toDate);
            }

            if($request->user!='' && $request->user!='All')
            {
                $table->where("t.user_unique_id", $request->user);
            }

            $rows1 = $table->whereIn('a.id', $this->userIds)->where('t.type', 'user')->orderBy('t.id', 'DESC')->get();

            $table2 = DB::table('transactions as t')->join('whatsapp_messages as wm', 'wm.campaign_unique_id', '=', 't.user_unique_id', 'left')->select('t.*', 'wm.campaign_name as username', 't.type as user_type');

            if(!empty($request->date_range))
            {
                $dateRange = explode(" - ", $request->date_range);
                $fromDate = date("Y-m-d", strtotime($dateRange[0]));
                $toDate = date("Y-m-d", strtotime($dateRange[1]));

                $table2->whereDate("t.created_at", ">=", $fromDate);
                $table2->whereDate("t.created_at", "<=", $toDate);
            }

            if($request->user!='' && $request->user!='All')
            {
                $table2->where("t.user_unique_id", $request->user);
            }

            $rows2 = $table2->whereIn('wm.login_id', $this->userIds)->where('t.type', 'campaign')->orderBy('t.id', 'DESC')->get();

            $merged = $rows2->merge($rows1);

            $rows = $merged->all();

            return datatables()->of($rows)->addIndexColumn()
            ->addColumn('id', function($data){
                return $data->id;
            })
            ->addColumn('username', function($data){
                $username = '';
                if(isset($data->user_unique_id))
                {
                    $username = $data->username.' ('.$data->user_unique_id.')';
                }
                return $username;
            })
            ->addColumn('user_type', function($data){
                return ucfirst($data->user_type);
            })
            ->addColumn('no_of_sms', function($data){
                if($data->txn_type=="credit")
                {
                    $credit = '<span class="text-success">+ '.$data->credit.'</span>';
                }
                else
                {
                    $credit = '<span class="text-danger">- '.$data->credit.'</span>';
                }
                return $credit;
            })
            ->addColumn('description', function($data){
                return isset($data->description) ? $data->description : '-';
            })
            ->addColumn('txn_type', function($data){
                if($data->txn_type=="credit")
                {
                    $status = '<span class="badge badge-pill badge-success">'.ucfirst($data->txn_type).'</span>';
                }
                else
                {
                    $status = '<span class="badge badge-pill badge-warning">'.ucfirst($data->txn_type).'</span>';
                }

                return $status;
            })
            ->addColumn('created_by', function($data){
                $username = '';
                if(isset($data->login_user_unique_id))
                {
                    $user = Admin::where('user_unique_id', $data->login_user_unique_id)->select('user_type', 'username')->first();

                    if(isset($user))
                    {
                        $username = $user->username.' ('.$user->user_type.')';
                    }
                }
                return $username;
            })
            ->addColumn('created_at', function($data){
                return date('d-M-Y h:i A', strtotime($data->created_at));
            })
            
            ->rawColumns(['id', 'username', 'user_type', 'no_of_sms', 'description', 'txn_type', 'tax_percent', 'created_by', 'created_at'])
            ->make(true);
        }
    }

}
