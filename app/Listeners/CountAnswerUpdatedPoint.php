<?php

namespace App\Listeners;

use App\Events\AnswerUpdated;
use App\Models\Answer;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CountAnswerUpdatedPoint
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(AnswerUpdated $event): void
    {
        $user = User::where('id', $event->answer->user_id)->get()->first();

        $totalPoints = array_reduce($event->answer->answer, function ($carry, $item) {
            return $carry + $item['point'];
        }, 0);

        $user->profile()->update([
            'point' => $totalPoints
        ]);
    }
}
