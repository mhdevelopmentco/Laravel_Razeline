@extends('layouts.app')
@section('title')
    Razeline | Messages
@endsection
@section('header')
@endsection
@section('content')
    <div class="d-flex flex full-ob border-bottom-1 always-ob" data-plugin="chat">
        <div class="fade aside aside-sm" id="content-aside-chat">
            <div class="d-flex flex-column w-xl b-r b-r-3x white modal-dialog pt-3" id="chat-nav">
                <div class="scrollable hover">
                    <div class="list inset">

                        <div class="p-2 px-3 text-muted text-sm">Messages</div>

                        @forelse($channels as $c)
                            @if($c->has_active_messages)
                                <div class="list-item @if($active_channel && $c->id == $active_channel->id) active @endif"
                                     data-id="item-14">
	      			            <span class="w-56 avatar circle brown">
                                    <a href="{{url('/profile').'?user='.base64_encode($c->opponent_id)}}">
	      			                    <img src="{{url($c->opponent_photo)}}" class="img-cover w-56 circle" alt=".">
                                        @if($c->unread_count)
                                            <span class="badge badge-pill up2 info up3">{{$c->unread_count}}</span>
                                        @endif
                                    </a>
	      			            </span>
                                    <div class="list-body">
                                        <div>
                                            <a href="{{url('/messages')}}?channel={{$c->id}}"
                                               class="item-title _500">{{$c->opponent_name}}</a>
                                            <span class="text-right past-date">{!! $c->op_last_date !!}</span>
                                        </div>


                                        <div class="item-except text-sm text-muted h-1x">
                                            {{$c->op_last_message}}

                                        </div>

                                        <div class="item-tag tag hide">
                                        </div>
                                    </div>
                                    <div>
                                    </div>
                                </div>
                            @endif
                        @empty
                            <div class="list-item">
                                <p class="text-center">No Messsages. <br> Please find a creator and chat here.</p>
                            </div>
                        @endforelse

                    </div>
                    <div class="no-result hide">
                        <div class="p-4 text-center">
                            No Results
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="d-flex flex" id="content-body">
            <div class="d-flex flex-column flex" id="chat-list">
                <div class="navbar flex-nowrap white lt box-shadow">
                    <a data-toggle="modal" data-target="#content-aside-chat" data-modal class="mr-1 d-md-none"
                       id="summary_toggle">
					<span class="btn btn-sm btn-icon primary">
			      		<i class="fa fa-th"></i>
			        </span>
                    </a>

                    <span class="text-md text-ellipsis flex">
		        	    @if($active_channel)
                            <a href="{{url('/profile').'?user='.base64_encode($active_channel->opponent_id)}}">
                            <img src="{{url($active_channel->opponent_photo)}}" class="img-cover w-32 d-md-none circle"
                                 alt=".">
                                {{$active_channel->opponent_name}}
                            </a>
                        @endif
		            </span>
                </div>
                <div class="scrollable hover app-content message-content">
                    <div class="p-3">
                        <div class="chat-list">
                            @if($active_channel)
                                @foreach($messages as $m)
                                    <div class="chat-item" @if($m->mine) data-class="alt"
                                         @else data-class="null" @endif>
                                        <a href="#" class="avatar w-40">
                                            <img src="{{url($m->sender_photo)}}" class="w-40 img-cover" alt=".">
                                        </a>
                                        <div class="chat-body">
                                            <div class="chat-content rounded msg">
                                                {{$m->message}}
                                            </div>

                                            <div class="chat-date date">
                                                {!! date('M j, H:m:s', strtotime($m->created_at)) !!}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <p>Please find or choose a creator and chat.</p>
                            @endif
                        </div>
                        <div class="hide">
                            <div class="chat-item" id="chat-item" data-class>
                                <a href="#" class="avatar w-40">
                                    <img class="image" src="{{asset('/assets/images/a0.jpg')}}" alt=".">
                                </a>
                                <div class="chat-body">
                                    <div class="chat-content rounded msg">
                                    </div>
                                    <div class="chat-date date"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-1 gray-bg lt b-t mt-auto" id="chat-form">
                    @if($active_channel)
                        <form method="post" action="{{url('/messages')}}/{{$active_channel->id}}/send" id="form-send">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Message" id="newField"
                                       name="message" maxlength="180">
                                <span class="input-group-btn">
                                    <button class="btn white b-a no-shadow" type="button" id="newBtn">
                                        <i class="fa fa-send text-success"></i>
                                    </button>
		          	            </span>
                            </div>
                            <span id="max_warn"
                                  class="small text-info"
                                  style="display: none;">*MESSAGES CAN ONLY BE 180 CHARACTERS.</span>
                        </form>
                    @else
                        <form method="post" disabled id="form-send">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Message" id="newField"
                                       name="message" maxlength="180" disabled="">
                                <span class="input-group-btn">
                                    <button class="btn white b-a no-shadow" type="button" id="newBtn" disabled="">
                                        <i class="fa fa-send text-success"></i>
                                    </button>
		          	            </span>
                            </div>
                            <span id="max_warn"
                                  class="small text-info"
                                  style="display: none;">*MESSAGES CAN ONLY BE 180 CHARACTERS.</span>
                        </form>
                    @endif
                </div>

            </div>
        </div>
    </div>

