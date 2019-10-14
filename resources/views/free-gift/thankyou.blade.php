@extends('layout.app')

@section('content')
<div class="col-md-12 text-center">
    <div class="col-md-12 text-center">
        <div class="thank-you-container">
            <h1 class="mb-5">Please redeem your free gift from any of the course consultants.</h1>
            <h1 class="mb-5">Thank you!</h1>

            <div class="mt-5">
                <a href="{{ route('clearSurveySession') }}" class="next-button"></a>
            </div>
        </div>
    </div>
</div>
@endsection