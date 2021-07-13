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

                    {{ __('You are logged in!') }}
                </div>



            </div>

            <div class="d-flex justify-content-center mt-5 mb-2">
                <a href="{{ route('questions.index') }}" class="btn btn-outline-success">All Questions</a>
            </div>

        </div>
    </div>
</div>
@endsection
