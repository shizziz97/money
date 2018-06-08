@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
        <h2>Searching</h2>
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
{{-- table of search --}}
<div class="row">
    <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Detail</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($search as $s)
                        <tr>
                            <td>
                                <u>
                                <h3> <a href="{{route('items.show',$s->id)}}">   {{ $s->parcode }}</a>
                                </h3> <small>{{$s->name}}</small>
                                
                                 </u>
                                <br>
                            </td>
                            <td class="float-right">
                                <form action="{{ route('items.destroy', $s->id)  }}"
                                    method="post">
                                    @csrf
                                    @method('DELETE')
                                    <a href="{{route('items.edit',$s->id)}}" class="btn btn-sm btn-primary ">Edit</a>
                                    <a href="{{route('itemthing.removesale',$s->id)}}" class="btn btn-sm btn-secondary">Remove Sale</a>                                        
                                    <a href="{{route('itemthing.getaddsale',$s->id)}}" class="btn btn-sm btn-success">Add Sale</a>                                    
                                    <button class="btn btn-sm btn-danger" type="submit">
                                            Delete 
                                        </button>
                                        <a href="{{route('itemthing.geteditsize',$s->id)}}" class="btn btn-sm btn-warning">edit Size</a>                                        
                                    <a href="{{route('items.show',$s->id)}}" class="btn btn-sm btn-info">More Info</a>                                    
    
                                </form>                            
                                                      </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="2" align="center">
                                Empty!! Sorry I can't found
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
    </div>
</div></div>

@stop