@extends('layouts.backend.master')
@section('title')
    {{trans('back.connect_intro_index')}}
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
                            <h2 class="content-header-title float-left mb-0">{{trans('back.connect_intro_index')}}</h2>
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
                                        @foreach($intro as $row)
                                            <td>{{$i++}}</td>
                                            <td>{{$row->title}}</td>
                                            <td>{{$row->limit(strip_tags($row->description))}}</td>
                                            <td><img src="{{$row->background_image}}" class="img-fluid"
                                                     style="width: 30px" alt=""></td>
                                            <td>
                                                <div class="demo-inline-spacing">
                                                    <a href="{{ URL::route('connects.edit',$row->intro_id) }}"
                                                       class="btn btn-primary"
                                                       style="position: relative;"> {{trans('back.edit')}} </a>
                                                    <a href="{{ URL::route('connects.show',$row->intro_id) }}"
                                                       class="btn btn-primary"
                                                       style="position: relative;"> {{trans('back.show')}} </a>
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
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">{{trans('back.reach_module')}}</h2>
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
                                        <th>{{trans('back.address')}}</th>
                                        <th>{{trans('back.working_hours')}}</th>
                                        <th>{{trans('back.action')}}</th>
                                    </tr>
                                    </thead>
                                    @php($i=1)
                                    <tbody>
                                    <tr>
                                        @foreach($reach as $row)
                                            <td>{{$i++}}</td>
                                            <td>{{$row->limit(strip_tags($row->address))}}</td>
                                            <td>{{$row->limit(strip_tags($row->working_hours))}}</td>
                                            <td>
                                                <div class="demo-inline-spacing">
                                                    <a href="{{ URL::route('reach.edit',$row->module_id) }}"
                                                       class="btn btn-primary"
                                                       style="position: relative;"> {{trans('back.edit')}} </a>
                                                    <a href="{{ URL::route('reach.show',$row->module_id) }}"
                                                       class="btn btn-primary"
                                                       style="position: relative;"> {{trans('back.show')}} </a>
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
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-6">
                            <h2 class="content-header-title float-left mb-0">{{trans('back.mails_contact')}}</h2>
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
                                        <th>{{trans('mail.email')}}</th>
                                        <th>{{trans('mail.name')}}</th>
                                        <th>{{trans('mail.subject_contact')}}</th>
                                        <th>{{trans('mail.message_contact')}}</th>
                                        <th>{{trans('mail.date')}}</th>
                                    </tr>
                                    </thead>
                                    @php($i=1)
                                    <tbody>
                                    @if(isset($messages))
                                        @foreach($messages as $row)

                                                <tr>
                                                    <td>{{$i++}}</td>
                                                    <td>{{$row->email}}</td>
                                                    <td>{{$row->name}}</td>
                                                    <td>{{$row->subject}}</td>
                                                    <td>{{$row->message}}</td>
                                                    <td>{{$row->created_at}}</td>

                                                </tr>

                                            @endforeach

                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
{{$messages->links()}}
                </section>
            </div>
        </div>
    </div>

@endsection
@section('js')
@endsection
