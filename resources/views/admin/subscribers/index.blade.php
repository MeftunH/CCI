@extends('layouts.backend.master')
@section('title')
{{trans('back.subscribers')}}
@endsection
@section('css')
@endsection
<link rel="stylesheet" type="text/css" href="{{asset('./backend/app-assets/vendors/css/vendors.min.css')}}">
@section('content')
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">{{trans('back.subscribers')}}</h2>
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
                                <table class="datatables-basic table" id="sub">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{trans('back.email')}}</th>
                                        <th>{{trans('back.is_subscriber_now')}}</th>
                                        <th>{{trans('back.sub_prefer_lang')}}</th>
                                        <th>{{trans('back.sub_date')}}</th>
                                    </tr>
                                    </thead>
                                    @php($i=1)

                                    <tbody>
                                    <tr>
                                        @foreach($subscribers as $sub)
                                        <td>{{$i++}}</td>
                                        <td>{{$sub->email}}</td>
                                        <td>{{$sub->subscribed ? trans('back.yes') : trans('back.no')}}</td>
                                        <td>{{$sub->locale}}</td>
                                        <td>{{$sub->created_at}}</td>
                                    </tr>
                                        @endforeach



                                    </tbody>
                                </table>
{{--{{$subscribers->links()}}--}}
                            </div>
                        </div>
                    </div>

                </section>
            </div>
        </div>
    </div>

@endsection
@section('js')
    <script
        src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
        crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js" defer></script>
    <script>
        $(document).ready(function () {
            $('#sub').DataTable();
        });
    </script>

@endsection
