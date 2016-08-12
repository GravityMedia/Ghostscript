<?php
/**
 * This file is part of the Ghostscript package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\Ghostscript\Process;

/**
 * The argument class.
 *
 * @package GravityMedia\Ghostscript\Process
 */
class Argument
{
    /**
     * The name.
     *
     * @var string
     */
    protected $name;

    /**
     * The value.
     *
     * @var mixed
     */
    protected $value;

    /**
     * Create argument object.
     *
     * @param string $name
     * @param mixed  $value
     */
    public function __construct($name, $value = null)
    {
        $this->name = $name;
        $this->value = $value;
    }

    /**
     * Create argument object from string.
     *
     * @param string $argument
     *
     * @return $this
     */
    public static function fromString($argument)
    {
        $argument = explode('=', $argument, 2);
        $instance = new static(array_shift($argument));

        if (count($argument) > 0) {
            $instance->setValue(array_shift($argument));
        }

        return $instance;
    }

    /**
     * Return argument object as string.
     *
     * @return string
     */
    public function toString()
    {
        if (!$this->hasValue()) {
            return $this->getName();
        }

        return sprintf('%s=%s', $this->getName(), $this->getValue());
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Return whether the argument has a value.
     *
     * @return bool
     */
    public function hasValue()
    {
        return null !== $this->value;
    }

    /**
     * Get value.
     *
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set value.
     *
     * @param mixed $value
     *
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }
}
