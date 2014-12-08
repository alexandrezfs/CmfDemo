<?php

// src/Acme/DemoBundle/DataFixtures/PHPCR/LoadRoutingData.php
namespace Acme\DemoBundle\DataFixtures\PHPCR;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;

use Symfony\Cmf\Bundle\RoutingBundle\Doctrine\Phpcr\Route;

class LoadRoutingData implements FixtureInterface
{
    public function load(ObjectManager $documentManager)
    {
        $routesRoot = $documentManager->find(null, '/cms/routes');

        $route = new Route();
        // set $routesBase as the parent and 'new-route' as the node name,
        // this is equal to:
        // $route->setName('new-route');
        // $route->setParentDocument($routesRoot);
        $route->setPosition($routesRoot, 'new-route');

        $page = $documentManager->find(null, '/cms/simple/quick_tour');
        $route->setContent($page);

        $documentManager->persist($route); // put $route in the queue
        $documentManager->flush(); // save it
    }
}