
@if ($errors->has('email'))
    <span class="invalid-feedback" role="alert">
        <strong>{{ $errors->first('email') }}</strong>
    </span>
@endif

@if ($errors->has('password'))
    <span class="invalid-feedback" role="alert">
        <strong>{{ $errors->first('password') }}</strong>
    </span>
@endif

@if ($errors->has('name'))
    <span class="invalid-feedback" role="alert">
        <strong>{{ $errors->first('name') }}</strong>
    </span>
@endif

