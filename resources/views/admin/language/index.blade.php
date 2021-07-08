@extends('layouts.backend.master')
@section('title')
    {{trans('back.languages')}}
@endsection
@section('css')
@endsection
<link rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
      integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
      crossorigin="anonymous">
@section('content')
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-6">
                            <h2 class="content-header-title float-left mb-0">{{trans('back.languages')}}</h2>
                        </div>
                        @can('language-create')
                            <div class="col-6">
                                <button type="button" onclick="window.location='{{route('languages.create')}}'"
                                        class="btn btn-success"
                                        style="position: relative;"> {{trans('back.add_languages')}} </button>
                            </div>
                        @endcan
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
                                        <th>{{trans('back.name')}}</th>
                                        <th>{{trans('back.code')}}</th>
                                        <th>{{trans('back.locale')}}</th>
                                        <th>{{trans('back.flag')}}</th>
                                        <th>{{trans('back.status')}}</th>
                                        <th>{{trans('back.action')}}</th>
                                        <th>{{trans('back.translations')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php($i=1)
                                    @if(isset($languages))
                                        @foreach($languages as $lang)

                                            <tr>
                                                <td>{{$i++}}</td>
                                                <td>{{$lang->name}}</td>
                                                <td>{{$lang->code}}</td>
                                                <td>{{$lang->locale}}</td>
                                                <td><img class="img-fluid" style="width: 30px" src="{{$lang->flag}}"
                                                         alt=""></td>
                                                <td>@if($lang->status == 1) <span
                                                        class="badge badge-light-success"> {{trans('back.active')}} </span>
                                                    @else<span
                                                            class="badge badge-light-danger"> {{trans('back.passive')}} </span>@endif
                                                </td>
                                                <td>

                                                    @can('language-edit')
                                                        <a href="{{ URL::route('languages.edit',$lang->id) }}"
                                                           class="btn btn-primary"
                                                           style="position: relative;"> {{trans('back.edit')}} </a>
                                                    @endcan
                                                    @can('language-delete')
                                                        @if($lang->code != 'en')
                                                            <form method="post"
                                                                  action="{{route('languages.destroy',$lang->id)}}">
                                                                @method('DELETE')
                                                                @csrf
                                                                <button type="submit" class="btn btn-danger"
                                                                        style="position: relative;">{{trans('back.delete')}}
                                                                </button>
                                                            </form>
                                                        @endif
                                                    @endcan
                                                </td>
                                                @can('edit-translations')
                                                <td>
                                                    <a onclick="EditModal(this.href, 'Edit Translation');return false;"
                                                       href="{{url('pages/config/edittranslation?edit='.$lang->locale.'&file=')}}"
                                                       class="btn btn-primary" data-toggle="modal"
                                                       data-target="#edit-modal">
                                                        {{trans('back.edit_translations')}}
                                                    </a>

                                                </td>
                                                @endcan
                                            </tr>

                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                                {{ $languages->links('pagination::bootstrap-4')}}
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
