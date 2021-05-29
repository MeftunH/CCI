@extends('layouts.backend.master')
@section('title')
    {{trans('back.case_studies_index')}}
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
                            <h2 class="content-header-title float-left mb-0">{{trans('back.case_studies_intro')}}</h2>
                        </div>
                        <div class="col-6">
                            <a type="button" class="btn btn-gradient-success"
                               href="{{route('clients.create')}}">{{trans('backend.create_client')}}</a>
                        </div>
                    </div>
                </div>

            </div>
            <div class="content-body">
                <!-- Basic table -->
                <section id="basic-datatable">
                    <div class="row">
                        <div class="col-12">
                            <form method="POST" action="{{route('aboutUs.caseStudies.clients.update_slider')}}">
                                @csrf
                            <div class="card">

                                <table class="datatables-basic table">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{trans('back.image')}}</th>
                                        <th>{{trans('back.slider_content')}}</th>
                                        <th>{{trans('back.add_to_slider')}}</th>
                                    </tr>
                                    </thead>
                                    @php($i=1)
                                    <tbody>

                                    @if(isset($clients))

                                        @foreach($clients as $cs)
                                            <tr>
                                                <td>{{$i++}}</td>
                                                <td><img src="{{$cs->image}}" class="img-fluid"
                                                         style="width: 30px"></td>
                                                <td>
                                                    @if($cs->is_slide_content == 1)
                                                        <span class="badge badge-success badge-pill"> {{trans('back.yes')}} </span>
                                                    @else
                                                        <span class="badge badge-danger badge-pill"> {{trans('back.no')}}  </span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="is_slide_content[{{ $cs->id }}]" @if($cs->is_slide_content == 1) checked @endif class="checkbox">
                                                    <label>{{trans('back.add')}}</label>

                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif


                                    </tbody>
                                </table>

                            </div>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="text-right">
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </form>

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
        <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'
                type='text/javascript'></script>
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
