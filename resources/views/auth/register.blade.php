@extends('layouts.app')
@section('title')
    Razeline | Register
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

                        <div class="form-signin">

                            <!--div class="g-signin2" data-onsuccess="onSignIn"></div-->

                            <button id="google_signin"
                                    class="g-bt form-label-group @if(\Illuminate\Support\Facades\Session::has('google_signedin')) hide @endif">
                                    <span class="google-icon">
                                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                             width="18px" height="18px" viewBox="0 0 48 48"
                                             class="abcRioButtonSvg"><g><path fill="#EA4335"
                                                                              d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"></path><path
                                                        fill="#4285F4"
                                                        d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"></path><path
                                                        fill="#FBBC05"
                                                        d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z"></path><path
                                                        fill="#34A853"
                                                        d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"></path><path
                                                        fill="none" d="M0 0h48v48H0z"></path></g></svg>
                                    </span>
                                <span class="signin_buttonText">Sign Up With Google</span>
                            </button>

                            <button id="google_signout"
                                    class="g-bt form-label-group @if(! \Illuminate\Support\Facades\Session::has('google_signedin')) hide @endif"
                                    onclick="google_signout();">
                                <span class="google-icon"><svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                                               width="18px" height="18px" viewBox="0 0 48 48"
                                                               class="abcRioButtonSvg"><g><path fill="#EA4335"
                                                                                                d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"></path><path
                                                    fill="#4285F4"
                                                    d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"></path><path
                                                    fill="#FBBC05"
                                                    d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z"></path><path
                                                    fill="#34A853"
                                                    d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"></path><path
                                                    fill="none" d="M0 0h48v48H0z"></path></g></svg></span>
                                <span class="buttonText">Sign out From Google</span>
                            </button>

                            <button id="fb_signin" class="fb-login-button2 @if(\Illuminate\Support\Facades\Session::has('facebook_signedin')) hide @endif" type="button" onclick="facebook_login()"><i
                                        class="fa fa-facebook-f"></i>Sign Up With Facebook
                            </button>

                            <button id="fb_signout" class="fb-login-button2  @if(! \Illuminate\Support\Facades\Session::has('facebook_signedin')) hide @endif" type="button" onclick="facebook_logout()">
                                <i class="fa fa-facebook-f"></i>Sign Out From Facebook
                            </button>
                            <div id="status"></div>

                        </div>

                        <div class="form-label-group text-center mt-4 mb-4">
                            <p>or sign up with e-mail</p>
                        </div>


                        <form class="form-horizontal form-signin" method="POST" action="{{ route('register') }}"
                              enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="form-label-group{{ $errors->has('name') ? ' has-error' : '' }}">

                                <input id="name" type="text" class="form-control" name="name" placeholder="Full Name"
                                       @if(\Illuminate\Support\Facades\Session::has('name'))
                                       value="{{\Illuminate\Support\Facades\Session::get('name')}}"
                                       @else
                                       value="{{ old('name') }}"
                                       @endif
                                       required autofocus
                                       autocomplete="name">

                                <label for="name" class="control-label">Full Name<span
                                            class="asterisk">*</span></label>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-label-group{{ $errors->has('username') ? ' has-error' : '' }}">

                                <input id="username" type="text" class="form-control" name="username" placeholder="Username"
                                       pattern="^[A-Za-z0-9_]{1,15}$" title="Only Characters and numbers are allowed with no spaces."
                                       value="{{ old('username') }}" required autocomplete="username">

                                <label for="username" class="control-label" >Username<span
                                            class="asterisk">*</span></label>

                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <label class="sub">Please use up to 16 of characters and no spaces.</label>

                            <div class="form-label-group{{ $errors->has('email') ? ' has-error' : '' }}">

                                <input id="email" type="email" class="form-control" name="email" placeholder="Email"
                                       @if(\Illuminate\Support\Facades\Session::has('email'))
                                       value="{{\Illuminate\Support\Facades\Session::get('email')}}"
                                       @else
                                       value="{{ old('email')}}"
                                       @endif
                                       required
                                       autocomplete="email">
                                <label for="email" class="control-label">E-Mail Address<span
                                            class="asterisk">*</span></label>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif

                            </div>


                            <div class="form-label-group{{ $errors->has('password') ? ' has-error' : '' }}">

                                <input id="password" type="password" class="form-control" name="password"
                                       placeholder="Password" autocomplete=""
                                       required>

                                <label for="password" class="control-label">Password<span
                                            class="asterisk">*</span></label>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                @endif

                            </div>

                            <div class="form-label-group">
                                <input id="password-confirm" type="password" class="form-control"
                                       name="password_confirmation" required placeholder="Confirm Password"
                                       autocomplete>
                                <label for="password-confirm" class="control-label">Confirm Password<span
                                            class="asterisk">*</span></label>
                            </div>


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
                                       placeholder="Heading"
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

    <script src="https://apis.google.com/js/platform.js?onload=init"></script>

    <script>
        //Google Signin
        var auth2;
        var googleUser = {};

        function init() {
            gapi.load('auth2', function () {
                /**
                 * Retrieve the singleton for the GoogleAuth library and set up the
                 * client.
                 */
                console.log('auth2 init');
                auth2 = gapi.auth2.init({
                    client_id: '4889135096-ifh2tjtpe0rm728jh6urvk2si9v1l1nt.apps.googleusercontent.com'
                });

                attachSignin(document.getElementById('google_signin'));
            });
        };

        function attachSignin(element) {
            console.log(element.id);
            auth2.attachClickHandler(element, {},
                function (googleUser) {

                    var profile = googleUser.getBasicProfile();
                    console.log("ID: " + profile.getId()); // Don't send this directly to your server!
                    console.log('Full Name: ' + profile.getName());
                    console.log('Given Name: ' + profile.getGivenName());
                    console.log('Family Name: ' + profile.getFamilyName());
                    console.log("Image URL: " + profile.getImageUrl());
                    console.log("Email: " + profile.getEmail());

                    // The ID token you need to pass to your backend:
                    var id_token = googleUser.getAuthResponse().id_token;
                    console.log("ID Token: " + id_token);

                    $('#google_sigin').fadeOut('slow', function () {
                        $('#google_signout').fadeIn('slow');
                    });

                    //signin with google
                    var form = $('#form-google-sign');
                    document.getElementById("form_name").value = profile.getName();
                    document.getElementById("form_photo_url").value = profile.getImageUrl();
                    document.getElementById("form_email").value = profile.getEmail();

                    form.submit();


                }, function (error) {
                    console.log(JSON.stringify(error, undefined, 2));
                });
        }

        function google_signout() {
            var auth = gapi.auth2.getAuthInstance();
            auth.signOut().then(function () {
                console.log('User signed out.');
                $('#google_signout').fadeOut('slow', function () {
                    $('#google_signin').fadeIn('slow');
                });
            });
            window.location.reload();
        }

        init();
    </script>

    <script>
        //FB signin

        var fbAccessToken;
        // This is called with the results from from FB.getLoginStatus().
        function statusChangeCallback(response) {
            console.log('statuschangecallback');
            if (response.status === 'connected') {

                // Logged into your app and Facebook.
                FB.api('/me', {fields:'name, email, picture, first_name, last_name'}, function(response) {
                    console.log(response);
                    if( response.name && response.email ){
                        facebook_form_signin(response);
                    } else {
                        alert('Failed to get your fb accoount info');
                        return;
                    }
                });
            } else {
                // The person is not logged into your app or we are unable to tell.

                alert('Please log into this app.');
            }
        }

        // This function is called when someone finishes with the Login
        // Button.  See the onlogin handler attached to it in the sample
        // code below.
        function checkLoginState() {
            FB.getLoginStatus(function(response) {
                statusChangeCallback(response);
            });
        }

        window.fbAsyncInit = function() {
            FB.init({
                appId      : '2212176545720097',
                status: false,
                cookie     : true,  // enable cookies to allow the server to access
                                    // the session
                xfbml      : true,  // parse social plugins on this page
                version    : 'v2.8' // use graph api version 2.8
            });

            // Now that we've initialized the JavaScript SDK, we call
            // FB.getLoginStatus().  This function gets the state of the
            // person visiting this page and can return one of three states to
            // the callback you provide.  They can be:
            //
            // 1. Logged into your app ('connected')
            // 2. Logged into Facebook, but not your app ('not_authorized')
            // 3. Not logged into Facebook and can't tell if they are logged into
            //    your app or not.
            //
            // These three cases are handled in the callback function.

            FB.getLoginStatus(function(response) {
                console.log(response);
                //statusChangeCallback(response);
                //get access token
                if(response.status=="unknown"){
                    return;
                } else{
                   fbAccessToken = response.authResponse.accessToken;
                }
            });

        };

        // Load the SDK asynchronously
        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "https://connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));

        function facebook_login(){
            FB.login(function(response){
                statusChangeCallback(response);
            }, {scope:'email, public_profile'});
        }

        function facebook_form_signin(response) {
            var form1 = $('#form-facebook-sign');
            document.getElementById("fb_form_name").value = response.name;
            document.getElementById("fb_form_email").value = response.email;
            form1.submit();
        }

        function facebook_logout(fbAccessToken){
            FB.logout(function(response){
                $('#fb_signout').fadeOut('slow');
                $('#fb_signin').fadeIn('slow');
                window.location.reload();
            });
        }
    </script>
@endsection