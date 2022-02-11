<?php

namespace Softspring\TimeAgoBundle\Twig;

use Softspring\TimeAgoBundle\Helper\TimeAgoHelper;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class TimeAgoExtension extends AbstractExtension
{
    protected TimeAgoHelper $helper;

    public function __construct(TimeAgoHelper $helper)
    {
        $this->helper = $helper;
    }

    /**
     * @return TwigFilter[]
     */
    public function getFilters(): array
    {
        return [
            new TwigFilter('time_ago', [$this->helper, 'ago']),
        ];
    }

    /**
     * @return TwigFunction[]
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('time_ago', [$this->helper, 'ago']),
        ];
    }
}
