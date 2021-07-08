@extends('layouts.backend.master')
@section('title')
    {{trans('back.home_index')}}
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
                            <h2 class="content-header-title float-left mb-0">{{trans('back.home')}}</h2>
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
                                                    <a href="{{ URL::route('homepage.edit',$row->intro_id) }}"
                                                       class="btn btn-primary"
                                                       style="position: relative;"> {{trans('back.edit')}} </a>
                                                    <a href="{{ URL::route('news.show',$row->intro_id) }}"
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
                <div class="content-header row">
                    <div class="content-header-left col-md-9 col-12 mb-2">
                        <div class="row breadcrumbs-top">
                            <div class="col-12">
                                <h2 class="content-header-title float-left mb-0">{{trans('back.innovation_module')}}</h2>
                            </div>
                        </div>
                    </div>

                </div>
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
                                        <th>{{trans('back.action')}}</th>
                                    </tr>
                                    </thead>
                                    @php($i=1)
                                    <tbody>
                                    <tr>
                                        @foreach($innovation_module as $row)
                                            <td>{{$i++}}</td>
                                            <td>{{$row->title}}</td>
                                            <td>{{$row->limit(strip_tags($row->description))}}</td>
                                            <td>
                                                <div class="demo-inline-spacing">
                                                    <a href="{{ URL::route('homepage.innovationModuleEdit',$row->intro_id) }}"
                                                       class="btn btn-primary"
                                                       style="position: relative;"> {{trans('back.edit')}} </a>
                                                    <a href="{{ URL::route('homepage.innovationModuleShow',$row->intro_id) }}"
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
                <div class="content-header row">
                    <div class="content-header-left col-md-9 col-12 mb-2">
                        <div class="row breadcrumbs-top">
                            <div class="col-12">
                                <h2 class="content-header-title float-left mb-0">{{trans('back.unlock_module')}}</h2>
                            </div>
                        </div>
                    </div>

                </div>
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
                                        <th>{{trans('back.background_image')}}</th>
                                        <th>{{trans('back.action')}}</th>
                                    </tr>
                                    </thead>
                                    @php($i=1)
                                    <tbody>
                                    <tr>
                                        @foreach($unlock_module as $row)
                                            <td>{{$i++}}</td>
                                            <td>{{$row->title}}</td>
                                            <td>{{$row->limit(strip_tags($row->description))}}</td>
                                            <td><img src="{{$row->image}}" class="img-fluid"
                                                     style="width: 30px" alt=""></td>
                                            <td><img src="{{$row->background_image}}" class="img-fluid"
                                                     style="width: 30px" alt=""></td>
                                            <td>
                                                <div class="demo-inline-spacing">
                                                    <a href="{{ URL::route('homepage.unlockModuleEdit',$row->intro_id) }}"
                                                       class="btn btn-primary"
                                                       style="position: relative;"> {{trans('back.edit')}} </a>
                                                    <a href="{{ URL::route('homepage.unlockModuleShow',$row->intro_id) }}"
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
{{--        <div class="content-wrapper">--}}
{{--            <div class="content-header row">--}}
{{--                <div class="content-header-left col-md-9 col-12 mb-2">--}}
{{--                    <div class="row breadcrumbs-top">--}}
{{--                        <div class="col-6">--}}
{{--                            <h2 class="content-header-title float-left mb-0">{{trans('back.news')}}</h2>--}}
{{--                        </div>--}}
{{--                        @can('news-create')--}}
{{--                            <div class="col-6">--}}
{{--                                <a type="button" class="btn btn-gradient-success"--}}
{{--                                   href="{{route('news.newsCreate')}}">{{trans('back.create_news')}}</a>--}}
{{--                            </div>--}}
{{--                        @endcan--}}
{{--                    </div>--}}

{{--                </div>--}}

{{--            </div>--}}
{{--            <div class="content-body">--}}
{{--                <!-- Basic table -->--}}

{{--                <section id="basic-datatable">--}}
{{--                    <div class="row">--}}
{{--                        <div class="col-12">--}}
{{--                            <div class="card">--}}
{{--                                <table class="datatables-basic table" id="news">--}}
{{--                                    <thead>--}}
{{--                                    <tr>--}}
{{--                                        <th>#</th>--}}
{{--                                        <th>{{trans('back.title')}}</th>--}}
{{--                                        <th>{{trans('back.description')}}</th>--}}
{{--                                        <th>{{trans('back.image')}}</th>--}}
{{--                                        <th>{{trans('back.action')}}</th>--}}
{{--                                        <th>{{trans('back.status')}}</th>--}}
{{--                                    </tr>--}}
{{--                                    </thead>--}}
{{--                                    @php($i=1)--}}
{{--                                    <tbody>--}}
{{--                                    @if(isset($news))--}}
{{--                                        @foreach($news as $row)--}}

{{--                                            <tr>--}}
{{--                                                <td>{{$i++}}</td>--}}
{{--                                                <td>{{$row->title}}</td>--}}
{{--                                                <td>{{ $row->limit($row->description) }}</td>--}}
{{--                                                <td><img src="{{$row->image}}" class="img-fluid"--}}
{{--                                                         style="width: 30px"></td>--}}
{{--                                                <td>--}}
{{--                                                    <div class="demo-inline-spacing">--}}
{{--                                                        @can('news-create')--}}
{{--                                                            <a href="{{ URL::route('news.newsEdit',$row->news_id) }}"--}}
{{--                                                               class="btn btn-primary"--}}
{{--                                                               style="position: relative;"> {{trans('back.edit')}} </a>--}}
{{--                                                        @endcan--}}
{{--                                                        <a href="{{ URL::route('news.newsShow',$row->news_id) }}"--}}
{{--                                                           class="btn btn-warning"--}}
{{--                                                           style="position: relative;"> {{trans('back.show')}} </a>--}}

{{--                                                        @can('news-delete')--}}
{{--                                                            <form method="POST" class="buttons-group"--}}
{{--                                                                  onclick="return confirm('{{trans('back.r_u_sure')}}')"--}}
{{--                                                                  action="{{ URL::route('news.newsDestroy',$row->news_id) }}">--}}
{{--                                                                {{ csrf_field() }}--}}
{{--                                                                {{ method_field('DELETE') }}--}}
{{--                                                                <button type="submit"--}}
{{--                                                                        class="btn btn-gradient-danger delete-item"--}}
{{--                                                                        style="position: relative;"> {{trans('back.delete')}} </button>--}}
{{--                                                            </form>--}}
{{--                                                        @endcan--}}
{{--                                                    </div>--}}
{{--                                                </td>--}}
{{--                                                <td>@if($row->status == 1) <span--}}
{{--                                                        class="badge badge-light-success"> {{trans('back.active')}} </span>--}}
{{--                                                    @else<span--}}
{{--                                                            class="badge badge-light-danger"> {{trans('back.passive')}} </span>@endif--}}
{{--                                                </td>--}}
{{--                                            </tr>--}}

{{--                                        @endforeach--}}

{{--                                    @endif--}}
{{--                                    </tbody>--}}
{{--                                </table>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                </section>--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>

@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $('#news').DataTable();
        });
    </script>
@endsection
