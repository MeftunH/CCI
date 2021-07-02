@extends('layouts.backend.master')

@section('title')
    {{trans('back.edit_settings')}}
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
                            <h2 class="content-header-title float-left mb-0"> {{trans('back.edit_settings')}}</h2>
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

                <form action="{{route('settings.update',$settings->id)}}" method="post" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="col-12">
                                    <div class="tab-content" id="pills-tabContent">

                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">

                                                    <label class="btn btn-primary mr-75 mb-0"
                                                           for="admin_panel_logo">
                                                        <span
                                                            class="d-none d-sm-block">{{trans('settings.admin_panel_logo')}}</span>
                                                        <input
                                                            name="admin_panel_logo"
                                                            class="form-control-file"
                                                            type="file"
                                                            id="admin_panel_logo"
                                                            hidden
                                                            accept="image/png, image/jpeg, image/jpg"
                                                        />

                                                        <span class="d-block d-sm-none">
                                                              <i class="mr-0" data-feather="edit"></i>
                                                                </span>
                                                    </label>

                                                </div>

                                                <img id="admin_panel_logo_upload"
                                                     src="https://www.riobeauty.co.uk/images/product_image_not_found.gif"
                                                     alt="preview image" class="img-fluid"
                                                     style="max-height: 100px;">


                                            </div>
                                            <div class="col">

                                                <label>{{trans('settings.old_image')}}</label>

                                                <img name="admin_panel_logo_old_image" src="{{$settings->admin_panel_logo}}"
                                                     class="img-fluid"
                                                     style="width: 150px" alt="{{$settings->admin_panel_logo}}">
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">

                                                    <label class="btn btn-primary mr-75 mb-0"
                                                           for="admin_panel_icon">
                                                        <span
                                                            class="d-none d-sm-block">{{trans('settings.admin_panel_icon')}}</span>
                                                        <input
                                                            name="admin_panel_icon"
                                                            class="form-control-file"
                                                            type="file"
                                                            id="admin_panel_icon"
                                                            hidden
                                                            accept="image/png, image/jpeg, image/jpg"
                                                        />

                                                        <span class="d-block d-sm-none">
                                                              <i class="mr-0" data-feather="edit"></i>
                                                                </span>
                                                    </label>

                                                </div>

                                                <img id="admin_panel_icon_upload"
                                                     src="https://www.riobeauty.co.uk/images/product_image_not_found.gif"
                                                     alt="preview image" class="img-fluid"
                                                     style="max-height: 100px;">


                                            </div>
                                            <div class="col">

                                                <label>{{trans('settings.old_image')}}</label>

                                                <img name="admin_panel_icon_old_image" src="{{$settings->admin_panel_icon}}"
                                                     class="img-fluid"
                                                     style="width: 150px" alt="{{$settings->admin_panel_icon}}">
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">

                                                    <label class="btn btn-primary mr-75 mb-0"
                                                           for="index_footer_logo">
                                                        <span
                                                            class="d-none d-sm-block">{{trans('settings.index_footer_logo')}}</span>
                                                        <input
                                                            name="index_footer_logo"
                                                            class="form-control-file"
                                                            type="file"
                                                            id="index_footer_logo"
                                                            hidden
                                                            accept="image/png, image/jpeg, image/jpg"
                                                        />

                                                        <span class="d-block d-sm-none">
                                                              <i class="mr-0" data-feather="edit"></i>
                                                                </span>
                                                    </label>

                                                </div>

                                                <img id="index_footer_logo_upload"
                                                     src="https://www.riobeauty.co.uk/images/product_image_not_found.gif"
                                                     alt="preview image" class="img-fluid"
                                                     style="max-height: 100px;">


                                            </div>
                                            <div class="col">

                                                <label>{{trans('settings.old_image')}}</label>

                                                <img name="index_footer_old_logo_upload" src="{{$settings->index_footer_logo}}"
                                                     class="img-fluid"
                                                     style="width: 150px" alt="{{$settings->index_footer_logo}}">
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">

                                                    <label class="btn btn-primary mr-75 mb-0"
                                                           for="non_index_footer_logo">
                                                        <span
                                                            class="d-none d-sm-block">{{trans('settings.non_index_footer_logo')}}</span>
                                                        <input
                                                            name="non_index_footer_logo"
                                                            class="form-control-file"
                                                            type="file"
                                                            id="non_index_footer_logo"
                                                            hidden
                                                            accept="image/png, image/jpeg, image/jpg"
                                                        />

                                                        <span class="d-block d-sm-none">
                                                              <i class="mr-0" data-feather="edit"></i>
                                                                </span>
                                                    </label>

                                                </div>

                                                <img id="non_index_footer_logo_upload"
                                                     src="https://www.riobeauty.co.uk/images/product_image_not_found.gif"
                                                     alt="preview image" class="img-fluid"
                                                     style="max-height: 100px;">


                                            </div>
                                            <div class="col">

                                                <label>{{trans('settings.old_image')}}</label>

                                                <img name="non_index_footer_logo_upload_old_image" src="{{$settings->non_index_footer_logo}}"
                                                     class="img-fluid"
                                                     style="width: 150px" alt="{{$settings->non_index_footer_logo}}">
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">

                                                    <label class="btn btn-primary mr-75 mb-0"
                                                           for="index_navbar_logo">
                                                        <span
                                                            class="d-none d-sm-block">{{trans('settings.index_navbar_logo')}}</span>
                                                        <input
                                                            name="index_navbar_logo"
                                                            class="form-control-file"
                                                            type="file"
                                                            id="index_navbar_logo"
                                                            hidden
                                                            accept="image/png, image/jpeg, image/jpg"
                                                        />

                                                        <span class="d-block d-sm-none">
                                                              <i class="mr-0" data-feather="edit"></i>
                                                                </span>
                                                    </label>

                                                </div>

                                                <img id="index_navbar_logo_upload"
                                                     src="https://www.riobeauty.co.uk/images/product_image_not_found.gif"
                                                     alt="preview image" class="img-fluid"
                                                     style="max-height: 100px;">


                                            </div>
                                            <div class="col">

                                                <label>{{trans('settings.old_image')}}</label>

                                                <img name="index_navbar_logo_upload_old_image" src="{{$settings->index_navbar_logo}}"
                                                     class="img-fluid"
                                                     style="width: 150px" alt="{{$settings->index_navbar_logo}}">
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">

                                                    <label class="btn btn-primary mr-75 mb-0"
                                                           for="non_index_navbar_logo">
                                                        <span
                                                            class="d-none d-sm-block">{{trans('settings.non_index_navbar_logo')}}</span>
                                                        <input
                                                            name="non_index_navbar_logo"
                                                            class="form-control-file"
                                                            type="file"
                                                            id="non_index_navbar_logo"
                                                            hidden
                                                            accept="image/png, image/jpeg, image/jpg"
                                                        />

                                                        <span class="d-block d-sm-none">
                                                              <i class="mr-0" data-feather="edit"></i>
                                                                </span>
                                                    </label>

                                                </div>

                                                <img id="non_index_navbar_logo_upload"
                                                     src="https://www.riobeauty.co.uk/images/product_image_not_found.gif"
                                                     alt="preview image" class="img-fluid"
                                                     style="max-height: 100px;">


                                            </div>
                                            <div class="col">

                                                <label>{{trans('settings.old_image')}}</label>

                                                <img name="non_index_navbar_logo_old_image" src="{{$settings->non_index_navbar_logo}}"
                                                     class="img-fluid"
                                                     style="width: 150px" alt="{{$settings->non_index_navbar_logo}}">
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">

                                                    <label class="btn btn-primary mr-75 mb-0"
                                                           for="frontend_icon">
                                                        <span
                                                            class="d-none d-sm-block">{{trans('settings.frontend_icon')}}</span>
                                                        <input
                                                            name="frontend_icon"
                                                            class="form-control-file"
                                                            type="file"
                                                            id="frontend_icon"
                                                            hidden
                                                            accept="image/png, image/jpeg, image/jpg"
                                                        />

                                                        <span class="d-block d-sm-none">
                                                              <i class="mr-0" data-feather="edit"></i>
                                                                </span>
                                                    </label>

                                                </div>

                                                <img id="frontend_icon_upload"
                                                     src="https://www.riobeauty.co.uk/images/product_image_not_found.gif"
                                                     alt="preview image" class="img-fluid"
                                                     style="max-height: 100px;">


                                            </div>
                                            <div class="col">

                                                <label>{{trans('settings.old_image')}}</label>

                                                <img name="frontend_icon_upload_old_image" src="{{$settings->frontend_icon}}"
                                                     class="img-fluid"
                                                     style="width: 150px" alt="{{$settings->frontend_icon}}">
                                            </div>
                                        </div>


                                    </div>
                                    <br>
                                    <label>{{trans('settings.mail')}} </label>
                                    <input type="text" class="form-control" id="exampleInputName1"
                                           name="mail"
                                           value="{{ $settings->mail }}">
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
                </form>
            </div>
        </div>
    </div>

