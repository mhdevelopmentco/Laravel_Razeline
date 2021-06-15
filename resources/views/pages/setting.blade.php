@extends('layouts.app')
@section('title')
    Razeline | Settings
@endsection
@section('header')
@endsection

@section('content')
    <div class="d-sm-flex" style="min-height: 500px">
        <div class="w w-auto-xs light bg bg-auto-sm b-r">
            <div class="py-3">
                <div class="nav-active-border left b-primary">
                    <ul class="nav flex-column nav-sm">
                        <li class="nav-item">
                            <a class="nav-link active" href="#" data-toggle="tab" data-target="#tab-1">Profile</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link " href="#" data-toggle="tab" data-target="#tab-2">Security</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col p-0">
            <div class="tab-content pos-rlt">
                <div class="tab-pane active" id="tab-1">
                    <div class="p-4 b-b _600">Public profile</div>
                    <form role="form" class="p-4 col-md-6" method="post" action="{{url('/profile')}}"
                          enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group">
                            <label for="file" class="control-label">Profile Picture</label>
                            <p>
                                <img class="img-responsive img-fluid" src="{{url($user->photo)}}"/>
                            </p>

                            <div class="form-file">
                                <input id="f01" type="file" name="photo" class="form-control hide"
                                       placeholder="Add profile background"/>
                                <label for="f01" class="btn  btn-secondary">Upload new picture</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="background1">Profile background picture</label>
                            <p>
                                <img class="img-responsive img-fluid" src="{{url($user->background)}}"/>
                            </p>

                            <div class="form-file">
                                <input id="background" type="file" name="background" class="form-control hide">
                                <label for="background" class="btn btn-secondary">Upload new picture</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{$user->name}}">
                        </div>

                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" disabled class="form-control" name="username" id="username" value="{{$user->username}}">
                        </div>

                        <div class="form-group">
                            <label>Heading</label>
                            <input type="text" class="form-control" name="profession" id="profession"
                                   value="{{$user->profession}}">
                        </div>

                        <div class="form-group">
                            <label>Description</label>
                            <input type="text" class="form-control" name="description" id="description"
                                   value="{{$user->description}}">
                        </div>

                        @if($user->type == 'creator')
                            <div class="form-group">
                                <label>Rate</label>
                                <select name="rate" id="rate" class="form-control">
                                    @for ($i = 5; $i <= 1000; $i++)
                                        <option value="{!!$i!!}" @if($i == $user->rate) selected @endif >{!!$i!!}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Do not send</label>
                                <input type="text" class="form-control" name="do_not_send" id="do_not_send"
                                       value="{{$user->do_not_send}}">
                            </div>
                        @else

                            <div class="form-group">
                                <label for="birthday" class="control-label">Birthday</label>

                                <div class="">
                                    <input type="text" id="birthday" name="birthday" class="form-control mb-3"
                                           data-plugin="datepicker" data-option="{autoclose: true}" required
                                           value="{{$user->birthday}}"
                                    >
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="gender" class="control-label">Gender</label>

                                <div class="">
                                    <select name="gender" id="gender" class="form-control">
                                        @if($user->gender == 'male')
                                            <option value="male" selected="selected"> Male</option>
                                            <option value="female">Female</option>
                                        @else
                                            <option value="male"> Male</option>
                                            <option value="female" selected="selected">Female</option>
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Education</label>
                                <input type="text" class="form-control" name="education" id="education"
                                       value="{{$user->education}}">
                            </div>

                        @endif

                        <button type="submit" class="btn primary mt-2">Update</button>
                        <a href="{{url('/profile')}}" class="btn secondary mt-2 info">Back To Profile</a>
                    </form>
                </div>


                <div class="tab-pane" id="tab-2">
                    <div class="p-4 b-b _600">Security</div>
                    <div class="p-4">
                        <div class="clearfix">
                            <form role="form" class="col-md-6 p-0" method="post" action="{{url('/profile')}}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="form-group">
                                    <label>New Password</label>
                                    <input type="password" class="form-control" name="password">
                                </div>
                                <div class="form-group">
                                    <label>New Password Again</label>
                                    <input type="password" class="form-control" name="password_confirmation">
                                </div>
                                <button type="submit" class="btn primary mt-2">Update</button>
                                <a href="{{url('/profile')}}" class="btn secondary mt-2 info">Back To Profile</a>
                            </form>
                        </div>
                    </div>
                </div>

            <!--div class="tab-pane" id="tab-3">
                    <div class="p-4 b-b _600">Subscribe</div>
                    <div class="p-4">
                        <div class="clearfix">
                            {{--<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">--}}
            {{--<input type="hidden" name="cmd" value="_s-xclick">--}}
            {{--<input type="hidden" name="hosted_button_id" value="8773GMXCJ4KHW">--}}
            {{--<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_subscribeCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">--}}
            {{--<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">--}}
            {{--</form>--}}

            @if(Auth::user()->subscription_available)
                You already subscribed.
@else

                <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post"
                      target="_top">
                    <input type="hidden" name="cmd" value="_s-xclick">
                    <input type="hidden" name="hosted_button_id" value="LG88SGG5BYHKG">
                    <input type="image"
                           src="https://www.sandbox.paypal.com/en_US/i/btn/btn_subscribeCC_LG.gif"
                           border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                    <img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif"
                         width="1" height="1">
                </form>

@endif

                    </div>
                </div>
            </div-->
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $("[type=file]").on("change", function () {
            // Name of file and placeholder
            var file = this.files[0].name;
            var dflt = $(this).attr("placeholder");
            if ($(this).val() != "") {
                $(this).next().text(file);
            } else {
                $(this).next().text(dflt);
            }
        });
    </script>

@endsection