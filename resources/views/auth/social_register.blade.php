@extends('layouts.app')
@section('title')
    Razeline | Register Via Social Account
@endsection
@section('header')
    <meta name="google-signin-scope" content="profile email">
    <meta name="google-signin-client_id"
          content="4889135096-ifh2tjtpe0rm728jh6urvk2si9v1l1nt.apps.googleusercontent.com">

    <link rel="stylesheet" href="<?=asset('assets/css/floatlabel.css')?>" type="text/css"/>
@endsection


@section('content')

    <div class="container">
        <div class="row mt-5 mb-5">
            <div class="col-md-6 offset-md-3 col-sm-10 offset-sm-1">
                <div class="panel panel-default m-auto panel-login">

                    <div class="panel-heading text-center"><h2>Sign Up</h2></div>

                    <div class="panel-body bg-white p-2">


                        <form class="form-horizontal form-signin" method="POST" action="{{ url('/register-social-submit') }}"
                              enctype="multipart/form-data">

                            <h4 class="text-center text-info">Welcome {!! $name !!}</h4>
                            <label class="py-3">Please fill the following fields:</label>

                            {{ csrf_field() }}

                            <input type="hidden" name="name" value="{{ $name }}" required>
                            <input type="hidden" name="email" value="{{ $email }}" required>

                            <div class="form-label-group{{ $errors->has('username') ? ' has-error' : '' }}">

                                <input id="username" type="text" class="form-control" name="username" placeholder="Username"
                                       value="{{ old('username') }}"
                                       pattern="^[A-Za-z0-9_]{1,15}$" title="Only Characters and numbers are allowed with no spaces."
                                       required autocomplete="username">

                                <label for="username" class="control-label">Username<span
                                            class="asterisk">*</span></label>

                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <label class="sub">Please use up to 16 of characters and no spaces.</label>

                            <div class="form-label-group">
                                <input type="text" id="birthday" name="birthday" class="form-control mb-3"
                                       placeholder="Birthday"
                                       data-plugin="datepicker" data-option="{autoclose: true}" required>
                                <label for="birthday" class="control-label">Birthday</label>
                            </div>

                            <div class="form-group row no-gutters">

                                <label for="gender" class="control-label col-md-4">Gender</label>

                                <select name="gender" id="gender" class="form-control col-md-8">
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>

                            </div>

                            <div class="form-group row no-gutters">
                                <label for="type" class="control-label col-md-4">User Type<span
                                            class="asterisk">*</span></label>

                                <select name="type" id="type" class="form-control col-md-8">
                                    <option value="creator">Creator</option>
                                    <option value="fan">Fan</option>
                                </select>

                            </div>

                            <div class="form-label-group{{ $errors->has('profession') ? ' has-error' : '' }}"
                                 id="group_profession">

                                <input id="profession" type="text" class="form-control hide_require" name="profession"
                                       placeholder="heading"
                                       value="{{ old('profession', isset($heading) ? $heading : "") }}" required>

                                <label for="profession" class="control-label">Heading<span
                                            class="asterisk">*</span></label>

                                @if ($errors->has('profession'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('profession') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group row no-gutters" id="group_description">
                                <!--label for="description" class="control-label col-md-4">Description<span
                                            class="asterisk">*</span></label-->
                                <textarea id="description" name="description" class="form-control col-md-12"
                                          required placeholder="Description*" rows="6"></textarea>
                            </div>

                            <div class="form-group row no-gutters" id="group_rate">

                                <label for="rate" class="control-label col-md-4">Rate<span
                                            class="asterisk">*</span></label>

                                <select name="rate" id="rate" class="form-control col-md-8" required>
                                    @for ($i = 5; $i <= 1000; $i++)
                                        <option value="{!!$i!!}" >{!!$i!!}</option>
                                    @endfor
                                </select>


                            </div>

                            <div class="form-group row no-gutters" id="group_do_not_send">
                                <label for="do_not_send" class="control-label col-md-4">Do not send<span
                                            class="asterisk">*</span></label>

                                <textarea id="do_not_send" name="do_not_send" class="form-control col-md-8"
                                          required></textarea>
                            </div>

                            <div class="form-group row no-gutters">
                                <label for="file" class="control-label col-md-4">Profile Picture*</label>
                                <div class="form-file col-md-8">
                                    <input id="f01" type="file" name="photo" class="form-control hide"
                                           placeholder="Add profile picture" required/>
                                    <label for="f01" class="btn btn-secondary">Upload File</label>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-lg btn-primary btn-block">
                                SIGN UP
                            </button>

                            <h6 class="text-center mt-3"><a class="btn-link" href="{{url('/login')}}">Log in</a></h6>

                        </form>
                        <form id="form-google-sign" method="post" action="{{url('/social-sign')}}">
                            {{ csrf_field() }}
                            <input type="hidden" id="form_name" name="name" value="">
                            <input type="hidden" id="form_photo_url" name="photo_url">
                            <input type="hidden" id="form_email" name="email">
                        </form>

                        <form id="form-facebook-sign" class="hidden" method="post" action="{{url('/social-sign')}}">
                            {{ csrf_field() }}
                            <input type="hidden" id="fb_form_name" name="name">
                            <input type="hidden" id="fb_form_email" name="email">
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script>
        $(document).ready(function () {
            function onChangeUserType() {
                var value = document.getElementById('type').value;

                if (value === 'creator') {
                    document.getElementById('group_profession').style.display = 'block';
                    document.getElementById('group_description').style.display = 'block';
                    document.getElementById('group_rate').style.display = 'block';
                    document.getElementById('group_do_not_send').style.display = 'block';

                    document.getElementById('profession').setAttribute('required', 'required');
                    document.getElementById('description').setAttribute('required', 'required');
                    document.getElementById('rate').setAttribute('required', 'required');
                    document.getElementById('do_not_send').setAttribute('required', 'required');

                } else {
                    document.getElementById('group_profession').style.display = 'none';
                    document.getElementById('group_description').style.display = 'none';
                    document.getElementById('group_rate').style.display = 'none';
                    document.getElementById('group_do_not_send').style.display = 'none';

                    //remove require
                    document.getElementById('profession').removeAttribute('required');
                    document.getElementById('description').removeAttribute('required');
                    document.getElementById('rate').removeAttribute('required');
                    document.getElementById('do_not_send').removeAttribute('required');

                }
            }

            $('#type').on("change", onChangeUserType);

        });

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