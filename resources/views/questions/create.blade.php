@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h2>Ask a Question</h2></div>
                <div class="card-body">
                    <form action="{{ route('questions.store')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" id="title" name="title" value="{{ old('title')}}"
                                class="form-control {{ $errors->has('title') ? 'is-invalid' : ''}}">
                            @error('title')
                                <div class="text-danger">{{ $message}}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Enter Question</label>
                            <input type="hidden" id="body" name="body" value="{{ old('body')}}">
                            <trix-editor input="body" class="form-control {{ $errors->has('body') ? 'is-invalid' : ''}}"></trix-editor>
                            @error('body')
                                <div class="text-danger">{{ $message}}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-outline-success">Submit</button>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js"></script>
@endsection

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.css">
@endsection
