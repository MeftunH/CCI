@extends('layouts.backend.master')
@section('title')
    Create Language
@endsection
@section('css')
@endsection

@section('content')
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Create Language</h2>

                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                    <div class="form-group breadcrumb-right">
                        <div class="dropdown">
                            <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                    data-feather="grid"></i></button>
                            <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item"
                                                                              href="javascript:void(0);"><i class="mr-1"
                                                                                                            data-feather="check-square"></i><span
                                        class="align-middle">Todo</span></a><a class="dropdown-item"
                                                                               href="javascript:void(0);"><i
                                        class="mr-1" data-feather="message-square"></i><span
                                        class="align-middle">Chat</span></a><a class="dropdown-item"
                                                                               href="javascript:void(0);"><i
                                        class="mr-1" data-feather="mail"></i><span class="align-middle">Email</span></a><a
                                    class="dropdown-item" href="javascript:void(0);"><i class="mr-1"
                                                                                        data-feather="calendar"></i><span
                                        class="align-middle">Calendar</span></a></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <section id="multiple-column-form">
                    <div class="row">
                        <form method="POST" action="{{route('languages.store')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Multiple Column</h4>
                                    </div>
                                    <div class="card-body">
                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                            <div class="row">
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="name">Name</label>
                                                        <input
                                                            type="text"
                                                            id="name"
                                                            class="form-control"
                                                            placeholder="name"
                                                            name="name"
                                                        />
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="code">Code *</label>
                                                        <input
                                                            type="text"
                                                            id="code"
                                                            class="form-control"
                                                            placeholder="code"
                                                            name="code"
                                                        />
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="locale">Locale **</label>
                                                        <input
                                                            type="text"
                                                            id="locale"
                                                            class="form-control"
                                                            placeholder="locale"
                                                            name="locale"
                                                        />
                                                    </div>
                                                    <label>
                                                        <select class="form-control" name="status">
                                                            <option value={{null}}>Status</option>
                                                            <option value="1">Active</option>
                                                            <option value="0">Passive</option>
                                                        </select>
                                                    </label>
                                                </div>
                                                <div>

                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <label>Image</label>
                                                    <div class="form-group">

                                                        <label class="btn btn-primary mr-75 mb-0"
                                                               for="flag">
                                                            <span class="d-none d-sm-block">Select Image</span>
                                                            <input
                                                                name="flag"
                                                                class="form-control-file"
                                                                type="file"
                                                                id="flag"
                                                                hidden
                                                                accept="image/png, image/jpeg, image/jpg"
                                                            />

                                                            <span class="d-block d-sm-none">
                                                              <i class="mr-0" data-feather="edit"></i>
                                                                </span>
                                                        </label>

                                                    </div>
                                                    <div class="col-md-12 mb-2">
                                                        <img id="preview-image-before-upload"
                                                             src="https://www.riobeauty.co.uk/images/product_image_not_found.gif"
                                                             alt="preview image" class="img-fluid"
                                                             style="max-height: 100px;">
                                                    </div>
                                                </div>

                                                <br>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-primary mr-1">Submit
                                                        </button>
                                                        <button type="reset" class="btn btn-outline-secondary">Reset
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <p>*{{trans('back.warn_code')}}<a target="_blank" href="https://cloud.google.com/translate/docs/languages">{{trans('back.codes')}}</a> </p>
                                            <p>*{{trans('back.warn_locales')}}<a target="_blank" href="https://github.com/mcamara/laravel-localization/blob/master/src/config/config.php">{{trans('back.locales')}}</a> </p>

                                    </div>
                                </div>

                            </div>
                        </form>

                    </div>
                </section>

            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script type="text/javascript">

        $(document).ready(function (e) {


            $('#flag').change(function () {

                let reader = new FileReader();

                reader.onload = (e) => {

                    $('#preview-image-before-upload').attr('src', e.target.result);
                }

                reader.readAsDataURL(this.files[0]);

            });

        });

    </script>
@endsection
