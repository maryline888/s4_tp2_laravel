@extends('layout.app')
@section('title', 'Pages')
@section('titleHeader', 'Pages')
@section('content')



<div class="card mt-3">
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>@lang('lang.blog_title')</th>
                    <th>@lang('lang.blog_autor')</th>
                </tr>
            </thead>
            <tbody>
                @foreach($blogs as $blog)
                <tr>
                    <td>{{ $blog->id }}</td>
                    <td>{{ $blog->title }}</td>
                    <td>{{ $blog->blogHasUser->name }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{$blogs}}
    </div>
</div>

@endsection