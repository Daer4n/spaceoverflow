<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Question;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;

final class MailerHelper extends TemplatedEmail
{
	private MailerInterface $mailer;

	public function __construct(MailerInterface $mailer){
		$this->mailer = $mailer;
	}

	public function sendMail(Question $question): void
	{
		$email = (new TemplatedEmail())
		->from('spaceoverflow@gmail.com')
		->to('you@example.com')
		->subject('Confirmation d\'envoi de votre nouvelle question')
		->htmlTemplate('email.html.twig')
		->context(['question' => $question]);

		$this->mailer->send($email);
	}
}