@extends('layouts.backend.master')
@section('title')
    Languages
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
                            <h2 class="content-header-title float-left mb-0">About Us Intro</h2>
                        </div>
                    </div>
                </div>

            </div>
            <div class="content-body">
                <!-- Basic table -->
                <section id="basic-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <table class="datatables-basic table">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{trans('back.title')}}</th>
                                        <th>{{trans('back.description')}}</th>
                                        <th>{{trans('back.background_image')}}</th>
                                        <th>{{trans('back.action')}}</th>
                                    </tr>
                                    </thead>
                                    @php($i=1)
                                    <tbody>
                                    <tr>
                                        @foreach($industry as $row)
                                        <td>{{$i++}}</td>
                                        <td>{{$row->title}}</td>
                                        <td>{{$row->limit(strip_tags($row->description))}}</td>
                                        <td><img src="{{$row->background_image}}" class="img-fluid" style="width: 30px" alt=""> </td>
                                            <td>
                                                <div class="demo-inline-spacing">
                                                <a href="{{ URL::route('industry.edit',$row->industry_id) }}"
                                                   class="btn btn-primary" style="position: relative;"> {{trans('back.edit')}} </a>
                                                <a href="{{ URL::route('industry.show',$row->industry_id) }}"
                                                   class="btn btn-primary" style="position: relative;"> {{trans('back.show')}} </a>
                                                </div>
                                            </td>
                                        @endforeach

                                    </tr>

                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>

                </section>
            </div>
        </div>
    </div>

@endsection
@section('js')
@endsection
