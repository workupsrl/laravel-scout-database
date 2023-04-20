<?php

declare(strict_types=1);

namespace Workup\Scout\Database\Stemmer;

/**
 * A stemmer using the Snowball algorithm for the French language.
 *
 * @package Workup\Scout\Database\Stemmer
 */
class FrenchStemmer extends SnowballStemmer
{
    public function __construct()
    {
        parent::__construct('french');
    }
}
