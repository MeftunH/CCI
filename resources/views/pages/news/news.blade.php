@extends('layouts.front')
@section('title')
    News
@endsection
@section('css')
@endsection
@section('navbar')
    @include('layouts.navbar.non_index_navbar')
@stop
@section('content')

    <section class="intro intro_news" style="background-image: url({{$intro->background_image}});">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-12">
                    <div class="intro_text news_intro">
                        <h1 class="intro_about">{{$intro->title}}</h1>
                        <p class="intro_work">{!! $intro->description !!}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="header_bottom_img">
            <img class="img-fluid" src="{{asset('./frontend/img/Wave_White_bottom_right_shape_02.png')}}">
        </div>
    </section>
    <!-- News -->
    <section class="news">
        <div class="container">
            <div class="row">
                <div class="col-lg-8  col-12">
                    <div class="news-left">
                        @foreach($news as $row)
                            <div class="future-news" style="background-image: url({{$row->image}})"></div>
                            <div class="news-left_text">
                                <h3 class="studies_coping studies_coping_news">{{$row->title}}</h3>
                                <p>{!! $row->limit($row->description) !!}
                                </p>
                            </div>
                            <div class="row card-bottom-text">
                                <div class="col-lg-6">
                                    <div class="social">
                                        <a class="social_link social_link-news" href="{{$socials->first()->link}}"><i class="fab fa-facebook-f"></i></a>
                                        <a class="social_link social_link-news" href="{{$socials->skip(1)->first()->link}}"><i class="fab fa-instagram"></i></a>
                                        <a class="social_link social_link-news" href="{{$socials->skip(2)->first()->link}}"><i class="fab fa-linkedin-in"></i></a>

                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="news-card_bottom">
                                        <span class="studies_bottom_text"><a class="studies_link studies_link_news"
                                                                             href="{{route('news.read_more',$row->news_id)}}">{{trans('front.read_more')}} <i
                                                    class="fas fa-arrow-circle-right studies_icon"></i></a></span>
                                    </div>

                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>




                <div class="col-lg-4  col-12">
                    <div class="row news-right ">
                        <form action="{{ route('news.search') }}" method="GET" style="display: flex">
                            @csrf

                                <input class="news-input" type="text" placeholder="{{trans('front.looking_for')}}"
                                       name="search">


                                    <button style="background: transparent;border: none" class="news_icon"
                                            type="submit"><i class="fas fa-search"></i></button>

                        </form>
                    </div>
                    <div class=" news-posts">
                        <h4>{{trans('front.popular_posts')}}</h4>
                        @foreach($popular_posts as $post)
                            <div class="news-post">
                                <div class="post-img">
                                    <img class="img-fluid post_img" src="{{url($post->image)}}">
                                </div>
                                <div class="post-text">
                                <span
                                    class="card-month card-month-post">{{\App\Helpers\LanguageHelper::DateTranslateWithDay($post->created_at)}}</span>
                                    <h3 class="card-office card-office-post">
                                        <a href="{{route('news.read_more',$post->news_id)}}"> {!! $post->title !!}</a>
                                    </h3>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-12">
                {{$news->links()}}
            </div>
        </div>

    </section>
@endsection
@section('js')
@endsection
