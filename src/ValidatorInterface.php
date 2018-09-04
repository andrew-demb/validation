<?php
/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */

namespace Spiral\Validation;


use Spiral\Validation\Exceptions\ValidationException;

/**
 * Singular validation state (with data, context and rules encapsulated).
 */
interface ValidatorInterface
{
    /**
     * Receive field from context data or return default value.
     *
     * @param string $field
     * @param mixed  $default
     *
     * @return mixed
     */
    public function getValue(string $field, $default = null);

    /**
     * Get context data (not validated).
     *
     * @return mixed
     */
    public function getContext();

    /**
     * Check if context data valid accordingly to provided rules.
     *
     * @return bool
     *
     * @throws ValidationException
     */
    public function isValid(): bool;

    /**
     * Register outer validation error. Registered error persists until context data are changed
     * or flushRegistered method not called.
     *
     * @param string $field
     * @param string $error
     *
     * @return ValidatorInterface
     */
    public function registerError(string $field, string $error): ValidatorInterface;

    /**
     * List of errors associated with parent field, every field should have only one error assigned.
     *
     * @return array
     *
     * @throws ValidationException
     */
    public function getErrors(): array;

    /**
     * Reset validation state including registered errors.
     */
    public function resetState();
}