<?php

namespace Test\Kernel;

use Exception;
use PHPUnit\Framework\TestCase;
use Telegram\Kernel\HandlerInterface;
use Telegram\Kernel\Kernel;

final class HandlerTest extends TestCase
{
    public function testHandler(): void
    {
        $handler = $this->getExampleHandler();

        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Handler is worked');

        $handler->handle();
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