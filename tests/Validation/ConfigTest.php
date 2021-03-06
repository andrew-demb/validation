<?php

/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */

declare(strict_types=1);

namespace Spiral\Tests\Validation;

use PHPUnit\Framework\TestCase;
use Spiral\Core\Container\Autowire;
use Spiral\Validation\Config\ValidatorConfig;

class ConfigTest extends TestCase
{
    public function testHasChecker(): void
    {
        $config = new ValidatorConfig([
            'checkers' => [
                'checker' => self::class
            ]
        ]);

        $this->assertTrue($config->hasChecker('checker'));
        $this->assertFalse($config->hasChecker('other'));
    }

    public function testHasCondition(): void
    {
        $config = new ValidatorConfig([
            'conditions' => [
                'condition' => self::class
            ]
        ]);

        $this->assertTrue($config->hasCondition('condition'));
        $this->assertFalse($config->hasCondition('other'));
    }

    public function testGetChecker(): void
    {
        $config = new ValidatorConfig([
            'checkers' => [
                'checker' => self::class
            ]
        ]);

        $this->assertInstanceOf(Autowire::class, $config->getChecker('checker'));
    }

    public function testGetCondition(): void
    {
        $config = new ValidatorConfig([
            'conditions' => [
                'condition' => self::class
            ]
        ]);

        $this->assertInstanceOf(Autowire::class, $config->getCondition('condition'));
    }

    /**
     * @expectedException \Spiral\Validation\Exception\ValidationException
     */
    public function testGetCheckerException(): void
    {
        $config = new ValidatorConfig([
            'checkers' => [
                'checker' => self::class
            ]
        ]);

        $config->getChecker('other');
    }

    /**
     * @expectedException \Spiral\Validation\Exception\ValidationException
     */
    public function testGetConditionException(): void
    {
        $config = new ValidatorConfig([
            'conditions' => [
                'condition' => self::class
            ]
        ]);

        $config->getCondition('other');
    }

    public function testGetCheckerExtended(): void
    {
        $config = new ValidatorConfig([
            'checkers' => [
                'checker' => [
                    'class' => self::class
                ]
            ]
        ]);

        $this->assertInstanceOf(Autowire::class, $config->getChecker('checker'));
    }

    public function testGetConditionExtended(): void
    {
        $config = new ValidatorConfig([
            'conditions' => [
                'condition' => [
                    'class' => self::class
                ]
            ]
        ]);

        $this->assertInstanceOf(Autowire::class, $config->getCondition('condition'));
    }

    public function testGetCheckerExtendedWithOptions(): void
    {
        $config = new ValidatorConfig([
            'checkers' => [
                'checker' => [
                    'class'   => self::class,
                    'options' => []
                ]
            ]
        ]);

        $this->assertInstanceOf(Autowire::class, $config->getChecker('checker'));
    }

    public function testGetConditionWithOptions(): void
    {
        $config = new ValidatorConfig([
            'conditions' => [
                'condition' => [
                    'class'   => self::class,
                    'options' => []
                ]
            ]
        ]);

        $this->assertInstanceOf(Autowire::class, $config->getCondition('condition'));
    }

    /**
     * @expectedException \Spiral\Validation\Exception\ValidationException
     */
    public function testInvalid(): void
    {
        $config = new ValidatorConfig([
            'checkers' => [
                'checker' => []
            ]
        ]);

        $config->getChecker('checker');
    }

    /**
     * @expectedException \Spiral\Validation\Exception\ValidationException
     */
    public function testInvalidCondition(): void
    {
        $config = new ValidatorConfig([
            'conditions' => [
                'condition' => []
            ]
        ]);

        $config->getCondition('condition');
    }
}
