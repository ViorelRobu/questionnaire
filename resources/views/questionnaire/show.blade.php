@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">


        <form action="/questionnaire/submit" method="post">
            @method('POST')
            @csrf
            @foreach ($questions as $question)
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">{{ $question->question }}</div>

                        <div class="card-body">
                            @foreach ($question->answers as $answer)
                            <div class="form-group">
                                <div class="row">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="true" name="answer[]">
                                        <label class="form-check-label">
                                            {{ $answer->response }}
                                        </label>
                                </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

            <button type="submit" class="btn btn-success form-control">Submit questionnaire</button>
        </form>


    </div>
</div>
@endsection
