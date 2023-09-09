<?php

namespace App\Http\Controllers\Admin\Tools;

use Illuminate\Http\Request;
use App\Models\Alert;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AlertController extends Controller
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
        if(Auth::user()->user_type=='admin')
        {
            return view('admin.tools.alerts.index');
        }
        else
        {
            abort(404);
        }
    }

    public function save(Request $request)
    {
    	// if (isset($request->alert_id)) {
    	// 	$update = Alert::find($request->alert_id);
     //        $update->property_type = $request->property_type;
     //        $update->name = $request->name;
    	// 	$query = $update->save();
    	// }
    	// else
    	// {
    		$save = new Alert;
            $save->description = $request->description;
    		$query = $save->save();
    	// }

    	if ($query)
    	{
    		return response()->json([
    			"status" => true,
    			'message' => 'Alert saved successfully !'
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
    	$data = Alert::where("id", $id)->first();
    	return response()->json($data);
    }

    public function serverSideDataTable(Request $request)
    {
    	if($request->ajax()){
    		$rows = Alert::where('is_active', 'Yes')->orderBy('id', 'DESC')->get();
	    	return datatables()->of($rows)->addIndexColumn()
	    	->addColumn('id', function($data){
	            return $data->id;
	        })
            ->addColumn('datetime', function($data){
                return date('d-M-Y h:i A', strtotime($data->created_at));
            })
	        ->addColumn('description', function($data){
	            return $data->description;
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
                $buttons = '<div class="ui">';
                // $buttons .= '<button type="button" data-id="'. $data->id .'" class="btn btn-sm btn-info edit-alert-btn" data-toggle="tooltip" data-placement="top" title="Edit Alert"><i class="bx bx-edit"></i></button>';
                    if($data->status=="Active")
                    {
                        $buttons .= ' <a href="javascript:void(0);" data-id="'.$data->id.'" class="btn btn-sm btn-danger deactivate-alert-btn" data-toggle="tooltip" data-placement="top" title="Block Alert"><i class="bx bx-block"></i></a>';
                    }
                    else
                    {
                        $buttons .= ' <a href="javascript:void(0);" data-id="'.$data->id.'" class="btn btn-sm btn-success activate-alert-btn" data-toggle="tooltip" data-placement="top" title="Activate Alert"><i class="bx bx-check"></i></a>';
                    }
                $buttons .= '</div>';
                return $buttons;
            })
	        
	        ->rawColumns(['id', 'datetime', 'description', 'status', 'actions'])
            ->make(true);
	    }
    }

     public function deactivate(Request $request)
    {
        $id = $request->id;

        $inactive = Alert::find($id);
        $inactive->status = "Inactive";
        $query = $inactive->save();
        
        if ($query)
        {
            return response()->json([
                "status" => true,
                'message' => 'Alert deactivated successfully !'
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

        $active = Alert::find($id);
        $active->status = "Active";
        $query = $active->save();
        
        if ($query)
        {
            return response()->json([
                "status" => true,
                'message' => 'Alert activated successfully !'
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
