<?php

declare(strict_types=1);

namespace Workup\Scout\Database\Contracts;

/**
 * Implementations of this interface are capable to strip individual words down to
 * their word stem. Word stemming allows to search for related words or words with
 * different spelling. The actual implementation may be (human) language agnostic.
 *
 * @package Workup\Scout\Database\Contracts
 */
interface Stemmer
{
    /**
     * Uses the given input word to calculate the stemmed variant of it.
     */
    public function stem(string $word): string;
}
