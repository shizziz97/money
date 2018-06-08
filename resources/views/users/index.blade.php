@extends('layouts.app')
@section('content')
<div class="container">
    <div class="col-md-12">
        <a href="{{route('users.create')}}" class="pull-right btn btn-primary">Add User </a>
            @if(count($users) == 0)
            <p>
                there's no users 
            </p>
            @else
        <table class="table">
            <thead>
                <tr>
                    <th> # </th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Sales</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
              @foreach($users as $user )
                <tr>
                    <th>{{$user->id}}</th>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td><?php echo rand(10,200); ?></td>
                    <td>
                        <form method="post" action="{{route('users.destroy',$user->id)}}">
                            @csrf
                            @method('delete')
                            <a href="{{route('users.edit',$user->id)}}" class="btn btn-primary">Edit</a>
                            <a href="{{route('users.show',$user->id)}}" class="btn btn-info">More Info</a>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
              @endforeach
            </tbody>
        </table>
        @endif
    </div>
</div>
@stop