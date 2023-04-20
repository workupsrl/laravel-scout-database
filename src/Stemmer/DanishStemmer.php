<?php

declare(strict_types=1);

namespace Workup\Scout\Database\Stemmer;

/**
 * A stemmer using the Snowball algorithm for the Danish language.
 *
 * @package Workup\Scout\Database\Stemmer
 */
class DanishStemmer extends SnowballStemmer
{
    public function __construct()
    {
        parent::__construct('danish');
    }
}
