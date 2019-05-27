<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;
use App\Campus;
use Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class AclController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showGroupsAcl()
    {
        $role= \Auth::user()->role;
        if($role === 'SUPER'){
            $group=Group::orderBy('id')->paginate();
            return view('acl.showGroups',compact('group'));
        }
        if($role === 'ADMIN'){
            $group_id= \Auth::user()->group_id;
            return redirect()->route('showDevicesTarget', $group_id);
        }
    }

    public function showDevicesAcl($id)
    {
    	$device = DB::table('campuses')->select('id','name','group_id')->distinct()->where('group_id', '=', $id)->get();
    	return view('acl.showDevices',compact('device','id'));
    }
}
