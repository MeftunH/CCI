@extends('layouts.backend.master')
@section('title')
    {{trans('back.profile-edit')}}
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
                        <div class="col-6">
                            <h2 class="content-header-title float-left mb-0">{{trans('back.profile-edit')}}</h2>
                        </div>

                    </div>
                </div>

            </div>
            <div class="content-body">
                <section class="my-5">
                    @if (session()->has('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('status') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Update Profile Information</h5>

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="container">

                                <livewire:profile-form/>
                                <livewire:password-change-form/>

                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

@endsection
