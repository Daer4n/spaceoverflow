<?php

declare(strict_types=1);

namespace App\DTO;

class Author {

	private string $firstname;
	private string $lastname;

	public function getFirstname() {
		return $this->firstname;
	}

	public function getLastname() {
		return $this->lastname;
	}

	public function __construct(string $first, string $last) {
		$this->firstname = $first;
		$this->lastname = $last;
	}

}