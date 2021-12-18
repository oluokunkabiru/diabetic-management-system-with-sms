
@extends('layouts.app')
@section('title', 'Page not found')
@section('style')
    <style>


    </style>
@endsection
@section('content')


    <section>
    <div class="container">
        @if (! Auth::check())
        <div class="container mt-5 pt-5">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                             <h1 class="display-3 text-danger font-weight-bold">Expired</h1>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-danger text-center">
                <p class="display-5">Oops! Something is wrong.</p>
                <h3> Please this page have expired, you can reload to have it back</h3>
                <a href="{{ route('home') }}" class="text-center my-3 btn btn-success"> Home</a>
            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-3"></div>
            </div>

        </div>
        @else
            <div class="container">
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">

                        <div class="card">
                            <div class="card-header">
                                <div class="text-center">
                                    <span class="fa fa-user display-3"></span>
                                    <h1 class="display-3 text-danger font-weight-bold">Expired</h1>
                                </div>
                                <div class="card-body">
                                    <div class="alert alert-danger text-center">
                                    <p class="display-5">Oops! Something is wrong.</p>
                                    <h3> Please this page have expired, you can reload to have it back</h3>
                                </div>
                                    <h1 class="my-2">{{ ucwords(Auth::user()->name) }}</h1>

                                </div>

                                <div class="row card-footer">
                                    <div class="col">
                                        <a class="btn btn-lg btn-warning float-left mx-2" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                    {{--  <div class="col">  --}}
                                        <a href="{{ route('dashboard') }}" class="btn btn-lg btn-dark float-right mx-2" style="color: #E91E63;">Dashboard</a>
                                    {{--  </div>  --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3"></div>
                </div>
            </div>
        @endif
    </div>
</section>
@endsection
@section('script')
<script>


</script>
@endsection


<!--Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
