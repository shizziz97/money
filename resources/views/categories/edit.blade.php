@extends('layouts.app')
@section('stylesheet')
<style>
.btn-primary{
    margin-top:15px;
}
.help-block{
    color:red;
}
</style>
@endsection
@section('content')
<div class="container">
 <div class="row justify-content-center">
     <div class="col-md-4">
<div class="card">
        {!! Form::model($cat, ['route'=>['categories.update',$cat->id]]) !!}
@csrf
@method('put')

<div class="form-group{{ $errors->has('name') ? ' has-error' :'' }}">
    <div class="card-header">  
        Change Name Of Category
    </div>
    <div class="card-body">  
        {!! Form::text('name', null , ['class' => 'form-control']) !!}
        @if ($errors->has('name')) 
        <span class="help-block">
               <strong>{{ $errors->first('name') }} </strong>
            </span>
          @endif
               {!! Form::submit('Save', ['class'=>'btn btn-primary float-right']) !!}
               <div class="clearfix"></div>
        </div>
        </div>
{!! Form::close() !!}
    </div>
    </div>
 </div>
</div>
@endsection
