<?php

namespace App\Mail;

use App\Event;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TeamScores extends Mailable
{
    use Queueable, SerializesModels;

    public $event;
    public $teamResult;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Event $event, $teamResult)
    {
        $this->event = $event;
        $this->teamResult = $teamResult;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.teamScores')->subject("Results from ".$this->event->name);
    }
}
