@extends('layouts.backend.master')
@section('title')
    {{trans('back.career_consulting')}}
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
                            <h2 class="content-header-title float-left mb-0">{{trans('back.career_consulting')}}</h2>
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
                                        @if(isset($career_consulting))
                                            @foreach($career_consulting as $lt)
                                                <td>{{$i++}}</td>
                                                <td>{{$lt->title}}</td>
                                                <td>{{$lt->limit(strip_tags($lt->description))}}</td>

                                                <td>
                                                    <div class="demo-inline-spacing">
                                                        <a href="{{ URL::route('careerConsulting.edit',$lt->cc_id) }}"
                                                           class="btn btn-primary"
                                                           style="position: relative;"> {{trans('back.edit')}} </a>


                                                        <a href="{{ URL::route('careerConsulting.show',$lt->cc_id) }}"
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
                            <h2 class="content-header-title float-left mb-0">{{trans('back.items')}}</h2>
                        </div>
                        <div class="col-6">
                            <a type="button" class="btn btn-gradient-success"
                               href="{{route('careerConsultingItem.item.create')}}">{{trans('backend.create_item')}}</a>
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
                                    @if(isset($career_consulting_items))
                                        @foreach($career_consulting_items as $lt)
                                            <tr>
                                                <td>{{$i++}}</td>
                                                <td>{{$lt->title}}</td>
                                                <td>
                                                    <div class="demo-inline-spacing">
                                                        <a href="{{ URL::route('careerConsultingItem.item.edit',$lt->item_id) }}"
                                                           class="btn btn-primary"
                                                           style="position: relative;"> {{trans('back.edit')}} </a>

                                                        <a href="{{ URL::route('careerConsultingItem.item.show',$lt->item_id) }}"
                                                           class="btn btn-warning"
                                                           style="position: relative;"> {{trans('back.show')}} </a>

                                                        <form method="POST" class="buttons-group"
                                                              onclick="return confirm('{{trans('back.r_u_sure')}}')"
                                                              action="{{ URL::route('careerConsultingItem.item.destroy',$lt->item_id) }}">
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
                                {{$career_consulting_items->links()}}
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
                            @if($active_count < 4)
                                <div class="col-6">
                                    <a type="button" class="btn btn-gradient-success"
                                       href="{{route('careerConsultingCard.card.create')}}">{{trans('backend.add_card')}}</a>
                                    <span
                                        class="badge badge-light-warning">{{trans('active_item count')}} {{$active_count}}/4  </span>
                                    @else
                                        <span
                                            class="badge badge-light-danger">{{trans('active_item count')}} {{$active_count}}/4 {{trans('back.max_active_item_count_is_4')}} </span>
                                    @endif
                                </div>
                        </div>
                    </div>
                </div>
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif
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
                                    @if(isset($cc_cards))
                                        @foreach($cc_cards as $lt)
                                            <tr>
                                                <td>{{$i++}}</td>
                                                <td>{{$lt->title}}</td>
                                                <td>{!! $lt->limit($lt->description) !!}</td>
                                                <td><img src="{{$lt->image}}" alt="{{$lt->image}}" class="img-fluid"
                                                         style="width: 30px"></td>
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
                                                        <a href="{{ URL::route('careerConsultingCard.card.edit',$lt->cc_card_id) }}"
                                                           class="btn btn-primary"
                                                           style="position: relative;"> {{trans('back.edit')}} </a>

                                                        <a href="{{ URL::route('careerConsultingCard.card.show',$lt->cc_card_id) }}"
                                                           class="btn btn-warning"
                                                           style="position: relative;"> {{trans('back.show')}} </a>

                                                        <form method="POST" class="buttons-group"
                                                              onclick="return confirm('{{trans('back.r_u_sure')}}')"
                                                              action="{{ URL::route('careerConsultingCard.card.destroy',$lt->cc_card_id) }}">
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
