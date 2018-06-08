<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Item;
use App\Image;
use App\Size;
use App\Photo;
use App\Countorder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class orderController extends Controller
{
    private $orderCount = 0;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::all();
        return view('order.index',comapct('items'));
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
        $user = User::find($order->user_id);
        $user->sales += 1 ;
        if($this->orderCount == '0'){
            $this->orderCount = new Countorder;
        }
        $this->orderCount->orders_count += 1; 
        $order->delete();
        alert()->success('you are Done','successfully');
        return redirect()->route('order.index');
    }   

    public function acceptable()
    {
        $orders = Order::where('accept','1')->get();
        return view('orders.acceptable',compact('orders'));
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
