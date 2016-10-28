<?php

namespace Application\Service;

use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;


class CommandServiceFactory implements FactoryInterface
{
    /**
     * Create an object
     *
     * @param  ContainerInterface $container
     * @param  string             $requestedName
     * @param  null|array         $options
     *
     * @return object
     * @throws ServiceNotFoundException if unable to resolve the service.
     * @throws ServiceNotCreatedException if an exception is raised when
     *     creating a service.
     * @throws ContainerException if any other error occurs
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = NULL)
    {
        $inputFilterManager = $container->get('InputFilterManager');

        $config         = $container->get('Config');
        $inputFilterMap = isset($config['tactician']['inputfilter-map']) ? $config['tactician']['inputfilter-map'] : [];

        $service = new CommandService();
        $service->setInputFilterManager($inputFilterManager);
        $service->setInputFilterMap($inputFilterMap);

        return $service;
    }
}