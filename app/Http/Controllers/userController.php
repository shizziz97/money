<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Rules\ValidPhone;

class userController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('admin' ,'0')->get();
        return view('users.index',compact('users','admins'));
    }

    public function create()
    {
        return view('users.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User;
        $request->validate( [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:6|confirmed',
        'phone' => ['required'  , 'unique:users,phone' ,new ValidPhone] ,
    ],[
    'phone.unique' => 'this number is already exists',
    ]
);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->phone = $request->phone;
        $user->location = $request->location;
        $user->address = $request->address;
        $user->save();
        alert()->success("$user->name successfully Added" ,'Successfully');
        return redirect()->route('users.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('users.edit',compact('user'));
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
        $request->validate([
            'name' => 'required|string|min:2|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
            'phone' => ['required'  , 'unique:users,phone,'.$id ,new ValidPhone] ,
        ]
    );
        $user = User::find($id);
        $user->phone = $request->phone;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->location = $request->location;
        $user->address = $request->address;
        $user->save();
        alert()->success("$user->name Info Updated", 'Successfully');
        return redirect()->route('users.show',$user->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $name = $user->name;
        $user->delete();
        alert()->success("$name Deleted" , 'Successfully');
        return redirect()->route('users.index');

    }
}
