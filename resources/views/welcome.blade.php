@extends('layout.app')
@section('title', config('app.name'))
@section('titleHeader', config('app.name'))
@section('content')
<div class="row">
    <div class="col-12 text-center">
        <p>Voir les articles de ce blog</p>
        <a href="{{ route('blog.index') }}" class="btn btn-outline-primary">Afficher les articles</a>
    </div>
</div>
@endsection