@extends('layouts.app')
@section('stylesheet')
<style>
    img{
        width:200px;
        height:200px;
    }
</style>
@endsection
@section('content')
<div class="container">
        <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="text-center">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT9lttfBcwHzZlP6IMZacTsZEYOaOK2bC5EApc1YrPTdgGuyryu" 
            class="rounded-circle" >
        </div>
        <div class="info">
            <p> Name : {{$user ->name}}</p>
            <p> E-mail : {{$user->email}} </p>
            <p> Location : {{$user->location}} </p>
            <p> Phone : {{$user->phone}}</p>
            <p> Address : {{$user->address}}</p>
            <p> Sales : {{ $user->sales}}</p>
            <form method="post" action="{{route('users.destroy',$user->id)}}">
                    @csrf
                    @method('delete')
                    <a href="{{route('users.edit',$user->id)}}" class="btn btn-primary">Edit</a>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
        </div>
    </div>
    </div>
</div>
@stop