@extends('layouts.backend.master')
@section('title')
    {{trans('back.long_term')}}
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
                            <h2 class="content-header-title float-left mb-0">{{trans('back.future')}}</h2>
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
                                        <th>{{trans('back.action')}}</th>
                                    </tr>
                                    </thead>
                                    @php($i=1)
                                    <tbody>
                                    <tr>
                                        @if(isset($future))
                                            <td>{{$i++}}</td>
                                            <td>{{$future->localized_data->first()->title}}</td>
                                            <td>{{$future->localized_data->first()->description}}</td>

                                            <td>
                                                <div class="demo-inline-spacing">
                                                    <a href="{{ URL::route('aboutUs.future.edit',$future->id) }}"
                                                       class="btn btn-primary"
                                                       style="position: relative;"> {{trans('back.edit')}} </a>


                                                    <a href="{{ URL::route('aboutUs.future.show',$future->id) }}"
                                                       class="btn btn-primary"
                                                       style="position: relative;"> {{trans('back.show')}} </a>
                                                </div>
                                            </td>
                                        @endif
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
                            <h2 class="content-header-title float-left mb-0">{{trans('back.future_item')}}</h2>
                        </div>
                        @if($active_count < 4)
                            <div class="col-6">
                                <a type="button" class="btn btn-gradient-success"
                                   href="{{route('aboutUs.future.item.create')}}">{{trans('back.create_item')}}</a>
                                <span class="badge badge-light-warning">{{trans('active_item count')}} {{$active_count}}/4  </span>
                                @else
                                    <span
                                        class="badge badge-light-danger">{{trans('active_item count')}} {{$active_count}}/4 {{trans('back.max_active_item_count_is_4')}} </span>
                                @endif
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
                                        <th>{{trans('back.image')}}</th>
                                        <th>{{trans('back.action')}}</th>
                                        <th>{{trans('back.status')}}</th>
                                    </tr>
                                    </thead>
                                    @php($i=1)
                                    <tbody>
                                    @if(isset($futureItems))
                                        @foreach($futureItems as $futureItem)
                                            @foreach($futureItem->localized_data as $fi)
                                                <tr>
                                                    <td>{{$i++}}</td>
                                                    <td>{{$fi->title}}</td>
                                                    <td><img src="{{$futureItem->image}}" class="img-fluid"
                                                             style="width: 30px"></td>
                                                    <td>
                                                        <div class="demo-inline-spacing">
                                                            <a href="{{ URL::route('aboutUs.future.item.edit',$futureItem->id) }}"
                                                               class="btn btn-primary"
                                                               style="position: relative;"> {{trans('back.edit')}} </a>

                                                            <a href="{{ URL::route('aboutUs.future.item.show',$futureItem->id) }}"
                                                               class="btn btn-warning"
                                                               style="position: relative;"> {{trans('back.show')}} </a>

                                                            <form method="POST" class="buttons-group"
                                                                  action="{{ URL::route('aboutUs.future.item.destroy',$futureItem->id) }}">
                                                                {{ csrf_field() }}
                                                                {{ method_field('DELETE') }}
                                                                <button type="submit"
                                                                        class="btn btn-gradient-danger delete-item"
                                                                        style="position: relative;"> {{trans('back.delete')}} </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                    <td>@if($futureItem->status == 1) <span
                                                            class="badge badge-light-success"> {{trans('back.active')}} </span>
                                                        @else<span
                                                                class="badge badge-light-danger"> {{trans('back.passive')}} </span>@endif
                                                    </td>
                                                </tr>

                                            @endforeach

                                        @endforeach
                                    @endif
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
                            <h2 class="content-header-title float-left mb-0">{{trans('back.add_to_future_list')}}</h2>
                        </div>
                        @if($list_active_count < 3)
                            <div class="col-6">
                                <a type="button" class="btn btn-gradient-success"
                                   href="{{route('aboutUs.future.list.item.create')}}">{{trans('back.create_content_to_list')}}</a>
                                <span class="badge badge-light-warning">{{trans('active_item count')}} {{$list_active_count}}/3  </span>
                                @else
                                    <span
                                        class="badge badge-light-danger">{{trans('active_item count')}} {{$list_active_count}}/3 {{trans('back.max_active_item_count_is_3')}} </span>
                                @endif
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
                                        <th>{{trans('back.action')}}</th>
                                        <th>{{trans('back.status')}}</th>
                                    </tr>
                                    </thead>
                                    @php($i=1)
                                    <tbody>
                                    @if(isset($future_list_items))
                                        @foreach($future_list_items as $future_list_item)
                                            @foreach($future_list_item->localized_data as $fi)
                                                <tr>
                                                    <td>{{$i++}}</td>
                                                    <td>{{$fi->title}}</td>
                                                    <td>{{$fi->description}}</td>

                                                    <td>@if($future_list_item->status == 1) <span
                                                            class="badge badge-light-success"> {{trans('back.active')}} </span>
                                                        @else<span
                                                                class="badge badge-light-danger"> {{trans('back.passive')}} </span>@endif
                                                    </td>
                                                    <td>
                                                        <div class="demo-inline-spacing">
                                                            <a href="{{ URL::route('aboutUs.future.list.item.edit',$future_list_item->id) }}"
                                                               class="btn btn-primary"
                                                               style="position: relative;"> {{trans('back.edit')}} </a>

                                                            <a href="{{ URL::route('aboutUs.future.list.item.show',$future_list_item->id) }}"
                                                               class="btn btn-warning"
                                                               style="position: relative;"> {{trans('back.show')}} </a>

                                                            <form method="POST" class="buttons-group"
                                                                  action="{{ URL::route('aboutUs.future.item.destroy',$future_list_item->id) }}">
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

                                        @endforeach
                                    @endif
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

    <script type="text/javascript">
        $("#formDelete").submit(function (event) {
            var x = confirm("Are you sure you want to delete?");
            if (x) {
                return true;
            } else {

                event.preventDefault();
                return false;
            }

        });
    </script>
    <script src="{{asset('./edit.js')}}" type="text/javascript"></script>
@endsection
