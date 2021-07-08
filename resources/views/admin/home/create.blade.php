<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.css"/>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/min/dropzone.min.css">
@extends('layouts.backend.master')

@section('title')
    {{trans('back.create_news')}}
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
                            <h2 class="content-header-title float-left mb-0">{{trans('back.news_create')}}</h2>
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

                <form action="{{route('news.newsSave')}}" method="post"
                      enctype="multipart/form-data">
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

                                                <label for="exampleInputName1">Title {{$value['name']}} </label>
                                                <input type="text" class="form-control" id="exampleInputName1"
                                                       name="title[{{$value['id']}}]"
                                                       value="{{old('title.'.$value['id']) }}">
                                                <br>
                                                <label>Description {{$value['name']}}</label>
                                                <div class="form-group">
                                                    <textarea class="summernote"
                                                              name="description[{{$value['id']}}]"
                                                              rows="30"
                                                              id="summernote">{{old('description.'.$value['id']) }}</textarea>
                                                </div>

                                            </div>
                                        @endforeach
                                        <div class="col-xs-12">
                                            <label>
                                                <select class="form-control" name="status">
                                                    <option value={{null}}>{{trans('back.status')}}</option>
                                                    <option value="1"
                                                            @if (old('status') == '1') selected="selected" @endif>{{trans('back.active')}}</option>
                                                    <option value="0"
                                                            @if (old('status') == '0') selected="selected" @endif>{{trans('back.passive')}}</option>
                                                </select>
                                            </label>
                                        </div>
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
                                                            value="{{old('background_image') }}"
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
                                                     alt="preview image" class="img-fluid" value="{{old('image') }}"
                                                     style="max-height: 100px;">

                                            </div>


                                        </div>
                                        <br>
                                    </div>
                                    <br>
                                    <br> <span class="text-center">Album</span><br>
                                    <div class="form-group">
                                        <label for="title">Image/file</label>
                                        <input id="gallery-photo-add" type="file" name="images[]" class="form-control" multiple accept="image/*">

                                        <div class="gallery">
                                            <div class="col md-6"></div>

                                        </div>

                                        @if($errors->has('images'))
                                            <span class="help-block text-danger">{{ $errors->first('images') }}</span>
                                        @endif

                                        <script>

                                            $(function () {
                                                // Multiple images preview in browser
                                                var imagesPreview = function (input, placeToInsertImagePreview) {
                                                    if (input.files) {
                                                        var filesAmount = input.files.length;
                                                        for (i = 0; i < filesAmount; i++) {
                                                            var reader = new FileReader();
                                                            reader.onload = function (event) {
                                                                $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(placeToInsertImagePreview).style().padding="10px";
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
                                    </div>
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
                </form>

            </div>

        </div>
    </div>

@endsection
@section('js')

    <script src="{{asset('./backend/assets/js/summernote-bs4.min.js')}}"></script>
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
