@extends('layouts.app')
@section('title')
    Razeline | Login
@endsection
@section('header')
    <meta name="google-signin-scope" content="profile email">
    <meta name="google-signin-client_id"
          content="4889135096-ifh2tjtpe0rm728jh6urvk2si9v1l1nt.apps.googleusercontent.com">
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <link rel="stylesheet" href="<?=asset('assets/css/floatlabel.css')?>" type="text/css"/>
@endsection

@section('content')
    <div class="container">
        <div class="row mt-5 mb-5">
            <div class="col-md-8 offset-md-2 col-sm-10 offset-sm-1">

                <div class="panel panel-default m-auto panel-login">

                    <div class="panel-heading text-center"><h2>Login</h2></div>

                    <div class="panel-body bg-white p-2">

                        <div class="form-signin">

                            <div class="g-signin2 form-label-group"
                                 data-width="430" data-height="50"
                                 data-onsuccess="onSignIn" data-theme="dark"></div>

                            <button class="fb-login-button2" type="button" onclick="facebook_login()"><i
                                        class="fa fa-facebook-f"></i>Continue With Facebook
                            </button>
                        </div>

                        <div class="form-label-group text-center mt-4 mb-4">
                            <p>or login with username/email</p>
                        </div>


                        @if ($errors->has('error'))
                            <p class="text-warning  form-signin">{!! $errors->first('error') !!}</p>
                        @endif
                        <form class="form-horizontal form-signin" method="POST" action="{{ route('login') }}">
                            {{ csrf_field() }}

                            <div class="form-label-group {{ $errors->has('login') ? 'has-error' : '' }}">

                                <input id="login" type="text" class="form-control" name="login"
                                       placeholder="Username or Email address"
                                       value="{{ old('login') }}" required autofocus>

                                <label for="login" class="control-label">Username / E-Mail Address</label>
                                @if ($errors->has('login'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('login') }}</strong>
                                    </span>
                                @endif

                            </div>

                            <div class="form-label-group {{ $errors->has('password') ? 'has-error' : '' }}">
                                <input id="password" type="password" class="form-control" name="password" required
                                       autocomplete
                                       placeholder="Password">
                                <label for="password" class="control-label">Password</label>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif

                            </div>

                            <div class="form-row">
                                <div class="form-group col-6">

                                    <div class="checkbox p-2">
                                        <label>
                                            <input type="checkbox"
                                                   name="remember" {{ old('remember') ? 'checked' : '' }}> Remember
                                            Me
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group col-6 text-right">
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        Forgot Your Password?
                                    </a>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-lg btn-primary btn-block">
                                LOGIN
                            </button>

                            <h6 class="text-center mt-3"> New to Razeline? <a class="btn-link"
                                                                              href="{{url('/register')}}">Sign Up</a>
                            </h6>

                        </form>

                        <form id="form-google-sign" class="hidden" method="post" action="{{url('/social-sign')}}">
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
        function onSignIn(googleUser) {
            // Useful data for your client-side scripts:
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

            var form = $('#form-google-sign');
            document.getElementById("form_name").value = profile.getName();
            document.getElementById("form_photo_url").value = profile.getImageUrl();
            document.getElementById("form_email").value = profile.getEmail();

            form.submit();
        };

    </script>

    <script>

        window.fbAsyncInit = function () {
            FB.init({
                appId: '2212176545720097',
                status: false,
                cookie: true,  // enable cookies to allow the server to access
                               // the session
                xfbml: true,  // parse social plugins on this page
                version: 'v2.8' // use graph api version 2.8
            });
        };

        // Load the SDK asynchronously
        (function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = "https://connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));

        function facebook_login() {
            FB.login(function (response) {
                statusChangeCallback(response);
            }, {scope: 'email, public_profile'});
        };

        function facebook_form_signin(response) {
            var form1 = $('#form-facebook-sign');
            document.getElementById("fb_form_name").value = response.name;
            document.getElementById("fb_form_email").value = response.email;
            console.log(response.name);
            console.log(response.email);
            form1.submit();
        }

        // This is called with the results from from FB.getLoginStatus().
        function statusChangeCallback(response) {
            // The response object is returned with a status field that lets the
            // app know the current login status of the person.
            // Full docs on the response object can be found in the documentation
            // for FB.getLoginStatus().
            if (response.status === 'connected') {
                // Logged into your app and Facebook.
                FB.api('/me', {fields: 'name, email, picture, first_name, last_name'}, function (response) {
                    console.log(JSON.stringify(response));
                    console.log('Successful login for: ' + response.name);
                    if (response.name && response.email) {
                        facebook_form_signin(response);
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
            console.log('checkLoginState');
            FB.getLoginStatus(function (response) {
                console.log(response);
                //statusChangeCallback(response);
            });
        }

    </script>
@endsection