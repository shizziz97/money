@extends('layouts.app')
@section('stylesheet')
<style>
    .help-block{
    color: red;
 }
 </style>
@stop
@section('content')
<div class="container">
    <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Add Sale') }}</div>

                    <div class="card-body">
 {!! Form::model($item,['route'=>['itemthing.postaddsale',$item->id] , 'files'=>'true'] ) !!}
 <div class="form-group row{{ $errors->has('sale') ? ' has-error' :'' }}">
        {!! Form::label('sale','Sale ', ['class'=> 'col-md-3 col-form-label control-label text-md-right']) !!}    
            <div class="col-md-7">
        {!! Form::number('sale', null , ['class' => 'form-control']) !!}
        @if ($errors->has('sale')) 
        <span class="help-block">
            <strong>{{ $errors->first('sale') }} </strong>
            </span>
        @endif
            </div>
        </div>
        <div class="form-group row">
                <div class="col-md-7 offset-md-3 float-right">                   
                    
            <a href="{{route('items.index')}}"  class="btn btn-danger">Cancel</a>         
            {!! Form::submit('Save Changes', ['class'=>'btn btn-primary']) !!}
                </div>
                        </div>
        {!! Form::close() !!}
              
                    </div>
                </div>
            </div>
    </div>
</div>  
@stop