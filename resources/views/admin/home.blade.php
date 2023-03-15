@extends('layouts.app')
@section('title', 'Home')
@section('content')
    <h2 class="fs-1 text-secondary my-4">
        {{ __('Dashboard') }}
    </h2>
    <div class="row">
        <div class="col d-flex justify-content-center">
            <div class="card mt-4 w-75 text-center">
                <div class="card-header fs-3">{{ __('User Dashboard') }}</div>

                <div class="card-body fs-5 text-success">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
@endsection
