@extends('layout.app')
@section('title', trans('lang.text_new_password'))
@section('titleHeader', trans('lang.text_new_password'))
@section('content')
<div class="row justify-content-center">
    <div class="col-6">
        <div class="card">
            <form method="post">
                @csrf
                @method('put')
                <div class="card-body">
                    <input type="password" class="form-control mt-3" name="password" placeholder="@lang('lang.text_new_password')">
                    @if($errors->has('password'))
                    <div class="text-danger mt-2">
                        {{$errors->first('password')}}
                    </div>
                    @endif
                    <input type="password" class="form-control mt-3" name="password_confirmation" placeholder="@lang('lang.text_confirm_password')">
                </div>
                <div class="card-footer d-grid mx-auto">
                    <input type="submit" value="@lang('lang.text_save')" class="btn btn-dark btn-block">
                </div>

            </form>
        </div>
    </div>
</div>
@endsection