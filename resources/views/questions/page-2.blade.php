@extends('layout.app')

@section('content')
<div class="survey col-md-12">
    <!-- <form action="/survey/2" method="post" class="w-100">
        @csrf -->
    <form class="w-100">

        @foreach ($questions as $question)
        <fieldset class="form-group">
            <div class="row">
                <legend class="col-form-label col-sm-2 pt-0 text-right">{{$question->id}})</legend>
                <div class="col-sm-10">
                    <p>{!!$question->question!!}</p>

                    <span class="invalid-feedback answer_{{$question->id}} d-block" role="alert"></span>

                    @foreach ($question->questionchoices as $choice)
                    <div class="form-check">
                        @if ($choice->question_id === 5)
                        <input class="form-control" type="text" name="{{ 'answer_'.$choice->question_id }}" id="{{$choice->id}}" data-question-id="{{$choice->question_id}}" value="{{ old('answer_'.$choice->question_id) }}">
                        @else
                        <input class="form-check-input @error('answer_{{$choice->question_id}}') is-invalid @enderror" type="{{ ($choice->question_id == 4) ? 'checkbox' : 'radio' }}" name="{{ ($choice->question_id === 4) ? 'answer_'.$choice->question_id.'[]' : 'answer_'.$choice->question_id }}" id="{{$choice->id}}" data-question-id="{{$choice->question_id}}" value="{{$choice->id}}" {{ (old('answer_'.$choice->question_id) == $choice->id) ? 'checked' : '' }}>
                        @endif
                        <label class="form-check-label" for="{{$choice->id}}">
                            {!!$choice->choice!!}
                        </label>

                        @error('answer_{{$choice->question_id}}')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    @endforeach
                </div>
            </div>
        </fieldset>
        @endforeach

        <div class="form-group row col-md-12 justify-content-center">
            <!-- <button type="submit" class="next-button"></button> -->
            <button type="button" class="next-button"></button>
        </div>

    </form>
</div>
@endsection

@section('scripts')
<script>
    $(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.next-button').click(function(e){
            e.preventDefault();

            // var answer_4 = ($('input[name="answer_4"]:checked').val()) ? {
            //     'question_id': $('input[name="answer_4"]:checked').data('question-id'),
            //     'question_choice_id': $('input[name="answer_4"]:checked').prop('id'),
            //     'others': ''
            // } : '';
            var answer_4 = [];
            $('input[name="answer_4[]"]:checked').each(function() {
                answer_4.push({
                    'question_id': $(this).data('question-id'),
                    'question_choice_id': $(this).prop('id'),
                    'others': ''
                });
                return answer_4;
            });
            var answer_5 = ($('input[name="answer_5"]').val()) ? {
                'question_id': $('input[name="answer_5"]').data('question-id'),
                'question_choice_id': $('input[name="answer_5"]').prop('id'),
                'others': $('input[name="answer_5"]').val()
            } : '';

            $.ajax({
                url:'/survey/2',
                type: 'POST',
                data:{
                    // answer_4: answer_4,
                    answer_4: (answer_4.length <= 0) ? '' : JSON.stringify(answer_4),
                    answer_5: answer_5,
                },
                success: function(data){
                    // console.log(data);
                    if (data.success) {
                        window.location.href = '/free-gift';
                    }

                    if (data.errors) {
                        // console.log(data.errors);
                        $('span.invalid-feedback').hide();
                        $('span.invalid-feedback').empty();

                        for (const key in data.errors) {
                            if (data.errors.hasOwnProperty(key)) {
                                const element = data.errors[key];
                                if ($('span.invalid-feedback').hasClass(key)) {
                                    // console.log(key);
                                    $('span.invalid-feedback.' + key).show();
                                    $('span.invalid-feedback.' + key).html('<strong>'+element[0]+'</strong>');
                                }
                            }
                        }
                    }
                },
                error: function(error){
                    console.log(error);
                }
            });
        });
    });
</script>
@endsection