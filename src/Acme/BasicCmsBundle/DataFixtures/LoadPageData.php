<?php

namespace Acme\BasicCmsBundle\DataFixtures\PHPCR;

use Acme\BasicCmsBundle\Document\Page;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ODM\PHPCR\DocumentManager;

class LoadPageData implements FixtureInterface
{
    public function load(ObjectManager $dm)
    {
        $parent = $dm->find(null, '/cms/pages');

        $page = new Page();
        $page->setTitle('Home');
        $page->setParentDocument($parent);
        $page->setContent("Welcome to the homepage of this really basic CMS.");

        $dm->persist($page);
        $dm->flush();
    }
}