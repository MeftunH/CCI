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
                            <h2 class="content-header-title float-left mb-0">Edit Intro</h2>
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

                <form action="{{route('partner.update',$intro->id)}}" method="post" enctype="multipart/form-data">
                    @method('PUT')
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

                                        @foreach($translations as $translation)
                                            <div
                                                class="tab-pane fade {{$loop->index == 0 ? 'active show' : null}}"
                                                id="pills-{{$translation->language_id}}" role="tabpanel"
                                                aria-labelledby="pills-{{$translation->language_id}}-tab">


                                                <label>Title </label>
                                                <input type="text" class="form-control" id="exampleInputName1"
                                                       name="title[{{$translation->language_id}}]"
                                                       value="{{ $translation->title }}">
                                                <br>
                                                <label>Description </label>
                                                <div class="form-group">
                                                    <textarea class="summernote"
                                                              name="description[{{ $translation->language_id}}]"
                                                              value="{{ $translation->description }}" rows="30"
                                                              id="summernote">{{$translation->description}}</textarea>
                                                </div>
                                                <br>

                                                <script type="text/javascript">

                                                    $(document).ready(function () {


                                                        $('.summernote').summernote({
                                                            callbacks: {
                                                                onPaste: function (e) {
                                                                    var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');

                                                                    e.preventDefault();

                                                                    // Firefox fix
                                                                    setTimeout(function () {
                                                                        document.execCommand('insertText', false, bufferText);
                                                                    }, 10);
                                                                }
                                                            }
                                                        });
                                                    });
                                                </script>
                                            </div>
                                        @endforeach

                                            <div class="row">
                                                <div class="col">
                                                    <label>Image</label>
                                                    <div class="form-group">

                                                        <label class="btn btn-primary mr-75 mb-0"
                                                               for="background_image">
                                                            <span class="d-none d-sm-block">Select Image</span>
                                                            <input
                                                                name="background_image"
                                                                class="form-control-file"
                                                                type="file"
                                                                id="background_image"
                                                                hidden
                                                                accept="image/png, image/jpeg, image/jpg"
                                                            />

                                                            <span class="d-block d-sm-none">
                                                              <i class="mr-0" data-feather="edit"></i>
                                                                </span>
                                                        </label>

                                                    </div>

                                                    <img id="preview-image-before-upload"
                                                         src="https://www.riobeauty.co.uk/images/product_image_not_found.gif"
                                                         alt="preview image" class="img-fluid"
                                                         style="max-height: 100px;">


                                                </div>
                                                <div class="col">

                                                    <label>Old Image: </label>

                                                    <img name="old_image" src="{{$translation->background_image}}" class="img-fluid"
                                                         style="width: 150px" alt="{{$translation->background_image}}">
                                                </div>
                                            </div>

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
@endsection
