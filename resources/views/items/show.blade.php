@extends('layouts.app')
@section('stylesheet')
<style>
    .row span{
        font-size: 15px;
        margin-right: 20px;
        margin-top: 20px;
    }
</style>
@endsection
@section('content')
<div class="container">
<div class="row">
    @foreach($photos as $photo)
        <div class="col-md-4 img">
            <img src="{{asset('storage/' . $photo->photo)}}" class="img-rounded" />
        </div>
    @endforeach
</div>
<div class="row">
    <div class="col-md-6">
        Sizes : 
    @foreach($item->sizes as $size)
    <span class="badge badge-primary">{{$size->name}}</span>
    
    @endforeach
    </div>
</div>
<div class="row">
<div class="col-md-3">
Price : {{$item->price_after_sale}}
</div>
<div class="col-md-3">
Parode : {{ $item->parcode }}
</div>
<div class="col-md-3">
sale : {{ $item->sale }}%
</div>
<div class="col-md-3">
Real Price : {{ $item->price }}
</div>
</div>
<div class="row">
        <form method="post" action="{{route('items.destroy',$item->id)}}">
                @csrf
                @method('delete')
                <a href="{{route('items.edit',$item->id)}}" class="btn btn-primary">Edit</a>
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
</div>
</div>
@stop