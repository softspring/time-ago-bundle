<?php

namespace Softspring\TimeAgoBundle\Helper;

use Psr\Log\LoggerInterface;
use Symfony\Component\Translation\TranslatorInterface;

class TimeAgoHelper
{
    /**
     * @var TranslatorInterface
     */
    protected $translator;

    /**
     * @var LoggerInterface|null
     */
    protected $logger;

    /**
     * TimeAgoHelper constructor.
     *
     * @param TranslatorInterface  $translator
     * @param LoggerInterface|null $logger
     */
    public function __construct(TranslatorInterface $translator, ?LoggerInterface $logger = null)
    {
        $this->translator = $translator;
        $this->logger = $logger;
    }

    /**
     * @param \DateTime|string $dateTime
     *
     * @return string
     */
    public function ago($dateTime): string
    {
        if (!$dateTime instanceof \DateTime) {
            if (is_string($dateTime)) {
                $dateTime = new \DateTime($dateTime);
            } else {
                $this->logger && $this->logger->warning(sprintf('Timeago extension must receive a DateTime object or string, %s received', gettype($dateTime)));
                return '';
            }
        }

        $diff = $dateTime->diff(new \DateTime('now'));

        if ($diff->y) {
            return $this->translator->transChoice('timeago.years', $diff->y, [], 'sfs_timeago');
        }

        if ($diff->m) {
            return $this->translator->transChoice('timeago.months', $diff->m, [], 'sfs_timeago');
        }

        if ($diff->d) {
            return $this->translator->transChoice('timeago.days', $diff->d, [], 'sfs_timeago');
        }

        if ($diff->h) {
            return $this->translator->transChoice('timeago.hours', $diff->h, [], 'sfs_timeago');
        }

        if ($diff->i) {
            return $this->translator->transChoice('timeago.minutes', $diff->i, [], 'sfs_timeago');
        }

        return $this->translator->transChoice('timeago.seconds', $diff->s, [], 'sfs_timeago');
    }
}