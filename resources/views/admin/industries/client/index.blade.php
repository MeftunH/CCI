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
                            <h2 class="content-header-title float-left mb-0">About Us Long Term</h2>
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
                                        @if(isset($industry_client))
                                            @foreach($industry_client as $row)
                                                <td>{{$i++}}</td>
                                                <td>{{$row->title}}</td>
                                                <td>{{$row->limit(strip_tags($row->description))}}</td>
                                                <td><img src="{{$row->background_image}}" class="img-fluid" style="width: 30px" alt=""> </td>
                                                <td>
                                                    <div class="demo-inline-spacing">
                                                        <a href="{{ URL::route('aboutUs.industry.client.update',$row->industry_client_id) }}"
                                                           class="btn btn-primary"
                                                           style="position: relative;"> {{trans('back.edit')}} </a>


                                                        <a href="{{ URL::route('aboutUs.industry.client.show',$row->industry_client_id) }}"
                                                           class="btn btn-primary"
                                                           style="position: relative;"> {{trans('back.show')}} </a>
                                                    </div>
                                                </td>
                                            @endforeach
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
                            <h2 class="content-header-title float-left mb-0">{{trans('back.long_term_items')}}</h2>
                        </div>
                        <div class="col-6">
                            <a type="button" class="btn btn-gradient-success"
                               href="{{route('aboutUs.industry.client.item.create')}}">{{trans('backend.create_item')}}</a>
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
                                        <th>{{trans('back.action')}}</th>
                                    </tr>
                                    </thead>
                                    @php($i=1)
                                    <tbody>
                                    @if(isset($industry_client_items))
                                        @foreach($industry_client_items as $lt)
                                            <tr>
                                                <td>{{$i++}}</td>
                                                <td>{{$lt->title}}</td>
                                                <td>
                                                    <div class="demo-inline-spacing">
                                                        <a href="{{ URL::route('aboutUs.industry.client.item.edit',$lt->item_id) }}"
                                                           class="btn btn-primary"
                                                           style="position: relative;"> {{trans('back.edit')}} </a>

                                                        <a href="{{ URL::route('aboutUs.industry.client.item.show',$lt->item_id) }}"
                                                           class="btn btn-warning"
                                                           style="position: relative;"> {{trans('back.show')}} </a>

                                                        <form method="POST" class="buttons-group"
                                                              onclick="return confirm('{{trans('back.r_u_sure')}}')"
                                                              action="{{ URL::route('aboutUs.industry.client.item.destroy',$lt->item_id) }}">
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
                                {{$industry_client_items->links()}}
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
                            <h2 class="content-header-title float-left mb-0">{{trans('back.cards')}}</h2>
                        </div>
                        <div class="col-6">
                            @if($active_count < 3)
                                <div class="col-6">
                                    <a type="button" class="btn btn-gradient-success"
                                       href="{{route('aboutUs.industry.experience.create')}}">{{trans('backend.add_card')}}</a>
                                    <span class="badge badge-light-warning">{{trans('active_item count')}} {{$active_count}}/3  </span>
                                    @else
                                        <span
                                            class="badge badge-light-danger">{{trans('active_item count')}} {{$active_count}}/3 {{trans('back.max_active_item_count_is_3')}} </span>
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
                                    @if(isset($experiences))
                                        @foreach($experiences as $lt)
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
                                                        <a href="{{ URL::route('aboutUs.industry.experience.edit',$lt->experience_id) }}"
                                                           class="btn btn-primary"
                                                           style="position: relative;"> {{trans('back.edit')}} </a>

                                                        <a href="{{ URL::route('aboutUs.industry.experience.show',$lt->experience_id) }}"
                                                           class="btn btn-warning"
                                                           style="position: relative;"> {{trans('back.show')}} </a>

                                                        <form method="POST" class="buttons-group" onclick="return confirm('{{trans('back.r_u_sure')}}')"
                                                              action="{{ URL::route('aboutUs.industry.experience.destroy',$lt->experience_id) }}">
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
