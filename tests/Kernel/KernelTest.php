<?php

namespace Test\Kernel;

use Exception;
use PHPUnit\Framework\TestCase;
use Telegram\Kernel\HandlerInterface;
use Telegram\Kernel\Kernel;

final class KernelTest extends TestCase
{
    public function testHandler(): void
    {
        $kernel = new Kernel();

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
            public function handle(): void
            {
                throw new Exception('Handler is worked');
            }
        };
    }
}