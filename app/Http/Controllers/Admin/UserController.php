<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Transaction;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\CommonController;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Setting;
use DB;

class UserController extends Controller
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
        if(Auth::user()->user_type=='admin' || Auth::user()->user_type=='reseller')
        {
            return view("admin.users.index");
        }
        else
        {
            abort(404);
        }
    }

    public function serverSideDataTable(Request $request)
    {
        if($request->ajax())
        {
            $rows = Admin::where('is_active', 'Yes')->where('user_type', 'user')->whereIn('id', $this->userIds)->where('id', '!=', Auth::user()->id)->orderBy('id', 'DESC')->get();
            return datatables()->of($rows)->addIndexColumn()
            ->addColumn('id', function($data){
                return $data->id;
            })
            ->addColumn('user_type', function($data){
                return $data->user_type;
            })
            ->addColumn('full_name', function($data){
                return $data->full_name;
            })
            ->addColumn('username', function($data){
                return $data->username;
            })
            ->addColumn('email_id', function($data){
                return $data->email_id;
            })
            ->addColumn('credit', function($data){
                return isset($data->credit) ? $data->credit : 0;
            })
            ->addColumn('status', function($data){
                if($data->status=="Active")
                {
                    $status = '<span class="badge badge-pill badge-success">Active</span>';
                }
                else
                {
                    $status = '<span class="badge badge-pill badge-danger">Inactive</span>';
                }

                return $status;
            })
            ->addColumn('actions', function($data){
                if(Auth::user()->user_type=='admin')
                {
                    $urluser = '/admin/';
                }
                else
                {
                    $urluser = '/';
                }

                $buttons = '<div class="ui" style="width: 100px;">';

                $buttons .= '<a href="'.url("").$urluser.'view-user/'.$data->user_unique_id.'" class="btn btn-sm btn-info" style="margin-bottom: 5px;" data-toggle="tooltip" data-placement="top" title="View Details"><i class="bx bx-dots-horizontal"></i></a>';

                $buttons .= ' <a href="'.url("").$urluser.'edit-user/'.$data->user_unique_id.'" class="btn btn-sm btn-primary" style="margin-bottom: 5px;" data-toggle="tooltip" data-placement="top" title="Edit User"><i class="bx bx-edit"></i></a>';

                $buttons .= ' <a href="'.url("").$urluser.'add-user-credit/'.$data->user_unique_id.'" class="btn btn-sm btn-warning" style="margin-bottom: 5px;" data-toggle="tooltip" data-placement="top" title="Add Credit"><i class="bx bxs-bank"></i></a>';

                $buttons .= ' <a href="'.url("").$urluser.'remove-user-credit/'.$data->user_unique_id.'" class="btn btn-sm btn-secondary" style="margin-bottom: 5px;" data-toggle="tooltip" data-placement="top" title="Remove Credit"><i class="bx bxs-eraser"></i></a>';

                $buttons .= ' <a href="javascript:void(0);" data-id="'.$data->id.'" class="btn btn-sm btn-light reset-password-btn" style="margin-bottom: 5px;" data-toggle="tooltip" data-placement="top" title="Reset Password"><i class="bx bx-key"></i></a>';

                if($data->status=="Active")
                {
                    $buttons .= ' <a href="javascript:void(0);" data-id="'.$data->id.'" class="btn btn-sm btn-danger deactivate-user-btn" style="margin-bottom: 5px;" data-toggle="tooltip" data-placement="top" title="Block User"><i class="bx bx-block"></i></a>';
                }
                else
                {
                    $buttons .= ' <a href="javascript:void(0);" data-id="'.$data->id.'" class="btn btn-sm btn-success activate-user-btn" style="margin-bottom: 5px;" data-toggle="tooltip" data-placement="top" title="Activate User"><i class="bx bx-check"></i></a>';
                }
                $buttons .= '</div>';
                return $buttons;
            })
            
            ->rawColumns(['id', 'user_type', 'full_name', 'username', 'email_id', 'credit', 'status', 'actions'])
                ->make(true);
        }
    }

    public function deactivate(Request $request)
    {
        $id = $request->id;

        $inactive = Admin::find($id);
        $inactive->status = "Inactive";
        $query = $inactive->save();
        
        if ($query)
        {
            return response()->json([
                "status" => true,
                'message' => 'User deactivated successfully !'
            ]);
        }
        else
        {
            return response()->json([
                "status" => false,
                'message' => 'Something went wrong !'
            ]);
        }
    }

    public function activate(Request $request)
    {
        $id = $request->id;

        $active = Admin::find($id);
        $active->status = "Active";
        $query = $active->save();
        
        if ($query)
        {
            return response()->json([
                "status" => true,
                'message' => 'User activated successfully !'
            ]);
        }
        else
        {
            return response()->json([
                "status" => false,
                'message' => 'Something went wrong !'
            ]);
        }
    }

    public function add(Request $request)
    {
        if(Auth::user()->user_type=='admin' || Auth::user()->user_type=='reseller')
        {
            return view("admin.users.add");
        }
        else
        {
            abort(404);
        }
    }

    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'full_name' => 'required',
            'username' => 'required',
            'email_id' => 'required',
            'mobile' => 'required',
            'image_status' => 'required'
        ]);

        $chkUnique = Admin::where('is_active', 'Yes')->where('status', 'Active')->where('username', $request->username)->get()->count();
        $chkUniqueEmail = Admin::where('is_active', 'Yes')->where('status', 'Active')->where('email_id', $request->email_id)->get()->count();
        $chkUniqueMobile = Admin::where('is_active', 'Yes')->where('status', 'Active')->where('mobile', $request->mobile)->get()->count();

        if ($validator->fails())
        {
            $msg = $this->common->chkValidator($validator);
            $result = [ 'status' => false, 'message' => $msg ];
        }
        else if($chkUnique>0)
        {
           $result = [ 'status' => false, 'message' => 'The username already exist !' ]; 
        }
        else if($chkUniqueEmail>0)
        {
           $result = [ 'status' => false, 'message' => 'The email id already exist !' ]; 
        }
        else if($chkUniqueMobile>0)
        {
           $result = [ 'status' => false, 'message' => 'The mobile number already exist !' ]; 
        }
        else
        {
            $user = new Admin;
            $user->user_unique_id = 'WP-';
            $user->user_type = 'user'; 
            $user->full_name = $request->full_name;
            $user->username = $request->username;
            $user->email_id = $request->email_id;
            $user->pwd = $request->password;
            $user->password = Hash::make($request->password);
            $user->mobile = $request->mobile;
            $user->company = $request->company;
            $user->profilepic = $request->profilepic;
            $user->parent_id = Auth::user()->id;
            $user->image_status = $request->image_status;
            $query = $user->save();

            if(strlen($user->id)>=4)
            {
                $my_user_unique_id = $user->user_unique_id.$user->id;
            }
            else
            {
                $my_user_unique_id = $user->user_unique_id.str_pad($user->id,4,'0', STR_PAD_LEFT);
            }

            $updateUser = Admin::find($user->id);
            $updateUser->user_unique_id = $my_user_unique_id;
            $updateUser->save();
            
            if ($query)
            {
                $result = [
                    "status" => true,
                    'message' => 'User created successfully !'
                ];
            }
            else
            {
                $result = [
                    "status" => false,
                    'message' => 'Something went wrong !'
                ];
            }
        }
        return response()->json($result);
    }

    public function edit(Request $request, $id)
    {
        if(Auth::user()->user_type=='admin' || Auth::user()->user_type=='reseller')
        {
            $user = Admin::where('user_unique_id', $id)->where('user_type', 'user')->first();
            if(isset($user->id))
            {
                if(in_array($user->id, $this->userIds))
                {
                    $data['user'] = $user;
                    return view("admin.users.edit")->with($data);
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
        else
        {
            abort(404);
        }
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'full_name' => 'required',
            'username' => 'required',
            'email_id' => 'required',
            'mobile' => 'required',
            'image_status' => 'required'
        ]);

        $chkUnique = Admin::where('is_active', 'Yes')->where('status', 'Active')->where('username', $request->username)->where('id', '!=', $request->id)->get()->count();
        $chkUniqueEmail = Admin::where('is_active', 'Yes')->where('status', 'Active')->where('email_id', $request->email_id)->where('id', '!=', $request->id)->get()->count();
        $chkUniqueMobile = Admin::where('is_active', 'Yes')->where('status', 'Active')->where('mobile', $request->mobile)->where('id', '!=', $request->id)->get()->count();

        if ($validator->fails())
        {
            $msg = $this->common->chkValidator($validator);
            $result = [ 'status' => false, 'message' => $msg ];
        }
        else if($chkUnique>0)
        {
           $result = [ 'status' => false, 'message' => 'The username already exist !' ]; 
        }
        else if($chkUniqueEmail>0)
        {
           $result = [ 'status' => false, 'message' => 'The email id already exist !' ]; 
        }
        else if($chkUniqueMobile>0)
        {
           $result = [ 'status' => false, 'message' => 'The mobile number already exist !' ]; 
        }
        else
        {
            $user = Admin::find($request->id);
            $user->full_name = $request->full_name;
            $user->username = $request->username;
            $user->email_id = $request->email_id;
            $user->mobile = $request->mobile;
            $user->company = $request->company;
            if($request->profilepic!=$user->profilepic)
            {
                $user->profilepic = $request->profilepic;
            }
            $user->image_status = $request->image_status;
            $query = $user->save();
            
            if ($query)
            {
                $result = [
                    "status" => true,
                    'message' => 'User details update successfully !'
                ];
            }
            else
            {
                $result = [
                    "status" => false,
                    'message' => 'Something went wrong !'
                ];
            }
        }
        return response()->json($result);
    }

    public function view(Request $request, $id)
    {
        if(Auth::user()->user_type=='admin' || Auth::user()->user_type=='reseller')
        { 
            $user = Admin::where('user_unique_id', $id)->where('user_type', 'user')->first();
            if(isset($user->id))
            {
                if(in_array($user->id, $this->userIds))
                {
                    $user->created_by = Admin::where('id', $user->parent_id)->value('full_name');
                    $data['user'] = $user;
                    return view("admin.users.view")->with($data);
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
        else
        {
            abort(404);
        }
    }

    public function addCredit(Request $request, $id)
    {
        if(Auth::user()->user_type=='admin' || Auth::user()->user_type=='reseller')
        {  
            $user = Admin::where('user_unique_id', $id)->where('user_type', 'user')->first();
            if(isset($user->id))
            {
                if(in_array($user->id, $this->userIds))
                {
                    $user->created_by = Admin::where('id', $user->parent_id)->value('full_name');
                    $data['user'] = $user;
                    return view("admin.users.add_credit")->with($data);
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
        else
        {
            abort(404);
        }
    }

    public function saveCredit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'user_unique_id' => 'required',
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
            $tax_percentage = Setting::where('is_active', 'Yes')->where('key_name', 'gst_rate')->value('key_value');
            $login_unique_id = Auth::user()->user_unique_id;
            $credit = Auth::user()->credit;

            if(empty($credit))
            {
                $result = [ 'status' => false, 'message' => 'Insufficient balance !' ];
            }
            else
            {
                if(intval($credit)<=0)
                {
                    $result = [ 'status' => false, 'message' => 'Insufficient balance !' ];
                }
                else
                {
                    if(intval($request->no_of_sms)>intval($credit))
                    {
                        $result = [ 'status' => false, 'message' => 'Insufficient balance !' ];
                    }
                    else
                    {
                        $debit = Admin::find(Auth::user()->id);
                        $debit->credit = intval($credit)-intval($request->no_of_sms);
                        $debit->save();

                        $cred = Admin::find($request->id);
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
                        $trans->user_unique_id = $request->user_unique_id;
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
            }
        }

        return response()->json($result);
    }

    public function removeCredit(Request $request, $id)
    {
        if(Auth::user()->user_type=='admin' || Auth::user()->user_type=='reseller')
        { 
            $user = Admin::where('user_unique_id', $id)->where('user_type', 'user')->first();
            if(isset($user->id))
            {
                if(in_array($user->id, $this->userIds))
                {
                    $user->created_by = Admin::where('id', $user->parent_id)->value('full_name');
                    $data['user'] = $user;
                    return view("admin.users.subtract_credit")->with($data);
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
        else
        {
            abort(404);
        }
    }

    public function submitSubtractCredit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'user_unique_id' => 'required',
            'no_of_sms' => 'required'
        ]);

        if ($validator->fails())
        {
            $msg = $this->common->chkValidator($validator);
            $result = [ 'status' => false, 'message' => $msg ];
        }
        else
        {
            $admin = Admin::find($request->id);

            if(isset($admin->id))
            {
                $admin_unique_id = $admin->user_unique_id;
                $admin_credit = $admin->credit;

                $login_unique_id = Auth::user()->user_unique_id;
                $login_credit = Auth::user()->credit;

                if(empty($admin_credit))
                {
                    $result = [ 'status' => false, 'message' => 'Insufficient balance !' ];
                }
                else
                {
                    if(intval($admin_credit)<=0)
                    {
                        $result = [ 'status' => false, 'message' => 'Insufficient balance !' ];
                    }
                    else
                    {
                        if(intval($request->no_of_sms)>intval($admin_credit))
                        {
                            $result = [ 'status' => false, 'message' => 'Insufficient balance !' ];
                        }
                        else
                        {
                            $admin->credit = intval($admin_credit)-intval($request->no_of_sms);
                            $admin->save();

                            $cred = Admin::find(Auth::user()->id);
                            $cred->credit = intval($login_credit)+intval($request->no_of_sms);
                            $cred->save();

                            $trans = new Transaction;
                            $trans->credit = $request->no_of_sms;
                            $trans->description = $request->description;
                            $trans->login_user_unique_id = $login_unique_id;
                            $trans->user_unique_id = $admin_unique_id;
                            $trans->txn_type = 'debit';
                            $query = $trans->save();
                            
                            if ($query)
                            {
                                $result = [
                                    "status" => true,
                                    'message' => 'Credit removed successfully !'
                                ];
                            }
                            else
                            {
                                $result = [
                                    "status" => false,
                                    'message' => 'Credit not removed !'
                                ];
                            }
                        } 
                    }
                }
            }
            else
            {
                $result = [ 'status' => false, 'message' => 'Reseller not found !' ];
            }  
        }
        
        return response()->json($result);
    }

    public function resetPassword(Request $request)
    {
        $reset = Admin::find($request->id);
        if(isset($reset->id))
        {
            $reset->pwd = $request->password;
            $reset->password = Hash::make($request->password);
            $update = $reset->save();

            if ($update)
            {
                $result = [
                    "status" => true,
                    'message' => 'Password reset successfully !'
                ];
            }
            else
            {
                $result = [
                    "status" => false,
                    'message' => 'Password reset failed !'
                ];
            }
        }
        else
        {
            $result = [
                "status" => false,
                'message' => 'User not found !'
            ];
        }

        return response()->json($result);
    }

    public function creditsDatatable(Request $request)
    {
        if($request->ajax())
        {
            $table = DB::table('transactions as t')->join('admins as a', 'a.user_unique_id', '=', 't.user_unique_id', 'left')->select('t.*', 'a.username', 'a.user_type');
            $rows1 = $table->where('a.id', $request->user_id)->where('t.type', 'user')->orderBy('t.id', 'DESC')->get();

            $table2 = DB::table('transactions as t')->join('whatsapp_messages as wm', 'wm.campaign_unique_id', '=', 't.user_unique_id', 'left')->select('t.*', 'wm.campaign_name as username', 't.type as user_type');
            $rows2 = $table2->where('wm.login_id', $request->user_id)->where('t.type', 'campaign')->orderBy('t.id', 'DESC')->get();

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

    public function campaignsDatatable(Request $request)
    {
        if($request->ajax())
        {
            $table = DB::table('whatsapp_messages');
            // $this->referral = [];
            // $userIds = $this->fetchAllReferral($request->user_id);
            $rows = $table->where('login_id', $request->user_id)->orderBy('id', 'DESC')->get();

            return datatables()->of($rows)->addIndexColumn()
            ->addColumn('id', function($data){
                return $data->id;
            })
            ->addColumn('unique_id', function($data){
                return $data->campaign_unique_id;
            })
            ->addColumn('campaign_name', function($data){
                return ucfirst($data->campaign_name);
            })
            ->addColumn('message', function($data){
                return $data->message;
            })
            ->addColumn('total_mob_no', function($data){
                return isset($data->number_count) ? $data->number_count : 0;
            })
            ->addColumn('created_at', function($data){
                return date('d-M-Y h:i A', strtotime($data->created_at));
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
            
            ->rawColumns(['id', 'unique_id', 'campaign_name', 'message', 'total_mob_no', 'created_at', 'status'])
            ->make(true);
        }
    }


    public function makeReseller(Request $request)
    {
        $make = Admin::find($request->user_id);
        if(isset($make->id))
        {
            $make->user_type = 'reseller';
            $update = $make->save();

            if ($update)
            {
                $result = [
                    "status" => true,
                    'message' => 'User upgraded to reseller successfully !'
                ];
            }
            else
            {
                $result = [
                    "status" => false,
                    'message' => 'Reseller creation failed !'
                ];
            }
        }
        else
        {
            $result = [
                "status" => false,
                'message' => 'User not found !'
            ];
        }

        return response()->json($result);
    }

}
