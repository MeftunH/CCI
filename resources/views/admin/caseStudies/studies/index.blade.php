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
                               href="{{route('studies.create')}}">{{trans('backend.create_study')}}</a>
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
                                        <th>{{trans('back.image')}}</th>
                                        <th>{{trans('back.status')}}</th>
                                        <th>{{trans('back.actions')}}</th>
                                    </tr>
                                    </thead>
                                    @php($i=1)
                                    <tbody>

                                    @if(isset($studies))
                                        @foreach($studies as $cs)
                                            <tr>
                                                <td>{{$i++}}</td>
                                                <td>{{$cs->title}}</td>
                                                <td>{{$cs->limit(strip_tags($cs->description))}}</td>
                                                <td><img src="{{$cs->image}}" class="img-fluid"
                                                         style="width: 30px"></td>
                                                <td>
                                                    @if($cs->status == 1)
                                                        <span
                                                            class="badge badge-success badge-pill"> {{trans('back.active')}} </span>
                                                    @else
                                                        <span
                                                            class="badge badge-danger badge-pill"> {{trans('back.passive')}}  </span>
                                                    @endif
                                                </td>
                                                <td>

                                                    <div class="demo-inline-spacing">
                                                        <a href="{{ URL::route('studies.edit',$cs->study_id) }}"
                                                           class="btn btn-primary"
                                                           style="position: relative;"> {{trans('back.edit')}} </a>
                                                        <a href="{{ URL::route('studies.show',$cs->study_id) }}"
                                                           class="btn btn-warning"
                                                           style="position: relative;"> {{trans('back.show')}} </a>
                                                        <form method="POST" class="buttons-group"
                                                              onclick="return confirm('{{trans('back.r_u_sure')}}')"
                                                              action="{{ URL::route('studies.destroy',$cs->study_id) }}">
                                                            {{ csrf_field() }}
                                                            {{ method_field('DELETE') }}
                                                            <button type="submit"
                                                                    class="btn btn-gradient-danger delete-item"
                                                                    style="position: relative;"> {{trans('back.delete')}} </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif


                                    </tbody>
                                </table>
                                {{$studies->links()}}
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
