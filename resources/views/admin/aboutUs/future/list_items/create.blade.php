@extends('layouts.backend.master')

@section('title')
    Edit Intro
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
                            <h2 class="content-header-title float-left mb-0">{{trans('future_list_item_create')}}</h2>
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

                <form action="{{route('aboutUs.future.list.item.save')}}" method="post" enctype="multipart/form-data">
                    @csrf
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

                                        @foreach(\App\Models\Language::all() as $key=> $value)
                                            <div
                                                class="tab-pane fade {{$loop->index == 0 ? 'active show' : null}}"
                                                id="pills-{{$value->id}}" role="tabpanel"
                                                aria-labelledby="pills-{{$value->id}}-tab">
                                                <label>Title {{$value['name']}} </label>
                                                <input type="text" class="form-control" id="exampleInputName1"
                                                       name="title[{{$value['id']}}]">
                                            <!--                                                        <img src="{{asset($value['flag'])}}"
                                                             style="width: 16px; height: 16px;"
                                                             alt="{{ $value['flag']}}">-->
                                                <br>
                                                <label>Description {{$value['name']}}</label>
                                                <div class="form-group">
                                                    <textarea class="summernote"
                                                              name="description[{{$value['id']}}]"
                                                              rows="30"
                                                              id="summernote"></textarea>
                                                </div>
                                                <br>


                                            </div>
                                        @endforeach

                                                <div class="col-xs-12">
                                                    <label>
                                                        <select class="form-control" name="status">
                                                            <option value={{null}}>{{trans('back.status')}}</option>
                                                            <option value="1">{{trans('back.active')}}</option>
                                                            <option value="0">{{trans('back.passive')}}</option>
                                                        </select>
                                                    </label>
                                                </div>

                                        <br>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="text-right">
                                                    <button type="submit" class="btn btn-primary">Save</button>
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

    <script type="text/javascript">

        $(document).ready(function (e) {


            $('#background_image').change(function () {

                let reader = new FileReader();

                reader.onload = (e) => {

                    $('#preview-image-before-upload').attr('src', e.target.result);
                }

                reader.readAsDataURL(this.files[0]);

            });

        });

    </script>
    <script type="text/javascript">

        $(document).ready(function () {
            $('.summernote').summernote();
        });
    </script>
@endsection
