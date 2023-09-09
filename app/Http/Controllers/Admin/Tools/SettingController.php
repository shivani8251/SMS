<?php

namespace App\Http\Controllers\Admin\Tools;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
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
            return view('admin.tools.settings.index');
        }
        else
        {
            abort(404);
        }
    }

    public function save(Request $request)
    {
    	if (isset($request->id)) {
    		$update = Setting::find($request->id);
            // $update->key_name = $request->key_name;
            $update->key_value = $request->key_value;
    		$query = $update->save();

        	if ($query)
        	{
        		return response()->json([
        			"status" => true,
        			'message' => 'Setting saved successfully !'
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
        else
        {
            return response()->json([
                "status" => false,
                'message' => 'Setting id not found !'
            ]);
        }
    }

    public function fetch(Request $request)
    {
    	$id = $request->id;
    	$data = Setting::where("id", $id)->first();
    	return response()->json($data);
    }

    public function serverSideDataTable(Request $request)
    {
    	if($request->ajax()){
    		$rows = Setting::where('is_active', 'Yes')->orderBy('id', 'DESC')->get();
	    	return datatables()->of($rows)->addIndexColumn()
	    	->addColumn('id', function($data){
	            return $data->id;
	        })
            ->addColumn('key_name', function($data){
                return $data->key_name;
            })
	        ->addColumn('key_value', function($data){
	            return $data->key_value;
	        })
            ->addColumn('actions', function($data){
                $buttons = '<div class="ui">';
                $buttons .= '<button type="button" data-id="'. $data->id .'" class="btn btn-sm btn-info edit-setting-btn" data-toggle="tooltip" data-placement="top" title="Edit Setting"><i class="bx bx-edit"></i></button>';
                $buttons .= '</div>';
                return $buttons;
            })
	        
	        ->rawColumns(['id', 'key_name', 'key_value', 'actions'])
            ->make(true);
	    }
    }


}
