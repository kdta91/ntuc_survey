@extends('layout.app')

@section('content')
<div id="respondent" class="col-md-12">
    <div class="row">
        <form action="/respondent" method="post" class="w-100">
            @csrf

            <div class="form-group row col-md-12">
                <label for="first_name">{{ __('First Name:') }}</label>

                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror"
                    name="first_name" value="{{ old('first_name') }}" autocomplete="first_name" autofocus>

                @error('first_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group row col-md-12">
                <label for="last_name">{{ __('Last Name:') }}</label>

                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror"
                    name="last_name" value="{{ old('last_name') }}" autocomplete="last_name" autofocus>

                @error('last_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group row col-md-12">
                <label for="email">{{ __('Email Address:') }}</label>

                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                    name="email" value="{{ old('email') }}" autocomplete="email" autofocus>

                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group row col-md-12">
                <label for="contact_number">{{ __('Contact Number:') }}</label>

                <input id="contact_number" type="text" class="form-control @error('contact_number') is-invalid @enderror"
                    name="contact_number" value="{{ old('contact_number') }}" autocomplete="contact_number" autofocus>

                @error('contact_number')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group row col-md-12">
                <button type="submit" class="next-button"></button>
            </div>

        </form>
    </div>
</div>
@endsection