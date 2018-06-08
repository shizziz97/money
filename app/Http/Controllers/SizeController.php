<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Size;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->middleware('admin');
    }
    public function index()
    {
        $sizes = Size::all();
        return view('sizes.index',compact('sizes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $size = new Size();
        $size->name = $request->name;
        $size->save();
        alert()->success('Size Added' ,'Successfully');
        return redirect()->route('sizes.index');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $size = Size::find($id);
        return view('sizes.edit',compact('size'));
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
        $size = Size::find($id);
        $request->validate([
            'name' => 'required'
        ]);
        if($size->name == $request->name)
        {
            return redirect()->route('sizes.index');
        }
        else{
            $size->name = $request->name;
            $size->save();
            alert()->success('Size Deleted' , 'Successfully');
            return redirect()->route('sizes.index');            
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $size = Size::find($id);
        $name = $size->name;
        $size->delete();
        alert()->success("$name Deleted" , "successfully");
        return redirect()->route('sizes.index');
    }
}
