<?php

/*
 * This file is part of the Checkinn Platform package.
 *
 * (c) Checkinn <developer@checkinn.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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
        $this->loadFixtures([
            new LoadInitPlatformData(),
            new LoadUserData(),
        ]);

        $user = $this->findOneBy(User::class, ['email' => 'user@test.tld']);

        static::assertSame('user@test.tld', $user->getEmail());

        $test = new User();
        $test->setEmail('test@test.tld');
        $test->setPassword('test');
        $this->create($test);

        $test2 = $this->findOneBy(User::class, ['id' => $test->getId()]);
        static::assertSame($test->getEmail(), $test2->getEmail());
    }
}
