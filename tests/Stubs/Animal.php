<?php

declare(strict_types=1);

namespace Workup\Scout\Database\Tests\Stubs;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

/**
 * An animal stub for tests.
 *
 * @package Workup\Scout\Database\Tests\Stubs
 */
class Animal extends Model
{
    use Searchable;

    protected $guarded = [];

    public function searchableAs()
    {
        return 'animal';
    }
}
