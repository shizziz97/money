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
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">{{ __('Edit Admin') }}</div>

               <div class="card-body">
                   {!! Form::model($admin,['route'=>['admins.update',$admin->id]]) !!}
                   @csrf
                   @method('put')
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

                    <div class="form-group row{{ $errors->has('email') ? ' has-error' :'' }}">
                {!! Form::label('email','E-mail ', ['class'=> 'col-md-3 col-form-label control-label text-md-right']) !!}    
                       <div class="col-md-7">
                {!! Form::email('email', null , ['class' => 'form-control']) !!}
                @if ($errors->has('email')) 
                <span class="help-block">
                 <strong>  {{ $errors->first('email') }} </strong>
                 </span>
               @endif
                           </div>
                       </div>
         
           <div class="form-group row{{ $errors->has('phone') ? ' has-error' :'' }}">
                   {!! Form::label('phone','Phone ', ['class'=> 'col-md-3 col-form-label control-label text-md-right']) !!}    
                           <div class="col-md-7">
                   {!! Form::text('phone', null , ['class' => 'form-control']) !!}
                   @if ($errors->has('phone')) 
                   <span class="help-block">
                           <strong> {{ $errors->first('phone') }}</strong>
                         </span>
                       @endif               
                             </div>
                           </div>

           <div class="form-group row{{ $errors->has('address') ? ' has-error' :'' }}">
                   {!! Form::label('address','Address ', ['class'=> 'col-md-3 col-form-label control-label text-md-right']) !!}    
                           <div class="col-md-7">
                   {!! Form::text('address', null , ['class' => 'form-control']) !!}
                   @if ($errors->has('address')) 
                   <span class="help-block">
                          <strong> {{ $errors->first('address') }}</strong>
                         </span>
                       @endif
                               </div>
                           </div>

           <div class="form-group row{{ $errors->has('location') ? ' has-error' :'' }}">
                   {!! Form::label('location','Location ', ['class'=> 'col-md-3 col-form-label control-label text-md-right']) !!}    
                           <div class="col-md-7">
                   {!! Form::text('location', null , ['class' => 'form-control']) !!}
                   @if ($errors->has('location')) 
                   <span class="help-block">
                          <strong> {{ $errors->first('location') }} </strong>
                         </span>
                       @endif
                               </div>
                           </div>
            <div class="form-group row{{ $errors->has('phone') ? ' has-error' :'' }}">
                {!! Form::label('phone','Phone ', ['class'=> 'col-md-3 col-form-label control-label text-md-right']) !!}    
                        <div class="col-md-7">
                            
                            {!! Form::textarea('info', null, ['class'=>'form-control']) !!}
                            
                            @if ($errors->has('phone')) 
                <span class="help-block">
                        <strong> {{ $errors->first('phone') }}</strong>
                        </span>
                    @endif               
                            </div>
                        </div>

           <div class="form-group row">
                   <div class="col-md-7 offset-md-3 pull-right">                   
                       
               <a href="{{route('admins.index')}}"  class="btn btn-danger">Cancel</a>         
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