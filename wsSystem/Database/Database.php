<?php

/**
 * --- WorkSena - Micro Framework ---
 * Classe abstrata que realiza a conexão com o banco de dados.
 * Aqui é defina a conexão com o banco de dados da aplicação em geral...
 * É possivel conectar-se a dois banco de dados (Mysql que é o padrão ou o
 * PostgreSql)
 * @license https://github.com/WalderlanSena/worksena/blob/master/LICENSE (MIT License)
 *
 * @copyright © 2013-2017 - @author Walderlan Sena <walderlan@worksena.xyz>
 *
 */

namespace WsSystem\Database;

abstract class Database
{
    /**
     *  Recebe a conexão com o banco de dados
     *  @var $pdo
     */
    private static $pdo;

    /**
     * Realizando a busca pelo arquivo com as configurações referentes ao banco
     * @return mixed
     */
    private static function findData()
    {
        // Capturando informações definidas no ConfigDB
        if (file_exists("../wsSystem/Config/ConfigDB.php")) {
            return require "../wsSystem/Config/ConfigDB.php";
        }//end if
    }//end findData

    /**
     * Método que realiza a conexão com o banco de dados
     * @return \PDO|string
     */
    public static function getConection()
    {
        // Chamando o método que retorna o array com as configurações do banco de dados
        $config = self::findData();
        // Verificando se o drive setado é o Mysql
        if ($config['driver'] == 'Mysql') {
            /**
             * Ultilizando o SGBD Mysql
             * Capturando os valores que foram definidos no arquivo de configuração
             * @param Capturando os parâmentro nescéssarios para a configuração do banco
             */
            $host      = $config['Mysql']['host'];
            $dbname    = $config['Mysql']['dbname'];
            $user      = $config['Mysql']['user'];
            $pass      = $config['Mysql']['pass'];
            $charset   = $config['Mysql']['charset'];
            $collation = $config['Mysql']['collation'];

            /**
             * Iniciando a conexão com um tratamento de erro try catch
             * @return retorna a conexão ou um erro caso ocorra
             */
            try {
                if (self::$pdo === null) {
                    self::$pdo = new \PDO("mysql:host=$host;dbname=$dbname;charset=$charset",$user,$pass);
                    self::$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                    self::$pdo->setAttribute(\PDO::MYSQL_ATTR_INIT_COMMAND,"SET NAMES '$charset' COLLATION '$collation'");
                    self::$pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_OBJ);
                }//end if
                return self::$pdo;
            } catch (\PDOException $e) {
                // Se o banco de dados não estiver configurado
                return "Erro: Mysql-> ". $e->getMessage();
            }//end try

        } else {
            /**
             * Ultilizando o SGBD PostgreSql
             * Capturando os valores que foram definidos no arquivo de configuração
             * @param Capturando os parâmentro nescéssarios para a configuração do banco
             */
            $host   = $config['PostgreSQL']['host'];
            $dbname = $config['PostgreSQL']['dbname'];
            $user   = $config['PostgreSQL']['user'];
            $pass   = $config['PostgreSQL']['pass'];

            /**
             * Iniciando a conexão com um tratamento de erro try catch
             * @return retorna a conexão ou um erro caso ocorra
             */
            try {
                self::$pdo = new \PDO("pgsql:dbname=$dbname host=$host", $user, $pass);
                self::$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                self::$pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_OBJ);
                return self::$pdo;
            } catch (\PDOException $e) {
              return "Erro: PostgreSql-> ". $e->getMessage();
            }//end try
        }//end if
    }//end método getConection

}//end class Databases
