<?php

declare(strict_types=1);

namespace Softspring\TimeAgoBundle\Tests\Twig;

use PHPUnit\Framework\TestCase;
use Softspring\TimeAgoBundle\Helper\TimeAgoHelper;
use Softspring\TimeAgoBundle\Twig\TimeAgoExtension;

final class TimeAgoExtensionTest extends TestCase
{
    public function testRegistersTimeAgoFilterAndFunction(): void
    {
        $extension = new TimeAgoExtension($this->createMock(TimeAgoHelper::class));

        $filters = $extension->getFilters();
        $functions = $extension->getFunctions();

        $this->assertCount(1, $filters);
        $this->assertCount(1, $functions);
        $this->assertSame('time_ago', $filters[0]->getName());
        $this->assertSame('time_ago', $functions[0]->getName());
    }

    public function testFilterDelegatesToHelper(): void
    {
        $helper = $this->createMock(TimeAgoHelper::class);
        $helper->expects($this->once())
            ->method('ago')
            ->with('2025-01-01 00:00:00')
            ->willReturn('A day ago');

        $extension = new TimeAgoExtension($helper);
        $callable = $extension->getFilters()[0]->getCallable();

        $this->assertSame('A day ago', \call_user_func($callable, '2025-01-01 00:00:00'));
    }

    public function testFunctionDelegatesToHelper(): void
    {
        $helper = $this->createMock(TimeAgoHelper::class);
        $helper->expects($this->once())
            ->method('ago')
            ->with('2025-01-01 00:00:00')
            ->willReturn('A day ago');

        $extension = new TimeAgoExtension($helper);
        $callable = $extension->getFunctions()[0]->getCallable();

        $this->assertSame('A day ago', \call_user_func($callable, '2025-01-01 00:00:00'));
    }
}
