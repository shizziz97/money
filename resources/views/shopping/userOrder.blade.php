@extends('layouts.app')
@section('content')
<div class="container">
   <div class="table-responsive">
      <table class="table table-hover">
        <thead>
            <tr>
                <th>Photo (click to see it bigger)</th>
                <th>Size</th>
                <th>Price</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr>
                    <td> 
                        <a href="{{route('home.seephoto',$order->photo)}}">
                          <img src="{{asset('storage/' . $order->photo)}}" width="40px" height="40px" />  
                        </a>    
                    </td>
                    <td>{{$order->size->name}}</td>
                    <td>{{$order->item->price_after_sale}}</td>
                    <td>
                        <form action="{{route('home.destroy',$order->id)}}">
                            @csrf
                            @method('DELETE')
                            <a href="{{route('home.edit',$order->id)}}" class="btn btn-primary">Edti Order</a>
                            <a href="{{route('home.seephoto',$order->photo)}}" class="btn btn-info">See Photo </a>
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
      </table>
     </div>
</div>
@endsection