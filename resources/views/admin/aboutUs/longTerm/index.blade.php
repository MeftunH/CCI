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
                                        <th>{{trans('back.action')}}</th>
                                    </tr>
                                    </thead>
                                    @php($i=1)
                                    <tbody>
                                    <tr>
                                        @if(isset($long_term_items))
                                            @foreach($long_term as $lt)
                                                <td>{{$i++}}</td>
                                                <td>{{$lt->title}}</td>
                                                <td>{{$lt->limit(strip_tags($lt->description))}}</td>

                                                <td>
                                                    <div class="demo-inline-spacing">
                                                            <a href="{{ URL::route('aboutUs.long_term.edit',$lt->long_term_id) }}"
                                                               class="btn btn-primary"
                                                               style="position: relative;"> {{trans('back.edit')}} </a>


                                                            <a href="{{ URL::route('aboutUs.long_term.show',$lt->long_term_id) }}"
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
                               href="{{route('aboutUs.long_term.item.create')}}">{{trans('backend.create_item')}}</a>
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
                                    @if(isset($long_term_items))
                                        @foreach($long_term_items as $lt)
                                            <tr>
                                                <td>{{$i++}}</td>
                                                <td>{{$lt->title}}</td>
                                                <td>
                                                    <div class="demo-inline-spacing">
                                                        <a href="{{ URL::route('aboutUs.long_term.item.edit',$lt->item_id) }}"
                                                           class="btn btn-primary"
                                                           style="position: relative;"> {{trans('back.edit')}} </a>

                                                        <a href="{{ URL::route('aboutUs.long_term.item.show',$lt->item_id) }}"
                                                           class="btn btn-warning"
                                                           style="position: relative;"> {{trans('back.show')}} </a>

                                                        <form method="POST" class="buttons-group"
                                                              action="{{ URL::route('aboutUs.long_term.item.destroy',$lt->item_id) }}">
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
                                {{$long_term_items->render()}}
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
                            <h2 class="content-header-title float-left mb-0">{{trans('back.timeline')}}</h2>
                        </div>
                        <div class="col-6">
                            <a type="button" class="btn btn-gradient-success"
                               href="{{route('aboutUs.time_line.create')}}">{{trans('backend.add_to_timeline')}}</a>
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
                                        <th>{{trans('back.date')}}</th>
                                        <th>{{trans('back.action')}}</th>
                                    </tr>
                                    </thead>
                                    @php($i=1)
                                    <tbody>
                                    @if(isset($time_line))
                                        @foreach($time_line as $lt)
                                            <tr>
                                                <td>{{$i++}}</td>
                                                <td>{{$lt->title}}</td>

                                                <td>{{\App\Helpers\LanguageHelper::DateTranslate($lt->date)}}</td>
                                                <td>
                                                    <div class="demo-inline-spacing">
                                                        <a href="{{ URL::route('aboutUs.long_term.timeline.edit',$lt->time_line_id) }}"
                                                           class="btn btn-primary"
                                                           style="position: relative;"> {{trans('back.edit')}} </a>

                                                        <a href="{{ URL::route('aboutUs.long_term.timeline.show',$lt->time_line_id) }}"
                                                           class="btn btn-warning"
                                                           style="position: relative;"> {{trans('back.show')}} </a>

                                                        <form method="POST" class="buttons-group"
                                                              action="{{ URL::route('aboutUs.long_term.timeline.destroy',$lt->time_line_id) }}">
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
                                {{$long_term_items->render()}}
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
