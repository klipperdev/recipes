<?php

namespace App\Tests\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Klipper\Bundle\FunctionalTestBundle\Test\DataFixtures\FixtureDefaultAuthenticationInterface;
use Klipper\Bundle\FunctionalTestBundle\Test\DataFixtures\FixtureDefaultAuthenticationTrait;

/**
 * Fixtures for user.
 */
class UserFixtures extends Fixture implements FixtureDefaultAuthenticationInterface
{
    use FixtureDefaultAuthenticationTrait;

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

    protected function addUser(string $username, string $email, array $roles = []): User
    {
        $user = new User();
        $user->setUsername($username);
        $user->setEmail($email);
        $user->setPassword($this->defaultPassword);
        $user->setRoles($roles);

        return $user;
    }
}
