@extends('layouts.backend.master')

@section('title')
    {{trans('back.social_edit')}}
@endsection

@section('css')

@endsection
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">

@section('content')
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">  {{trans('back.social_edit')}}</h2>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-12 grid-margin strecth  stretch-card">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{route('social.update',$social->id)}}" method="post" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="col-12">
                                    <div class="tab-content" id="pills-tabContent">
                                        <label>{{trans('settings.social_name')}} </label>
                                        <input type="text" class="form-control" id="exampleInputName1"
                                               name="name"
                                               value="{{ $social->name }}">
                                        <br>
                                        <label>{{trans('settings.link')}} </label>
                                        <input type="text" class="form-control" id="exampleInputName1"
                                               name="link"
                                               value="{{ $social->link }}">
                                        <br>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="text-right">
                                                    <button type="submit"
                                                            class="btn btn-primary">{{trans('back.update')}}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@section('js')
    <script src="{{asset('./backend/assets/js/summernote-bs4.min.js')}}"></script>
@endsection
