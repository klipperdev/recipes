<?php

namespace App\Tests\Fixtures\Entity;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Klipper\Bundle\FunctionalTestBundle\Test\DefaultAuthenticationInterface;
use Klipper\Bundle\FunctionalTestBundle\Test\DefaultAuthenticationTrait;
use Doctrine\Common\DataFixtures\FixtureInterface;

/**
 * Fixtures for user.
 */
class LoadUserData implements FixtureInterface, DefaultAuthenticationInterface
{
    use DefaultAuthenticationTrait;

    public function load(ObjectManager $manager): void
    {
        $this->flush($manager, [
            $this->addUser('admin.test', 'admin@test.tld'),
            $this->addUser($this->defaultUsername, 'user@test.tld'),
            $this->addUser('user.test.alone', 'user.alone@test.tld'),
        ]);
    }

    /**
     * @param User[] $users
     */
    protected function flush(ObjectManager $manager, array $users): void
    {
        foreach ($users as $user) {
            $manager->persist($user);
        }

        $manager->flush();
    }

    protected function addUser(string $username, string $email, array $roles = [])
    {
        $user = new User();
        $user->setUsername($username);
        $user->setEmail($email);
        $user->setPassword($this->defaultPassword);
        $user->setRoles($roles);

        return $user;
    }
}
