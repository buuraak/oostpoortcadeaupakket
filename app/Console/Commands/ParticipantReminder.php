<?php

namespace App\Console\Commands;

use App\Mail\ReminderParticipant;
use App\Models\Invited_Participants;
use App\Models\Participants;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class ParticipantReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checks and sends an email to all participants that received an email 3 days ago but havent verified';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $subject = 'Friendly reminder - bevestig je deelname en maak kans op het Oostpoort cadeaupakket!';
        $unverified_participants = Participants::where('created_at', '<=', Carbon::now()->subDay(3)->toDateTimeString())->get();

        foreach($unverified_participants as $unverified_participant) {
            if($unverified_participant->verified === 0 && $unverified_participant->reminder_sent == 0){
                $friend = Invited_Participants::where('participant_id', $unverified_participant->id)->first();
                $data = [
                    'name' => $unverified_participant->p_name,
                    'email' => $unverified_participant->p_email,
                    'friend_name' => $friend->name,
                    'url' => url('/confirm/' . $unverified_participant->id),
                    'subject' => $subject
                ];
                Mail::to($unverified_participant->p_email)->locale('nl')->send(new ReminderParticipant($data));
                $unverified_participant->reminder_sent = 1;
                $unverified_participant->save();
                echo response()->json(['status' => __('success'),'message' => __('Successfully sent reminder to participants'), 'data' => $data ], 200);
            }
        }

        $unverified_friends = Invited_Participants::where('created_at', '<=', Carbon::now()->subDay(3)->toDateTimeString())->get();

        foreach($unverified_friends as $unverified_friend) {
            if($unverified_friend->verified === 0 && $unverified_friend->reminder_sent === 0) {
                $friend = Participants::where('id', $unverified_friend->participant_id)->first();
                $data = [
                    'name' => $unverified_friend->name,
                    'email' => $unverified_friend->email,
                    'friend_name' => $friend->p_name,
                    'url' => url('/confirm/friend/' . $unverified_friend->id),
                    'subject' => $subject
                ];
                Mail::to($unverified_friend->email)->locale('nl')->send(new ReminderParticipant($data));
                $unverified_friend->reminder_sent = 1;
                $unverified_friend->save();
                echo response()->json(['status' => __('success'),'message' => __('Successfully sent reminder to friends of participants'), 'data' => $data ], 200);

            }
        }
    }
}
