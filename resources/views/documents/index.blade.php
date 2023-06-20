@extends('layout.app')
@section('title',__('lang.titre_doc'))
@section('titleHeader',__('lang.titre_doc'))
@section('content')
<div class="container">
    <div class="row">
        <div class="">
            @auth
            <a href="{{ route('doc.create') }}" class="btn btn-primary btn-sm mt-3">{{__('lang.doc_add_btn')}}</a>
            @endauth
        </div>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>@lang('lang.doc_titre')</th>
                <th>@lang('lang.doc_dateCreation')</th>
                <th>@lang('lang.doc_name')</th>
                <th>@lang('lang.doc_file')</th>
                <th>@lang('lang.text_modif')</th>
            </tr>
        </thead>
        <tbody>
            @foreach($documents as $document)
            <tr>
                <td>{{ $document->id }}</td>
                @if(App::getLocale() == 'en')
                <td> {{ $document->titre_en }}</td>
                @else
                <td> {{ $document->titre_fr }}</td>
                @endif

                <td>{{ $document->date }}</td>
                <td>{{ $document->user->first_name }}</td>

                <td><a href="{{ asset('storage/document/' . str_replace('public/documents/', '', $document->file)) }}" target="_blank">@lang('lang.text_upload')</a></td>
                </td>
                <td>
                    <div class="row">
                        <div class="col-5 ">
                            @if (Auth::check() && Auth::user()->id == $document->user_id)
                            <a href="{{ route('doc.edit', $document->id)}}" class="btn btn-success">@lang('lang.text_modif')</a>
                        </div>
                        <div class="col-4">
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalDelete">
                                @lang('lang.text_delete')
                            </button>
                            @endif
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{$documents}}
</div>

@endsection