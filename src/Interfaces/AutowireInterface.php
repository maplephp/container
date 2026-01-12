<?php

namespace MaplePHP\Container\Interfaces;

interface AutowireInterface
{
    /**
     * Disable the dependency injector
     *
     * Note: This method MUST be implemented in such a way as to retain the immutability
     *
     * @return $this
     */
    public function disableDI(): self;

    /**
     * Pass custom arguments to the class constructor
     *
     * Note: This method MUST be implemented in such a way as to retain the immutability
     * Note: This will disable the dependency injector
     *
     * @param array $args
     * @return $this
     */
    public function addArgs(array $args): self;

    /**
     * Run the class with all dependencies.
     *
     * @return mixed
     * @throws \ReflectionException
     */
    public function run(): mixed;
}
