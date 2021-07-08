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

                <form action="{{route('news.newsUpdate',$news->id)}}" method="POST" enctype="multipart/form-data">
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
                                        <div class="col-md-6 col-6">
                                            <label>{{trans('back.image')}}</label>
                                            <div class="form-group">

                                                <label class="btn btn-primary mr-75 mb-0"
                                                       for="image">
                                                    <span class="d-none d-sm-block">{{trans('back.select_image')}}</span>
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

                                                    <img src="{{$news->image}}" alt="{{$news->image}}"
                                                         class="img-fluid">
                                                    <input type="hidden" name="old_image" value="{{ $news->image }}">
                                                </div>
                                            </div>
                                        </div>
                                        <label>
                                            <select class="form-control" name="status">
                                                <option>{{trans('back.status')}}</option>
                                                <option @if ($news->status ==1) selected @endif value="1">
                                                    {{trans('back.active')}}
                                                </option>
                                                <option @if ($news->status ==0)selected @endif  value="0">
                                                    {{trans('back.passive')}}
                                                </option>
                                            </select>
                                        </label>
                                    </div>
                                    <div class="form-group col-md-12">

                                        <br> <span class="text-center">{{trans('back.album')}}</span><br>
                                        <div class="form-group">
                                            <label for="title">Image/file</label>
                                            <input id="gallery-photo-add" type="file" name="images[]"
                                                   class="form-control"
                                                   multiple accept="image/*">
                                            <div class="gallery">
                                                <div class="row">
                                                    <div class="col-md-6">

                                                    </div>
                                                </div>
                                            </div>
                                            @if($errors->has('images'))
                                                <span
                                                    class="help-block text-danger">{{ $errors->first('images') }}</span>
                                            @endif
                                        </div>
                                        <script>
                                            $(function () {
                                                // Multiple images preview in browser
                                                var imagesPreview = function (input, placeToInsertImagePreview) {
                                                    if (input.files) {
                                                        var filesAmount = input.files.length;
                                                        for (i = 0; i < filesAmount; i++) {
                                                            var reader = new FileReader();
                                                            reader.onload = function (event) {
                                                                $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
                                                            }
                                                            reader.readAsDataURL(input.files[i]);
                                                        }
                                                    }
                                                };

                                                $('#gallery-photo-add').on('change', function () {
                                                    imagesPreview(this, 'div.gallery');
                                                });
                                            });
                                        </script>


                                        <div class="row">
                                            @if(isset($images))
                                                <div class="col-sm">
                                                    <label><input type="checkbox" class="sub_chk" name="checkAll"
                                                                  id="checkAll">Delete
                                                        All</label><label for="exampleInputName1">Old Images</label>
                                                    @foreach($images as $ph)


                                                        <img src="{{ $ph->image_path }}"
                                                             style="width: 70px; height: 50px;">
                                                        <input type="hidden" name="old_photos[]"
                                                               value="{{ $ph->image_path }}">
                                                        <input type="checkbox" value="{{$ph->id}}" id="albumCheck"
                                                               class="checkSingle" name="checked[]">Delete
                                                    @endforeach
                                                    @endif
                                                </div>
                                        </div>
                                    </div>
                                    <script>
                                        $("#checkAll").click(function () {
                                            $(".checkSingle").each(function () {
                                                this.checked = true;
                                            });
                                        });
                                    </script>
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
    <script>
        $('.summernote').summernote({
            height: ($(window).height() - 300),
            callbacks: {
                onImageUpload: function (image) {
                    uploadImage(image[0]);
                }
            }
        });

        function uploadImage(image) {
            var data = new FormData();
            data.append("image", image);
            $.ajax({
                url: {{'news.newsUpdate',$news->id}},
                cache: false,
                contentType: false,
                processData: false,
                data: data,
                type: "post",
                success: function (url) {
                    var image = $('<img>').attr('src', 'http://' + url);
                    $('#summernote').summernote("insertNode", image[0]);
                },
                error: function (data) {
                    console.log(data);
                }
            });
        }
    </script>
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

    <script type="text/javascript">

        $(document).ready(function () {
            $('.summernote').summernote();
        });
    </script>
@endsection
