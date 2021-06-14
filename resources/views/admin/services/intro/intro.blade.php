@extends('layouts.backend.master')
@section('title')
{{trans('back.service')}}
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
                            <h2 class="content-header-title float-left mb-0">{{trans('back.service_intro')}}</h2>
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
                                        @foreach($service as $row)
                                        <td>{{$i++}}</td>
                                        <td>{{$row->title}}</td>
                                        <td>{{$row->limit(strip_tags($row->description))}}</td>
                                        <td><img src="{{$row->background_image}}" class="img-fluid" style="width: 30px"> </td>
                                            <td>
                                                <a href="{{ URL::route('service.edit',$row->service_id) }}"
                                                   class="btn btn-primary" style="position: relative;"> {{trans('back.edit')}} </a>
                                                <a href="{{ URL::route('service.show',$row->service_id) }}"
                                                   class="btn btn-primary" style="position: relative;"> {{trans('back.show')}} </a>
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
