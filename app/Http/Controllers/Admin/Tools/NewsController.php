<?php

namespace App\Http\Controllers\Admin\Tools;

use Illuminate\Http\Request;
use App\Models\News;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
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
        // if(Auth::user()->user_type=='admin')
        // {
            return view('admin.tools.news.index');
        // }
        // else
        // {
        //     abort(404);
        // }
    }

    public function save(Request $request)
    {
    	// if (isset($request->news_id)) {
    	// 	$update = News::find($request->news_id);
     //        $update->property_type = $request->property_type;
     //        $update->name = $request->name;
    	// 	$query = $update->save();
    	// }
    	// else
    	// {
    		$save = new News;
            $save->heading = $request->heading;
            $save->description = $request->description;
    		$query = $save->save();
    	// }

    	if ($query)
    	{
    		return response()->json([
    			"status" => true,
    			'message' => 'News saved successfully !'
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

    public function serverSideDataTable(Request $request)
    {
    	if($request->ajax())
        {
    		$rows = News::where('is_active', 'Yes')->orderBy('id', 'DESC')->get();
	    	return datatables()->of($rows)->addIndexColumn()
	    	->addColumn('id', function($data){
	            return $data->id;
	        })
            ->addColumn('datetime', function($data){
                return date('d-M-Y h:i A', strtotime($data->created_at));
            })
            ->addColumn('heading', function($data){
                return $data->heading;
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
                if(Auth::user()->user_type=="admin")
                {
                    $buttons = '<div class="ui">';
                    // $buttons .= '<button type="button" data-id="'. $data->id .'" class="btn btn-sm btn-info edit-news-btn" data-toggle="tooltip" data-placement="top" title="Edit News"><i class="bx bx-edit"></i></button>';
                        if($data->status=="Active")
                        {
                            $buttons .= ' <a href="javascript:void(0);" data-id="'.$data->id.'" class="btn btn-sm btn-danger deactivate-news-btn" data-toggle="tooltip" data-placement="top" title="Block News"><i class="bx bx-block"></i></a>';
                        }
                        else
                        {
                            $buttons .= ' <a href="javascript:void(0);" data-id="'.$data->id.'" class="btn btn-sm btn-success activate-news-btn" data-toggle="tooltip" data-placement="top" title="Activate News"><i class="bx bx-check"></i></a>';
                        }
                    $buttons .= '</div>';
                }
                else
                {
                    $buttons = '-';
                }
                return $buttons;
            })
	        
	        ->rawColumns(['id', 'datetime', 'heading', 'description', 'status', 'actions'])
            ->make(true);
	    }
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
