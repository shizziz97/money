<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Item;
use App\Image;
use App\Size;
use App\Photo;
use App\Order;
use App\Countorder;
use App\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\OrderDone;

class orderController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::all();
        return view('orders.index',compact('orders'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function accept($id)
    {
        $order = Order::find($id);
        $order->accept = "1";
        $order->save();
        return redirect()->route('order.index');
    }

    public function Done($id)
    {
        $order = Order::find($id);        
        $orderDone = OrderDone::find('1');
        if(empty($orderDone)){
            $orderDone = new OrderDone;
            $orderDone->id = '1';
            $orderDone->money = $order->item->price_after_sale;
            $orderDone->orders_count =1;
            $orderDone->save(); 
        }
        else{
            $orderDone->money += $order->item->price_after_sale;
            $orderDone->orders_count +=1;
            $orderDone->save(); 
        }
        $user = User::find($order->user_id);
        $user->sales += 1 ;
        $order->delete();
        alert()->success('you are Done','successfully');
        return back();
    }   

    public function acceptable()
    {
        $orders = Order::where('accept','1')->get();
        $orderDone = OrderDone::find('1');
        return view('orders.acceptable',compact('orders','orderDone'));
    }

    //this function to reset the orders done  
    public function reset(){
        $order = OrderDone::find('1');
        if($order){
        $order->delete();
    }
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::find($id);
        return view('orders.show',compact('order'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::find($id);
        $order->delete();
        alert()->info('successfully Deleted','order not delivery');
        return redirect()->route('order.index');
    }
}
