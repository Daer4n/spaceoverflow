<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AnswerController
{

	/**
	 * @Route("/comments/{id}/vote/{direction}")
	 */
	public function vote(int $id, string $direction)
	{
		//Simule un accès a la db et une incrementation ou decreamentation
		$currentVotes = rand(-100, 100);
		$content = [ 'votes', $currentVotes ];

		return new Response(json_encode($content));
	}
}
