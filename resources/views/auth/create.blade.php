@extends('layout.app')
@section('title', 'Registration')
@section('titleHeader', 'Registration')
@section('content')

<div class="row justify-content-center">
    <div class="col-6">
        <div class="card">
            <form action="" method="POST">
                @csrf
                <div class="card-body">
                    <input type="text" class="form-control mt-3" name="name" placeholder="Name">
                    <input type="email" class="form-control mt-3" name="email" placeholder="Email">
                    <input type="password" class="form-control mt-3" name="password" placeholder="Password">
                </div>
                <div class="card-footer d-grid mx-auto">
                    <input type="submit" value="Save" class="btn btn-dark btn-block">
                </div>
            </form>
        </div>
    </div>
</div>

@endsection