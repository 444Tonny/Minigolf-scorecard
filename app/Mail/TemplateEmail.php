<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TemplateEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $names;
    public $scores;
    public $date;

    /**
     * Create a new message instance.
     *
     * @param  string  $names
     * @param  string  $scores
     * @param  string  $date
     * @return void
     */
    public function __construct($names, $scores, $date)
    {
        $this->names = $names;
        $this->scores = $scores;
        $this->date = $date;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('thanks@thedugoutminigolf.com')
            ->subject('The Dugout - Your game results')
            ->view('emails.template')
            ->with([
                'names' => $this->names,
                'scores' => $this->scores,
                'date' => $this->date,
        ]);
    }
}