@extends('layout.report')

@section('content')
<div class="col-md-12">
    <a href="{{route('exportReport')}}" class="btn btn-primary">Export to CSV</a>

    <!-- <table class="table table-striped">
        <thead class="table-dark">
            <tr>
                <th>Name</th>
                <th>Question</th>
                <th>Choice</th>
                <th>Others</th>
            </tr>
        </thead>

        @foreach ($survey_results as $result)
        <tr>
            <td>{{ $result->respondent->first_name . ' ' . $result->respondent->last_name }}</td>
            <td>{!! $result->question->question !!}</td>
            <td>{!! $result->questionChoice->choice !!}</td>
            <td>{{ $result->others }}</td>
        </tr>
        @endforeach
    </table> -->
</div>
@endsection