@endsection

@section('script')
    <script src="https://js.pusher.com/4.0/pusher.min.js"></script>

    <script>
        var pusher = new Pusher("be70bda4a0273ca4a552", {cluster: "us2", encrypted: true});

        Pusher.logToConsole = true;

        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

        });

        //        $(window).keydown(function (event) {
        //            if (event.keyCode == 13) {
        //                event.preventDefault();
        //                return false;
        //            }
        //        });
    </script>

    <script>

        function show_summary() {
            if (window.matchMedia('(max-width: 767px)').matches) {
                $('#summary_toggle').trigger('click');
            }
        }

        $(document).ready(function () {

            @if(empty(!$error))
                alert('{!! $error !!}');
                    @endif

            var cur_url = window.location.href;
            if ((cur_url.indexOf('channel') == -1) && (cur_url.indexOf('user') == -1 )) {
                show_summary();
            }


            //scroll down to last message
            if ($('.chat-list .chat-item').length > 0) {
                $('div.scrollable').animate({
                    scrollTop: $(".chat-list .chat-item:last-child").offset().top
                }, 2000);
            }

            //check character length
            $("#newField").on('input', function () {
                if ($(this).val().length >= 180) {
                    $('#max_warn').fadeIn('slow');
                } else {
                    $('#max_warn').fadeOut('slow');
                }
            });

        });
    </script>


    @if(!empty($active_channel))
        <script>
            window.chat = {};

            (function ($, list) {
                "use strict";

                var nav_el = "#chat-nav"
                    , list_el = "#chat-list"
                    , navlist
                    , list
                ;

                var channel = pusher.subscribe('chat{{$active_channel->id}}');
                channel.bind('new-message', function (data) {
                    create(data);
                });

                $(document).on('click', '#chat-form #newBtn', function (e) {
                    e.preventDefault();
                    send();
                });

                $('#chat-form #newField').bind('keydown', function (e) {
                    if (e.keyCode == 13) {
                        //control enter pressed
                        e.preventDefault();
                        send();
                    }
                });

                function send() {
                    console.log("send");
                    var newField = $('#newField');
                    if (newField.val() !== '') {
                        var msg = newField.val();

                        @if($active_channel->need_pay)
                        console.log('submitting form');
                        var form = $('#form-send');
                        form.submit();
                        @else
                        console.log('sending ajax call');
                        $.ajax({
                            url: "{{url('/messages')}}/{{$active_channel->id}}/send",
                            type: 'POST',
                            data: {
                                'message': msg,
                            },
                            success: function (data) {
                                //waiting
                            },
                            error: function (XMLHttpRequest, textStatus, errorThrown) {
                                notie.alert({type: 1, text: 'Failed to send chat'});
                                console.log(textStatus);
                            },
                            cache: false
                        });
                        @endif


                        $("#newField").val("");
                    }
                }


                function create(data) {

                    list.add({
                        msg: data.message,
                        date: data.created_at,
                        image: data.sender_photo,
                        class: data.sender_id == '{{Auth::user()->id}}' ? 'alt' : ''
                    });

                    gotoMsg();
                }

                function gotoMsg() {
                    $('.scrollable', list_el).animate({
                        scrollTop: $('.scrollable', list_el).prop("scrollHeight")
                    }, 1000, 'easeInOutExpo');
                }

                var init = function () {
                    $(document).trigger('refresh');

                    // nav
                    navlist = new List(nav_el.substr(1), {
                        valueNames: [
                            'item-title',
                            'item-except'
                        ]
                    });

                    // list
                    list = new List(list_el.substr(1), {
                        listClass: 'chat-list',
                        item: 'chat-item',
                        valueNames: [
                            'msg',
                            'date',
                            {data: ['class']},
                            {name: 'image', attr: 'src'}
                        ]
                    });

//                        notie.alert({type:1, text: 'Try say something' });

                }

                // for ajax to init again
                list.init = init;
            })(jQuery, window.chat);

        </script>
    @endif
@endsection