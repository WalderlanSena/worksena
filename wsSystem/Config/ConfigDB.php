<?php

/**
 * --- WorkSena - Micro Framework ---
 *	Configurações dos Banco de Dados
 *	Modifica as mesmas de acordo com o seu banco de dados
 * 	Databases: @Mysql e @PostgreSql
 * @license https://github.com/WalderlanSena/worksena/blob/master/LICENSE (MIT License)
 *
 * @copyright © 2013-2017 - @author Walderlan Sena <walderlan@worksena.xyz>
 *
 */

/**
 * Selecione o Banco que deseja ultilizar - Default é Mysql
 * @return configurações referente ao banco de dados
 */
return [
	'driver' => 'Mysql',

	'Mysql' => [
		'host'      => 'localhost',
		'dbname'    => 'WsBase',
		'user'      => 'root',
		'pass'      => '12345',
		'charset'   => 'utf8',
		'collation' => 'utf8_unicode_ci'
	],

	'PostgreSQL'  => [
		'host'      => 'localhost',
		'dbname'    => 'WsBase',
		'user'      => 'postgres',
		'pass'      => '',
		'charset'   => 'utf8',
		'collation' => 'utf8_unicode_ci'
	]
];
