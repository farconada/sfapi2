<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 01/03/14
 * Time: 10:16
 */

namespace Fer\ApiBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Fer\ApiBundle\Entity\Item;

class LoadUserData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {

        $loader = new \Nelmio\Alice\Loader\Yaml();
        $objects = $loader->load(__DIR__.'/fixtures.yml');
        $persister = new \Nelmio\Alice\ORM\Doctrine($manager);
        $persister->persist($objects);

    }
}