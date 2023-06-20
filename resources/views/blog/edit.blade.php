@extends('layout.app')
@section('title', 'Modifier un article')
@section('titleHeader', 'Modifier un article')
@section('content')

<div class="row mt-4 justify-content-center">
    <div class="col-6">
        <form method="post">
            @csrf
            @method('put')
            <div class="card">
                <div class="card-header">
                    <h3>Formulaire de modification</h3>
                </div>
                <div class="card-body">
                    <label for="title">@lang('lang.blog_title')</label>
                    <input type="text" id="title" name="title" class="form-control" value="{{$blogPost->title}}">

                    <label for="article">@lang('lang.blog_article')</label>
                    <textarea name="body" id="article" class="form-control">{{$blogPost->body}}</textarea>
                </div>
                <div class="card-footer text-center">
                    <input type="submit" value="Sauvegarder" class="btn btn-success">
                </div>
        </form>
    </div>
</div>
</div>

@endsection