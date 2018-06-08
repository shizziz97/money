@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ Auth::user()->name }}</div>
                <div class="card-body">
                    <div class="info">
                        <p>Sales : 10 </p>
                        <a href="{{route('home.userOrder')}}" class="btn btn-info">My Orders </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
{{--   لما برافق الأدمن عليها  وبيكتب تم بروح وبزيد عدد السلع اللي اشتراها هاليوزر
    --}}