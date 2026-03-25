<?php

declare(strict_types=1);

namespace Softspring\TimeAgoBundle\Tests\DependencyInjection;

use PHPUnit\Framework\TestCase;
use Softspring\TimeAgoBundle\DependencyInjection\SfsTimeAgoExtension;
use Softspring\TimeAgoBundle\Helper\TimeAgoHelper;
use Softspring\TimeAgoBundle\Twig\TimeAgoExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;

final class SfsTimeAgoExtensionTest extends TestCase
{
    public function testLoadsServicesWithoutExtraConfiguration(): void
    {
        $container = new ContainerBuilder();
        $extension = new SfsTimeAgoExtension();

        $extension->load([], $container);

        $this->assertTrue($container->hasDefinition('sfs_time_ago.helper'));
        $this->assertTrue($container->hasDefinition('sfs_time_ago.twig_extension'));

        $helperDefinition = $container->getDefinition('sfs_time_ago.helper');
        $twigExtensionDefinition = $container->getDefinition('sfs_time_ago.twig_extension');

        $this->assertSame(TimeAgoHelper::class, $helperDefinition->getClass());
        $this->assertSame(TimeAgoExtension::class, $twigExtensionDefinition->getClass());
        $this->assertArrayHasKey('twig.extension', $twigExtensionDefinition->getTags());
    }
}
