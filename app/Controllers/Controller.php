<?php

namespace App\Controllers;

use Psr\Container\ContainerInterface;

abstract class Controller
{
    /**
     * The container instance.
     *
     * @var ContainerInterface
     */
    protected $c;

    /**
     * Set up controllers to have access to the container.
     *
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->c = $container;
    }
}
