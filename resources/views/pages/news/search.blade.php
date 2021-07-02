@extends('layouts.front')
@section('title')
    Case Studies
@endsection
@section('css')
@endsection

@section('navbar')
    @include('layouts.navbar.non_index_navbar')
@stop
@section('content')


    <section class="studies">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="studies_text">
                        <h1 class="studies_case"> <span
                                class="innovation_color innovation_color-case"></span>
                        </h1>
                        <p class="studies_advice"></p>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($posts as $ls)
                    <br/>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                        <div class="studies-card">
                            <div class="studies_card_01" style="background-image: url('{{url($ls->image)}}');">
                            </div>
                            <div class="studies_card_text">
                              <a href="{{ URL::route('news.read_more',$ls->news_id) }}"> <h3 class="studies_coping studies_coping-case">{{$ls->title}}</h3></a>
                                <span class="studies_bottom_text"><a class="studies_link" href="{{ URL::route('news.read_more',$ls->news_id) }}">{{trans('back.read_more')}} <i
                                            class="fas fa-arrow-circle-right studies_icon"></i></a></span>
                            </div>
                        </div>
                    </div>

                @endforeach
            </div>


        </div>
        <div class="studies-bottom">
            <img class="img-fluid" src="{{asset('./frontend/img/Wave_grey_bottom_left_shape_01.png')}}">
        </div>
    </section>
@endsection
@section('js')
@endsection
