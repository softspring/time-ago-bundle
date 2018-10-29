<?php

namespace Softspring\TimeAgoBundle;

use Symfony\Component\Translation\TranslatorInterface;

class TimeAgoHelper
{
    /**
     * @var TranslatorInterface
     */
    protected $translator;

    /**
     * TimeAgoExtension constructor.
     *
     * @param TranslatorInterface $translator
     */
    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
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
                throw new \InvalidArgumentException('Timeago extension must receive a DateTime object or string');
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