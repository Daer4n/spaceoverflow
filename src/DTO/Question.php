<?php

declare(strict_types=1);

namespace App\DTO;

class Question {

	private Author $author;
	public string $slug;

	public function getAuthor() : Author
	{
		return $this->author;
	}

	public function getSlug() : string
	{
		return $this->slug;
	}

	public function __construct(Author $author, string $slug) {
		$this->author = $author;
		
		$this->slug = ucfirst(str_replace("-", " ", $slug));
	}
}