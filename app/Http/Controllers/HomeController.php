<?php

namespace App\Http\Controllers;

use App\Jobs\SendConfirmationMailParticipant;
use App\Mail\AdminNewParticipant;
use App\Mail\ConfirmationMailInvitedParticipant;
use App\Mail\ConfirmationMailParticipant;
use App\Models\Invited_Participants;
use App\Models\Participants;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Revolution\Google\Sheets\Facades\Sheets;


class HomeController extends Controller {
    /*
    * Checks if participant has already participated this month.
    */
    public function post( Request $request ) {
        $request->validate( [
            'p_name'  => 'required',
            'p_email' => [ 'required', 'indisposable' ],
            'name'    => 'required',
            'email'   => [ 'required', 'indisposable' ],
        ],
            [
                'p_name.required'      => 'Naam is verplicht',
                'p_email.required'     => 'Email is verplicht',
                'name.required'        => 'Naam is verplicht',
                'email.required'       => 'Email is verplicht',
                'p_email.indisposable' => 'Wegwerp email is niet toegestaan',
                'email.indisposable'   => 'Wegwerp email is niet toegestaan',
            ] );

        $participant_email        = strip_tags( $request->get( 'p_email' ) );
        $participant_name         = strip_tags( $request->get( 'p_name' ) );
        $participant_friend_email = strip_tags( $request->get( 'email' ) );
        $participant_friend_name  = strip_tags( $request->get( 'name' ) );

        $now           = Carbon::now();
        $current_month = $now->month;

        $check = $this->check_participant( $participant_email, $participant_friend_email );

        if ( $check !== true ) {
            return $check;
        }

        $check_reversed = $this->participant_exists_reversed( $participant_email, $participant_friend_email );

        if ( $check_reversed !== true ) {
            return $check_reversed;
        }

        $participant_data = [
            'p_name'  => $participant_name,
            'p_email' => $participant_email
        ];

        $participant = Participants::create( $participant_data )->id;

        $participant_friend_object = [
            'name'           => $participant_friend_name,
            'email'          => $participant_friend_email,
            'participant_id' => $participant
        ];

        $participant_friend = Invited_Participants::create( $participant_friend_object )->id;

        if ( $participant_friend ) {
            $subject = __( 'Bevestig je deelname en maak kans op het Oostpoort cadeaupakket!' );
            $data    = [
                'lang'         => 'nl',
                'email'        => $participant_email,
                'name'         => $participant_friend_name,
                'inviter_name' => $participant_name,
                'subject'      => $subject,
                'url'          => url( '/confirm/friend/' . $participant_friend )
            ];

            Mail::to( $participant_friend_email )->locale( 'nl' )->send( new ConfirmationMailInvitedParticipant( $data ) );
        }

        if ( $participant ) {
            $subject = __( 'Bevestig je deelname en maak kans op het Oostpoort cadeaupakket!' );
            $data    = [
                'lang'    => 'nl',
                'email'   => $participant_email,
                'name'    => $participant_name,
                'subject' => $subject,
                'url'     => url( '/confirm/' . $participant )
            ];
            Mail::to( $participant_email )->locale( $data['lang'] )->send( new ConfirmationMailParticipant( $data ) );
            Sheets::spreadsheet( env( 'SPREADSHEET_ID' ) )->sheet( 'cadeaupakket' )->append( [
                [
                    $current_month,
                    $participant_name,
                    $participant_email,
                    $participant_friend_name,
                    $participant_friend_email
                ]
            ] );
        }
        //Send mail to admin
        if ( $participant && $participant_friend ) {
            $subject = __( 'Er is een nieuwe deelname!' );
            $data    = [
                'emailParticipant' => $participant_email,
                'emailFriend'      => $participant_friend_email,
                'subject'          => $subject
            ];
            Mail::to( 'info@oostpoortcadeaupakket.nl' )->locale( 'nl' )->send( new AdminNewParticipant( $data ) );
        }

        return response()->json( [
            'status'  => 'success',
            'message' => __( 'Er is een mail verzonden naar jouw en je vriend(in). Bevestig alleen nog jullie email om je deelname af te ronden.' )
        ], 200 );
    }

    /*
     * Checks if participant has already been invited this month in which case they should not be able to participate anymore.
     */

    private function check_participant( $participant_email, $participant_friend_email ) {
        $now               = Carbon::now();
        $current_month     = $now->month;
        $check_participant = Participants::where( 'p_email', $participant_email )->whereMonth( 'created_at', '=', $current_month )->first();

        if ( $check_participant ) {
            return response()->json( [
                'status'  => 'error',
                'message' => __( 'Je hebt deze maand al een keer meegedaan!' )
            ], 422 );
        } elseif ( ! $check_participant ) {
            $check_invited_participant = Invited_Participants::where( 'email', $participant_friend_email )->first();
            if ( $check_invited_participant ) {
                return response()->json( [
                    'status'  => 'error',
                    'message' => __( 'Deze gebruiker is al een keer uitgenodigd!' )
                ], 422 );
            }
        }

        return true;
    }

    /*
     * Post function for the form on the homepage.
     */

    private function participant_exists_reversed( $participant_email, $participant_friend_email ) {
        $now           = Carbon::now();
        $current_month = $now->month;

        $check_participant = Invited_Participants::where( 'email', $participant_email )->whereMonth( 'created_at', '=', $current_month )->first();
        $check_invited     = Participants::where( 'p_email', $participant_friend_email )->whereMonth( 'created_at', '=', $current_month )->first();

        if ( $check_participant && $check_invited ) {
            $messageDanger = 'De volgende deelnemers bestaan al: ' . $check_invited->p_email . ', ' . $check_participant->email;

            return response()->json( [ 'status' => 'error', 'message' => $messageDanger ], 422 );
        } elseif ( $check_participant || $check_invited ) {
            if ( $check_invited ) {
                $messageDanger = 'De volgende deelnemer bestaat al: ' . $check_invited->p_email;
            } else {
                $messageDanger = 'De volgende deelnemer bestaat al: ' . $check_participant->email;
            }

            return response()->json( [ 'status' => 'error', 'message' => $messageDanger ], 422 );
        }

        return true;
    }

    public function confirmationParticipant( $id ) {
        $current_user = Participants::where( 'id', $id )->first();
        if ( $current_user ) {
            $current_user->verified = 1;
            $current_user->save();
            $message = 'Jouw deelname is succesvol bevestigd.';
        }

        return view( 'home.home' )->with( 'message', $message );
    }

    public function confirmationInvited( $id ) {
        $current_user = Invited_Participants::where( 'id', $id )->first();
        if ( $current_user ) {
            $current_user->verified = 1;
            $current_user->save();
            $message = 'Jouw deelname is succesvol bevestigd.';
        }

        return view( 'home.home' )->with( 'message', $message );
    }

}
