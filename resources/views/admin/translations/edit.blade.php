{{--<div class="col-sm=12">--}}
{{--    <h4>Manage Translation</h4>--}}
{{--    <hr/>--}}
{{--    <ul class="nav nav-tabs" role="tablist">--}}
{{--        @foreach($data['files'] as $fl)--}}
{{--            @if($fl != '.' && $fl != '..' && $fl != 'info.json')--}}
{{--                <li class="nav-item" @if($data['file'] == $fl) class="active" @endif>--}}
{{--                   <a  href="{{url('/edit/translation?edit='.$data['lang'].'/file='.$fl)}}" aria-selected="true">{{$fl}}</a>--}}
{{--                </li>--}}
{{--            @endif--}}
{{--        @endforeach--}}
{{--    </ul>--}}
{{--</div>--}}


<div class="row" id="edit-modal">
    <form class="forms-sample" id="jsform" action="{{ route('translation.save')}}" method="post"
          enctype="multipart/form-data">
        @csrf
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="col-lg-12">


            <h4>Manage Translations</h4>
            <hr/>
            <ul class="nav nav-tabs" id="pills-tab" role="tablist">
                @foreach($data['files'] as $fl)
                    @if($fl !='.' && $fl !='..' && $fl !='info.json')
                        <li class="nav-item" id="#{{$fl}}">
                            <a @if($data['file'] == $fl) class="nav-link active" @else class="nav-link"
                               @endif onclick="EditModal(this.href, 'Edit Translation');return false"
                               href="{{url('pages/config/edittranslation?edit='.$data['lang'].'&file='.$fl)}}"
                               role="tab">{{$fl}}</a>
                        </li>
                    @endif

                @endforeach
            </ul>
            <div class="row">
                <div class="col-lg-12">


                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                            <tr>
                                <th>Parse</th>
                                <th>Translate</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data['stringLangs'] as $key => $val)
                                @if(!is_array($val))
                                    <tr>
                                        <td>{{$key}}</td>
                                        <td><input type="text" name="{{$key}}" value="{{$val}}" class="form-control"></td>
                                    </tr>

                                @endif
                            @endforeach
                            </tbody>
                        </table>

                </div>
            </div>
        </div>
        <input type="hidden" name="file" value="{{$data['file']}}">
        <input type="hidden" name="lang" value="{{$data['lang']}}">
        <button type="submit" class="btn btn-primary mr-2">Update</button>


    </form>

</div>
