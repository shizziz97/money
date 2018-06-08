<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use App\Rules\ValidPhone;

class AdminController extends Controller
{

    public function __construct(){
        $this->middleware('admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = User::where('admin','1')->get();
        return view('admins.index',compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admins.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $admin = new User();
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'phone' => ['required'  , 'unique:users,phone' ,new ValidPhone] ,
        ],[
        'phone.unique' => 'this number is already exists',
        ]);
        $admin->name = $request->name;
        $admin->admin = "1";
        $admin->email = $request->email;
        $admin->info = $request->info;
        $admin->phone = $request->phone;
        $admin->address = $request->address;
        $admin->location = $request->location;
        $admin->password = Hash::make($request->password);
        $admin->save();
        alert()->success('New Admin Created' ,'Successfully');
        if($admin)
        return redirect()->route('admins.index');
        return redirct()->route('/home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $admin = User::find($id);
        if($admin->admin)
        return view('admins.show',compact('admin'));
        return redirect()->route('/home');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $admin = User::find($id);
        if($admin->admin)
        return view('admins.edit',compact('admin'));
        return redirect()->route('/home');
 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $admin = User::find($id);
        if($admin->admin){
            $request->validate([
                'name' => 'required|string|min:2|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,'.$id,
                'phone' => ['required'  , 'unique:users,phone,'.$id ,new ValidPhone] ,    
            ]);
            $admin->name = $request->name;
            $admin->email = $request->email;
            $admin->phone = $request->phone;
            $admin->address = $request->address;
            $admin->info = $request->info;
            $admin->location = $request->location;
            $admin->save();
            alert()->success('Update Admin' ,'Successfully');
            return redirect()->route('admins.index');
        }
        return redirect()->route('/home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $admin = User::find($id);
        if($admin->admin){
            $name = $admin->name;
            $admin->delete();
            alert()->success("$name Admin Deleted",'Successfully');
            return redirect()->route('admins.index');    
        }
            return redirect()->route('/home');
            
}
}
