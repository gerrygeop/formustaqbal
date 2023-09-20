<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use App\Models\Module;
use App\Models\Question;
use App\Models\User;
use App\Models\UserResponses;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index(Module $module, Assessment $assessment)
    {
        $rooms = auth()
            ->user()
            ->rooms()
            ->where('module_id', $module->id)
            ->with(['users' => function ($query) use ($assessment) {
                $query->where('user_id', '!=', auth()->id())
                    ->whereHas('assessments', function ($subquery) use ($assessment) {
                        $subquery->where('assessment_id', $assessment->id);
                    });
            }])
            ->get();

        return view('reviews.index', [
            'module' => $module,
            'assessment' => $assessment,
            'rooms' => $rooms,
        ]);
    }

    public function show(Module $module, Assessment $assessment, User $user)
    {
        $ur = UserResponses::query()
            ->where([
                ['assessment_id', '=', $assessment->id],
                ['user_id', '=', $user->id],
            ])
            ->with('user')
            ->get();

        return view('reviews.show', [
            'user' => $user,
            'module' => $module,
            'assessment' => $assessment,
            'responses' => $ur,
        ]);
    }

    public function edit(Module $module, Assessment $assessment, UserResponses $userresponses)
    {
        $responses = collect(json_decode($userresponses->responses));
        $questions = Question::whereIn('id', $responses->pluck('question_id'))->with('choices')->get();

        $questions = $questions->mapWithKeys(function ($question, int $key) {
            return [$question->id => $question];
        });

        return view('reviews.edit', [
            'module' => $module,
            'assessment' => $assessment,
            'userResponses' => $userresponses,
            'questions' => $questions,
        ]);
    }

    public function update(Request $request, UserResponses $user)
    {
        $validated = $request->validate([
            'feedback' => ['string'],
        ]);
        $req = $request->except('_token', '_method', 'feedback');
        $responses = json_decode($user->responses, true);

        $score = [];
        foreach ($req as $questionId => $point) {
            foreach ($responses as &$response) {
                if ($response['question_id'] == $questionId) {
                    $response['point'] = $point;
                    $score[] = $point;
                }
            }
        }

        $user->responses = json_encode($responses);
        $user->score = array_sum($score);
        $user->feedback = $validated['feedback'];
        $user->reviewed = auth()->id();
        $user->save();

        return back()->with('submit-success', 'Berhasil disubmit');
    }
}
