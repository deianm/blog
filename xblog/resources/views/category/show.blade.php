@extends('layouts.app')
@section('title','Categories Articles')
@section('content')
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="{{ route('post.index') }}">Articles</a></li>
            <li><a href="{{ route('category.index') }}">Categories</a></li>
            <li class="active">{{ $name }}</li>
        </ol>
        <div class="row">
            <div class="col-md-8">
                @if($posts->isEmpty())
                    @include('partials.empty')
                @else
                    @each('post.item',$posts,'post')
                    @if($posts->lastPage() > 1)
                        {{ $posts->links() }}
                    @endif
                @endif
            </div>
            <div class="col-md-4">
                @include('layouts.widgets')
            </div>
        </div>
    </div>
@endsection