<?php

/**
 *
 * @author:  Eddie BARRACO <eddie.barraco@idci-consulting.fr>
 * @license: GPL
 *
 */

namespace Tms\Bundle\LikeBundle\Tests\Controller\Rest;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApiUrlLikeControllerTest extends WebTestCase
{
    public function testPostUrlLike()
    {
        $toPostSerializedUrlLike = array(
            'userId' => 'idci-dev',
            'url'    => 'http://idci-consulting.fr/',
        );

        $toPostSerializedUrlLikeWithError = array(
            'userId' => 'idci-dev',
            'url'    => 'idci-consulting.fr',
        );

        $client = static::createClient();

        $crawler = $client->request('POST', '/api/urllikes', $toPostSerializedUrlLike);
        $this->assertTrue($client->getResponse()->isSuccessful());

        $response = json_decode($client->getResponse()->getContent(), true);
        $createdUrlLikeId = $response['data']['id'];

        $crawler = $client->request('POST', '/api/urllikes', $toPostSerializedUrlLike);
        $this->assertTrue($client->getResponse()->getStatusCode() === 409);

        $crawler = $client->request('POST', '/api/urllikes', $toPostSerializedUrlLikeWithError);
        $this->assertTrue($client->getResponse()->getStatusCode() === 400);

        return $createdUrlLikeId;
    }

    /**
     * @depends testPostUrlLike
     */
    public function testGetUrlLike($postedUrlLikeId)
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/api/urllikes');
        $this->assertTrue($client->getResponse()->isSuccessful());

        $crawler = $client->request('GET', '/api/urllikes?userId=idci-dev&userEmail=contact@idci-consulting.fr&userNickname=contact&url=http://idci-consulting.fr/&content=C\'est le meilleur site de l\'univer !');
        $response = json_decode($client->getResponse()->getContent(), true);
        $this->assertTrue($response['metadata']['totalCount'] !== 0);

        return $postedUrlLikeId;
    }

    /**
     * @depends testGetUrlLike
     */
    public function testGetUrlLikes($postedUrlLikeId)
    {
        $client = static::createClient();

        $crawler = $client->request('GET', sprintf('/api/urllikes/%s', $postedUrlLikeId));
        $this->assertTrue($client->getResponse()->isSuccessful());

        $crawler = $client->request('GET', sprintf('/api/urllikes/%s', $postedUrlLikeId+1));
        $this->assertTrue($client->getResponse()->isNotFound());

        return $postedUrlLikeId;
    }

    /**
     * @depends testGetUrlLike
     */
    public function testDeleteUrlLike($postedUrlLikeId)
    {
        $client = static::createClient();

        $crawler = $client->request('DELETE', sprintf('/api/urllikes/%s', $postedUrlLikeId));
        $this->assertTrue($client->getResponse()->isSuccessful());

        $crawler = $client->request('DELETE', sprintf('/api/urllikes/%s', $postedUrlLikeId));
        $this->assertTrue($client->getResponse()->isNotFound());
    }
}
