<?php

declare(strict_types=1);

namespace Workup\Scout\Database\Stemmer;

/**
 * A stemmer using the Snowball algorithm for the English language.
 * This stemmer is also known as the Porter 2 stemmer.
 *
 * @package Workup\Scout\Database\Stemmer
 */
class EnglishStemmer extends SnowballStemmer
{
    public function __construct()
    {
        parent::__construct('english');
    }
}
