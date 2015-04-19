<?php

namespace MMI\MMIBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class MMIMMIBundle extends Bundle
{
	public function getParent()
	{
		return 'FOSUserBundle';
	}
}
