@extends('layouts.backend.master')
@section('title')
    {{trans('back.index')}}
@endsection
@section('css')
@endsection
@section('content')
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">

            <div class="content-body">
                <center>
                    <div class="row">

                        <div class="col-md-12">
                            <div class="card card-statistics"><!----><!---->
                                <div class="card-header"><h4 class="card-title">{{trans('back.visit_homepage')}}</h4>
                                    <a href="{{url('/')}}">{{@trans('visit_homepage')}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </center>
@endsection
@section('js')
@endsection
