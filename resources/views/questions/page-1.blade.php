@extends('layout.app')

@section('content')
<div class="survey col-md-12">
    <!-- <form action="/survey/1" method="post" class="w-100">
        @csrf -->
    <form class="w-100">

        @foreach ($questions as $question)
        <fieldset class="form-group">
            <div class="row">
                <legend class="col-form-label col-sm-1 pt-0 text-right">{{$question->id}})</legend>
                <div class="col-sm-11">
                    <p>{!!$question->question!!}</p>

                    <span class="invalid-feedback answer_{{$question->id}} d-block" role="alert"></span>

                    @foreach ($question->questionchoices as $choice)
                    <div class="form-check" style="display: {{ ($choice->question_id == 1) ? 'inline-block' : '' }}">
                        <input class="form-check-input {{$choice->type}} @error('answer_{{$choice->question_id}}') is-invalid @enderror" type="{{ ($choice->question_id == 3) ? 'checkbox' : 'radio' }}" name="{{ ($choice->question_id === 3) ? 'answer_'.$choice->question_id.'[]' : 'answer_'.$choice->question_id }}" id="{{$choice->id}}" data-question-id="{{$choice->question_id}}" value="{{ ($choice->type === 'custom') ? 'custom' : $choice->id }}" {{ (old('answer_'.$choice->question_id) == $choice->id) ? 'checked' : '' }}>
                        <label class="form-check-label" for="{{$choice->id}}">
                            {!!$choice->choice!!}
                        </label>
                        @if ($choice->type === 'custom')
                        <div class="others-container {{ 'answer_'.$choice->question_id }}">
                            <input class="form-control" type="text" name="{{ ($choice->question_id == 3) ? 'custom_answer_'.$choice->question_id.'[]' : 'custom_answer_'.$choice->question_id }}">
                        </div>
                        @endif

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

            var answer_1 = ($('input[name="answer_1"]:checked').val()) ? {
                'question_id': $('input[name="answer_1"]:checked').data('question-id'),
                'question_choice_id': $('input[name="answer_1"]:checked').prop('id'),
                'others': ''
            } : '';
            var answer_2 = ($('input[name="answer_2"]:checked').val()) ? {
                'question_id': $('input[name="answer_2"]:checked').data('question-id'),
                'question_choice_id': $('input[name="answer_2"]:checked').prop('id'),
                'others': ($('input[name="answer_2"]:checked').val() !== 'custom') ? '' : $('input[name="custom_answer_2"]').val()
            } : '';
            var answer_3 = [];
            $('input[name="answer_3[]"]:checked').each(function() {
                answer_3.push({
                    'question_id': $(this).data('question-id'),
                    'question_choice_id': $(this).prop('id'),
                    'others': ($(this).val() !== 'custom') ? '' : $('input[name="custom_answer_3[]"]').val()
                });
                return answer_3;
            });

            $.ajax({
                url:'/survey/1',
                type: 'POST',
                data:{
                    answer_1: answer_1,
                    answer_2: answer_2,
                    answer_3: (answer_3.length <= 0) ? '' : JSON.stringify(answer_3)
                },
                success: function(data){
                    // console.log(data);
                    if (data.success) {
                        window.location.href = '/survey/2';
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