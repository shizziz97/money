@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="table table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th> Parcode </th>
                        <th> How many</th>
                        <th> Picture</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
@foreach($orders as $order)
                    <tr>
                        <td>
<a href="{{route('order.show',$order->id)}}" class="btn-default">{{$order->item->parcode}}</a>
                        </td>
                        <td>{{$order->many}}</td>
                        <td>
                            <img src="{{asset('storage/' . $order->photo)}}" width="40px" height="30px"/>
                        </td>
                        <td>
                            <form action="{{route('order.destroy',$order->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <a href="{{route('order.Done',$order->id)}}" class="btn btn-success">Done</a>
                                <a href="{{route('order.show',$order->id)}}" class="btn btn-info">More Info</a>
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
@endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection