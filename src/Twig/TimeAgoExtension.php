<?php

namespace Softspring\TimeAgoBundle\Twig;

use Softspring\TimeAgoBundle\Helper\TimeAgoHelper;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class TimeAgoExtension extends AbstractExtension
{
    /**
     * @var TimeAgoHelper
     */
    protected $helper;

    /**
     * TimeAgoExtension constructor.
     *
     * @param TimeAgoHelper $helper
     */
    public function __construct(TimeAgoHelper $helper)
    {
        $this->helper = $helper;
    }

    /**
     * @inheritdoc
     */
    public function getFilters()
    {
        return [
            new TwigFilter('time_ago', [$this->helper, 'ago']),
        ];
    }

    /**
     * @inheritdoc
     */
    public function getFunctions()
    {
        return [
            new TwigFunction('time_ago', [$this->helper, 'ago']),
        ];
    }
}