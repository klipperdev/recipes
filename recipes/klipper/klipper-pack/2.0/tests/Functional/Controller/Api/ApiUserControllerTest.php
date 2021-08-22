<?php

namespace App\Tests\Functional\Controller\Api;

use App\Tests\DataFixtures\UserFixtures;
use Klipper\Bundle\FunctionalTestBundle\Test\Browser\ContentMessage;
use Klipper\Bundle\FunctionalTestBundle\Test\DataFixtures\Data\PlatformInitFixtures;
use Klipper\Bundle\FunctionalTestBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @internal
 *
 * @group api-user
 */
final class ApiUserControllerTest extends WebTestCase
{
    public function testGetCurrentUser(): void
    {
        $client = static::createClient();

        static::loadFixtures([
            new PlatformInitFixtures(),
            new UserFixtures(),
        ]);

        $client->loginUser(static::getDefaultUser());

        $content = static::requestJson(
            $client,
            Response::HTTP_OK,
            Request::METHOD_GET,
            static::getUrl('klipper_apiuser_user_viewuser')
        );

        static::assertContentEquals(
            ContentMessage::create()
                ->addField('id')
                ->addField('organization_id')
                ->addField('username')
                ->addField('email')
                ->addField('roles')
                ->addField('initial')
                ->addField('created_at')
                ->addField('updated_at'),
            $content
        );
    }
}
