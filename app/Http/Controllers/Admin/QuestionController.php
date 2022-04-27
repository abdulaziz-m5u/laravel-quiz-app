<?php

namespace App\Http\Controllers\Admin;

use App\Models\Question;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Admin\QuestionRequest;
use App\Models\Category;
use App\Models\Option;

class QuestionController extends Controller
{
   
    public function index(): View
    {
        $questions = Question::all();

        return view('admin.questions.index', compact('questions'));
    }

    public function create(): View
    {
        $categories = Category::all()->pluck('name', 'id');

        return view('admin.questions.create', compact('categories'));
    }

    public function store(QuestionRequest $request): RedirectResponse
    {
        $question = Question::create($request->validated());
        for($optionIndex=0;$optionIndex<=(count($request->option)-1);$optionIndex++){
            Option::create(
                [
                    'question_id'   =>  $question->id,
                    'option_text'   =>  $request->option[$optionIndex],
                    'points'        =>  $request->point[$optionIndex]
                ]
            );
        }

        return redirect()->route('admin.questions.index')->with([
            'message' => 'successfully created !',
            'alert-type' => 'success'
        ]);
    }

    public function show(Question $question): View
    {
        return view('admin.questions.show', compact('question'));
    }

    public function edit($id): View
    {
        $categories = Category::all()->pluck('name', 'id');
        $question = Question::with('questionOptions')->find($id);
        return view('admin.questions.edit', compact('question', 'categories'));
    }

    public function update(QuestionRequest $request, Question $question): RedirectResponse
    {
        $question->update($request->validated());
        for($optionIndex=0;$optionIndex<=(count($request->option)-1);$optionIndex++){

            $option = Option::find($request->id[$optionIndex]);
            $option->update([
                'option_text'   =>  $request->option[$optionIndex],
                'points'        =>  $request->point[$optionIndex]
            ]);
        }

        return redirect()->route('admin.questions.index')->with([
            'message' => 'successfully updated !',
            'alert-type' => 'info'
        ]);
    }

    public function destroy(Question $question): RedirectResponse
    {
        $question->delete();

        return back()->with([
            'message' => 'successfully deleted !',
            'alert-type' => 'danger'
        ]);
    }

    public function massDestroy()
    {
        Question::whereIn('id', request('ids'))->delete();

        return response()->noContent();
    }
}
