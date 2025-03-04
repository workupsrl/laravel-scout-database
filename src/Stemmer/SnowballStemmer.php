<?php

declare(strict_types=1);

namespace Workup\Scout\Database\Stemmer;

use Workup\Scout\Database\Contracts\Stemmer;
use Wamania\Snowball\NotFoundException;
use Wamania\Snowball\StemmerFactory;

/**
 * A base stemmer supporting any language of the Snowball algorithm.
 *
 * @package Workup\Scout\Database\Stemmer
 */
abstract class SnowballStemmer implements Stemmer
{
    private \Wamania\Snowball\Stemmer\Stemmer $stemmer;

    /**
     * SnowballStemmer constructor.
     *
     * @throws NotFoundException
     */
    public function __construct(string $language)
    {
        $this->stemmer = StemmerFactory::create($language);
    }

    /**
     * Uses the given input word to calculate the stemmed variant of it.
     *
     * @throws \Exception
     */
    public function stem(string $word): string
    {
        return $this->stemmer->stem($word);
    }
}
