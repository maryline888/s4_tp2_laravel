@extends('layout.app')
@section('title', 'Ajouter un article')
@section('titleHeader', __('lang.blog_add_article'))
@section('content')
<div class="row mt-4 justify-content-center">
    <div class="col-6">
        <div class="card">
            <form method="post">
                @csrf
                <div class="card-header">
                    @lang('lang.form')
                </div>
                <div class="card-body">
                    <label for="title">@lang('lang.blog_title')</label>
                    <input type="text" id="title" name="title" class="form-control" value="{{ auth()->user()->id }}">
                    <label for=" article">@lang('lang.blog_article')</label>
                    <textarea name="body" id="article" class="form-control"></textarea>
                </div>
                <div class="card-footer text-center">
                    <input type="submit" class="btn btn-success" value="@lang('lang.text_save')">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection