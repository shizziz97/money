@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        @foreach($items as $item)
<div class="col-md-4">
        <div class="card" style="width: 18rem;">
                        <a href="{{route('items.show',$item->id)}}"> 
                                        
                <img class="card-img-top" src="{{asset('storage/' . $item->mainPhoto)}}" alt="Card image cap">
                        </a>
                <div class="card-body">
                        <h5 class="card-title">{{$item->name}}</h5>
                        <span class="text-danger">{{$item->price_after_sale}}</span>
                      <a href="{{route('home.order',$item->id)}}"> 
                         <span class="btn btn-success float-right btn-sm">Add To Card </span>
                      </a> 
                </div>
              </div>
</div>
        @endforeach
    </div>
</div>
@stop