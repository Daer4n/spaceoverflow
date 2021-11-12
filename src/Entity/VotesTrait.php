<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

trait VotesTrait
{
	/**
    * @ORM\Column(type="integer")
    */
    private int $votes = 0;
	
	public function getVotes(): ?int
    {
        return $this->votes;
    }

    public function setVotes(int $votes): self
    {
        $this->votes = $votes;

        return $this;
    }

	public function upVote(): self
	{
		$this->votes++;
		return $this;
	}

	public function downVote(): self
	{
		$this->votes--;
		return $this;
	}

	public function getVotesString()
	{
		$prefix = $this->votes > 0 ? '+' : ($this->votes < 0 ? '-' : '');
		return sprintf('%s %d', $prefix, abs($this->votes));
	}
}