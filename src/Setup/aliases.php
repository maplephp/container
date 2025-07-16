<?php
if (!interface_exists(\MaplePHP\Container\Interfaces\ContainerInterface::class)) {
    class_alias(
        \Psr\Container\ContainerInterface::class,
        \MaplePHP\Container\Interfaces\ContainerInterface::class
    );
}