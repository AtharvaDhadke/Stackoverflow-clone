<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAnswerRequest;
use App\Http\Requests\UpdateAnswerRequest;
use App\Http\Requests\UpdateQuestionRequest;
use App\Models\Answer;
use App\Models\Question;
use App\Notifications\NewReplyAdded;
use App\Policies\AnswerPolicy;
use CreateAnswersTable;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    public function store(Question $question, CreateAnswerRequest $request)
    {
        $question->answers()->create([
            'body' => $request->body,
            'user_id' => auth()->id()
        ]);

        $question->owner->notify(new NewReplyAdded($question));
        session()->flash('success','Your answer submitted successfully');
        return redirect($question->url);
    }

    public function edit(Question $question, Answer $answer)
    {
        $this->authorize('update', $answer);
        return view('answers._edit', compact(['question', 'answer']));
    }

    public function update(UpdateAnswerRequest $request, Question $question, Answer $answer)
    {
        $this->authorize('update', $answer);
        $answer->update([
            'body' => $request->body
        ]);
        session()->flash('success', 'Your answer was updated successfully!!');
        return redirect($question->url);
    }

    public function bestAnswer(Answer $answer)
    {
        $this->authorize('markAsBest', $answer);
        $answer->question->markBestAnswer($answer);
        return redirect()->back();
    }

    public function destroy(Question $question, Answer $answer)
    {
        $this->authorize('delete',$answer);
        $answer->delete();

        session()->flash('success', 'Your answer has been deleted');
        return redirect()->back();
    }
}
