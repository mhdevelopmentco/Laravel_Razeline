@extends('layouts.app')
@section('title')
    Razeline | Profile
@endsection
@section('header')
    <style>
        .img-bg {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        .img-bg img {
            width: 100%;
            min-height: 500px;
        }

        .row-about {
            margin-top: 15px;
            margin-bottom: 15px;
        }
    </style>
@endsection

@section('content')

    <div class="full-ob bg-cover" style="background-image:url({{$user->background}});">

        <div class="container section-profile full-ob">
            <div class="row pt-3 pb-1">
                <div class="col-md-6 offset-md-3 col-sm-8 offset-sm-2">
                    <h2 class="profile-name text-center">
                        @if($user->me)
                            My Profile
                        @else
                            {{$user->name}}
                        @endif
                    </h2>
                    <hr>
                </div>
            </div>

            <div class="row py-3">
                <div class="col-md-12 pb-1">
                    @if(Auth::user())
                        @if( Auth::user()->type == 'creator' && $user->id == Auth::user()->id )
                            <h5 class="text-center">Copy and paste this link:</h5>
                            <p class="text-center text-break"><a
                                        href="{{url('/username/'.$user->username)}}">{!! url('/username').'/'.$user->username !!}</a>
                            </p>
                        @endif
                    @endif
                </div>

                <div class="col-md-5 col-sm-6">
                    <div class="pos-rlt text-center">
                        <img src="{{$user->photo}}" alt="." class="profil-photo img-responsive">
                    </div>
                    <div class="text-center mt-5">
                        @if(!$user->me)
                            <a class="md-btn md-raised mb-2 w-md green"
                               href="{{url('/messages')}}?user={{$user->id}}"><i
                                        class="fa fa-comment-o"></i>&nbsp;&nbsp;Message</a>
                        @endif
                    </div>
                </div>
                <div class="col-md-7 col-sm-6 my-4 my-sm-0">

                    <div class="d-flex flex-wrap py-2" style="justify-content: space-between;">

                        <h4>{{$user->name}}</h4>
                        @if($user->me)
                            <a href="{{url('/settings')}}" class="edit-profile-link"><i
                                        class="fa fa-edit align-right"></i></a>
                        @endif
                    </div>


                    <div class="row py-2">
                        <div class="col-sm-4">
                            <h5>Username:</h5>
                        </div>
                        <div class="col-md-8"><p>{{$user->username}}</p></div>
                    </div>

                    @if($user->type == 'creator')
                        <div class="row py-2">
                            <p class="col-md-12"> {{$user->profession}}</p>
                        </div>

                        <div class="row py-2">
                            <p class="col-md-12">{{$user->description}}</p>
                        </div>

                        <div class="row py-2">
                            <div class="col-sm-4">
                                <h5>Rate:</h5>
                            </div>
                            <div class="col-md-8"><p>${{$user->rate}}</p></div>
                        </div>

                        <div class="row py-2">
                            <div class="col-sm-4">
                                <h5>Do not send:</h5>
                            </div>
                            <div class="col-md-8">
                                <p>{{$user->do_not_send}}</p>
                            </div>
                        </div>

                    @else

                        <div class="row py-2">
                            <div class="col-sm-4">
                                <h5>Date of birth:</h5>
                            </div>
                            <div class="col-md-8"><p>{{$user->birthday}}</p></div>
                        </div>

                        <div class="row py-2">
                            <div class="col-sm-4">
                                <h5>Gender:</h5>
                            </div>
                            <div class="col-md-8">
                                <p>{{$user->gender}}</p>
                            </div>
                        </div>

                        <div class="row py-2">
                            <p class="col-md-12">{{$user->description}}</p>
                        </div>

                    @endif

                </div>
            </div>

        </div>

    </div>
@endsection

@section('script')

@endsection

