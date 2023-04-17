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

                    Hello Admin!
                </div>
                <div class="text-center p-3">
                    <a class="btn btn-outline-success" href="{{ route('editArticlePage') }}">Edit Article</a>
                    <a class="btn btn-outline-success" href="{{ route('deleteArticlePage') }}">Delete Article</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection