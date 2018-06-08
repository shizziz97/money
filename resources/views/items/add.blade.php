@extends('layouts.app')
@section('link')
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
                <div class="card-header">{{ __('Adding New Item') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('items.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="category_id"class="col-md-4 col-form-label text-md-right">{{  __('Category')}}</label>

                            <div class="col-md-6">
                                <select class="form-control" name="category_id" id="demo">
                                    @foreach($cats as $cat)
                                    <option value="{{$cat->id}}">{{$cat->name}}</option>
                                      @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                                <label for="parcode" class="col-md-4 col-form-label text-md-right">{{ __('Parcode') }}</label>
    
                                <div class="col-md-6">
                                    <input id="parcode" type="text" class="form-control{{ $errors->has('parcode') ? ' is-invalid' : '' }}" name="parcode" value="{{ old('parcode') }}" required autofocus>
    
                                    @if ($errors->has('parcode'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('parcode') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group row">
                                    <label for="price" class="col-md-4 col-form-label text-md-right">{{ __('Price') }}</label>
        
                                    <div class="col-md-6">
                                        <input type="number" max="1000000" class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}" id="price" name="price" value="{{ old('price') }}" required autofocus>
                                        @if ($errors->has('price'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('price') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                            </div>
                            {{--  sizes  --}}
                            <div class="form-group row">
                                <label for="sizes" class="col-md-4 col-form-label text-md-right">{{ __('Sizes') }} </label>
                                <div class="col-md-6">                                    
                                <select class="select2-multi form-control" name="sizes[]" multiple="multiple">
                                    @foreach($sizes as $size)
                                        <option value="{{$size->id}}" >{{$size->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            </div>
                          
                            <div class="form-group row">
                                    <label for="sale" class="col-md-4 col-form-label text-md-right">{{ __('Sale') }}</label>
        
                                    <div class="col-md-6">
                                        <input type="number" max="100" class="form-control{{ $errors->has('sale') ? ' is-invalid' : '' }}" id="sale" name="sale" value="{{ old('sale') }}" required autofocus>
                                        @if ($errors->has('sale'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('sale') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                            </div>
                        {{-- main photo --}}
                            <div class="form-group row">
                                    <label for="mainPhoto" class="col-md-4 col-form-label text-md-right">{{ __('Main Photo') }}</label>
        
                                    <div class="col-md-6">
                            <input type="file" name="mainPhoto" class="form-control">
                                    </div>
                       {{-- more photos --}}
                            <div class="form-group row">
                                    <label for="photos" class="col-md-4 col-form-label text-md-right">{{ __('More Photos') }}</label>
        
                                    <div class="col-md-6">
                            <input type="file" name="photos[]" multiple class="form-control">
                                    </div>
                            </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Add') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection