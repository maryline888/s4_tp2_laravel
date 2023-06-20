@extends('layout.app')
@section('title', 'Article')
@section('titleHeader', 'Article')
@section('content')
<div class="row mt-5">
    <div class="col-12">
        <a href="{{route('blog.index')}}" class="btn btn-outline-primary btn-sm">Retourner</a>
        <hr>
        <h2 class='display-6 mt-5'>
            {{$blogPost->title}}
        </h2>
        <p>
            {{ $blogPost->body  }}
            <!-- si il y a du code html sans quon voit les balises et quon veut lafficher, il faut ecrire les !!  -->
        </p>
        <p>
            <strong>Author :</strong> {{ $blogPost->blogHasUser->name }}
        </p>
    </div>
    <hr>
</div>
<div class="row">

    <div class="col-4">
        @if (Auth::check() && Auth::user()->id == $blogPost->user_id)
        <!-- pour passer plus de param a la route on doit faire un tableau -->
        <a href="{{route('blog.edit', $blogPost->id)}}" class="btn btn-success">Modifier</a>

    </div>
    <div class="col-4">
        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Supprimer
        </button>
        @endif
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Confirmation</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Êtes-vous certain de vouloir supprimer votre article {{ $blogPost->title }}?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                <form method="post">
                    @csrf
                    @method('delete')
                    <input type="submit" class="btn btn-primary" value="Supprimer définitivement">
                </form>
            </div>
        </div>
    </div>
</div>
@endsection