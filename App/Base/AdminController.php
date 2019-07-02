<?php

namespace App\Base;

class AdminController extends BaseController
{
	public function onRequest(?string $action): ?bool
	{
		return true;
	}
}