<?php

declare(strict_types=1);

namespace App\Form;

use App\Entity\Question;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

Class QuestionType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options): void
	{
		$builder
			->add('title', TextType::class)
			->add('content', TextareaType::class, [
				'label' => 'Détail de votre question',
			])
			->add('askedAt', DateTimeType::class, [
				'widget' => 'single_text',
			])
			->add('gender', ChoiceType::class, [
				'mapped' => false,
				'choices' => [
					'Male' => 'male',
					'Female' => 'female',
					'Not your business' => 'other',
				]
			])
		;
	}

	public function configureOptions(OptionsResolver $resolver) {
		$resolver->setDefaults([
			'method' => 'post',
			'data_class' => Question::class,
		]);
	}
}