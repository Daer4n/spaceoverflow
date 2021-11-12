<?php

namespace App\DataFixtures;

use App\Entity\Question;
use App\Factory\QuestionFactory;
use App\Factory\AnswerFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
		
		QuestionFactory::new()->createMany(20);
		AnswerFactory::new()->createMany(50, static function(){
			return ['question' => QuestionFactory::random()];
		});
		QuestionFactory::new()->unpublished()->createMany(5);
        $manager->flush();
    }
}