<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;
use App\Campus;
use App\Interfaces;
use Redirect;
use Illuminate\Support\Facades\DB;

class GroupController extends Controller
{
    public function showGroups()
    {
        $role= \Auth::user()->role;
        if($role === 'SUPER'){
            $group=Group::orderBy('id')->paginate();
        }
        return view('groups.showGroups',compact('group'));
    }

    public function createGroup()
    {
    	return view('groups.createGroup');
    }

    public function createGroupPost(Request $request)
    {
    	$this->validate($request,[
            'name' => 'required|max:15|alpha_dash|unique:groups',
        ]);
        $group = new Group;
        $group->name = $request->name;
        $group->save();
        return redirect()->route('showGroups')->with('success','Registry created successfully.');
    }

    public function showDevices($id)
    {
    	$device = DB::table('campuses')->select('id','name')->distinct()->where('group_id', '=', $id)->get();
    	return view('groups.showDevices',compact('device','id'));
    }

    public function createDevice($id)
    {
    	return view('groups.createDevice',compact('id'));
    }

    public function createDevicePost(Request $request)
    {
    	$this->validate($request,[ 
            'campus' => 'required|max:30|alpha_dash',
        ]);
        $campus = new Campus;
        $campus->name = $request->campus;
        $campus->group_id = $request->group_id;
        $campus->save();
        return redirect()->route('showDevices',$request->group_id)->with('success','Registry created successfully.');
    }

    public function showInterfaces($id)
    {
        $interface=Interfaces::orderBy('id')->paginate();
        return view('groups.showInterfaces',compact('interface','id'));
    }

    public function createInterface($id)
    {
        return view('groups.createInterface',compact('id'));
    }

    public function createInterfacePost(Request $request)
    {
        $this->validate($request,[ 
            'interface' => 'required|unique:interfaces',
            'name_interface' => 'required|max:30|alpha_dash',
            'type_interface' => 'required|max:30|alpha_dash',
            'ip_interface' => 'required|ip',
        ]);
        $Interfaces = new Interfaces;
        $Interfaces->interface = $request->interface;
        $Interfaces->name = $request->name_interface;
        $Interfaces->type = $request->type_interface;
        $Interfaces->ip = $request->ip_interface;
        $Interfaces->campus_id = $request->campus_id;
        $Interfaces->save();
        return redirect()->route('showInterfaces',$request->campus_id)->with('success','Registry created successfully.');
    }
}
