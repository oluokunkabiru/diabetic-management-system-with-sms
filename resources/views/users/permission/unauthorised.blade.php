@extends('users.layout.app')
@section('title', 'Access denie area')

@section('content')
    <div class="card m-5 p-5">
        <div class="card-header text-center">
                <h3 class="text-center text-danger text-uppercase">Unauthorised</h3>
        </div>
        <div class="card-body p-3">
            <h5>
                You don't have permission to access this page
                <div class="text-center my-5">
                        <a href="{{ route('home') }}" class="btn btn-primary btn-rounded">Dashboard</a>
                </div>
            </h5>
        </div>
    </div>
@endsection
