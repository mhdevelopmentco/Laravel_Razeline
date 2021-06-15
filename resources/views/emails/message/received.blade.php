<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>New Message</title>

    <style>
        /* CSS Document */
        img {
            width: 25%;
        }

        .containerStyling {
            margin-top: 5%;
            align-content: center;
            text-align: center;
            border-style: solid;
            border-width: 1px;

        }

        .button1 {
            background-color: #3BB56A;
            border-style: none;
            cursor: pointer;
            width: 150px;
            height: 50px;
            color: white;
        }

        .button1:hover {
            background-color: #4DC57B
        }

        .margin3 {
            margin: 3%;
        }

    </style>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>

<body>

<div class="container containerStyling">

    <img class="margin3" src="{{asset('/public/image/email_logo.png')}}" alt="logo">

    <h5 class="margin3">You have received a new private message from <strong>{{$msg->sender_name}}</strong> on RazeLine
    </h5>

    <a class="button1" href="{{url('/messages?channel='.$msg->channel_id)}}"><strong>View Message</strong></a>

    <h5 class="margin3">Thank you from the RAZELINE team!</h5>


    <p>The information in this email and any files transmitted with it may be of a confidential nature and is intended
        solely for the addressees. If you are not the intended addressee, any disclosure, copying or distribution by you
        is prohibited and may be unlawful. Copyright 2018 Raze Technologies Inc. All rights reserved</p>

</div>
</body>
</html>
