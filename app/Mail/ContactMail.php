<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
	use Queueable, SerializesModels;

	/**
	 * Create a new message instance.
	 *
	 * @return void
	 */
	public function __construct($contact)
	{
		$this->contact = $contact;
	}

	/**
	 * Build the message.
	 *
	 * @return $this
	 */
	public function build()
	{
		return $this
			->from(env('MAIL_FROM_ADDRESS'), mb_encode_mimeheader(env('MAIL_FROM_NAME')))
			->subject('クーポン引き換え用URL送付')
			->view('contact.mail')
			->with(['contact' => $this->contact]);
	}
}
