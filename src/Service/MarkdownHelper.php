<?php

declare(strict_types=1);

namespace App\Service;

use Knp\Bundle\MarkdownBundle\MarkdownParserInterface;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

final class MarkdownHelper
{
	private MarkdownParserInterface $markdown;
	private CacheInterface $cache;

	public function __construct(MarkdownParserInterface $markdown, CacheInterface $cache){
		$this->markdown = $markdown;
		$this->cache = $cache;
	}

	public function parse(string $source): string
	{

		$source = $this->cache->get(md5($source), function(ItemInterface $item) use ($source){
			// sleep(2);
			$item->expiresAfter(20);
			return $this->markdown->transformMarkdown($source);
		});

		return $source;
	}
}