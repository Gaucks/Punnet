<?php

namespace Punnet\SiteBundle\DataFixtures\ORM\User;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

use Punnet\UserBundle\Entity\User;

class LoadUserData extends AbstractFixture implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface {

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null) {
        $this->container = $container;
    }

    public function load(ObjectManager $manager) {

        $userManager = $this->container->get('fos_user.user_manager');

        // Create a new user
        $user = $userManager->createUser();
        $user->setUsername('John');
        $user->setEmail('john@do.com');
        $user->setPlainPassword('0000');
        $user->setRegion($this->getReference('region-pa'));
        $user->setDepartement($this->getReference('departement-var'));
        $user->setVille($this->getReference('ville-vin'));
        $user->setEnabled(true);

        $manager->persist($user);
        $manager->flush();
        
        $this->addReference('user-1', $user);
     }
     
     public function getOrder()
	{
		return 4; 
	} 
}