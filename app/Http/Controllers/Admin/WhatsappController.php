<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Transaction;
use App\Models\Setting;
use App\Models\WhatsappMessage;
use App\Models\MobileListing;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\CommonController;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Image;
use App\Imports\ContactImport;
use Excel;
use DB;
use App\Exports\MobileExport;

class WhatsappController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        return view("admin.whatsapp.index");
    }

    public function upload(Request $request)
    {
        if ($file = $request->file('file'))
        {
            $ext = $request->file('file')->getClientOriginalExtension();
            $imgName = rand(1000000000, 9999999999).'_image.'.$ext;
            $file = $request->file->storeAs('public/whatsapp/images', $imgName);
            $data = $imgName;

            return response()->json([
                "success" => true,
                "file" => $data
            ]);
        }
        else
        {
            return response()->json([
                "success" => false
            ]);
        }
    }

    public function uploadPDF(Request $request)
    {
        if ($file = $request->file('file'))
        {
            $ext = $request->file('file')->getClientOriginalExtension();
            $imgName = rand(1000000000, 9999999999).'_pdf.'.$ext;
            $file = $request->file->storeAs('public/whatsapp/pdf', $imgName);
            $data = $imgName;

            return response()->json([
                "success" => true,
                "file" => $data
            ]);
        }
        else
        {
            return response()->json([
                "success" => false
            ]);
        }
    }

    public function uploadVideo(Request $request)
    {
        if ($file = $request->file('file'))
        {
            $ext = $request->file('file')->getClientOriginalExtension();
            $imgName = rand(1000000000, 9999999999).'_video.'.$ext;
            $file = $request->file->storeAs('public/whatsapp/videos', $imgName);
            $data = $imgName;

            return response()->json([
                "success" => true,
                "file" => $data
            ]);
        }
        else
        {
            return response()->json([
                "success" => false
            ]);
        }
    }

    public function sendParent(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile' => 'required',
            'number_count' => 'required'
        ]);

        if ($validator->fails())
        {
            $commonController = new CommonController;
            $msg = $commonController->chkValidator($validator);
            $result = [ 'status' => false, 'message' => $msg ];
        }
        else
        {
            $user_credit = Auth::user()->credit;
            if ($user_credit != 0 || !empty($user_credit))
            {
                if($user_credit>=intval($request->number_count))
                {
                    $whatsapp = new WhatsappMessage;
                    $whatsapp->login_id = Auth::user()->id;
                    $whatsapp->campaign_unique_id = 'WP-';
                    $whatsapp->campaign_name = $request->campaign_name;
                    $whatsapp->message = $request->message;
                    $whatsapp->number_count = $request->number_count;
                    $whatsapp->image_one = $request->image_one;
                    $whatsapp->image_two = $request->image_two;
                    $whatsapp->image_three = $request->image_three;
                    $whatsapp->image_four = $request->image_four;
                    if($request->pdf_or_video=='PDF')
                    {
                        $whatsapp->upload_pdf = $request->upload_pdf;
                    }
                    else
                    {
                        $whatsapp->send_video = $request->send_video;
                    }
                    $whatsapp->dp_image = $request->dp_image;
                    $whatsapp->sort_date_wise = date('Y-m-d');
                    $query = $whatsapp->save();

                    $updateWhatsapp = WhatsappMessage::find($whatsapp->id);
                    if(strlen($whatsapp->id)>=4)
                    {
                        $campaign_unique_id = $whatsapp->campaign_unique_id.date('Y').$whatsapp->id;
                    }
                    else
                    {
                        $campaign_unique_id = $whatsapp->campaign_unique_id.date('Y').str_pad($whatsapp->id, 4, '0', STR_PAD_LEFT);
                    }
                    
                    $updateWhatsapp->campaign_unique_id = $campaign_unique_id;
                    $updateWhatsapp->save();
                    
                    if ($query)
                    {
                        $trans = new Transaction;
                        $trans->credit = $request->number_count;
                        $trans->per_sms_price = 0;
                        $trans->tax_status = 'No';
                        $trans->tax_amount = 0;
                        $trans->total_amount = 0;
                        $trans->login_user_unique_id = Auth::user()->user_unique_id;
                        $trans->user_unique_id = $campaign_unique_id;
                        $trans->type = 'campaign';
                        $trans->txn_type = 'debit';
                        $trans->save();

                        $result = [
                            "status" => true,
                            'parent_id' => $whatsapp->id
                        ];
                    }
                    else
                    {
                        $result = [
                            "status" => false,
                            'message' => 'Whatsapp message not send !'
                        ];
                    }
                }
                else
                {
                    $result = [
                        "status" => false,
                        'message' => 'Insufficient balance !'
                    ];
                }
            }
            else
            {
                $result = [
                    "status" => false,
                    'message' => 'Insufficient balance !'
                ];
            }
        }
        return response()->json($result);
    }

    public function send(Request $request)
    {
        $parent_id = $request->parent_id;
        $listings = [];
        $mobilenos = json_decode($request->mobilenos, true);
        $user_credit = Auth::user()->credit;
        if ($user_credit != 0 || !empty($user_credit))
        {
            if($user_credit>=count($mobilenos))
            {
                foreach($mobilenos as $mobileno)
                {
                    if(isset($mobileno))
                    {
                        if(!empty($mobileno))
                        {
                            $mobileno = preg_replace("/\r|\n/", "", $mobileno);
                            $lasttendigit = substr($mobileno, -10);
                            $country_code = trim(str_replace($lasttendigit ,"", $mobileno));
                            $code = '91';
                            if(isset($country_code))
                            {
                                if($country_code!="")
                                {
                                    $code = $country_code;
                                }
                            }

                            $listings[] = [
                                'country_code' => $code,
                                'mobile_no'=> $lasttendigit,
                                'send_wp_msgs_id'=> $parent_id,
                                'created_at'=> date('Y-m-d H:i:s'),
                                'sort_date'=> date('Y-m-d'),
                            ];
                        }
                    }
                }
                
                $listing = MobileListing::insert($listings);

                $number_count = count($listings);

                $admin = Admin::find(Auth::user()->id);
                $admin->credit = intval($admin->credit)-intval($number_count);
                $admin->save();

                if(isset($listing))
                {
                    $result = [
                        "status" => true,
                        "message" => 'Whatsapp message sent successfully !',
                    ];
                }
                else
                {
                    $result = [
                        "status" => false,
                        "message" => 'Whatsapp message not sent !',
                    ];
                }
            }
            else
            {
                $result = [
                    "status" => false,
                    'message' => 'Insufficient balance !'
                ];
            }
        }
        else
        {
            $result = [
                "status" => false,
                'message' => 'Insufficient balance !'
            ];
        }

        return response()->json($result);
    }

    public function sendOld(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // 'message' => 'required',
            'mobile' => 'required',
            'number_count' => 'required'
        ]);

        if ($validator->fails())
        {
            $commonController = new CommonController;
            $msg = $commonController->chkValidator($validator);
            $result = [ 'status' => false, 'message' => $msg ];
        }
        else
        {
            $user_credit = Auth::user()->credit;
            if ($user_credit != 0 || !empty($user_credit))
            {
                if($user_credit>=intval($request->number_count))
                {
                    $whatsapp = new WhatsappMessage;
                    $whatsapp->login_id = Auth::user()->id;
                    $whatsapp->campaign_unique_id = 'WP-';
                    $whatsapp->campaign_name = $request->campaign_name;
                    $whatsapp->message = $request->message;
                    $whatsapp->number_count = $request->number_count;
                    $whatsapp->image_one = $request->image_one;
                    $whatsapp->image_two = $request->image_two;
                    $whatsapp->image_three = $request->image_three;
                    $whatsapp->image_four = $request->image_four;
                    if($request->pdf_or_video=='PDF')
                    {
                        $whatsapp->upload_pdf = $request->upload_pdf;
                    }
                    else
                    {
                        $whatsapp->send_video = $request->send_video;
                    }
                    $whatsapp->dp_image = $request->dp_image;
                    $whatsapp->sort_date_wise = date('Y-m-d');
                    $query = $whatsapp->save();

                    $updateWhatsapp = WhatsappMessage::find($whatsapp->id);
                    if(strlen($whatsapp->id)>=4)
                    {
                        $campaign_unique_id = $whatsapp->campaign_unique_id.date('Y').$whatsapp->id;
                    }
                    else
                    {
                        $campaign_unique_id = $whatsapp->campaign_unique_id.date('Y').str_pad($whatsapp->id, 4, '0', STR_PAD_LEFT);
                    }
                    
                    $updateWhatsapp->campaign_unique_id = $campaign_unique_id;
                    $updateWhatsapp->save();
                    
                    if ($query)
                    {
                        $trans = new Transaction;
                        $trans->credit = $request->number_count;
                        $trans->per_sms_price = 0;
                        $trans->tax_status = 'No';
                        $trans->tax_amount = 0;
                        $trans->total_amount = 0;
                        $trans->login_user_unique_id = Auth::user()->user_unique_id;
                        $trans->user_unique_id = $campaign_unique_id;
                        $trans->type = 'campaign';
                        $trans->txn_type = 'debit';
                        $trans->save();

                        $listings = [];
                        $mobilenos = explode("\n", $request->mobile);
                        foreach($mobilenos as $mobileno)
                        {
                            if(isset($mobileno))
                            {
                                $mobileno = preg_replace("/\r|\n/", "", $mobileno);
                                $lasttendigit = substr($mobileno, -10);
                                $country_code = trim(str_replace($lasttendigit ,"", $mobileno));
                                $code = '91';
                                if(isset($country_code))
                                {
                                    if($country_code!="")
                                    {
                                        $code = $country_code;
                                    }
                                }

                                $listings[] = [
                                    'country_code' => $code,
                                    'mobile_no'=> $lasttendigit,
                                    'send_wp_msgs_id'=> $whatsapp->id,
                                    'created_at'=> date('Y-m-d H:i:s'),
                                    'sort_date'=> date('Y-m-d'),
                                ];

                                // dd($code, $lasttendigit);

                                // $listing = new MobileListing;
                                // $listing->country_code = $code;
                                // $listing->mobile_no = $lasttendigit;
                                // $listing->send_wp_msgs_id = $whatsapp->id;
                                // $listing->sort_date = date('Y-m-d');
                                // $listing->save();

                                // $admin = Admin::find(Auth::user()->id);
                                // $admin->credit = intval($admin->credit)-1;
                                // $admin->save();
                            }
                        }

                        $listing = MobileListing::insert($listings);

                        $admin = Admin::find(Auth::user()->id);
                        $admin->credit = intval($admin->credit)-intval($request->number_count);
                        $admin->save();

                        $result = [
                            "status" => true,
                            'message' => 'Whatsapp message sent successfully !'
                        ];
                    }
                    else
                    {
                        $result = [
                            "status" => false,
                            'message' => 'Whatsapp message not send !'
                        ];
                    }
                }
                else
                {
                    $result = [
                        "status" => false,
                        'message' => 'Insufficient balance !'
                    ];
                }
            }
            else
            {
                $result = [
                    "status" => false,
                    'message' => 'Insufficient balance !'
                ];
            }
        }
        return response()->json($result);
    }

    public function importContacts(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required'
        ]);

        if ($validator->fails())
        {
            return response()->json(['status' => false, 'message' => 'Input field file is required !']);
        }
        else
        {
            $import = new ContactImport;
            $path1 = $request->file('file')->store('temp'); 
            $path = storage_path('app').'/'.$path1; 

            $rows = \Excel::toArray($import, $path)[0];
            $count = count($rows);

            if ($count > 0)
            {
                if ($count >= 10)
                {
                    return response()->json(['status' => true, 'message' => 'Contacts imported successfully !', 'rows' => $rows, 'count' => $count]);
                }
                else
                {
                    return response()->json(['status' => false, 'message' => 'Minimum 10 contacts required !']);
                }
            }
            else
            {
                return response()->json(['status' => false, 'message' => 'Contacts Import failed !']);
            }
        }
        
    }

    public function updateStatusPage(Request $request)
    {
        if(Auth::user()->user_type=='admin')
        {
            return view("admin.whatsapp.update_status");
        }
        else
        {
            abort(404);
        }
    }

    public function fetchCampaignDetails(Request $request)
    {
        if(isset($request->unqiue_campaign_id))
        {
            $campaign = DB::table('whatsapp_messages as wm')
                ->join('admins as a', 'wm.login_id', '=', 'a.id', 'left')
                ->select('wm.id', 'wm.campaign_unique_id', 'wm.campaign_name', 'wm.login_id', 'a.full_name', 'a.username', 'a.email_id')
                ->where('wm.campaign_unique_id', $request->unqiue_campaign_id)
                ->first();
            if(isset($campaign->id))
            {
                $campaign->numbers_counts = MobileListing::where('send_wp_msgs_id', $campaign->id)->get()->count();

                $result = ['status' => true, 'data' => $campaign];
            }
            else
            {
                $result = ['status' => false, 'message' => 'Invalid unique id or details not found !'];
            }
        }
        else
        {
            $result = ['status' => false, 'message' => 'Invalid unique id or details not found !'];
        }

        return response()->json($result);
    }

    public function postUpdateStatus(Request $request)
    {
        // dd($request->id);
        $mobilenos = explode("\n", $request->phone_numbers);
        if(count($mobilenos)>0)
        {
            $mobilenosArr = [];
            foreach($mobilenos as $mobileno)
            {
                if(isset($mobileno))
                {
                    $mobileno = preg_replace("/\r|\n/", "", $mobileno);
                    $lasttendigit = substr($mobileno, -10);
                    $mobilenosArr[] = $lasttendigit;
                }
            }

            $updateData = [
                'status' => $request->new_status,
                'updated_at' => date('Y-m-d H:i:s')
            ];

            $listing = DB::table('mobile_listings')->where('send_wp_msgs_id', $request->id)->whereIn('mobile_no', $mobilenosArr)->update($updateData);

            if($listing)
            {
                $result = [
                    "status" => true,
                    'message' => 'Status updated successfully !'
                ];
            }
            else
            {
                $result = [
                    "status" => false,
                    'message' => 'Status not updated !'
                ];
            }
        }
        else
        {
            $result = [
                "status" => false,
                'message' => 'Mobile numbers can not be empty !'
            ];
        }

        return response()->json($result);
    }

    public function searchMobileNumber(Request $request)
    {
        if(Auth::user()->user_type=='admin')
        {
            return view("admin.whatsapp.search_mobile");
        }
        else
        {
            abort(404);
        }
    }

    public function searchMobileNumberDataTable(Request $request)
    {
        if($request->ajax())
        {
            $ids = WhatsappMessage::where(function($q) use($request){
                $q->where('campaign_unique_id', $request->first_unqiue_id);
                $q->orWhere('campaign_unique_id', $request->second_unqiue_id);
            })
            ->pluck('id')
            ->toArray();

            $rows = DB::table('mobile_listings')->select('id', 'mobile_no', 'status', 'created_at')->whereIn('send_wp_msgs_id', $ids)->groupBy('mobile_no')->havingRaw('COUNT(mobile_no) > ?', [1])->get();

            foreach ($rows as $key => $value)
            {
                $value->sn = ++$key;
            }

            return datatables()->of($rows)->addIndexColumn()
            
            ->addColumn('sn', function($data){
                return $data->sn;
            })
            ->addColumn('mobile_number', function($data){
                return $data->mobile_no;
            })
            ->addColumn('status', function($data){
                return $data->status;
            })
            ->addColumn('created_at', function($data){
                return date('d-M-Y h:i A', strtotime($data->created_at));
            })
            
            ->rawColumns(['sn', 'mobile_number', 'status', 'created_at'])
            ->make(true);
        }
    }

    public function exportMobileListings(Request $request, $id)
    {
        $mobileExp = new MobileExport($id);
        $row = DB::table('whatsapp_messages as wm')
            ->join('admins as a', 'wm.login_id', '=', 'a.id', 'left')
            ->select('wm.campaign_unique_id', 'a.username')
            ->where('wm.id', $id)
            ->first();
        $filename = $row->username.'-'.date('d-m-Y').'-'.$row->campaign_unique_id;
        return Excel::download($mobileExp, $filename.'.xlsx');
    }

}
