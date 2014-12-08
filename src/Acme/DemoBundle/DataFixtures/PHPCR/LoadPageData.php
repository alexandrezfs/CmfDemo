<?php

namespace Acme\MainBundle\DataFixtures\PHPCR;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Cmf\Bundle\SimpleCmsBundle\Doctrine\Phpcr\Page;
use Symfony\Cmf\Bundle\RoutingBundle\Doctrine\Phpcr\Route;

class LoadPageData implements FixtureInterface, OrderedFixtureInterface
{
    public function getOrder()
    {
        // refers to the order in which the class' load function is called
        // (lower return values are called first)
        return 10;
    }

    public function load(ObjectManager $documentManager)
    {
        $page = new Page(); // create a new Page object (document)
        $page->setName('new_page'); // the name of the node
        $page->setLabel('Another new Page');
        $page->setTitle('Another new Page');
        $page->setBody('I have added this page myself!');

        // get root document (/cms/simple)
        $simpleCmsRoot = $documentManager->find(null, '/cms/simple');

        $page->setParentDocument($simpleCmsRoot); // set the parent to the root

        $documentManager->persist($page); // add the Page in the queue
        $documentManager->flush(); // add the Page to PHPCR

    }
}