@extends('layouts.backend.master')
@section('title')
    {{trans('back.innovation')}}
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
                            <h2 class="content-header-title float-left mb-0">{{trans('back.innovation')}}</h2>
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
                                        @foreach($innovation as $inv)
                                            <td>{{$i++}}</td>
                                            <td>{{$inv->title}}</td>
                                            <td>{{$inv->limit(strip_tags($inv->description))}}</td>
                                            <td>
                                                <div class="demo-inline-spacing">
                                                    <a href="{{ URL::route('aboutUs.services.innovation.edit',$inv->innovation_id) }}"
                                                       class="btn btn-primary"
                                                       style="position: relative;"> {{trans('back.edit')}} </a>
                                                    <a href="{{ URL::route('aboutUs.services.innovation.show',$inv->innovation_id) }}"
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
                            <h2 class="content-header-title float-left mb-0">{{trans('back.innovation_items')}}</h2>
                        </div>
                        <div class="col-6">
                            @if($active_count < 6)
                                <div class="col-6">
                                    <a type="button" class="btn btn-gradient-success"
                                       href="{{route('aboutUs.services.innovation.item.create')}}">{{trans('backend.add_item')}}</a>
                                    <span class="badge badge-light-warning">{{trans('back.active_item_count')}} {{$active_count}}/6  </span>
                                    @else
                                        <span
                                            class="badge badge-light-danger">{{trans('back.active_item_count_max')}} {{$active_count}}/6 </span>
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
                                        <th>{{trans('back.status')}}</th>
                                        <th>{{trans('back.action')}}</th>
                                    </tr>
                                    </thead>
                                    @php($i=1)
                                    <tbody>
                                    @if(isset($innovation_items))
                                        @foreach($innovation_items as $lt)
                                            <tr>
                                                <td>{{$i++}}</td>
                                                <td>{{$lt->title}}</td>
                                                <td><img src="{{$lt->image}}" alt="{{$lt->image}}" class="img-fluid" style="width: 30px"> </td>
                                                <td>
                                                    @if($lt->status == 1)
                                                        <span
                                                            class="badge badge-success badge-pill"> {{trans('back.active')}} </span>
                                                    @else
                                                        <span
                                                            class="badge badge-danger badge-pill"> {{trans('back.passive')}}  </span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="demo-inline-spacing">
                                                        <a href="{{ URL::route('aboutUs.services.innovation.item.edit',$lt->item_id) }}"
                                                           class="btn btn-primary"
                                                           style="position: relative;"> {{trans('back.edit')}} </a>

                                                        <a href="{{ URL::route('aboutUs.services.innovation.item.show',$lt->item_id) }}"
                                                           class="btn btn-warning"
                                                           style="position: relative;"> {{trans('back.show')}} </a>

                                                        <form method="POST" class="buttons-group"
                                                              onclick="return confirm('{{trans('back.r_u_sure')}}')"
                                                              action="{{ URL::route('aboutUs.services.innovation.item.destroy',$lt->item_id) }}">
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
                            <h2 class="content-header-title float-left mb-0">{{trans('back.service_cards')}}</h2>
                        </div>
                        <div class="col-6">
                            @if($service_card_active_count < 3)
                                <div class="col-6">
                                    <a type="button" class="btn btn-gradient-success"
                                       href="{{route('aboutUs.services.card.create')}}">{{trans('backend.add_item')}}</a>
                                    <span class="badge badge-light-warning">{{trans('active_item count')}} {{$service_card_active_count}}/3  </span>
                                    @else
                                        <span
                                            class="badge badge-light-danger">{{trans('active_item count')}} {{$service_card_active_count}}/3 {{trans('back.max_active_item_count')}} </span>
                                    @endif
                                </div>
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
                                        <th>{{trans('back.action')}}</th>
                                    </tr>
                                    </thead>
                                    @php($i=1)
                                    <tbody>
                                    @if(isset($service_cards))
                                        @foreach($service_cards as $lt)
                                            <tr>
                                                <td>{{$i++}}</td>
                                                <td>{{$lt->title}}</td>
                                                <td>{{$lt->description}}</td>
                                                <td><img src="{{$lt->image}}" alt="{{$lt->image}}" class="img-fluid" style="width: 30px"> </td>
                                                <td>
                                                    @if($lt->status == 1)
                                                        <span
                                                            class="badge badge-success badge-pill"> {{trans('back.active')}} </span>
                                                    @else
                                                        <span
                                                            class="badge badge-danger badge-pill"> {{trans('back.passive')}}  </span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="demo-inline-spacing">
                                                        <a href="{{ URL::route('aboutUs.services.card.edit',$lt->service_card_id) }}"
                                                           class="btn btn-primary"
                                                           style="position: relative;"> {{trans('back.edit')}} </a>

                                                        <a href="{{ URL::route('aboutUs.services.card.show',$lt->service_card_id) }}"
                                                           class="btn btn-warning"
                                                           style="position: relative;"> {{trans('back.show')}} </a>

                                                        <form method="POST" class="buttons-group"
                                                              onclick="return confirm('{{trans('back.r_u_sure')}}')"
                                                              action="{{ URL::route('aboutUs.services.card.destroy',$lt->service_card_id) }}">
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
