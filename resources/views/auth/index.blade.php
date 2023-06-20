@extends('layout.app')
@section('title', 'Login')
@section('titleHeader', trans('lang.text_login'))
@section('content')
<div class="row justify-content-center">
    <div class="col-6">
        <div class="card">
            <form action="{{route('login.authentication')}}" method="post">
                @csrf
                <div class="card-body">
                    <input type="email" class="form-control mt-3" name="email" placeholder="@lang('lang.text_email')" value="{{old('email')}}">
                    @if($errors->has('email'))
                    <div class="text-danger mt-2">
                        {{$errors->first('email')}}
                    </div>
                    @endif
                    <input type="password" class="form-control mt-3" name="password" placeholder="@lang('lang.text_password')">
                    @if($errors->has('password'))
                    <div class="text-danger mt-2">
                        {{$errors->first('password')}}
                    </div>
                    @endif
                    <a href="{{route('forgot.password')}}">Forgot password</a>
                </div>
                <div class="card-footer d-grid mx-auto">
                    <input type="submit" value="@lang('lang.text_login')" class="btn btn-dark btn-block">
                </div>

            </form>
        </div>
    </div>
</div>
@endsection