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
            return $this->translator->transChoice('timeago.years', $diff->y, [], 'timeago');
        }

        if ($diff->m) {
            return $this->translator->transChoice('timeago.months', $diff->m, [], 'timeago');
        }

        if ($diff->d) {
            return $this->translator->transChoice('timeago.days', $diff->d, [], 'timeago');
        }

        if ($diff->h) {
            return $this->translator->transChoice('timeago.hours', $diff->h, [], 'timeago');
        }

        if ($diff->i) {
            return $this->translator->transChoice('timeago.minutes', $diff->i, [], 'timeago');
        }

        return $this->translator->transChoice('timeago.seconds', $diff->s, [], 'timeago');
    }
}