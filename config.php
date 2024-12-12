<?php
session_start();

//Fuso horário de São Paulo
date_default_timezone_set('America/Sao_Paulo');

define('INCLUDE_PATH', 'http://localhost/Projeto_01/');

define('INCLUDE_PATH_PAINEL', INCLUDE_PATH.'painel/');


define('HOST', 'localhost');
define('DATABASE', 'projeto_01');
define('USER', 'root');
define('PASSWORD', '');

$autoload = function($class){
    include('assets/classes/'.$class.'.php');
};

spl_autoload_register($autoload);

//Função para o cargo
function pegaCargo($cargo){
    $vetor = [
        '0' => 'Normal',
        '1' => 'Sub-administrador',
        '2' => 'Administrador'
    ];
    return $vetor[$cargo];
}

//Nome para inserir no painel da empresa
$nomeEmpresa = 'IFPR';
define('NOME_EMPRESA', 'IFPR')

?>