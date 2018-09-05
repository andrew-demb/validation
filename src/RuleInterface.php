<?php
/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */

namespace Spiral\Validation;

interface RuleInterface
{
    /**
     * Must return true if rule does expect to validate empty values.
     *
     * Example:
     * ["notEmpty", "email"] // fails on empty
     * ["email"]             // passed empty values
     *
     * @param mixed $value
     *
     * @return bool
     */
    public function ignoreEmpty($value): bool;

    /**
     * Conditions associated with the rule.
     *
     * @return ConditionInterface[]
     */
    public function getConditions(): array;

    /**
     * @param ValidatorInterface $v
     * @param string             $field
     * @param mixed              $value
     *
     * @return bool
     */
    public function validate(ValidatorInterface $v, string $field, $value): bool;

    /**
     * Get validation error message.
     *
     * @param string $field
     * @param mixed  $value
     *
     * @return string
     */
    public function getMessage(string $field, $value): string;
}