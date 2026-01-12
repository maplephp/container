<?php

declare(strict_types=1);

namespace MaplePHP\Container;

use MaplePHP\Container\Interfaces\AutowireInterface;

class Autowire implements AutowireInterface
{
    private Reflection $reflect;
    /**
     * @var mixed|object|null
     */
    private mixed $class = null;
    private bool $disableDI = false;

    /**
     * @param string $class
     * @throws \ReflectionException
     */
    public function __construct(string $class)
    {
        if (is_string($class) && class_exists($class)) {
            $this->reflect = new Reflection($class);
        } else {
            throw new \InvalidArgumentException("The class {$class} does not exist.");
        }
    }

    /**
     * Disable the dependency injector
     *
     * Note: This method MUST be implemented in such a way as to retain the immutability
     *
     * @return $this
     */
    public function disableDI(): self
    {
        $inst = clone $this;
        $inst->disableDI = true;
        return $inst;
    }

    /**
     * Pass custom arguments to the class constructor
     *
     * Note: This method MUST be implemented in such a way as to retain the immutability
     * NOTE: This will disable the dependency injector
     *
     * @param array $args
     * @return $this
     */
    public function addArgs(array $args): self
    {
        if (count($args) <= 0) {
            throw new \InvalidArgumentException("You must provide at least one argument.");
        }
        $inst = $this->disableDI();
        $inst->reflect->setArgs($args);
        return $inst;
    }

    /**
     * Run the class with all dependencies.
     *
     * @return mixed
     * @throws \ReflectionException
     */
    public function run(): mixed
    {
        if (is_null($this->class)) {
            $this->class = ($this->disableDI) ? $this->reflect->get() : $this->reflect->dependencyInjector();
        }
        return $this->class;
    }
}
