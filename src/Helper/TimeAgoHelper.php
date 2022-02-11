<?php

namespace Softspring\TimeAgoBundle\Helper;

use Psr\Log\LoggerInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class TimeAgoHelper
{
    protected TranslatorInterface $translator;

    protected ?LoggerInterface $logger;

    public function __construct(TranslatorInterface $translator, ?LoggerInterface $logger = null)
    {
        $this->translator = $translator;
        $this->logger = $logger;
    }

    /**
     * @param \DateTime|string $dateTime
     *
     * @throws \Exception
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
            return $this->translator->trans('timeago.years', ['%count%' => $diff->y], 'sfs_timeago');
        }

        if ($diff->m) {
            return $this->translator->trans('timeago.months', ['%count%' => $diff->m], 'sfs_timeago');
        }

        if ($diff->d) {
            return $this->translator->trans('timeago.days', ['%count%' => $diff->d], 'sfs_timeago');
        }

        if ($diff->h) {
            return $this->translator->trans('timeago.hours', ['%count%' => $diff->h], 'sfs_timeago');
        }

        if ($diff->i) {
            return $this->translator->trans('timeago.minutes', ['%count%' => $diff->i], 'sfs_timeago');
        }

        return $this->translator->trans('timeago.seconds', ['%count%' => $diff->s], 'sfs_timeago');
    }
}
