@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Welcome ' . Auth::user()->name . '. You are logged in!') }}
                </div>

                <div class="d-flex justify-content-center mb-3">
                    <a href="{{route('admin.dashboard')}}" class="btn btn-info btn-sm">Continue</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
