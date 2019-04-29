@if(count($errors) > config('defaul_value_0'))
    <ul class="list-group">
        @foreach($errors->all() as $error)
            <li class="alert-danger alert">
                {{ $error }}
            </li>
        @endforeach
    </ul>
@endif
