@extends('layouts.app', ['title' => 'Vendor Chat', 'activePage' => 'seller.messages'])

@section('content')
<section class="user-dashboard-section section-b-space">
    <div class="container-fluid-xs">
        <div class="row">
            <div class="col-xxl-3 col-lg-4">
                @include('seller.layouts.sidebar', ['activePage' => 'seller.messages'])
            </div>

            <div class="col-xxl-9 col-lg-8">
                <button class="btn left-dashboard-show btn-animation btn-md fw-bold d-block mb-4 d-lg-none">
                    Dashboard Menu</button>
                <div class="dashboard-right-sidebar">
                    <div class="product-tab">
                        <div class="title">
                            <h2>Chat</h2>
                            <span class="title-leaf">
                                &nbsp;
                            </span>
                        </div>

                        <div class="table-responsive dashboard-bg-box">
                            <div class="dashboard-title dashboard-flex">
                                <h3>{{ $chat->user->firstname.' '.$chat->user->lastname }}</h3>
                                <button class="btn btn-sm theme-bg-color"><a class="text-white" href="{{ route('seller.messages') }}"><i class="fa fa-arrow-left"></i>  Back</a></button>
                            </div>
                            <div class="theme-color fw-bold fs-6" style="margin-bottom:15px">
                                <a href="javascript:void(0)" style="display:block; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                                    ORDER #{{ $chat->order->code }}</a>
                            </div>
                            <div id="th-chatbox">
                                @foreach ($chatlog as $log)
                                    @if($log->sender == 'seller')
                                        <div class="row justify-content-end">
                                            <div class="sender">{{ $log->message }}</div>
                                        </div>
                                    @else
                                        <div class="row justify-content-start">
                                            <div class="receiver">{{ $log->message }}</div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <div style="padding:20px 30px; background:#e3e3e3;">
                                @csrf
                                <div class="input-group mb-1">
                                    <textarea id="message" class="form-control" placeholder="Write message" aria-label="Write message" aria-describedby="sendBtn" 
                                        style="height:50px; max-height:100px;" autofocus></textarea>
                                    <button class="btn btn-animation" type="button" id="sendBtn"><i class="fa fa-arrow-up"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<input type="hidden" id="sendMessageLink" value="{{ route('seller.message.send', ['id' => $chat->id]) }}">
@endsection

@push('custom-script')
    <script>
        $(document).ready(function(){
            $('#th-chatbox').scrollTop($('#th-chatbox')[0].scrollHeight);
            $('#sendBtn').click(function() {
                let message = $('#message').val();
                let token = $('meta[name=csrf-token]').attr('content');
                if (message != '') {
                    $.ajax({
                        type: 'POST',
                        dataType: 'json',
                        url: $('#sendMessageLink').val(),
                        data: {_token:token, message:message},
                        success: function(data) {
                            if ($.isEmptyObject(data.error)) {
                                let msg = '<div class="row justify-content-end"><div class="sender">'+message+'</div></div>';
                                $('#th-chatbox').append(msg);
                                $('#th-chatbox').scrollTop($('#th-chatbox')[0].scrollHeight);
                                $('#message').val('');
                                //alert('Message sent');
                            }
                        },
                        error: function() {
                            alert('Problem found');
                        }
                    });
                } else {
                    alert('Empty message');
                }
            });
            const chatId = {{ $chat->id }};
            const userId = {{ $chat->user_id }};
            const sellerId = {{ auth('seller')->id() }};
            window.Echo.channel(`chat`).listen('.chat.sent', (e) => {
                //console.log('Chat Event Received');
                if(e.seller_id == sellerId && e.user_id == userId && e.sender == 'user' && e.id == chatId) {
                    let msg = '<div class="row justify-content-start"><div class="receiver">'+e.message+'</div></div>';
                    $('#th-chatbox').append(msg);
                    $('#th-chatbox').scrollTop($('#th-chatbox')[0].scrollHeight);
                    var audio = new Audio("{{ asset('notify.mp3') }}");
                    audio.play();
                }
            });
        });
    </script>
@endpush