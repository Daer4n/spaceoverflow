<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Answer;
use App\Entity\Question;
use App\Form\QuestionType;
use App\Service\MarkdownHelper;
use App\Service\MailerHelper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use DateTime;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Doctrine\ORM\EntityManager;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\Messenger\SendEmailMessage;
use Symfony\Flex\Path;

// use Twig\Environment;

class QuestionController extends AbstractController{

	/** 
	* @Route("/", name="app_question_home") 
	*/ 
	public function homepage ( EntityManagerInterface $entityManager ) : Response {
		$questions = $entityManager->getRepository(Question::class)->findByAskedOrderNewest();
		return $this->render('question/homepage.html.twig', ['questions' => $questions]);
	}

	/** 
	* @Route("/question/{slug}", name="app_question_show", priority=-1) 
	*/ 
	public function show($slug, Question $question, EntityManagerInterface $entityManager) : Response
	{
		// $question = $entityManager->getRepository(Question::class)->findOneBy(['slug' => $slug]);
		// if ($question === null) throw $this->createNotFoundException();
		return $this->render('question/show.html.twig', [ 'question' => $question ]);
	}

	/**
	* @Route("/question/new", name="app_question_new")
	*/
	public function new(Request $request, EntityManagerInterface $entityManager, MailerHelper $mailer) : Response
	{
		$form = $this->createForm(QuestionType::class);
		$form->handleRequest($request);
		
		if ($form->isSubmitted() && $form->isValid())
		{
			$question = $form->getData();
			
			$entityManager -> persist($question);
			$entityManager -> flush();

			$mailer->sendMail($question);

			return $this->redirectToRoute('app_question_show', ['slug' => $question->getSlug()]);
		}

		return $this->render('question/add.html.twig', ['form' => $form->createView()]);
	}

	/**
	* @Route("/question/edit/{slug}", name="app_question_edit")
	*/
	public function edit(Request $request, EntityManagerInterface $entityManager, Question $question) : Response
	{
		$form = $this->createForm(QuestionType::class, $question);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid())
		{
			$question = $form->getData();
			
			$entityManager -> persist($question);
			$entityManager -> flush();

			return $this->redirectToRoute('app_question_show', ['slug' => $question->getSlug()]);
		}

		return $this->render('question/add.html.twig', ['form' => $form->createView()]);
	}

	/**
	* @Route("/question/{slug}/vote", name="app_question_vote", methods={"POST"})
	*/
	public function vote(Question $question, Request $request, EntityManagerInterface $entityManager) : Response
	{
		$direction = $request->request->get('direction');

		if ($direction === 'up') {
			$question->upVote();
		}elseif ($direction === 'down'){
			$question->downVote();
		}

		$entityManager -> persist($question);
		$entityManager -> flush();

		return $this->redirectToRoute('app_question_show', ['slug' => $question->getSlug()]);
	}

}