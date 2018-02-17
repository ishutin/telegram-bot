<?php

namespace Test\Kernel;

use Exception;
use PHPUnit\Framework\TestCase;
use Telegram\Kernel\HandlerInterface;
use Telegram\Kernel\Kernel;
use Telegram\Kernel\Request;
use Telegram\Kernel\RequestInterface;

final class KernelTest extends TestCase
{
    public function testHandler(): void
    {
        $request = new Request('xxxx-xxxx-xxxx-xxxx');
        $kernel = new Kernel($request);

        $exampleHandler = $this->getExampleHandler();

        $kernel->attachHandler($exampleHandler);
        $kernel->detachHandler($exampleHandler);
        $kernel->run();

        $kernel->attachHandler($exampleHandler);

        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Handler is worked');

        $kernel->run();

        $kernel->detachHandler($exampleHandler);
    }

    private function getExampleHandler(): HandlerInterface
    {
        return new class implements HandlerInterface
        {
            /**
             * @param RequestInterface $request
             * @throws Exception
             */
            public function handle(RequestInterface $request): void
            {
                throw new Exception('Handler is worked');
            }
        };
    }
}