<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Question;
use App\Service\MarkdownHelper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use DateTime;
use Doctrine\ORM\EntityManager;

// use App\DTO\Question;
// use App\DTO\Author;
// use Twig\Environment;

class QuestionController extends AbstractController{

	/** 
	* @Route("/", name="app_question_home") 
	*/ 
	public function homepage (/* Environment $twig */) : Response {

		// return new Response( $twig->render('question/homepage.html.twig') );
		return $this->render('question/homepage.html.twig');
	}

	/** 
	* @Route("/question/{slug}", name="app_question_show") 
	*/ 
	public function show($slug, MarkdownHelper $helper) : Response
	{
		$content = "Je suis tombé **sans faire exprès** dans un trou noir, pouvez vous m'indiquer comment sortir de là ?";

		$question = [
			'slug' => ucfirst(str_replace("-", " ", $slug)),
			'content' => $content
		];

		// $question = new Question( new Author('Alexis', 'Couturas'), $slug);

		return $this->render(
			'question/show.html.twig',
			[ 'question' => $question ]
		);
	}

	/**
	 * @Route("/question/new", name="app_question_new", priority=1)
	 */
	public function new(EntityManagerInterface $entityManager) : Response
	{
		$question = (new Question())
		->setTitle("Comment sortir d'un trou noir ?")
		->setSlug('sortir-d-un-trou-noir'.uniqid())
		->setContent("Je suis tombé sans faire exprès dans un trou noir, pouvez vous m'indiquer comment sortir de là ?")
		->setAskedAt(new \DateTime('1 hour ago'))
		;

		$entityManager -> persist($question);
		$entityManager -> flush();

		// dd($question);

		return new Response('<body><html>New Question '.$question->getId().'</html></body>');
	}
}
