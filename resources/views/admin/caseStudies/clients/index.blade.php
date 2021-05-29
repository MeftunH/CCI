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
                            <div class="card">
                                <table class="datatables-basic table">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{trans('back.image')}}</th>
                                        <th>{{trans('back.status')}}</th>
                                        <th>{{trans('back.slider_content')}}</th>
                                        <th>{{trans('back.actions')}}</th>
                                    </tr>
                                    </thead>
                                    @php($i=1)
                                    <tbody>

                                    @if(isset($client))

                                        @foreach($client as $cs)
                                            <tr>
                                                <td>{{$i++}}</td>
                                                <td><img src="{{$cs->image}}" class="img-fluid"
                                                         style="width: 30px"></td>
                                                <td>
                                                  @if($cs->status == 1)
                                                        <span class="badge badge-success badge-pill"> {{trans('back.active')}} </span>
                                                    @else
                                                        <span class="badge badge-danger badge-pill"> {{trans('back.passive')}}  </span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($cs->is_slide_content == 1)
                                                        <span class="badge badge-success badge-pill"> {{trans('back.yes')}} </span>
                                                    @else
                                                        <span class="badge badge-danger badge-pill"> {{trans('back.no')}}  </span>
                                                    @endif
                                                </td>
                                                <td>

                                                    <div class="demo-inline-spacing">
                                                    <a href="{{ URL::route('clients.edit',$cs->id) }}"
                                                       class="btn btn-primary"
                                                       style="position: relative;"> {{trans('back.edit')}} </a>
                                                    <a href="{{ URL::route('clients.show',$cs->id) }}"
                                                       class="btn btn-warning"
                                                       style="position: relative;"> {{trans('back.show')}} </a>
                                                        <form method="POST" class="buttons-group"
                                                              action="{{ URL::route('clients.destroy',$cs->id) }}">
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
                                {{$client->links()}}
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
