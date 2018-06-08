@extends('layouts.app')
@section('content')
<div class="container">
    <div class="col-md-12">
        <a href="{{route('admins.create')}}" class="pull-right btn btn-primary">Add admin </a>
        <table class="table">
            <thead>
                <tr>
                    <th> # </th>
                    <th>Name</th>
                    <th>Email</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
              @foreach($admins as $admin )
                <tr>
                    <th>{{$admin->id}}</th>
                    <td>{{$admin->name}}</td>
                    <td>{{$admin->email}}</td>
                    <td>
                        <form method="post" action="{{route('admins.destroy',$admin->id)}}">
                            @csrf
                            @method('delete')
                            <a href="{{route('admins.edit',$admin->id)}}" class="btn btn-primary">Edit</a>
                            <a href="{{route('admins.show',$admin->id)}}" class="btn btn-info">More Info</a>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
              @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop