@extends('layouts.backend.master')
@section('title')
    {{trans('back.resume')}}
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
                                        <th>{{trans('back.footer')}}</th>
                                        <th>{{trans('back.image')}}</th>
                                        <th>{{trans('back.action')}}</th>
                                    </tr>
                                    </thead>
                                    @php($i=1)
                                    <tbody>
                                    <tr>
                                        @if(isset($resume_intro))
                                            @foreach($resume_intro as $lt)
                                                <td>{{$i++}}</td>
                                                <td>{{$lt->limit(strip_tags($lt->title))}}</td>
                                                <td>{{$lt->limit(strip_tags($lt->description))}}</td>
                                                <td>{{$lt->limit(strip_tags($lt->footer))}}</td>
                                                <td><img src="{{$lt->image}}" class="img-fluid"
                                                         style="width: 30px"></td>

                                                <td>
                                                    <div class="demo-inline-spacing">
                                                        <a href="{{ URL::route('resumeUp.edit',$lt->item_id) }}"
                                                           class="btn btn-primary"
                                                           style="position: relative;"> {{trans('back.edit')}} </a>


                                                        <a href="{{ URL::route('resumeUp.show',$lt->item_id) }}"
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
                            <h2 class="content-header-title float-left mb-0">{{trans('back.resumes')}}</h2>
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
                                        <th>{{trans('back.doc_name')}}</th>
                                        <th>{{trans('back.sent_date')}}</th>
                                        <th>{{trans('back.download')}}</th>
                                    </tr>
                                    </thead>
                                    @php($i=1)
                                    <tbody>
                                    @if(isset($resumes))
                                        @foreach($resumes as $resume)
                                            <tr>
                                                <td>{{$i++}}</td>
                                                <td>{{$resume->resume}}</td>
                                                <td>{{$resume->created_at}}</td>
                                                <td>
                                                    <div class="demo-inline-spacing">
                                                        <a href="{{ URL::route('resume.download',$resume->id) }}"
                                                           class="btn btn-gradient-success"
                                                           style="position: relative;"> {{trans('back.download')}} </a>
                                                    </div>
                                                </td>

                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                                {{$resumes->links()}}
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
