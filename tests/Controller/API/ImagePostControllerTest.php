<?php

namespace App\Tests;

use App\Test\Traits\AuthenticationTrait;
use Hautelook\AliceBundle\PhpUnit\ReloadDatabaseTrait;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Panther\Client;
use Symfony\Component\Panther\PantherTestCase;

/**
 * Class ImagePostControllerTest
 * @package App\Tests
 */
class ImagePostControllerTest extends PantherTestCase
{
    use ReloadDatabaseTrait;
    use AuthenticationTrait;

    public static function setUpBeforeClass(): void
    {
        self::$purgeWithTruncate = true;
    }

    public function testPostAndDeleteImage(): void
    {
        // Create new image
        $clientUser = $this->createAuthenticatedClient('thoma.vuille', 'p4ssWord');
        $imageFile = new UploadedFile('../../Resources/arbres-herons.jpg', 'photo-test.jpg', 'image/jpeg', 123);

        $clientUser->request('POST',
            '/api/images',
            ['fileName' => 'Fabien'],
            ['file' => $imageFile]
        );

        $this->assertResponseStatusCodeSame(200);
        $data = json_decode($clientUser->getResponse()->getContent(), true);
        var_dump($data);

        $fileId = $data['fileId'];

        // Remove file in imagekit
        $client = new \GuzzleHttp\Client();

        $container = self::$container;

        $response = $client->request(
            'DELETE',
            'https://api.imagekit.io/v1/files/' . $fileId,
            [
                'auth' => [$container->getParameter('imagekit_private_key'), '']
            ]
        );

        $this->assertEquals(204, $response->getStatusCode());
    }
}