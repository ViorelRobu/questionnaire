<?php

namespace App\Http\Controllers;

use App\Models\QuestionAnswers;
use App\Models\Questionnaire;
use App\Models\QuestionnaireDetail;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Database\Eloquent\InvalidCastException;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use InvalidArgumentException;

class QuestionnaireController extends Controller
{
    /**
     * Show the questionnaire creation page
     *
     * @return View|Factory
     * @throws BindingResolutionException
     */
    public function create()
    {
        return view('questionnaire.create');
    }

    /**
     * Create a questionnaire
     *
     * @param Request $request
     * @return Redirector|RedirectResponse
     * @throws InvalidArgumentException
     * @throws InvalidCastException
     * @throws BindingResolutionException
     */
    public function store(Request $request)
    {

        // create the questionnaire
        $questionnaire = Questionnaire::create([
            'name' => $request->name
        ]);

        $offset = 0;

        // create the questions and the answers
        foreach ($request->question as $k => $q) {
            $question = new QuestionnaireDetail();
            $question->q_id = $questionnaire->id;
            $question->question = $q;
            $question->save();

            $total_answers = $request->answer_no[$k];

            $answers = array_slice($request->answer, $offset, $total_answers);

            foreach ($answers as $akey => $ans) {
                $answer = new QuestionAnswers();
                $answer->q_d_id = $question->id;
                $answer->response = $ans;
                $answer->is_correct = $request->correct_answer[$akey];
                $answer->save();
            }

            $offset += $request->answer_no[$k];

        }

        return redirect('/');
    }

    /**
     * Show the questionnaire
     *
     * @param Questionnaire $id
     * @return void
     */
    public function show(Questionnaire $id)
    {
        $questions = QuestionnaireDetail::where('q_id', $id->id)->get();

        return view('questionnaire.show', ['questions' => $questions]);
    }

    public function submit(Request $request)
    {
        dd('Your form has been submitted!');
    }
}
