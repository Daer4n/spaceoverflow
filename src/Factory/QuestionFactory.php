<?php

namespace App\Factory;

use App\Entity\Question;
use App\Repository\QuestionRepository;
use Symfony\Component\String\Slugger\AsciiSlugger;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<Question>
 *
 * @method static Question|Proxy createOne(array $attributes = [])
 * @method static Question[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Question|Proxy find(object|array|mixed $criteria)
 * @method static Question|Proxy findOrCreate(array $attributes)
 * @method static Question|Proxy first(string $sortedField = 'id')
 * @method static Question|Proxy last(string $sortedField = 'id')
 * @method static Question|Proxy random(array $attributes = [])
 * @method static Question|Proxy randomOrCreate(array $attributes = [])
 * @method static Question[]|Proxy[] all()
 * @method static Question[]|Proxy[] findBy(array $attributes)
 * @method static Question[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Question[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static QuestionRepository|RepositoryProxy repository()
 * @method Question|Proxy create(array|callable $attributes = [])
 */
final class QuestionFactory extends ModelFactory
{

    protected function getDefaults(): array
    {
        return [
			'title' => self::faker()->realText(50),
			'content' => self::faker()->paragraph(self::faker()->numberBetween(1,6)),
			'askedAt' => self::faker()->DateTimeBetween('-3 years', '-1 minute'),
			'votes' => self::faker()->numberBetween(-20, 50),
        ];
    }

	// protected function initialize(): self
	// {
	//     return $this
	//         ->afterInstantiate(function(Question $question) {
	// 			$slugger = new AsciiSlugger();
	// 			$question->setSlug($slugger->slug($question->getTitle()));
	// 		})
	//     ;
	// }

	public function unpublished(): self
	{
		return $this->addState(['askedAt' => null]);
	}

    protected static function getClass(): string
    {
        return Question::class;
    }
}
