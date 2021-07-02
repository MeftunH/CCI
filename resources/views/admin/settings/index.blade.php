@extends('layouts.backend.master')
@section('title')
    {{trans('settings.index')}}
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
                            <h2 class="content-header-title float-left mb-0">{{trans('settings.index')}}</h2>
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
                                <div class="table-responsive-lg">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{trans('back.admin_panel_logo')}}</th>
                                        <th>{{trans('back.admin_panel_icon')}}</th>
                                        <th>{{trans('back.index_footer_logo')}}</th>
                                        <th>{{trans('back.non_index_footer_logo')}}</th>
                                        <th>{{trans('back.index_navbar_logo')}}</th>
                                        <th>{{trans('back.non_index_navbar_logo')}}</th>
                                        <th>{{trans('back.frontend_icon')}}</th>
                                        <th>{{trans('back.mail')}}</th>
                                        <th>{{trans('back.action')}}</th>
                                    </tr>
                                    </thead>
                                    @php($i=1)
                                    <tbody>
                                    <tr>

                                        <td>{{$i++}}</td>
                                        <td><img src="{{$settings->admin_panel_logo}}" class="img-fluid" style="width: 30px"> </td>
                                        <td><img src="{{$settings->admin_panel_icon}}" class="img-fluid" style="width: 30px"> </td>
                                        <td><img src="{{$settings->index_footer_logo}}" class="img-fluid" style="width: 30px"> </td>
                                        <td><img src="{{$settings->non_index_footer_logo}}" class="img-fluid" style="width: 30px"> </td>
                                        <td><img src="{{$settings->index_navbar_logo}}" class="img-fluid" style="width: 30px"> </td>
                                        <td><img src="{{$settings->non_index_navbar_logo}}" class="img-fluid" style="width: 30px"> </td>
                                        <td><img src="{{$settings->frontend_icon}}" class="img-fluid" style="width: 30px"> </td>
                                        <td>{{$settings->mail}} </td>

                                            <td>
                                                <div class="demo-inline-spacing">
                                                <a href="{{ URL::route('settings.edit',$settings->id) }}"
                                                   class="btn btn-primary" style="position: relative;"> {{trans('back.edit')}} </a>
                                                <a href="{{ URL::route('settings.show',$settings->id) }}"
                                                   class="btn btn-primary" style="position: relative;"> {{trans('back.show')}} </a>
                                                </div>
                                            </td>

                                    </tr>

                                    </tbody>
                                </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </section>
                <section id="basic-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="table-responsive-lg">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{trans('back.name')}}</th>
                                        <th>{{trans('back.link')}}</th>
                                        <th>{{trans('back.action')}}</th>
                                    </tr>
                                    </thead>
                                    @php($i=1)
                                    <tbody>
                                    <tr>
                                        @foreach($socials->get() as $row)
                                        <td>{{$i++}}</td>

                                        <td>{{$row->name}}</td>
                                        <td>{{$row->link}}</td>
                                            <td>
                                                <div class="demo-inline-spacing">
                                                <a href="{{ URL::route('social.edit',$row->id) }}"
                                                   class="btn btn-primary" style="position: relative;"> {{trans('back.edit')}} </a>

                                                </div>
                                            </td>


                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </section>
            </div>
        </div>
    </div>

@endsection
@section('js')
    @push('script')
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js' type='text/javascript'></script>
        <script>
            $(document).ready(function () {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            });
        </script>
        <script src="{{asset('./edit.js')}}" type="text/javascript"></script>
    @endpush
@endsection
