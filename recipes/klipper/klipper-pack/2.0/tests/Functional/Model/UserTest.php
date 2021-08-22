<?php

namespace App\Tests\Functional\Model;

use App\Entity\User;
use App\Tests\Fixtures\Entity\LoadUserData;
use Klipper\Bundle\FunctionalTestBundle\Test\Fixtures\Init\LoadInitPlatformData;
use Klipper\Bundle\FunctionalTestBundle\Test\WebTestCase;

/**
 * Model user tests.
 *
 * @internal
 */
final class UserTest extends WebTestCase
{
    public function testUserEmail(): void
    {
        static::loadFixtures([
            new LoadInitPlatformData(),
            new LoadUserData(),
        ]);

        $user = static::findOneBy(User::class, ['email' => 'user@test.tld']);

        static::assertSame('user@test.tld', $user->getEmail());

        $test = new User();
        $test->setEmail('test@test.tld');
        $test->setPassword('test');
        static::create($test);

        $test2 = static::findOneBy(User::class, ['id' => $test->getId()]);
        static::assertSame($test->getEmail(), $test2->getEmail());
    }
}
