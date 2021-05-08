@extends('layouts.backend.master')
@section('title')
Index
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
                        <h2 class="content-header-title float-left mb-0">Layout Empty</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Layouts</a>
                                </li>
                                <li class="breadcrumb-item active">Layout Empty
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                <div class="form-group breadcrumb-right">
                    <div class="dropdown">
                        <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="grid"></i></button>
                        <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="javascript:void(0);"><i class="mr-1" data-feather="check-square"></i><span class="align-middle">Todo</span></a><a class="dropdown-item" href="javascript:void(0);"><i class="mr-1" data-feather="message-square"></i><span class="align-middle">Chat</span></a><a class="dropdown-item" href="javascript:void(0);"><i class="mr-1" data-feather="mail"></i><span class="align-middle">Email</span></a><a class="dropdown-item" href="javascript:void(0);"><i class="mr-1" data-feather="calendar"></i><span class="align-middle">Calendar</span></a></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body"><div class="row">
                <div class="col-12">
                    <div class="alert alert-primary" role="alert">
                        <div class="alert-body">
                            <strong>Info:</strong> This layout can be useful for getting started with empty content section. Please check
                            the&nbsp;<a
                                class="text-primary"
                                href="https://pixinvent.com/demo/vuexy-html-bootstrap-admin-template/documentation/documentation-layout-empty.html"
                                target="_blank"
                            >Layout empty documentation</a
                            >&nbsp; for more details.
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
@section('js')
@endsection
