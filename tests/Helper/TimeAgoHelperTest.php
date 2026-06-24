<?php

declare(strict_types=1);

namespace Softspring\TimeAgoBundle\Tests\Helper;

use DateInterval;
use DateTime;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;
use Softspring\TimeAgoBundle\Helper\TimeAgoHelper;
use Symfony\Component\Translation\Loader\ArrayLoader;
use Symfony\Component\Translation\Translator;

final class TimeAgoHelperTest extends TestCase
{
    public function testRendersRecentSecondsForDateTimeInput(): void
    {
        $helper = new TimeAgoHelper($this->createTranslator('en'));
        $dateTime = $this->createNow()->sub(new DateInterval('PT10S'));

        $this->assertSame('Less than a minute ago', $helper->ago($dateTime));
    }

    public function testRendersMinutesForStringInput(): void
    {
        $helper = new TimeAgoHelper($this->createTranslator('en'));
        $dateTime = $this->createNow()->sub(new DateInterval('PT5M'));

        $this->assertSame('5 minutes ago', $helper->ago($dateTime->format(DateTime::ATOM)));
    }

    public function testUsesActiveLocaleTranslations(): void
    {
        $helper = new TimeAgoHelper($this->createTranslator('es'));
        $dateTime = $this->createNow()->sub(new DateInterval('PT1H'));

        $this->assertSame('Hace 1 hora', $helper->ago($dateTime));
    }

    public function testUsesSingleMainUnitOnly(): void
    {
        $helper = new TimeAgoHelper($this->createTranslator('en'));
        $dateTime = $this->createNow()
            ->sub(new DateInterval('P1D'))
            ->sub(new DateInterval('PT3H'));

        $this->assertSame('A day ago', $helper->ago($dateTime));
    }

    public function testRendersMonths(): void
    {
        $helper = new TimeAgoHelper($this->createTranslator('en'));
        $dateTime = $this->createNow()->sub(new DateInterval('P2M'));

        $this->assertSame('2 months ago', $helper->ago($dateTime));
    }

    public function testRendersYears(): void
    {
        $helper = new TimeAgoHelper($this->createTranslator('en'));
        $dateTime = $this->createNow()->sub(new DateInterval('P2Y'));

        $this->assertSame('2 years ago', $helper->ago($dateTime));
    }

    public function testReturnsEmptyStringAndLogsWarningForInvalidInput(): void
    {
        $logger = $this->createMock(LoggerInterface::class);
        $logger->expects($this->once())
            ->method('warning')
            ->with($this->stringContains('integer received'));

        $helper = new TimeAgoHelper($this->createTranslator('en'), $logger);

        $this->assertSame('', $helper->ago(123));
    }

    public function testReturnsEmptyStringAndLogsWarningForInvalidDateString(): void
    {
        $logger = $this->createMock(LoggerInterface::class);
        $logger->expects($this->once())
            ->method('warning')
            ->with($this->stringContains('valid date string'));

        $helper = new TimeAgoHelper($this->createTranslator('en'), $logger);

        $this->assertSame('', $helper->ago('not-a-date'));
    }

    private function createTranslator(string $locale): Translator
    {
        $translator = new Translator($locale);
        $translator->addLoader('array', new ArrayLoader());
        $translator->addResource('array', [
            'timeago.seconds' => 'Less than a minute ago',
            'timeago.minutes' => '{1} A minute ago|]1,Inf[ %count% minutes ago',
            'timeago.hours' => '{1} An hour ago|]1,Inf[ %count% hours ago',
            'timeago.days' => '{1} A day ago|]1,Inf[ %count% days ago',
            'timeago.months' => '{1} A month ago|]1,Inf[ %count% months ago',
            'timeago.years' => '{1} A year ago|]1,Inf[ %count% years ago',
        ], 'en', 'sfs_timeago');
        $translator->addResource('array', [
            'timeago.seconds' => 'Hace unos segundos',
            'timeago.minutes' => '{1} Hace 1 minuto|]1,Inf[ Hace %count% minutos',
            'timeago.hours' => '{1} Hace 1 hora|]1,Inf[ Hace %count% horas',
            'timeago.days' => '{1} Hace 1 día|]1,Inf[ Hace %count% días',
            'timeago.months' => '{1} Hace 1 mes|]1,Inf[ Hace %count% meses',
            'timeago.years' => '{1} Hace 1 año|]1,Inf[ Hace %count% años',
        ], 'es', 'sfs_timeago');

        return $translator;
    }

    private function createNow(): DateTime
    {
        return new DateTime('now');
    }
}
