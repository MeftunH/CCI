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
                            <h2 class="content-header-title float-left mb-0">{{trans('back.edit_long_term')}}</h2>
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

                <form action="{{route('partner.item.update',$partner->id)}}" method="post"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">

                                <div class="col-12">
                                    <div class="tab-content" id="pills-tabContent">


                                                <label>Title </label>
                                                <input type="text" class="form-control" id="exampleInputName1"
                                                       name="title"
                                                       value="{{ $partner->title }}">
                                                <br>

                                            </div>

                                        <div class="col-md-6 col-6">
                                            <label>Image</label>
                                            <div class="form-group">

                                                <label class="btn btn-primary mr-75 mb-0"
                                                       for="image">
                                                    <span class="d-none d-sm-block">Select Image</span>
                                                    <input
                                                        name="image"
                                                        class="form-control-file"
                                                        type="file"
                                                        id="image"
                                                        hidden
                                                        accept="image/png, image/jpeg, image/jpg"
                                                    />

                                                    <span class="d-block d-sm-none">
                                                              <i class="mr-0" data-feather="edit"></i>
                                                                </span>
                                                </label>

                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-2">
                                                    <img id="preview-image-before-upload"
                                                         src="https://www.riobeauty.co.uk/images/product_image_not_found.gif"
                                                         alt="preview image" class="img-fluid"
                                                         style="max-height: 100px;">
                                                </div>
                                                <div class="col-md-6 mb-2">

                                                    <label>Old Image: </label>

                                                    <img src="{{$partner->image}}" alt="{{$partner->image}}"
                                                         class="img-fluid">
                                                    <input type="hidden" name="old_image" value="{{ $partner->image }}">
                                                </div>
                                            </div>
                                        </div>
                                        <label>
                                                <select class="form-control" name="status">
                                                    <option>Status</option>

                                                    <option @if ($partner->status ==1) selected @endif value="1">
                                                        {{trans('back.active')}}
                                                    </option>

                                                    <option @if ($partner->status ==0)selected @endif  value="0">
                                                        {{trans('back.passive')}}
                                                    </option>
                                                </select>

                                        </label>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="text-right">
                                                <button type="submit" class="btn btn-primary">Update</button>
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
    <script src="{{asset('./backend/assets/js/summernote-ext-addclass.js')}}"></script>

    <script src="{{asset('./backend/assets/js/summernote-bs4.min.js')}}"></script>
    <script type="text/javascript">

        $(document).ready(function (e) {


            $('#image').change(function () {

                let reader = new FileReader();

                reader.onload = (e) => {

                    $('#preview-image-before-upload').attr('src', e.target.result);
                }

                reader.readAsDataURL(this.files[0]);

            });

        });

    </script>
@endsection
