<?php
/**
 * --- WorkSena - Micro Framework ---
 * @license https://github.com/WalderlanSena/worksena/blob/master/LICENSE (MIT License)
 * @copyright © 2013-2018 - @author Walderlan Sena <walderlan@worksena.xyz>
 */

namespace Config\Autoload;

use App\Service\Home\HomeService;
use App\Service\Home\Interfaces\HomeServiceInterface;

return [
    'di' => [
       HomeService::class => HomeServiceInterface::class
    ],
];