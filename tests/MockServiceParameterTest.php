<?php

use Pact\Pact;

class MockServiceParameterTest extends PHPUnit\Framework\TestCase
{
    public function testNoArguments(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        Pact::mockService([]);
    }

    public function testMissingPort(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        Pact::mockService(['consumer' => 'test', 'provider' => 'woo']);
    }

    public function testMissingProvider(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        Pact::mockService(['port' => 1234, 'consumer' => 'test']);
    }

    public function testMissingConsumer(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        Pact::mockService(['port' => 1234, 'provider' => 'woo']);
    }

    public function testCreateMockService(): void
    {
        $mockService = Pact::mockService(['port' => 1234, 'consumer' => 'test', 'provider' => 'woo']);
        $this->assertInstanceOf("Pact\MockService", $mockService);
    }
}
