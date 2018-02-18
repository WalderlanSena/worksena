<?php

/**
 * --- WorkSena - Micro Framework ---
 * Classe abstrata responsavel por renderizar o layout
 * Caso o mesmo exista e seja setando no controller. Também a definição de configurações
 * das views da aplicação...
 * @license https://github.com/WalderlanSena/worksena/blob/master/LICENSE (MIT License)
 *
 * @copyright © 2013-2017 - @author Walderlan Sena <walderlan@worksena.xyz>
 *
 */

namespace WsSystem\Controller;

use WsSystem\Components\Sessions\Session;
use WsSystem\Authentication\AuthUser;

abstract class Action
{
    protected $view;                   // Recebe o objeto padrão stdClass
    protected $success;                // Flash messages de sucesso
	protected $errors;                 // Flash messages de erro
    protected $info;                   // Flash messages de informação
    protected $inputs;                 // Armazena os dados dos inputs temporariamente
    protected $action;                 // Recebe o nome da action setada
	protected $auth;		           // Recebe um objeto com os dados do usuario logado
    private $pageDescription = null;   // Recebe a descrição da meta tags description
    private $pageTitle       = null;   // Recebe o titulo da página
    private $config;

	public function __construct()
    {
        // Criando e inicializando um objeto view
		$this->view = new \stdClass();
        $this->auth = new AuthUser();

        // Variável que recebe as configurações padrões da aplicação
		$this->config = self::findDataSettings();

        // Inicializando flash mensagem da aplicação

        // Mensagem padrão para operações de sucesso
        if (Session::getSession('success')) {
            $this->success = Session::getSession('success');
            Session::destroySession('success');
        }//end if
        // Mensagem padrão para operações de erros
        if (Session::getSession('errors')) {
            $this->errors = Session::getSession('errors');
            Session::destroySession('errors');
        }//end if
		// Mensagem padrão para operações de info
        if (Session::getSession('info')) {
            $this->info = Session::getSession('info');
            Session::destroySession('info');
        }//end if
        // Captura padrão de dados inseridos nos campos dos formularios
        if (Session::getSession('inputs')) {
            $this->inputs = Session::getSession('inputs');
            Session::destroySession('inputs');
        }//endif
    }//end construct

	/**
	 *	Método que retorna as configurações padrão de localização de layout e mensagem
	 *  @return Array com as configurações pertinentes as localizações de arquivos
	 */
	private function findDataSettings()
	{
		if(file_exists("../wsSystem/Config/GeneralSettings.php"))
			return require "../wsSystem/Config/GeneralSettings.php";
	}//end findDataSettings

    /**
     * @param $action
     * @param bool $layout
     * @return mixed|void
     */
	public function render($action, $layout = true)
    {
        // Passando o nome da view que foi solicitada
        $this->action = $action;
        // Verifica se o layout existe. E Se caso o mesmo exista será incluido
		if ($layout == true && file_exists($this->config['layoutLocation'])) {
		    include_once $this->config['layoutLocation'];
		} else {
            // Caso não aja um layout existente, ou não seja solicitado, e carregado o content
            $this->content();
		}//end if
	}//end function render

    /**
     * Renderizando as flash mensagens
     * @param $layoutLocation
     */
    public function renderNotify($layoutLocation)
    {
        if (file_exists($this->config['notifyMessage'].$layoutLocation.".php"))
            include_once $this->config['notifyMessage'].$layoutLocation.".php";
        else
            echo "Erro: Layout de notificação padrão não encontrado !";
    }//end renderNotify

    /**
     *  Renderiza o content da Aplicação
     */
	public function content()
    {
		// Captura o nome da class atual
		$current   = get_class($this);
		// Remove o caminho desnecessários somente o nome do controller
		$ClassName = strtolower(str_replace("App\\Controllers\\", "", $current));
		// Remove a palavra Controller, para corrigir o nome do diretorio da view
		$filterFolder = str_replace("controller","", $ClassName);
		// Inclui a view referente ao nome filtrado acima
		include_once '../app/Views/'.$filterFolder.'/'.$this->action.'.php';
	}//end function content

    /**
     * Configurando titulo dinâmico para as views
     * @param $pageTitle
     */
	protected function setPageTitle($pageTitle)
    {
	    $this->pageTitle = $pageTitle;
	}//end function setPageTitle

    /**
     * Adiciona separador no titulo da página
     * @param null $separator
     * @return null|string
     */
	protected function getPageTitle($separator = null)
    {
		if ($separator)
			return $this->pageTitle. " " . $separator. " ";
		else
			return $this->pageTitle;
	}//end function getPageTitle

    /**
     * @param $description
     */
    protected function setDescription($description)
    {
        $this->pageDescription = $description;
    }

    /**
     * @return null
     */
    protected function getDescription()
    {
        return $this->pageDescription;
    }


}// end class Action
