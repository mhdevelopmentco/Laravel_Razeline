@extends('layouts.app')
@section('title')
    Welcome To Razeline
@endsection
@section('content')

    <div class="item">
        <div class="img-bg">
            <img src="<?=('image/raze_banner.png')?>" alt=".">
        </div>
        <div class="row mt-12">
            <div class="col-md-12">
                <div class="home-section-column home-banner">
                    <h1 style=" text-align: center; color:#fff">GET PAID TO RESPOND TO YOUR MESSAGES</h1>
                    <a href="{{url('/register')}}" class="btn btn-danger"><h4>Create Your Account</h4></a>
                </div>
            </div>
        </div>
    </div>

    <div class="item">
        <div class="p-2 p-sm-5   bg-white home-section-column">
            <h2>About Razeline</h2>

            <div class="intro container text-sm-left text-center my-3">
                <div class="row">
                    <div class="col-md-6 col-sm-12 mb-5 mb-sm-3 mb-md-0">
                        <h4 class="vertical-center l-h-2x sm-l-h-1x">RazeLine allows you to get paid to take Prescreened
                            messages from fans
                            and anyone else that would like to directly get in touch with you</h4>
                    </div>
                    <div class="col-md-6 col-sm-12 mb-5 mb-sm-3 mb-md-0">
                        <img src="<?=asset('image/about.jpg')?>" class="img-responsive m-auto img-fluid">
                    </div>
                </div>
            </div>
        </div>

        <div class="p-2 p-sm-5 home-section-column">

            <h2>How it works</h2>
            <div class="helps container">
                <div class="row">
                    <div class="col-md-4 text-center">
                        <img src="<?=asset('image/like.png')?>">
                        <h4>Share your RazeLine profile link on your YouTube and social media pages so your fans and
                            others can get directly in touch with you.</h4>
                    </div>
                    <div class="col-md-4 text-center">
                        <img src="<?=asset('image/message.png')?>">
                        <h4>Receive prescreened 180 character private messages and reply
                            within 72 hours to finalize the trasaction.</h4>
                    </div>
                    <div class="col-md-4 text-center">
                        <img src="<?=asset('image/payment.png')?>">
                        <h4>Get Paid.</h4>
                    </div>
                </div>

            </div>
            <div class="fee text-center">
                <h4>RazeLine retains 25% for each message response.</h4>
            </div>
        </div>
    </div>

@endsection
