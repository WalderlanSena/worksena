<?php

/**
 * --- WorkSena - Micro Framework ---
 *	Configurações de localização de alguns aquivos e deritórios da aplicação
 * @license https://github.com/WalderlanSena/worksena/blob/master/LICENSE (MIT License)
 *
 * @copyright © 2013-2017 - @author Walderlan Sena <walderlan@worksena.xyz>
 *
 */

/**
 * Selecione a localização do layout que você deseja ultilizar
 * Selicione a localização das messagem de notificação
 * @return configurações referente as localização
 */

return [
    // Layout a ser ultilizado na aplicação.
    'layoutLocation' => '../app/Views/templates/ws-default/layout.php',
    // Localização das views com as flash message.
    'notifyMessage'  => '../app/Views/notify/'
];
