<?php

declare(strict_types=1);

namespace Workup\Scout\Database\Stemmer;

/**
 * A stemmer using the Snowball algorithm for the Romanian language.
 *
 * @package Workup\Scout\Database\Stemmer
 */
class RomanianStemmer extends SnowballStemmer
{
    public function __construct()
    {
        parent::__construct('romanian');
    }
}
