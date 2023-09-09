<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Complaint;
use App\Models\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\CommonController;

class ComplaintController extends Controller
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
        // if(Auth::user()->user_type=='admin' || Auth::user()->user_type=='reseller')
        // {
            return view('admin.complaints.index');
        // }
        // else
        // {
        //     abort(404);
        // }
    }

    public function serverSideDataTable(Request $request)
    {
        if($request->ajax())
        {
            if(Auth::user()->user_type=='admin')
            {
                $rows = Complaint::where('is_active', 'Yes')->orderBy('id', 'DESC')->get();
            }
            else
            {
                $rows = Complaint::where('is_active', 'Yes')->whereIn('user_id', $this->userIds)->orderBy('id', 'DESC')->get();
            }
            return datatables()->of($rows)->addIndexColumn()
            ->addColumn('id', function($data){
                return $data->id;
            })
            ->addColumn('created_at', function($data){
                return date('d-M-Y h:i A', strtotime($data->created_at));
            })
            ->addColumn('sender', function($data){
                $user = Admin::select('username', 'user_unique_id')->where('id', $data->user_id)->first();
                return $user->username.(isset($user->user_unique_id) ? ' ('.$user->user_unique_id.')' : '');
            })
            ->addColumn('subject', function($data){
                return $data->subject;
            })
            ->addColumn('description', function($data){
                return $data->description;
            })            
            ->rawColumns(['id', 'created_at', 'sender', 'subject', 'description'])
            ->make(true);
        }
    }

    public function form(Request $request)
    {
        if(Auth::user()->user_type=='reseller' || Auth::user()->user_type=='user')
        {
            return view('admin.complaints.form');
        }
        else
        {
            abort(404);
        }
    }

    public function save(Request $request)
    {
		$save = new Complaint;
        $save->user_id = Auth::user()->id;
        $save->subject = $request->subject;
        $save->description = $request->description;
		$query = $save->save();

    	if ($query)
    	{
    		return response()->json([
    			"status" => true,
    			'message' => 'Complaint saved successfully !'
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

    public function fetchData(Request $request)
    {
    	$id = $request->id;
    	$data = News::where("id", $id)->first();
    	return response()->json($data);
    }    

     public function deactivate(Request $request)
    {
        $id = $request->id;

        $inactive = News::find($id);
        $inactive->status = "Inactive";
        $query = $inactive->save();
        
        if ($query)
        {
            return response()->json([
                "status" => true,
                'message' => 'News deactivated successfully !'
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

        $active = News::find($id);
        $active->status = "Active";
        $query = $active->save();
        
        if ($query)
        {
            return response()->json([
                "status" => true,
                'message' => 'News activated successfully !'
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


}
