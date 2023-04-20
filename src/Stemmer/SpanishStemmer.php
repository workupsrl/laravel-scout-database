<?php

declare(strict_types=1);

namespace Workup\Scout\Database\Stemmer;

/**
 * A stemmer using the Snowball algorithm for the Spanish language.
 *
 * @package Workup\Scout\Database\Stemmer
 */
class SpanishStemmer extends SnowballStemmer
{
    public function __construct()
    {
        parent::__construct('spanish');
    }
}
