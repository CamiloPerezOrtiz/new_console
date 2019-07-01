<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;
use App\Campus;
use App\Interfaces;
use App\User;
use Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class GroupController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function showGroups()
    {
        $role= \Auth::user()->role;
        if($role === 'SUPER'){
            $group=Group::orderBy('id')->paginate();
            return view('groups.showGroups',compact('group'));
        }
        if($role === 'ADMIN'){
            $group_id= \Auth::user()->group_id;
            return redirect()->route('showDevices', Crypt::encrypt($group_id));
        }
    }

    public function createGroup()
    {
    	return view('groups.createGroup');
    }

    public function createGroupPost(Request $request)
    {
    	$this->validate($request,[
            'name' => 'required|max:15|unique:groups',
        ]);
        $group = new Group;
        $group->name = snake_case($request->name);
        $group->save();
        return redirect()->route('showGroups')->with('success','Registry created successfully.');
    }

    public function editGroup($id)
    {
        $group = Group::find($id);
        return view('groups.editGroup',compact('id','group'));
    }

    public function editGroupPost(Request $request, $id)
    {
        $this->validate($request,[
            'name' => "required|max:15|unique:groups,name,$id",
        ]);
        $nombre = strtolower($request->name);
        DB::table('groups')->where('id', $id)->update(array(
            'name' => snake_case($nombre)));
        return redirect()->route('showGroups')->with('success','Registry updated successfully.');
    }

    public function deleteGroup($id)
    {
        $group = Group::find($id)->delete();
        return Redirect::back()->with('success','Registry successfully deleted.');
    }

    public function showUsers($id)
    {
        $user = DB::table('users')->select('id','name','lastname','email','role')->where('group_id', '=', $id)->get();
        return view('groups.showUsers',compact('user','id'));
    }

    public function createUser($id)
    {
        return view('groups.createUser',compact('id'));
    }

    public function createUserPost(Request $request, $id)
    {
        $this->validate($request,[ 
            'name' => 'required|max:15',
            'lastname' => 'required|max:25',
            'email' => 'required|max:50|email|unique:users',
            'password' => 'required|min:8|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/|regex:/[@$!%*#?&]/|confirmed|max:30',
        ]);
        $user = new User;
        $user->name = $request->name;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role = $request->role;
        $user->group_id = $id;
        $user->save();
        return redirect()->route('showUsers', $id)->with('success','Registry created successfully.');
    }

    public function editUser($id)
    {
        $user = User::find($id);
        return view('groups.editUser',compact('id','user'));
    }

    public function editUserPost(Request $request, $id)
    {
        $this->validate($request,[ 
            'name' => 'required|max:15',
            'lastname' => 'required|max:25',
            'email' => "required|max:50|email|unique:users,email,$id",
        ]);
        DB::table('users')->where('id', $id)->update(array(
            'name' => $request->name, 'lastname' => $request->lastname, 'email' => $request->email, 'role' => $request->role));
        return redirect()->route('showUsers', $request->group_id)->with('success','Registry created successfully.');
    }

    public function deleteUser($id)
    {
        $user = User::find($id)->delete();
        return Redirect::back()->with('success','Registry successfully deleted.');
    }

    public function showDevices($id)
    {
    	$device = DB::table('campuses')->select('id','name')->distinct()->where('group_id', '=', Crypt::decrypt($id))->get();
    	return view('groups.showDevices',compact('device','id'));
    }

    public function createDevice($id)
    {
    	return view('groups.createDevice',compact('id'));
    }

    public function createDevicePost(Request $request)
    {
    	$this->validate($request,[ 
            'name' => 'required|max:30|unique:campuses',
        ]);
        $campus = new Campus;
        $campus->name = snake_case($request->name);
        $campus->group_id = $request->group_id;
        $campus->save();
        return redirect()->route('showDevices', Crypt::encrypt($request->group_id))->with('success','Registry created successfully.');
    }

    public function showInterfaces($id)
    {
        $interface=DB::table('interfaces')->select('id','interface','name','type','ip','campus_id')->where('campus_id', '=', $id)->get();
        $group_id = Campus::find($id);
        return view('groups.showInterfaces',compact('interface','id','group_id'));
    }

    public function createInterface($id)
    {
        return view('groups.createInterface',compact('id'));
    }

    public function createInterfacePost(Request $request)
    {
        $this->validate($request,[ 
            'interface' => 'required',
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

    public function editInterface($id)
    {
        $interface = Interfaces::find($id);
        return view('groups.editInterface',compact('id','interface'));
    }

    public function editInterfacePost(Request $request, $id)
    {
        $this->validate($request,[ 
            'interface' => 'required',
            'name_interface' => 'required|max:30|alpha_dash',
            'type_interface' => 'required|max:30|alpha_dash',
            'ip_interface' => 'required|ip',
        ]);
        DB::table('interfaces')->where('id', $id)->update(array(
            'interface' => $request->interface, 'name' => $request->name_interface, 'type' => $request->type_interface, 'ip' => $request->ip_interface));
        return redirect()->route('showInterfaces',$request->campus_id)->with('success','Registry updated successfully.');
    }

    public function deleteInterface($id)
    {
        $interface = Interfaces::find($id)->delete();
        return Redirect::back()->with('success','Registry successfully deleted.');
    }
}
