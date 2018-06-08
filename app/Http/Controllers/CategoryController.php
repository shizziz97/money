<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class categoryController extends Controller
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
        $cats = Category::all();//cats == categories
        //items == how many items in this category 
        return view('categories.index',compact('cats'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cat = new Category();
        $request->validate([
            'name' => 'required|min:2|max:255|unique:categories,name'
        ]);
        $cat->name = $request->name;
        $cat->save();
        alert()->success("$cat->name Category has been Added" , 'successfully');
        return redirect()->route('categories.index');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cat = Category::find($id);
        return view('categories.edit',compact('cat'));
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
        $cat = Category::find($id);
        $request->validate([
            'name' => 'required|min:2|max:255|unique:categories,name,'.$id
            ]);
        $cat->name = $request->name;
        $cat->save();
        if($cat->name != $request->name)
        alert()->success("$cat->name updated",'successfully');
        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cat = Category::find($id);
        $name = $cat->name;
        $cat->delete();
        alert()->success("$name Deleted" , "successfully");
        return redirect()->route('categories.index');
        
    }
}
