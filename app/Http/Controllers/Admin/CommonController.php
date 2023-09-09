<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Http\Controllers\Controller;
use Validator;
use Auth;

class CommonController extends Controller
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

    public function chkValidator($validator)
    {
        $messages = $validator->errors()->getMessages();
        $required_fields = '';
        $required_fields_arr = [];
        foreach($messages as $key => $message)
        {
            $required_fields_arr[] = $key;
        }
        $total_count = count($required_fields_arr);

        foreach($required_fields_arr as $mykey => $required_fields_array)
        {
            if($total_count>=2)
            {
                if($mykey<=($total_count-2))
                {
                    $required_fields .= $required_fields_array.', ';
                }
                else
                {
                    $required_fields .= $required_fields_array;
                }
            }
            else
            {
                $required_fields .= $required_fields_array;
            }
        }

        if ($validator->fails())
        {
            if($total_count>=2)
            {
                $finalMsg = 'The '.$required_fields.' fields are required !';
            }
            else
            {
                $finalMsg = 'The '.$required_fields.' field is required !';
            }
        }
        else
        {
            $finalMsg = NULL;
        }

        return $finalMsg;
    }

    public function treeviewParentCard($userid)
    {
        $user = Admin::select('id', 'username', 'user_unique_id')->where('is_active', 'Yes')->where('id', $userid)->first();

        $rows = '<ul class="list-group">';

        if(isset($user))
        {
            $this->nreferral = [];
            $counts = $this->fetchAllReferralWithoutParent($user->id);

            if($counts>0)
            {
                $rows .= '<li class="list-group-item node-custom-icon-treeview fetch-child-opt" data-nodeid="'.$user->id.'" style="color: blue; background-color: undefined;">
                    <span class="icon expand-icon bx bx-chevron-right"></span>
                    <span class="icon node-icon bx bx-bookmark"></span> <strong>'.ucfirst($user->username).' ('.$user->user_unique_id.') </strong>
                    <span class="badge badge-pill badge-round float-right"><strong>'.$counts.'</strong></span>
                </li>
                <div id="child-of-'.$user->id.'" class="non-expanded">
                    <ul class="list-group ml-1 d-none" id="loading-child-of-'.$user->id.'">
                        <li class="list-group-item node-custom-icon-treeview">Loading...</li>
                    </ul>
                </div>';
            }
            else
            {
                $rows .= '<li class="list-group-item node-custom-icon-treeview" data-nodeid="'.$user->id.'" style="color: blue; background-color: undefined;">
                    <span class="icon bx"></span>
                    <span class="icon node-icon bx bx-bookmark"></span> '.ucfirst($user->username).' ('.$user->user_unique_id.')
                </li>';
            }
        }

        $rows .= '</ul>';

        return $rows;
    }

    public function getTreeViewChild(Request $request)
    {
        if(isset($request->user_id))
        {
            $users = Admin::select('id', 'username', 'user_unique_id')->where('is_active', 'Yes')->where('parent_id', $request->user_id)->get();
            $rows = '<ul class="list-group ml-1">';
            foreach($users as $user)
            {
                $this->nreferral = [];
                $counts = $this->fetchAllReferralWithoutParent($user->id);
                if($counts>0)
                {
                    $rows .= '<li class="list-group-item node-custom-icon-treeview fetch-child-opt" data-nodeid="'.$user->id.'" style="color: blue; background-color: undefined;">
                        <span class="float-left">
                            <span class="icon expand-icon bx bx-chevron-right"></span>
                            <span class="icon node-icon bx bx-bookmark"></span> <strong>'.ucfirst($user->username).' ('.$user->user_unique_id.')</strong>
                        </span>    
                        <span class="badge badge-pill badge-round float-right"><strong>'.$counts.'</strong></span>
                    </li>
                    <div id="child-of-'.$user->id.'" class="non-expanded">
                        <ul class="list-group ml-1 d-none" id="loading-child-of-'.$user->id.'">
                            <li class="list-group-item node-custom-icon-treeview">Loading...</li>
                        </ul>
                    </div>';
                }
                else
                {
                    $rows .= '<li class="list-group-item node-custom-icon-treeview" data-nodeid="'.$user->id.'" style="color: blue; background-color: undefined;">
                        <span class="icon bx"></span>
                        <span class="icon node-icon bx bx-bookmark"></span> <span>'.ucfirst($user->username).' ('.$user->user_unique_id.')</span>
                    </li>';
                }
            }

            $rows .= '</ul>';

            $result = ['status' => true, 'result' => $rows];
        }
        else
        {
            $result = ['status' => false, 'result' => $rows];
        }
        return $result;
    }

    protected $referral = [];

    public function fetchAllReferralWithParent($userid)
    {
        array_push($this->referral, $userid);
        $referral = Admin::where('is_active', 'Yes')->where('parent_id', $userid)->pluck("id");

        if ($referral)
        {
            foreach($referral as $ref)
            {
                if(!in_array($ref, $this->referral))
                {
                    $this->fetchAllReferralWithParent($ref);
                }
            }
        }

        $this->referral = array_unique($this->referral);

        return $this->referral;
    }

    protected $nreferral = [];
    public function fetchAllReferralWithoutParent($userid)
    {
        $nreferral = Admin::where('is_active', 'Yes')->where('parent_id', $userid)->pluck("id");

        if ($nreferral)
        {
            foreach($nreferral as $ref)
            {
                if(!in_array($ref, $this->nreferral))
                {
                    array_push($this->nreferral, $ref);
                    $this->fetchAllReferralWithoutParent($ref);
                }
            }
        }

        $this->nreferral = array_unique($this->nreferral);

        return count($this->nreferral);
    }

}
