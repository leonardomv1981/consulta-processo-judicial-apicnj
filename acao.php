<?php
include 'apicnjClass.php';


switch ($_POST['acao']) {
    case 'consulta': 


        $retornoValidacaoNumero = apicnjClass::validarNumeroCnj($_POST);

        if (isset($retornoValidacaoNumero['erro'])) {
            echo $retornoValidacaoNumero['erro'];
            break;
        };

        $retornoApi = apicnjClass::buscarTribunalApi($retornoValidacaoNumero);

        if (isset($retornoApi['erro'])) {
            echo $retornoApi['erro'];
            break;
        };

        $retornoDadosProcesso = apicnjClass::consomeApi($retornoApi);
        
        if (!empty($retornoDadosProcesso['erro'])) {
            echo $retornoDadosProcesso['erro'];
            break;
        };

        require_once 'mostra-processos.php';

        break;
    case 'verificaNumero':
    break;
}