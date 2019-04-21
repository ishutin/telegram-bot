<?php

namespace Test\Kernel;

use PHPUnit\Framework\TestCase;
use RuntimeException;
use Telegram\Kernel\HandlerInterface;

final class HandlerTest extends TestCase
{
    public function testHandler(): void
    {
        $handler = $this->getExampleHandler();

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Handler is worked');

        $handler->handle();
    }

    private function getExampleHandler(): HandlerInterface
    {
        return new class implements HandlerInterface
        {
            /**
             * @throws RuntimeException
             */
            public function handle(): void
            {
                throw new RuntimeException('Handler is worked');
            }
        };
    }
}
