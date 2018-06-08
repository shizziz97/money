<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Item;
use App\Image;
use App\Size;
use App\Photo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
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
        $items = Item::all();
        return view('items.index',compact('items','sizes'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cats = Category::all();
        $sizes = Size::all();
        return view('items.add',compact('cats','sizes'));
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
            'price' => 'required|max:1000000' ,
            'parcode' => 'unique:items,parcode' ,
            'sale' => 'min:1|max:100' ,
            'mainPhoto' => 'required|file|image|mimes:jpeg,png,gif,webp|max:2048' ,
            'photo.*' => 'required|file|image|mimes:jpeg,png,gif,webp|max:2048'
            
        ]);
        $item = new Item();
        $item->parcode = $request->parcode;
        $item->category_id = $request->category_id;
        $item->name = $request->name;
        $item->price = $request->price;
        $item->sale = $request->sale;
        $item->mainPhoto = $request->mainPhoto;
        if($item->sale > 0){
            $item->price_after_sale = $item->price - (($item->price * $item->sale) / 100);
        }
        else{
            $item->price_after_sale = $item->price;
        }
        $item->save();
        $id = $item->id;

         //main photo 
         $file = $request->mainPhoto;
         $filename = 'main' . '-' . $id . '.' . $file->getClientOriginalExtension();        
         Storage::put($filename , file_get_contents($file));
         $item->mainPhoto = $filename;
       
         $item->save();
        //save the image 
        $files = $request->file('photos') ;
        if(!empty($files)){
            $i = 0 ;
            foreach($files as $file){
                $filename = $id. '-'. $i .'.' . $file->getClientOriginalExtension();        
                Storage::put($filename , file_get_contents($file));
                $i++;
                $photo = new Photo;
                $photo->photo = $filename;
                $photo->item_id = $id;
                $photo->save();
            }
        //end save the image

        //save size of this item 
            $item->sizes()->sync($request->sizes,false);

        //end save size

        alert()->success('created Successfully' , 'success');
        return redirect()->route('items.index');
    }
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $photos = DB::table('photos')->where('item_id',$id)->get();
        $item = Item::find($id);
        return view('items.show',compact('photos','item'));        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Item::find($id);
        $categories = Category::all();
        $sizeItems = Size::all();
        $cats =[];
        $sizes = [];
        foreach($categories as $category){
            $cats[$category->id] = $category->name;
        }
        foreach($sizeItems as $size){
            $sizes[$size->id] = $size->name;
        }
        return view('items.edit',compact('item','cats','sizes'));
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
            'price' => 'required|max:1000000' ,
            'parcode' => "unique:items,parcode,$id"  ,
            'sale' => 'min:1|max:100' ,
            'mainPhoto' => 'file|image|mimes:jpeg,png,gif,webp|max:2048',
            'photo.*' => 'file|image|mimes:jpeg,png,gif,webp|max:2048'
            
        ]);
        $item = Item::find($id);
        $item->parcode = $request->parcode;
        $item->category_id = $request->category_id;
        $item->name = $request->name;
        $item->price = $request->price;
        $item->sale = $request->sale;
        if($item->sale > 0){
            $item->price_after_sale = $item->price - (($item->price * $item->sale) / 100);
        }
        else{
            $item->price_after_sale = $item->price;
        }
        if($request->mainPhoto){
            $file = $request->mainPhoto;
            $filename = 'main' . '-' . $item->id . '.' . $file->getClientOriginalExtension();        
            Storage::put($filename , file_get_contents($file));
            $item->mainPhoto = $filename;
           
        }
        $item->save();
        $id = $item->id;
        //show if any image uploaded 
        $files = $request->file('photos');
        if(!empty($files)){
            $photos = DB::table('photos')->where('item_id',$id)->get();
            foreach($photos as $photo){
               $filename = $photo->photo;
               Storage::delete($filename);
               DB::table('photos')->where('item_id',$id)->delete();               
             }
            $i = 0 ;
            foreach($files as $file){
                $filename = $id. '-'. $i .'.' . $file->getClientOriginalExtension();        
                Storage::put($filename , file_get_contents($file));
                $i++;
                $photo = new Photo;
                $photo->photo = $filename;
                $photo->item_id = $id;
                $photo->save();
            }
        }
        //save the size 
        $item->sizes()->sync($request->sizes , true);

        alert()->success($item->parcode . "Updated" , "Successfully" );
        return redirect()->route('items.index');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Item::find($id);
        $name = $item->parcode;
        $photos = DB::table('photos')->where('item_id',$id)->get();
        foreach($photos as $photo){
           $filename = $photo->photo;
           Storage::delete($filename);
         }
        DB::table('photos')->where('item_id',$id)->delete();
        $item->delete();
        alert()->success("$name Deleted","Successfully");
        return redirect()->route('items.index');
    }

    //this function return the search of the box in the right in index page

    public function search(Request $request){
        $s = $request->s;
        $search = Item::search($s)->get();
        return view('items.search',compact('search'));
    }
   
}
