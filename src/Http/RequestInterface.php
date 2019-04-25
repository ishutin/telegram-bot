<?php

namespace Telegram\Http;

use GuzzleHttp\ClientInterface;
use Psr\Http\Message\ResponseInterface;
use Telegram\Entity\Factory\EntityFactoryInterface;
use Telegram\Http\Exception\MissingEntityFactory;

interface RequestInterface extends RequestMethodsInterface
{
    public function getClient(): ClientInterface;

    /**
     * @return EntityFactoryInterface
     * @throws MissingEntityFactory
     */
    public function getEntityFactory(): EntityFactoryInterface;

    public function setEntityFactory(EntityFactoryInterface $entityFactory): RequestInterface;

    public function getResponseData(ResponseInterface $response):? array;
}
