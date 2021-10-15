<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\DTO\Question;
use App\DTO\Author;
use Twig\Environment;

class QuestionController extends AbstractController{

	/** 
	* @Route("/", name="app_question_home") 
	*/ 
	public function homepage (/* Environment $twig */) {

		// return new Response( $twig->render('question/homepage.html.twig') );
		return $this->render('question/homepage.html.twig');
	}

	/** 
	* @Route("/question/{slug}", name="app_question_show") 
	*/ 
	public function show($slug) : Response
	{
		// $slug = ucfirst(str_replace("-", " ", $slug));
		// return $this->render( 'question/show.html.twig', [
		// 	'question' => [
		// 		'slug' => $slug
		// 	]
		// ]);
		$test = new Question( new Author('Alexis', 'Couturas'), $slug);


		return $this->render(
			'question/show.html.twig'
		);
	}
}
