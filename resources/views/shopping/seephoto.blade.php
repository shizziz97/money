@extends('layouts.app')
@section('stylesheet')
<style>
    img{
        width:100%;
        height:100%;
        border:2px solid #333; 
    }
</style>
@endsection
@section('content')
<div class="container">
    <div class="back"> 
        <a href="{{route('home.userOrder')}}" class="btn btn-dark">back to my orders</a> 
    </div>
        
        <div class="row justify-contain-center">
            <div class="col-md-8">
                <div class="card-image">
                    <img class="img-responsive" src="{{asset('storage/' . $photo)}}"/>
                </div>
            </div>
        </div>
</div>
@endsection