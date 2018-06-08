@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
        <h2>Items <small>
        <a href="{{route('items.create')}}" class="btn btn-sm btn-primary" style="margin-left:30px">Add item </a>
        </small></h2>
        </div>
        <div class="col-md-6 text-right">
            <form class="form-inline float-right" action = "{{ route('items.search') }}" method="get">
                <div class="form-group">
                    <input type="text" class="form-control" name="s" placeholder="Parcode"
                    value="{{ isset($s) ? $s : '' }}"/>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-outline-primary my-2 my-sm-0">Search</button>
                </div>
            </form>
        </div>
    </div>
    <hr>
        <div class="col-md-12">                
        <table class="table">
            <thead>
                <tr>
                    <th> # </th>
                    <th>Name</th>
                    <th>Parcode</th>
                    <th>price</th>
                    <th>sale</th>
                    <th>Category</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
              @foreach($items as $item )
                <tr>
                    <th>{{$item->id}}</th>
                    <td>{{$item->name}}</td>
                    <td>{{$item->parcode}}</td>
                    <td>{{$item->price}}</td>
                    <td>{{$item->sale}}</td>
                    <td>{{$item->category->name}}</td>
                    <td>
                        <form method="post" action="{{route('items.destroy',$item->id)}}">
                            @csrf
                            @method('delete')
                            <a href="{{route('items.edit',$item->id)}}" class="btn btn-primary">Edit</a>
                            <a href="{{route('items.show',$item->id)}}" class="btn btn-info">More Info</a>
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