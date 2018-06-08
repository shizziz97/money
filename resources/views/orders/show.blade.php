@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4 justify-content-center">
            <div class="card" style="width:18rem">
                <img class="card-img-top" src="{{$order->photo}}" alt="card-image-cap"/>
                <div class="card-body">
                    <div class="card-title">{{$order->item->parcode}}</div>
                    <span class="text-danger">{{$order->item->price_after_sale}}$</span>
                    <br/>
                    <span class="text-black">{{$order->size->name}} size</span>
                </div>
            </div>

            </div>
        </div>
    </div>
</div>
@endsection