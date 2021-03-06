<?php

/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */

declare(strict_types=1);

namespace Spiral\Tests\Validation;

use Spiral\Validation\Condition\WithAllCondition;
use Spiral\Validation\Condition\WithAnyCondition;
use Spiral\Validation\Condition\WithoutAllCondition;
use Spiral\Validation\Condition\WithoutAnyCondition;

class AliasedConditionsTest extends BaseTest
{
    public const CONFIG = [
        'checkers'   => [],
        'conditions' => [],
        'aliases'    => [
            'withAny'    => WithAnyCondition::class,
            'withoutAny' => WithoutAnyCondition::class,
            'withAll'    => WithAllCondition::class,
            'withoutAll' => WithoutAllCondition::class,
        ],
    ];

    public function testWithAny(): void
    {
        $this->assertValid(
            ['i' => 'a',],
            ['i' => [['is_bool', 'if' => ['withAny' => ['b', 'c']]]]]
        );

        $this->assertNotValid(
            'i',
            ['i' => 'a', 'b' => 'b'],
            ['i' => [['is_bool', 'if' => ['withAny' => ['b', 'c']]]]]
        );

        $this->assertNotValid(
            'i',
            ['i' => 'a', 'b' => 'b', 'c' => 'c'],
            ['i' => [['is_bool', 'if' => ['withAny' => ['b', 'c']]]]]
        );
    }

    public function testWithAll(): void
    {
        $this->assertValid(
            ['i' => 'a',],
            ['i' => [['is_bool', 'if' => ['withAll' => ['b', 'c']]]]]
        );

        $this->assertValid(
            ['i' => 'a', 'b' => 'b'],
            ['i' => [['is_bool', 'if' => ['withAll' => ['b', 'c']]]]]
        );

        $this->assertNotValid(
            'i',
            ['i' => 'a', 'b' => 'b', 'c' => 'c'],
            ['i' => [['is_bool', 'if' => ['withAll' => ['b', 'c']]]]]
        );
    }

    public function testWithoutAny(): void
    {
        $this->assertNotValid(
            'i',
            ['i' => 'a',],
            ['i' => [['is_bool', 'if' => ['withoutAny' => ['b', 'c']]]]]
        );

        $this->assertNotValid(
            'i',
            ['i' => 'a', 'b' => 'b'],
            ['i' => [['is_bool', 'if' => ['withoutAny' => ['b', 'c']]]]]
        );

        $this->assertValid(
            ['i' => 'a', 'b' => 'b', 'c' => 'c'],
            ['i' => [['is_bool', 'if' => ['withoutAny' => ['b', 'c']]]]]
        );
    }

    public function testWithoutAll(): void
    {
        $this->assertNotValid(
            'i',
            ['i' => 'a',],
            ['i' => [['is_bool', 'if' => ['withoutAll' => ['b', 'c']]]]]
        );

        $this->assertValid(
            ['i' => 'a', 'b' => 'b'],
            ['i' => [['is_bool', 'if' => ['withoutAll' => ['b', 'c']]]]]
        );

        $this->assertValid(
            ['i' => 'a', 'b' => 'b', 'c' => 'c'],
            ['i' => [['is_bool', 'if' => ['withoutAll' => ['b', 'c']]]]]
        );
    }
}
