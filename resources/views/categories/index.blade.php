@extends('layouts.app')
@section('stylesheet')
<style>
    .help-block{
        color: red;
    }
</style>
@endsection
@section('content')
<div class="container">
    <div class="col-md-12">
<div class="create float-md-right">
    {!! Form::open(['route'=>['categories.store']]) !!}
    @csrf     
    <div class="form-group row{{ $errors->has('name') ? ' has-error' :'' }}">
            {!! Form::label('name','Name ', ['class'=> ' col-form-label control-label text-md-right']) !!}    
                  <div class="col-md-8">
            {!! Form::text('name', null , ['class' => 'form-control']) !!}
            @if ($errors->has('name')) 
            <span class="help-block">
                   <strong>{{ $errors->first('name') }} </strong>
                </span>
              @endif
                   </div>
                   <div class="col-md-2">
                   {!! Form::submit('Add', ['class'=>'btn btn-primary']) !!}
               </div>
            </div>
    {!! Form::close() !!}
</div>
<div class="clearfix"></div>
<h3>Categories</h3>
        @if(count($cats) == 0)
            <p>
                there's no categories 
            </p>
            @else

        <table class="table">
            <thead>
                <tr>
                    <th> # </th>
                    <th>Name</th>
                    <th>Items</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
              @foreach($cats as $cat )
                <tr>
                    <th>{{$cat->id}}</th>
                    <td>{{$cat->name}}</td>
                    <td>{{$cat->items()->count()}}</td>
                    <td>
                        {!! Form::open(['route'=>['categories.destroy',$cat->id]]) !!}
                            @csrf
                            @method('delete')
                            <a href="{{route('categories.edit',$cat->id)}}" class="btn btn-primary">Edit</a>
                            {!! Form::submit('Delete',['class'=>'btn btn-danger']) !!}
                            {!! Form::close() !!}
                    </td>
                </tr>
              @endforeach
            </tbody>
        </table>
        @endif
    </div>
</div>
@stop