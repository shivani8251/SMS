<?php

namespace App\Http\Controllers\Admin\Tools;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\CommonController;

class TreeViewController extends Controller
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
        if(Auth::user()->user_type=='admin' || Auth::user()->user_type=='reseller')
        {
            return view('admin.tools.treeview.index');
        }
        else
        {
            abort(404);
        }
    }

    public function getTreeView(Request $request)
    {
        $common = new CommonController;
        $data = $common->treeviewParentCard(Auth::user()->id);
        if($data)
        {
            $result = ['status' => true, 'result' => $data];
        }
        else
        {
            $result = ['status' => false, 'result' => []];
        }
        return response()->json($result);
    }
}
