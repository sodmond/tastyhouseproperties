@extends('layouts.app', ['title' => 'Vendor Messages', 'activePage' => 'seller.messages'])

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
                            <h2>My Messages</h2>
                            <span class="title-leaf">
                                &nbsp;
                            </span>
                        </div>

                        <div class="table-responsive dashboard-bg-box">
                            <div class="dashboard-title dashboard-flex">
                                <h3>Chat List</h3>
                            </div>
                            <table class="table product-tabl table-hover">
                                <tbody>
                                    @foreach($chats as $chat)
                                    @php $msgCount = count($chat->chatlog); @endphp
                                    <tr style="cursor:pointer;" onclick="window.location.href='{{ route('seller.message', ['id' => $chat->id]) }}'" class="{{ ($chat->seller_read_status == 0) ? 'theme-light-bg' : '' }}">
                                        <td class="product-image">
                                            @php $profilepix = asset(empty($chat->user->image) ? 'img/user-icon.png' : 'storage/user/profile_pix/'.$chat->user->image ); @endphp
                                            <img src="{{ $profilepix }}" class="blur-up lazyload img-thumbnail" alt="" style="border-radius:100px; max-width:50px;">
                                        </td>
                                        <td style="text-align:left; max-width: 200px;">
                                            <h6 class="theme-color fw-bold mb-2">{{ $chat->user->firstname.' '.$chat->user->lastname }}</h6>
                                            <h6 class="ellipsis">{{ $chat->chatlog[$msgCount-1]->message }}</h6>
                                        </td>
                                        <td style="vertical-align: middle;">
                                            @if ($chat->seller_read_status == 0)
                                                <div class="mb-2"><small style="background:#F75709; color:#FFF;" class="px-2 py-2 rounded-pill">unread</small></div>
                                            @endif
                                            <div class="small">{{ $chat->chatlog[$msgCount-1]->created_at }}</div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <nav class="custom-pagination">
                                {{ $chats->appends($_GET)->links() }}
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection