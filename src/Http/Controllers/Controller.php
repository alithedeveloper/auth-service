<?php
declare(strict_types=1);

namespace Diplodocker\Http\Controllers;

use Diplodocker\Http\Concerns\JsonResponsable;
use Illuminate\Routing\Controller as BaseController;

/**
 * BaseController
 * Class Controller
 * @package Diplodocker\Http\Controllers
 */
abstract class Controller extends BaseController
{
    use JsonResponsable;
}
