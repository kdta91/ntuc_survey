@extends('layout.app')

@section('content')
<div id="home" class="col-md-12 text-center">
    <div class="home-image">
        <img src="{{ asset('images/logo.png') }}" alt="NTUC LearningHub" class="logo">
    </div>
    <div class="home-image">
        <img src="{{ asset('images/free-gift.png') }}" alt="Complete the survey to get a free gift" class="headline">
    </div>

    <a href="{{ route('respondent.create') }}" class="start-button"></a>
</div>
@endsection