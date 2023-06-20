@extends('layout.app')
@section('title', __('lang.mod_doc_explication'))
@section('titleHeader', __('lang.mod_doc_explication'))
@section('content')

<a href="{{ route('doc.index') }}" class="btn btn-outline-primary btn-sm">@lang('lang.text_retour')</a>

<div class="row mt-4 justify-content-center">
    <div class="col-6">
        <div class="card">
            <form method="post" action="{{ route('doc.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="card-header p-4 text-center ">
                    <h4>@lang('lang.form')</h4>
                </div>
                <div class="card-body">
                    <label for="title">@lang('lang.text_name')</label>
                    <input type="text" id="nom" name="nom" class="form-control" value="{{ auth()->user()->first_name }}">

                    <label for="titre_en">@lang('lang.titre_en')</label>
                    <input type="text" id="titre_en" name="titre_en" class="form-control">

                    <label for="titre_fr">@lang('lang.titre_fr')</label>
                    <input type="text" id="titre_fr" name="titre_fr" class="form-control">


                    <label for="user_id">@lang('lang.file') :</label>
                    <input type="file" class="form-control" id="file" name="file">
                </div>
                <div class="card-footer text-center">
                    <input type="submit" class="btn btn-success" value="@lang('lang.text_save')">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection