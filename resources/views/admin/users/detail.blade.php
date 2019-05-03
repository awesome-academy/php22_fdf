@extends('layouts.app')
@section('content')
    @include('admin.include.errors')
         <div class="card">
             <div class="card-header">
                 <a href = "{{ route('admin.user.show',['id' => $user->id]) }}">@lang('header.users.title_detail'): {{ $user->name }}</a>
             </div>
         </div>
         <div class="card-body">
             <div class="form-group" >
                 <label class="col-sm-4 col-form-label font-weight-bold">@lang('header.users.header_name'):</label>
                     {{ $user->name }}
             </div>
             <div class="form-group" >
                 <label class="col-sm-4 col-form-label font-weight-bold">@lang('header.email'):</label>
                     {{ $user->email }}
             </div>
             <div class="form-group" >
                 <label class="col-sm-4 col-form-label font-weight-bold">@lang('header.phone'):</label>
                     {{ $user->phone }}
             </div>
             <div class="form-group" >
                 <label class="col-sm-4 col-form-label font-weight-bold">@lang('header.address'):</label>
                     {{ $user->address }}
             </div>
             <div class="form-group" >
                 <label class="col-sm-4 col-form-label font-weight-bold">@lang('header.create_at'):</label>
                 <time class="published" datetime="2016-04-17 12:00:00">
                     {{ $user->created_at->toFormattedDateString() }}
                 </time>
             </div>
        </div>
@endsection
