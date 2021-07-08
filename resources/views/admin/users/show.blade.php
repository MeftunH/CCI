@extends('layouts.backend.master')
@section('title')
    {{trans('back.news_index')}}
@endsection
@section('css')
@endsection
<link rel="stylesheet" type="text/css"
      href="{{asset('./css/datatables.min.css')}}">
@section('content')
    <div class="app-content content " xmlns="">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">{{trans('back.users')}}</h2>
                        </div>
                    </div>
                </div>

            </div>
            <div class="content-body">

                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-left">
                            <h2>  {{trans('back.show')}}</h2>
                        </div>
                        <div class="pull-right">
                            <a class="btn btn-primary" href="{{ route('users.index') }}"> {{trans('back.back')}}</a>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans('back.name')}}:</strong>
                            {{ $user->name }}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans('back.email')}}:</strong>
                            {{ $user->email }}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Roles:</strong>
                            @if(!empty($user->getRoleNames()))
                                @foreach($user->getRoleNames() as $v)
                                    <label class="badge badge-success">{{ $v }}</label>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
        </div>
    </div>

@endsection
@section('js')
    <script
        src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js" defer></script>
    <script src="{{asset('./edit.js')}}" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            $('#users').DataTable();
        });
    </script>
@endsection
