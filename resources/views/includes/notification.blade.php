<ul class="dropdown-menu dropdown__menu" aria-labelledby="navbarDropdown">
    @foreach(auth()->user()->notifications as $notification)
        @if($notification->type == 'App\\Notifications\\NewOrder')
            <li class="dropdown-item  @if($notification->unread()) unseen @endif" id="notificationsMenu">
                <a class="nav-link seenSingle" id = "{{ $notification->id }}" href=" {{route('admin.user.show', ['id' => $notification->data['user_id']])}}#{{$notification->data['id_transaction']}}">
                    @lang('header.notification.neworder') <strong>{{ $notification->data['user_name'] }}</strong><p class="small float-right">{{ $notification->created_at->diffForHumans() }}</p>
                </a>
            </li>
        @elseif($notification->type == 'App\\Notifications\\NewStatusOrder')
            <li class="dropdown-item  @if($notification->unread()) unseen @endif" id="notificationsMenu">
                <a class="nav-link seenSingle" id = "{{ $notification->id }}" href="{{route('checkout.show', [ 'id' => auth()->id()])}}#{{$notification->data['id_transaction']}}">
                    @lang('header.notification.newstatusorder') <strong>{{ $notification->data['id_transaction'] }}</strong> @lang('header.notification.is') <strong>{{ $notification->data['status_transaction'] }}</strong><br><p class="small float-right">{{ $notification->created_at->diffForHumans() }}</p>
                </a>
            </li>
        @else
            <li class="dropdown-item  @if($notification->unread()) unseen @endif" id="notificationsMenu">
                <a class="nav-link seenSingle" id = "{{ $notification->id }}"  href=" {{route('admin.order.index')}}#pending"> @lang('header.notification.processing')<p class="small float-right">{{ $notification->created_at->diffForHumans() }}</p></a>
            </li>
        @endif
    @endforeach
    @if (auth()->user()->unreadnotifications()->count() > config('setting.default_value_0'))
        <li class="dropdown-item " id="notificationsMenu">
            <a class="float-right seenAll" href="">@lang('header.notification.seeall')</a>
        </li>
    @endif
</ul>
