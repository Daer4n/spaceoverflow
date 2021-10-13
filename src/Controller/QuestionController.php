<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuestionController extends AbstractController{
	
	/** 
		* @Route("/", name="app_question_home") 
	*/ 
	public function homepage () {
		return $this->render('base.html.twig');
	}

	/** 
	* @Route("/questions/{slug}", name="app_question_show") 
	*/ 
	public function show(string $slug) : Response
	{
		$slug = ucfirst(str_replace("-", " ", $slug));
		return $this->render( 'questions/show.html.twig', ['slug' => $slug] );
	}
}