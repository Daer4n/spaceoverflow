<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AnswerController extends AbstractController
{

	/**
	 * @Route("/answers/{id}/vote/{direction<up|down>}", name="app_answers_vote", methods={"POST"})
	 */
	public function vote(int $id, string $direction)
	{
		//Simule un accès a la db et une incrementation ou decrementation
		if ( $direction === "up" ) {
			$currentVotes = "+".rand(1, 10);
		}else{
			$currentVotes = rand(0, -10);
		}

		return $this->json(["votes" => $currentVotes]);
	}
}
