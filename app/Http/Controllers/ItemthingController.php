<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\size;

class itemthingController extends Controller
{
     //add sale function 
     public function getaddsale($id){
        $item=Item::find($id);
        return view('items.addsale',compact('item'));
    }

    public function postaddsale(Request $request , $id){
        $item = Item::find($id);
        $item->sale = $request->sale;
        $item->price_after_sale = $item->price - (($item->price * $item->sale) / 100);
        $item->save();
        return redirect()->route('items.index');
    }

    //direct remove sale from item
    public function removesale($id){
        $item = Item::find($id);
        if($item->sale == 0)
        {
            alert()->info('No Sale','there is no sale on this item');
        }
        else{
        $item->sale=0;
        $item->price_after_sale= $item->price;
        $item->save();
        alert()->success("Sale Deleted","Successfully");}
        return redirect()->route('items.index');
    }

    //edit size function
    public function geteditsize($id){
        $item = Item::find($id);
        $sizeItems = Size::all();
        $sizes = [];
        foreach($sizeItems as $size){
            $sizes[$size->id] = $size->name;
        }
        return view('items.editsize',compact('sizes','item'));
    }
    public function posteditsize(Request $request , $id){
        $item = Item::find($id);
        $item->sizes()->sync($request->sizes , true);
        return redirect()->route('items.index');
    }

}
