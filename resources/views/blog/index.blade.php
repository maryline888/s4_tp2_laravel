@extends('layout.app')
@section('title', 'Liste des articles')
@section('titleHeader', 'Articles')
@section('content')

<div class="row">
    <div class="col-8">
        <p>@lang('lang.blog_explication').</p>
        <div class="col-4">
            <p></p>
            <a href="{{route('blog.create')}}" class="btn btn-primary btn-sm">@lang('lang.blog_add_article')</a>
        </div>
    </div>
</div>
<div class="row mt-5">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>@lang('lang.blog_list')</h4>
            </div>
            <div class="card-body">
                <ul>
                    @forelse($posts as $post )
                    <li><a href="{{ route('blog.show', $post->id)}}">{{ $post->title }} </a> </li>
                    @empty
                    <li> {{ $post->title }} </li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection