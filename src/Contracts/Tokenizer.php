<?php

declare(strict_types=1);

namespace Workup\Scout\Database\Contracts;

/**
 * Implementations of this interface are capable of splitting search strings into tokens.
 *
 * @package Workup\Scout\Database\Contracts
 */
interface Tokenizer
{
    /**
     * Splits the given string into tokens. The way the input string is split into tokens
     * depends on the actual implementation.
     *
     * @return string[]
     */
    public function tokenize(string $input): array;
}
