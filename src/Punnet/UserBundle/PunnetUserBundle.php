<?php

namespace Punnet\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class PunnetUserBundle extends Bundle
{
	public function getParent()
    {
        return 'FOSUserBundle';
    } 
}
