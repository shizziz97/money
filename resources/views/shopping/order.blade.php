@extends('layouts.app')
@section('stylesheet')
<style>
    .btn-primary{
        width:250px;
        height:100%;
    }
    .hidden{
        display:none;
    }
        .check
        {
            opacity:0.5;
            color:#996;
            
        }
        </style>
@endsection
@section('content')
<div class="container">
    <div class="row">
        <form action="{{route('home.store')}}" method="post">
            @csrf
            <input name="item_id" type="hidden" value="{{$item->id}}"/>
            <input type = "hidden" name="user_id"  value = "{{Auth::user()->id}}">
            
        @foreach($photos as $photo)  
            
<div class="col-md-3">
                <div class="col-md-3"><label class="btn btn-default">
                    <img src="{{asset('storage/' . $photo->photo)}}" class="img-check">
                    <input type="checkbox" name="photo" id="photo" value="{{$photo->photo}}" class="hidden">
                </label>
                </div>
            </div>

        @endforeach
        {{--  sizes  --}}
        <div class="form-group row">
                <label for="size" class="col-md-4 col-form-label text-md-right">{{ __('Choose your Size') }} </label>
                <div class="col-md-6">                                    
                <select class="select2-multi form-control" name="size">
                    @foreach($sizes as $size)
                        <option value="{{$size->id}}" >{{$size->name}}</option>
                    @endforeach
                </select>
            </div>
            </div>

            {{-- many --}}
            <div class="form-group row">
                <label for="many" class="col-md-4 col-form-label text-md-right">{{ __('Choose How Many')}}</label>
                <div class="col-md-6">
                    <input type="number" min="1" max="20" name="many">
                </div>
            </div>
   <div class="form-group">
    <button type="submit" class="btn btn-success"> Buy </button>
   </div>
        </form>
    </div>
</div>
@stop
@section('script')
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous"></script> 
    <script type="text/javascript">        
$(document).ready(function(e){
    $(".img-check").click(function(){
        $(this).toggleClass("check");
    });
});
</script>
@endsection