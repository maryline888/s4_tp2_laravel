@extends('layout.app')
@section('title', 'lister les Utilisateur')
@section('titleHeader', 'lister les Utilisateur')
@section('content')



<div class="card mt-3">
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nom</th>
                    <th>Article</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>
                        @foreach($user->userHasPosts as $post)
                        <p>{{ $post->title }}</p>
                        @endforeach
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{$users}}
    </div>
</div>

@endsection