@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        @foreach ($questionnaires as $questionnaire)

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $questionnaire->name }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a class="btn btn-secondary" href="/questionnaire/{{ $questionnaire->id }}/show"">Take questionnaire</a>
                </div>
            </div>
        </div>

        @endforeach

    </div>
</div>
@endsection
