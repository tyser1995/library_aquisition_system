<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use App\Models\ItinerarySendMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ItineraryMail extends Mailable
{
    use Queueable, SerializesModels;

    public $itinerary_send_mail;
    public $user_all;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( $itinerary_send_mail, $user_all)
    {   

        $this->itinerary_send_mail =  $itinerary_send_mail;
        $this->user_all = $user_all;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(Request $request)
    {
        $user_all = Auth::user();
        $user_sender =  $user_all->name;

        // $ItinerarySendMail = ItinerarySendMail::find($request->client_info);
        // $itinerary_send_mail->client_email = ($request->input('share_btn_client_email'));
        // $itinerary_send_mail->agent_email = ($request->input('share_btn_agent_email'));

        return $this->subject('Shared a custom travel proposal with you')
                   ->from('no-reply@wayfairertravel', $user_sender)
                    ->markdown('emails.emails');
    }
}
