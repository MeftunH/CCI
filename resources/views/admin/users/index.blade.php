<link rel="stylesheet" type="text/css"
      href="{{asset('./backend/app-assets/vendors/css/tables/datatable/dataTable.min.css')}}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

@extends('layouts.backend.master')
@section('title')
    {{trans('back.news_index')}}
@endsection
@section('css')
@endsection
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.10.25/datatables.min.css"/>

@section('content')
    <div class="app-content content " xmlns="">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">{{trans('back.users')}}</h2>
                        </div>
                    </div>
                </div>

            </div>
            <div class="content-body">

                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-left">
                            <h2>Users Management</h2>
                        </div>
                        <div class="pull-right">
                            <a class="btn btn-success" href="{{ route('users.create') }}"> Create New User</a>
                        </div>
                    </div>
                </div>


                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif


                <table class="table table-bordered" id="users">
                    <thead>
                    <tr>
                        <th> {{trans('back.no')}}</th>
                        <th> {{trans('back.name')}}</th>
                        <th> {{trans('back.email')}}</th>
                        <th> {{trans('back.roles')}}</th>
                        <th width="280px"> {{trans('back.action')}}</th>
                    </tr>
                    </thead>
                    @php($i=0)
                    <tbody>
                    @foreach ($data as $key => $user)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if(!empty($user->getRoleNames()))
                                    @foreach($user->getRoleNames() as $v)
                                        <label class="badge badge-success">{{ $v }}</label>
                                    @endforeach
                                @endif
                            </td>
                            <td>
                                <a class="btn btn-info" href="{{ route('users.show',$user->id) }}"> {{trans('back.show')}}</a>
                                <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}"> {{trans('back.edit')}}</a>
                                {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
{{--{{$data->render()}}--}}
@endsection
@section('js')
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.10.25/datatables.min.js" defer></script>
    <script
        src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js" defer></script>
    <script src="{{asset('./edit.js')}}" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            $('#users').DataTable();
        });
    </script>
@endsection
