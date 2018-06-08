<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Size;
use App\Item;
use App\Photo;
use App\Order;
use Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class HomeShoppingController extends Controller
{
    public function __construct()
    {
        // Alternativly
        $this->middleware('auth', ['except' => ['index']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::all();
        return view('shopping.HomeShopping',compact('items'));
    }


    /**
     * Show the form for creating a new ordering .
     *
     * @return \Illuminate\Http\Response
     */
    public function createOrder($id)
    {
        $photos = DB::table('photos')->where('item_id',$id)->get();
        $item = Item::find($id);
        $sizes = Size::all();        
        return view('shopping.order',compact('item','photos','sizes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $order = new Order;
        $order->item_id = $request->item_id;
        $order->photo =$request->photo;
        $order->size_id = $request->size;
        $order->user_id = $request->user_id; 
        $order->many = $request->many;
        $order->save();
        alert()->success('we will talk to you to certain , please check your mobile phone','Successfully');
        return redirect()->route('home.index');
    }

    //this function to make the user show all his orders and he can delete , edit or update 

        public function userOrder(){
            $user = Auth::user()->id;
            $orders = Order::where('user_id',$user)->get();
            return view('shopping.userOrder',compact('orders'));
        }

        // this function to display the photo from the order 

        public function seephoto($photo){
            return view('shopping.seephoto',compact('photo'));
        }

        //this function to refturn the profile for user 

        public function profile(){
            return view('shopping.profile');
        }
    /**
     * 
     * 
     * 
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }


    public function destroy($id)
    {
        $order = Order::find($id);
        if($order->accept){
        alert()->info('Sorry You Cant delete it , because the product is near from your house ','Cant Delete');
        return redirect()->route('home.profile');
    }
        $order->delete();
        alert()->success('Deleted the order' , 'successfully');
        return redirect()->route('home.profile');
    }

}
