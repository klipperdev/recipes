<?php

namespace App\Tests\Functional\Model;

use App\Entity\User;
use App\Tests\DataFixtures\UserFixtures;
use Klipper\Bundle\FunctionalTestBundle\Test\DataFixtures\Data\PlatformInitFixtures;
use Klipper\Bundle\FunctionalTestBundle\Test\WebTestCase;

/**
 * Model user tests.
 *
 * @internal
 *
 * @group module-platform
 */
final class UserTest extends WebTestCase
{
    public function testUserEmail(): void
    {
        static::loadFixtures([
            new PlatformInitFixtures(),
            new UserFixtures(),
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

    public function testOrganizationContextOfPlatformAdminUser(): void
    {
        static::loadFixtures([
            new PlatformInitFixtures(),
            new UserFixtures(),
        ]);

        static::injectUserByIdentifier('admin');
        static::injectOrganisation('org-admin');

        $org = static::getOrganizationalContext()->getCurrentOrganization();

        static::assertNotNull($org);
        static::assertSame('org-admin', $org->getName());
    }
}
