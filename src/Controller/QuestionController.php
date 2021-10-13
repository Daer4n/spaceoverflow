<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuestionController {
	/** 
		* @Route("/", name="app_question_home") 
	*/ 
	public function homepage () {
		return new Response("<h1>Hello World</h1>");
	}

	/** 
	* @Route("/questions/{slug}", name="app_question_show") 
	*/ 
	public function show(string $slug)
	{
		$slug = ucfirst(str_replace("-", " ", $slug));
		return new Response("<h1>$slug ?</h1>");
	}
}