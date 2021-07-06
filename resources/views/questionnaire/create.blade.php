@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('New Questionnaire') }}</div>

                <div class="card-body">
                    <form method="POST" action="/questionnaire/store">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label for="name">Questionnaire Name</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Questionnaire Name">
                        </div>
                        <button type="button" class="btn btn-primary" id="new_question">New Question</button>
                        <hr>
                        <div id="question_container" class="form-group">

                        </div>
                        <hr>
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script>
        $('#new_question').on('click', function(e) {
            e.preventDefault();
            $('#question_container').append(`
                <div class="question_div">
                    <div class="row py-1">
                        <input type="hidden" class="answer_no" name="answer_no[]" value="">
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="question[]" placeholder="Question">
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-danger form-control delete_question">Delete</button>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-primary form-control new_answer">New Answer</button>
                        </div>
                    </div>
                    <div class="answer_div">

                    </div>
                </div>
            `);
        });

        $('body').on('click', '.delete_question',function(e) {
            e.preventDefault();
            let el = $(this).parent().parent().parent();
            el.remove();
        });

        $('body').on('click', '.new_answer',function(e) {
            e.preventDefault();
            let el = $(this).parent().parent().parent();
            let answer_no = $(this).parent().parent().children('.answer_no');
            let children = el.children();
            answer_no.val(children.length - 1);
            console.log(children.length - 1);
            el.append(`
                <div class="answers_div">
                    <div class="row py-1">
                        <div class="col-md-1">
                            ${children.length - 1}.
                        </div>
                        <div class="col-md-7">
                            <input type="text" class="form-control" name="answer[]" placeholder="Answer">
                        </div>
                        <div class="col-md-2">
                            <select class="form-control" name="correct_answer[]">
                                <option value="0">Incorrect</option>
                                <option value="1">Correct</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-danger form-control delete_answer">Delete</button>
                        </div>
                    </div>
                </div>
            `);
        });

        $('body').on('click', '.delete_answer',function(e) {
            e.preventDefault();
            let el = $(this).parent().parent().parent();
            el.remove();
        });

    </script>
@endsection