@endsection
@section('js')
    <script src="{{asset('./backend/assets/js/summernote-bs4.min.js')}}"></script>

    <script type="text/javascript">

        $(document).ready(function (e) {


            $('#admin_panel_logo').change(function () {

                let reader = new FileReader();

                reader.onload = (e) => {

                    $('#admin_panel_logo_upload').attr('src', e.target.result);
                }

                reader.readAsDataURL(this.files[0]);

            });
            $('#admin_panel_icon').change(function () {

                let reader = new FileReader();

                reader.onload = (e) => {

                    $('#admin_panel_icon_upload').attr('src', e.target.result);
                }

                reader.readAsDataURL(this.files[0]);

            });
            $('#index_footer_logo').change(function () {

                let reader = new FileReader();

                reader.onload = (e) => {

                    $('#index_footer_logo_upload').attr('src', e.target.result);
                }

                reader.readAsDataURL(this.files[0]);

            });
            $('#non_index_footer_logo').change(function () {

                let reader = new FileReader();

                reader.onload = (e) => {

                    $('#non_index_footer_logo_upload').attr('src', e.target.result);
                }

                reader.readAsDataURL(this.files[0]);

            });
            $('#index_navbar_logo').change(function () {

                let reader = new FileReader();

                reader.onload = (e) => {

                    $('#index_navbar_logo_upload').attr('src', e.target.result);
                }

                reader.readAsDataURL(this.files[0]);

            });
            $('#non_index_navbar_logo').change(function () {

                let reader = new FileReader();

                reader.onload = (e) => {

                    $('#non_index_navbar_logo_upload').attr('src', e.target.result);
                }

                reader.readAsDataURL(this.files[0]);

            });
            $('#frontend_icon').change(function () {

                let reader = new FileReader();

                reader.onload = (e) => {

                    $('#frontend_icon_upload').attr('src', e.target.result);
                }

                reader.readAsDataURL(this.files[0]);

            });


        });

    </script>
@endsection
