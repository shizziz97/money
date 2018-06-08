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
               <div class="card-header">{{ __('Edit Item') }}</div>

               <div class="card-body">
                   {!! Form::model($item,['route'=>['items.update',$item->id] , 'files'=>'true'] ) !!}
                   @csrf
                   @method('put')
                   <!-- name -->
                   <div class="form-group row{{ $errors->has('name') ? ' has-error' :'' }}">
                 {!! Form::label('name','Name ', ['class'=> 'col-md-3 col-form-label control-label text-md-right']) !!}    
                       <div class="col-md-7">
                 {!! Form::text('name', null , ['class' => 'form-control']) !!}
                 @if ($errors->has('name')) 
                 <span class="help-block">
                        <strong>{{ $errors->first('name') }} </strong>
                     </span>
                   @endif
                        </div>
                    </div>

                    <!-- categories -->
                    <div class="form-group row{{ $errors->has('category_id') ? ' has-error' :'' }}">                        
                        {!! Form::label('category_id','Category ', ['class'=> 'col-md-3 col-form-label control-label text-md-right']) !!}    
                        <div class="col-md-7">
                        {!! Form::select('category_id', $cats ,null , ['class' => 'form-control']) !!}
                        @if ($errors->has('category_id')) 
                        <span class="help-block">
                               <strong>{{ $errors->first('category_id') }} </strong>
                            </span>
                          @endif
                               </div>
                           </div>
                           <!-- sizes -->
                           <div class="form-group row{{ $errors->has('size') ? ' has-error' :'' }}">                        
                            {!! Form::label('size','Size ', ['class'=> 'col-md-3 col-form-label control-label text-md-right']) !!}    
                            <div class="col-md-7">
                            {!! Form::select('sizes[]', $sizes, null, ['class'=>'form-control','multiple'=>'multiple']) !!}
                            @if ($errors->has('size')) 
                            <span class="help-block">
                                   <strong>{{ $errors->first('size') }} </strong>
                                </span>
                              @endif
                                   </div>
                               </div>
                        <!-- parcode -->
                        <div class="form-group row{{ $errors->has('parcode') ? ' has-error' :'' }}">
                            {!! Form::label('parcode','Parcode ', ['class'=> 'col-md-3 col-form-label control-label text-md-right']) !!}    
                                <div class="col-md-7">
                            {!! Form::text('parcode', null , ['class' => 'form-control']) !!}
                            @if ($errors->has('parcode')) 
                            <span class="help-block">
                                <strong>{{ $errors->first('parcode') }} </strong>
                                </span>
                            @endif
                                </div>
                            </div>    
                                  <!-- price -->
                        <div class="form-group row{{ $errors->has('price') ? ' has-error' :'' }}">
                                {!! Form::label('price','Price ', ['class'=> 'col-md-3 col-form-label control-label text-md-right']) !!}    
                                    <div class="col-md-7">
                                {!! Form::number('price', null , ['class' => 'form-control']) !!}
                                @if ($errors->has('price')) 
                                <span class="help-block">
                                    <strong>{{ $errors->first('price') }} </strong>
                                    </span>
                                @endif
                                    </div>
                                </div>     
                                   <!-- sale -->
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
                                
                        {{-- main photo --}}
                            <div class="form-group row">
                                    <label for="mainPhoto" class="col-md-4 col-form-label text-md-right">{{ __('Main Photo') }}</label>
        
                                    <div class="col-md-6">
                            <input type="file" name="mainPhoto" class="form-control">
                            <small>if you dont upload any photo.. the old photo will keep it , but if you upload.. the old photo will be deleted it , and the new one is become for this item</small>
                            
                                    </div>
                                <!-- more photo -->
                                <div class="form-group row{{ $errors->has('photo') ? ' has-error' :'' }}">
                          {!! Form::label('photo','Upload Photo ', ['class'=> 'col-md-3 col-form-label control-label text-md-right']) !!}    
                          <div class="col-md-7">
         <input type="file" name="photos[]" multiple class="form-control">
         <small>if you dont upload any photo.. the old photo will keep it , but if you upload.. the old photo will be deleted it , and the new one is become for this item</small>
                                @if ($errors->has('photo')) 
<span class="help-block">
    <strong>{{ $errors->first('photo') }} </strong>
    </span>
@endif
    </div>
</div>



                    <div class="form-group row">
                   <div class="col-md-7 offset-md-3 pull-right">                   
                       
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
@endsection