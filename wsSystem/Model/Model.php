<?php

/**
 * --- WorkSena - Micro Framework ---
 * Camada Model da Aplicação
 * @Descrição: Responsavel pela interação com o Banco de dados, aqui são definidos as
 * operações de CRUD e manipulação de dados da aplicação
 * @license: https://github.com/WalderlanSena/worksena/blob/master/LICENSE (MIT License)
 *
 * @copyright © 2013-2017 - @Autor: Walderlan Sena
 *
 */

namespace WsSystem\Model;

abstract class Model
{
    private $db;        //Atributo que recebe retorno da conexão com o banco de dados
    protected $_table;  //Atributo que será subscrito por uma model setada

    /**
     * Inicializando conexão com o banco dados, recebendo a conexão via parâmetro
     * Model constructor.
     * @param \PDO $connection
     */
    public function __construct(\PDO $connection)
    {
        // Passando o retorno da conexão para o atributo db
        $this->db = $connection;
    }//end construct

    /**
     * ReadAll - Lendo todos os dados
     * Método que retorna de dados do banco de forma geral, ou seja, retorna todos os dados
     * da tabela a qual foi setada
     * @param null $limit
     * @param null $offset
     * @param null $orderby
     * @return array
     */
    public function readAll($limit = null, $offset = null, $orderby = null)
    {
        // Tratamento e verificações dos parâmetro passados ao read
        $limit   = ($limit   != null ? "LIMIT    {$limit}"   : "");
        $offset  = ($offset  != null ? "OFFSET   {$offset}"  : "");
        $orderby = ($orderby != null ? "ORDER BY {$orderby}" : "");

        // Montando query de pesquisa
        $sql  = "SELECT * FROM `{$this->_table}` {$orderby} {$limit} {$offset}";
        // Preparando para iniciar a busca pelos dados
        $stmt = $this->db->prepare($sql);
        // Executando a query
        $stmt->execute();
        $result = $stmt->fetchAll();
        // Fechando o ponteiro
        $stmt->CloseCursor();
        // Retorna os dados encontrados na tabela
        return $result;
    }//end método readAll

    /**
     * where - Lendo apenas um dados setado
     * @param $column
     * @param $value
     * @return mixed
     */
    public function where($column, $value)
    {
        // Montando query de pesquisa
        $sql  = "SELECT * FROM `{$this->_table}` WHERE $column = ?";
        // Preparando para iniciar a busca pelos dados
        $stmt = $this->db->prepare($sql);
        // Passando os valores pelo filtro PDO e repassando para a query
        $stmt->bindValue(1, $value);
        // Executando a query
        $stmt->execute();
        // Transformando o retorno em objeto, e passando para a variavel $result
        $result = $stmt->fetch();
        // Fechando o ponteiro
        $stmt->CloseCursor();
        // Retornando os dados para o controller
        return $result;
    }//end método where

    /**
     * Update - atualizando dados do banco
     * @param array $dados
     * @param $column
     * @param $value
     * @return bool
     */
    public function update(array $dados, $column, $value)
    {
        // Percorrendo os dados e filtrando para as posições respectivas
        foreach ($dados as $indice => $values) {
            $setData[] = "{$indice} = ?";
            $bindVal[] = "$values";
        }
        /* Variavel de representação numera da quantidade de campos a serem passadas no
       bindValue*/
       $numBind = 1;
       // Montando os campos com ,
       $campos = implode(", ", $setData);
       // Montando query de update
       $sql = "UPDATE `{$this->_table}` SET {$campos} WHERE $column = ?";
       // Preparando para iniciar a busca pelos dados
       $stmt = $this->db->prepare($sql);
       // Laço for para montar os bindvalues respectivos
       for ($i = 0; $i < count($dados); $i++) {
           $stmt->bindValue($numBind, $bindVal[$i]);
           $numBind++;
       }//end for
       // último bindValue referente ao where
       $stmt->bindValue($numBind, $value);
       // Executando e testado a query
       $result = $stmt->execute();
       // Fechando o ponteiro
       $stmt->CloseCursor();
       // Retornando a resposta da atualização - True ou False
       return $result;
    }//end método update

    /**
     * findId - Lendo apenas um dados setado
     * Método que retorna apenas um dado referente ao campo que foi setado
     * @param array com os dados a serem inseridos no banco
     * @return true caso os dados sejam inseridos com sucesso
     */
    public function insert(array $dados)
    {
        // Tratando dados recebidos no array
        $valuesQuery = "";
        /* Variavel de representação numera da quantidade de campos a serem passadas no
           bindValue*/
        $numBind = 1;
        // For para realiza a montagem variaveis com os valores simbolicos que serão
        // substituidos na query
        for ($i = 0; $i < count($dados); $i++) {
            $valuesQuery = "{$valuesQuery},?";
        }//end for
        // Removendo virgula extra no começo da string montada
        $values = substr($valuesQuery, 1);
        // Criando os campos de referencia do bindValue
        $bindCampos = array_values($dados);
        // Montado os campos da query de inserção
        $campos = implode(', ', array_keys($dados));
        // Montando query de inserção
        $sql = "INSERT INTO `{$this->_table}` ({$campos}) VALUES ({$values})";
        // Atribuindo ao statement para iniciar posteriormente a inserção dos dados
        $stmt = $this->db->prepare($sql);
        // Passando os valores pelo filtro PDO e repassando para a query
        for ($i = 0; $i < count($dados); $i++) {
            $stmt->bindValue($numBind, $bindCampos[$i]);
            $numBind++;
        }//end for
        // Executado e testando a query
        $result = $stmt->execute();
        // Fechando o ponteiro
        $stmt->CloseCursor();
        // Retornando a resposta da inserção - True ou False
        return $result;
    }//end método insert

    /**
     * Delete - Deletando os dados setados
     * Método que deleta o dado referente ao campo que foi setado
     * @param $column
     * @param $value
     * @return bool
     */
    public function delete($column, $value)
    {
        // Montado a query para deletar dado
        $sql  = "DELETE FROM `{$this->_table}` WHERE $column = ?";
        // Atribuindo ao statement para iniciar posteriormente a exclusão dos dados
        $stmt = $this->db->prepare($sql);
        // Atribuindo o dado a query de delete
        $stmt->bindValue(1, $value);
        // Executado e testando a query
        $result = $stmt->execute();
        // Fechando o ponteiro
        $stmt->CloseCursor();
        // Retornando a resposta da inserção - True ou False
        return $result;
    }//end método delete

}//end camada model
