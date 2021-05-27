@extends('layouts.backend.master')

@section('title')
    Create TimeLine
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
                            <h2 class="content-header-title float-left mb-0">{{trans('show_time_line_detail')}}</h2>
                        </div>
                    </div>
                </div>
                <a href="{{ url()->previous() }}" type="button"
                   class="btn btn-gradient-primary"> {{trans('back.back')}} </a>
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

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <ul class="nav nav-pills nav-pills-success" id="pills-tab" role="tablist">
                                @foreach(\App\Models\Language::all() as $key=> $value)
                                    <li class="nav-item">
                                        <a class="nav-link {{$loop->index == 0 ? 'active' : null}}"
                                           id="pills-{{$value->id}}-tab" data-toggle="pill"
                                           href="#pills-{{$value->id}}" role="tab"
                                           aria-controls="pills-{{$value->id}}"
                                           aria-selected="{{$loop->index == 0 ? 'true' : 'false'}}"><img
                                                src="{{ URL::to($value->flag)}}"
                                                style="width: 16px;height: 16px" alt=""></a>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="col-12">
                                <div class="tab-content" id="pills-tabContent">

                                    @foreach($translations as $translation)
                                        <div
                                            class="tab-pane fade {{$loop->index == 0 ? 'active show' : null}}"
                                            id="pills-{{$translation->language_id}}" role="tabpanel"
                                            aria-labelledby="pills-{{$translation->language_id}}-tab">


                                            <label>Title </label>
                                            <input type="text" class="form-control" id="exampleInputName1"
                                                   name="title[{{$translation->language_id}}]"
                                                   value="{{ $translation->title }}" disabled>
                                            <br>
                                            <br>

                                        </div>
                                    @endforeach


                                    <label for="fp-default">{{trans('back.date')}}</label>
                                    <input type="text" id="fp-default" class="form-control format-picker" disabled
                                          value="{{$time_line->date}}" name="date"/>

                                </div>
                                <br>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')
    <script src="{{asset('./backend/assets/js/summernote-bs4.min.js')}}"></script>
@endsection
