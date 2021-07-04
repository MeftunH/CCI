<meta name="csrf_token" content="{{csrf_token()}}">

@extends('layouts.backend.master')
@section('title')
    {{trans('back.profile-edit')}}
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
                            <h2 class="content-header-title float-left mb-0">{{trans('back.profile-edit')}}</h2>
                        </div>

                    </div>
                </div>

            </div>
            <div class="content-body">
                <section class="my-5">
                    @if (session()->has('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('status') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Update Profile Information</h5>

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="container">
                                <div style="display: flex;">
                                    <div>
                                        <img id="img_prv" style="max-width: 150px;max-height: 150px" class="img-thumbnail" src="{{Auth::user()->photo}}">
                                    </div>
                                    <div style="margin-left: 15px; flex-grow: 1">
                                        <p>Choose a file</p>
                                        <input type="file" name="file_img" id="img_file_upid">
                                        <span id="mgs_ta"></span>
                                        <br>
                                        <div class="progress">
                                            <div class="progress-bar"
                                                 role="progressbar" aria-valuemin="0"
                                                 aria-valuemax="100">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                             <div>


                                 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
                                 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

                                 <script type="text/javascript">
                                     $('#img_file_upid').on('change',function(ev){
                                         console.log("here inside");

                                         var filedata=this.files[0];
                                         var imgtype=filedata.type;


                                         var match=['image/jpeg','image/jpg','image/png'];

                                         if(!(imgtype==match[0])||(imgtype==match[1])){
                                             $('#mgs_ta').html('<p style="color:red">{{trans('back.valid_type_image_error')}}</p>');

                                         }else{

                                             $('#mgs_ta').empty();


                                             //---image preview

                                             var reader=new FileReader();

                                             reader.onload=function(ev){
                                                 $('#img_prv').attr('src',ev.target.result).css('width','150px').css('height','150px');
                                             }
                                             reader.readAsDataURL(this.files[0]);

                                             /// preview end

                                             //upload

                                             var postData=new FormData();
                                             postData.append('file',this.files[0]);

                                             var url="{{route('updateProfileImage')}}";

                                             $.ajax({
                                                 xhr: function () {
                                                     var xhr = new window.XMLHttpRequest();
                                                     xhr.upload.addEventListener("progress", function (evt) {
                                                         if (evt.lengthComputable) {
                                                             var percentComplete = evt.loaded / evt.total;
                                                             percentComplete = parseInt(percentComplete * 100);
                                                             console.log(percentComplete);
                                                             $('.progress-bar').css('width', percentComplete + '%');
                                                             if (percentComplete === 100) {
                                                                 console.log('completed 100%')
                                                                 setTimeout(function () {
                                                                     $('.progress-bar').css('width', '0%');
                                                                 }, 2000)
                                                             }
                                                         }
                                                     }, false);
                                                     return xhr;
                                                 },

                                                 headers:{'X-CSRF-Token':$('meta[name=csrf_token]').attr('content')},
                                                 async:true,
                                                 type:"post",
                                                 contentType:false,
                                                 url:url,
                                                 data:postData,
                                                 processData:false,
                                                 success:function(){
                                                     console.log("success");
                                                 }


                                             });

                                         }

                                     });

                                 </script>

                             </div>
                                <livewire:profile-form/>
                                <livewire:password-change-form/>

                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
