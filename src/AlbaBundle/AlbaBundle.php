<?php

namespace AlbaBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class AlbaBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
