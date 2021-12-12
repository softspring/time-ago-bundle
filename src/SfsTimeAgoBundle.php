<?php

namespace Softspring\TimeAgoBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class SfsTimeAgoBundle extends Bundle
{
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}