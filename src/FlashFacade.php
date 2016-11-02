<?php

namespace CrazyInventor\LaFlash;

use \Illuminate\Support\Facades\Facade;

class FlashFacade extends Facade
{
	/**
	 * Get accessor
	 *
	 * @return string
	 */
	public static function getFacadeAccessor() {
		return 'flash';
	}
}