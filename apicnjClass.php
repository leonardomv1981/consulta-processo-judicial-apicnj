<?php
Class ApicnjClass
{
    public static function validarNumeroCnj($data)
    {
        // retira . e - do número do processo
        $processo['numeroCNJ'] = str_replace(['.', '-', '_'], '', $data['numeroCNJ']);

        //separa o número em categorias para validação do digito do número
        $processo['n'] = substr($processo['numeroCNJ'], 0, 7);
        $processo['d'] = substr($processo['numeroCNJ'], 7, 2);
        $processo['a'] = substr($processo['numeroCNJ'], 9, 4);
        $processo['j'] = substr($processo['numeroCNJ'], 13, 1);
        $processo['tr'] = substr($processo['numeroCNJ'], 14, 2);
        $processo['o'] = substr($processo['numeroCNJ'], 16, 4);

        $operacaoDV = $processo['n']%97;
        $operacao1 = ($operacaoDV . $processo['a'] . $processo['j'] . $processo['tr']) %97;
        $operacao2 = ($operacao1 . $processo['o'] . $processo['d']) %97;
        //Se o número CNJ for válido, o resultado da operação2 será 1. Caso seja diferente,o número CNJ é inválido.

        if ($operacao2 != 1) {
            return ['erro' => "Erro! O número CNJ informado não é válido."];
            die;
        }
        
        return $processo;

    }
    
    public static function buscarTribunalApi($data)
    {

        $tribunais = array (
            1 => [0 => ['link' => '', 'nome' => 'Supremo Tribunal Federal']],
            2 => [0 => ['link' => '', 'nome' => 'Conselho Nacional de Justiça']],
            3 => [0 => ['link' => 'https://api-publica.datajud.cnj.jus.br/api_publica_stj/_search', 'nome' => 'Superior Tribunal de Justiça']],
            4 => [
                1 => ['link' => 'https://api-publica.datajud.cnj.jus.br/api_publica_trf1/_search', 'nome' => 'Tribunal Regional Federal da 1a Região'], 
                2 => ['link' => 'https://api-publica.datajud.cnj.jus.br/api_publica_trf2/_search', 'nome' => 'Tribunal Regional Federal da 2a Região'], 
                3 => ['link' => 'https://api-publica.datajud.cnj.jus.br/api_publica_trf3/_search', 'nome' => 'Tribunal Regional Federal da 3a Região'], 
                4 => ['link' => 'https://api-publica.datajud.cnj.jus.br/api_publica_trf4/_search', 'nome' => 'Tribunal Regional Federal da 4a Região'], 
                5 => ['link' => 'https://api-publica.datajud.cnj.jus.br/api_publica_trf5/_search', 'nome' => 'Tribunal Regional Federal da 5a Região'], 
                6 => ['link' => 'https://api-publica.datajud.cnj.jus.br/api_publica_trf6/_search', 'nome' => 'Tribunal Regional Federal da 6a Região']
            ],
            5 => [
                0 => ['link' => 'https://api-publica.datajud.cnj.jus.br/api_publica_tst/_search', 'nome' => 'Tribunal Superior do Trabalho'],
                1 => ['link' => 'https://api-publica.datajud.cnj.jus.br/api_publica_trt1/_search', 'nome' => 'Tribunal Regional do Trabalho da 1 região'],
                2 => ['link' => 'https://api-publica.datajud.cnj.jus.br/api_publica_trt2/_search', 'nome' => 'Tribunal Regional do Trabalho da 2 região'],
                3 => ['link' => 'https://api-publica.datajud.cnj.jus.br/api_publica_trt3/_search', 'nome' => 'Tribunal Regional do Trabalho da 3 região'],
                4 => ['link' => 'https://api-publica.datajud.cnj.jus.br/api_publica_trt4/_search', 'nome' => 'Tribunal Regional do Trabalho da 4 região'],
                5 => ['link' => 'https://api-publica.datajud.cnj.jus.br/api_publica_trt5/_search', 'nome' => 'Tribunal Regional do Trabalho da 5 região'],
                6 => ['link' => 'https://api-publica.datajud.cnj.jus.br/api_publica_trt6/_search', 'nome' => 'Tribunal Regional do Trabalho da 6 região'],
                7 => ['link' => 'https://api-publica.datajud.cnj.jus.br/api_publica_trt7/_search', 'nome' => 'Tribunal Regional do Trabalho da 7 região'],
                8 => ['link' => 'https://api-publica.datajud.cnj.jus.br/api_publica_trt8/_search', 'nome' => 'Tribunal Regional do Trabalho da 8 região'],
                9 => ['link' => 'https://api-publica.datajud.cnj.jus.br/api_publica_trt9/_search', 'nome' => 'Tribunal Regional do Trabalho da 9 região'],
                10 => ['link' => 'https://api-publica.datajud.cnj.jus.br/api_publica_trt10/_search', 'nome' => 'Tribunal Regional do Trabalho da 10 região'],
                11 => ['link' => 'https://api-publica.datajud.cnj.jus.br/api_publica_trt11/_search', 'nome' => 'Tribunal Regional do Trabalho da 11 região'],
                12 => ['link' => 'https://api-publica.datajud.cnj.jus.br/api_publica_trt12/_search', 'nome' => 'Tribunal Regional do Trabalho da 12 região'],
                13 => ['link' => 'https://api-publica.datajud.cnj.jus.br/api_publica_trt13/_search', 'nome' => 'Tribunal Regional do Trabalho da 13 região'],
                14 => ['link' => 'https://api-publica.datajud.cnj.jus.br/api_publica_trt14/_search', 'nome' => 'Tribunal Regional do Trabalho da 14 região'],
                15 => ['link' => 'https://api-publica.datajud.cnj.jus.br/api_publica_trt15/_search', 'nome' => 'Tribunal Regional do Trabalho da 15 região'],
                16 => ['link' => 'https://api-publica.datajud.cnj.jus.br/api_publica_trt16/_search', 'nome' => 'Tribunal Regional do Trabalho da 16 região'],
                17 => ['link' => 'https://api-publica.datajud.cnj.jus.br/api_publica_trt17/_search', 'nome' => 'Tribunal Regional do Trabalho da 17 região'],
                18 => ['link' => 'https://api-publica.datajud.cnj.jus.br/api_publica_trt18/_search', 'nome' => 'Tribunal Regional do Trabalho da 18 região'],
                19 => ['link' => 'https://api-publica.datajud.cnj.jus.br/api_publica_trt19/_search', 'nome' => 'Tribunal Regional do Trabalho da 19 região'],
                20 => ['link' => 'https://api-publica.datajud.cnj.jus.br/api_publica_trt20/_search', 'nome' => 'Tribunal Regional do Trabalho da 20 região'],
                21 => ['link' => 'https://api-publica.datajud.cnj.jus.br/api_publica_trt21/_search', 'nome' => 'Tribunal Regional do Trabalho da 21 região'],
                22 => ['link' => 'https://api-publica.datajud.cnj.jus.br/api_publica_trt22/_search', 'nome' => 'Tribunal Regional do Trabalho da 22 região'],
                23 => ['link' => 'https://api-publica.datajud.cnj.jus.br/api_publica_trt23/_search', 'nome' => 'Tribunal Regional do Trabalho da 23 região'],
                24 => ['link' => 'https://api-publica.datajud.cnj.jus.br/api_publica_trt24/_search', 'nome' => 'Tribunal Regional do Trabalho da 24 região']
            ],
            6 => [
                0 => ['link' => 'https://api-publica.datajud.cnj.jus.br/api_publica_tse/_search', 'nome' => 'Tribunal Superior Eleitoral'],
                1 => ['link' => 'https://api-publica.datajud.cnj.jus.br/api_publica_tre-ac/_search', 'nome' => 'Tribunal Regional Eleitoral do Acre'],
                2 => ['link' => 'https://api-publica.datajud.cnj.jus.br/api_publica_tre-al/_search', 'nome' => 'Tribunal Regional Eleitoral de Alagoas'],
                3 => ['link' => 'https://api-publica.datajud.cnj.jus.br/api_publica_tre-ap/_search', 'nome' => 'Tribunal Regional Eleitoral do Amapá'],
                4 => ['link' => 'https://api-publica.datajud.cnj.jus.br/api_publica_tre-am/_search', 'nome' => 'Tribunal Regional Eleitoral de Amazonas'],
                5 => ['link' => 'https://api-publica.datajud.cnj.jus.br/api_publica_tre-ba/_search', 'nome' => 'Tribunal Regional Eleitoral da Bahia'],
                6 => ['link' => 'https://api-publica.datajud.cnj.jus.br/api_publica_tre-ce/_search', 'nome' => 'Tribunal Regional Eleitoral do Ceara'],
                7 => ['link' => 'https://api-publica.datajud.cnj.jus.br/api_publica_tre-dft/_search', 'nome' => 'Tribunal Regional Eleitoral do Distrito Federal'],
                8 => ['link' => 'https://api-publica.datajud.cnj.jus.br/api_publica_tre-es/_search', 'nome' => 'Tribunal Regional Eleitoral do Espirito Santo'],
                9 => ['link' => 'https://api-publica.datajud.cnj.jus.br/api_publica_tre-go/_search', 'nome' => 'Tribunal Regional Eleitoral de Goias'],
                10 => ['link' => 'https://api-publica.datajud.cnj.jus.br/api_publica_tre-ma/_search', 'nome' => 'Tribunal Regional Eleitoral do Maranhão'],
                11 => ['link' => 'https://api-publica.datajud.cnj.jus.br/api_publica_tre-mt/_search', 'nome' => 'Tribunal Regional Eleitoral do Mato Grosso'],
                12 => ['link' => 'https://api-publica.datajud.cnj.jus.br/api_publica_tre-ms/_search', 'nome' => 'Tribunal Regional Eleitoral do Mato Grosso do Sul'],
                13 => ['link' => 'https://api-publica.datajud.cnj.jus.br/api_publica_tre-mg/_search', 'nome' => 'Tribunal Regional Eleitoral de Minas Gerais'],
                14 => ['link' => 'https://api-publica.datajud.cnj.jus.br/api_publica_tre-pa/_search', 'nome' => 'Tribunal Regional Eleitoral do Pará'],
                15 => ['link' => 'https://api-publica.datajud.cnj.jus.br/api_publica_tre-pb/_search', 'nome' => 'Tribunal Regional Eleitoral da Paraíba'],
                16 => ['link' => 'https://api-publica.datajud.cnj.jus.br/api_publica_tre-pr/_search', 'nome' => 'Tribunal Regional Eleitoral do Paraná'],
                17 => ['link' => 'https://api-publica.datajud.cnj.jus.br/api_publica_tre-pe/_search', 'nome' => 'Tribunal Regional Eleitoral de Pernambuco'],
                18 => ['link' => 'https://api-publica.datajud.cnj.jus.br/api_publica_tre-pi/_search', 'nome' => 'Tribunal Regional Eleitoral do Piaui'],
                19 => ['link' => 'https://api-publica.datajud.cnj.jus.br/api_publica_tre-rj/_search', 'nome' => 'Tribunal Regional Eleitoral do Rio de Janeiro'],
                20 => ['link' => 'https://api-publica.datajud.cnj.jus.br/api_publica_tre-rn/_search', 'nome' => 'Tribunal Regional Eleitoral do Rio Grande do Norte'],
                21 => ['link' => 'https://api-publica.datajud.cnj.jus.br/api_publica_tre-rs/_search', 'nome' => 'Tribunal Regional Eleitoral do Rio Grande do Sul'],
                22 => ['link' => 'https://api-publica.datajud.cnj.jus.br/api_publica_tre-ro/_search', 'nome' => 'Tribunal Regional Eleitoral de Rondonia'],
                23 => ['link' => 'https://api-publica.datajud.cnj.jus.br/api_publica_tre-rr/_search', 'nome' => 'Tribunal Regional Eleitoral de Roraima'],
                24 => ['link' => 'https://api-publica.datajud.cnj.jus.br/api_publica_tre-sc/_search', 'nome' => 'Tribunal Regional Eleitoral de Santa Catarina'],
                25 => ['link' => 'https://api-publica.datajud.cnj.jus.br/api_publica_tre-se/_search', 'nome' => 'Tribunal Regional Eleitoral de Sergipe'],
                26 => ['link' => 'https://api-publica.datajud.cnj.jus.br/api_publica_tre-sp/_search', 'nome' => 'Tribunal Regional Eleitoral de São Paulo'],
                27 => ['link' => 'https://api-publica.datajud.cnj.jus.br/api_publica_tre-to/_search', 'nome' => 'Tribunal Regional Eleitoral de Tocantins']
            ],
            7 => [
                0 => ['link' => 'https://api-publica.datajud.cnj.jus.br/api_publica_stm/_search', 'nome' => 'Tribunal Superior Militar'],
                1 => ['link' => '', 'nome' => '1a Circunscrição Judiciária Militar'],
                2 => ['link' => '', 'nome' => '2a Circunscrição Judiciária Militar'],
                3 => ['link' => '', 'nome' => '3a Circunscrição Judiciária Militar'],
                4 => ['link' => '', 'nome' => '4a Circunscrição Judiciária Militar'],
                5 => ['link' => '', 'nome' => '5a Circunscrição Judiciária Militar'],
                6 => ['link' => '', 'nome' => '6a Circunscrição Judiciária Militar'],
                7 => ['link' => '', 'nome' => '7a Circunscrição Judiciária Militar'],
                8 => ['link' => '', 'nome' => '8a Circunscrição Judiciária Militar'],
                9 => ['link' => '', 'nome' => '9a Circunscrição Judiciária Militar'],
                10 => ['link' => '', 'nome' => '10a Circunscrição Judiciária Militar'],
                11 => ['link' => '', 'nome' => '11a Circunscrição Judiciária Militar'],
                12 => ['link' => '', 'nome' => '12a Circunscrição Judiciária Militar'],
            ],
            8 => [
                1 => ['link' => 'https://api-publica.datajud.cnj.jus.br/api_publica_tjac/_search', 'nome' => 'Tribunal de Justiça do Estado do Acre'],
                2 => ['link' => 'https://api-publica.datajud.cnj.jus.br/api_publica_tjal/_search', 'nome' => 'Tribunal de Justiça do Estado de Alagoas'],
                3 => ['link' => 'https://api-publica.datajud.cnj.jus.br/api_publica_tjap/_search', 'nome' => 'Tribunal de Justiça do Estado do Amapá'],
                4 => ['link' => 'https://api-publica.datajud.cnj.jus.br/api_publica_tjam/_search', 'nome' => 'Tribunal de Justiça do Estado de Amazonas'],
                5 => ['link' => 'https://api-publica.datajud.cnj.jus.br/api_publica_tjba/_search', 'nome' => 'Tribunal de Justiça do Estado da Bahia'],
                6 => ['link' => 'https://api-publica.datajud.cnj.jus.br/api_publica_tjce/_search', 'nome' => 'Tribunal de Justiça do Estado do Ceara'],
                7 => ['link' => 'https://api-publica.datajud.cnj.jus.br/api_publica_tjdft/_search', 'nome' => 'Tribunal de Justiça do Estado do Distrito Federal'],
                8 => ['link' => 'https://api-publica.datajud.cnj.jus.br/api_publica_tjes/_search', 'nome' => 'Tribunal de Justiça do Estado do Espirito Santo'],
                9 => ['link' => 'https://api-publica.datajud.cnj.jus.br/api_publica_tjgo/_search', 'nome' => 'Tribunal de Justiça do Estado de Goias'],
                10 => ['link' => 'https://api-publica.datajud.cnj.jus.br/api_publica_tjma/_search', 'nome' => 'Tribunal de Justiça do Estado do Maranhão'],
                11 => ['link' => 'https://api-publica.datajud.cnj.jus.br/api_publica_tjmt/_search', 'nome' => 'Tribunal de Justiça do Estado do Mato Grosso'],
                12 => ['link' => 'https://api-publica.datajud.cnj.jus.br/api_publica_tjms/_search', 'nome' => 'Tribunal de Justiça do Estado do Mato Grosso do Sul'],
                13 => ['link' => 'https://api-publica.datajud.cnj.jus.br/api_publica_tjmg/_search', 'nome' => 'Tribunal de Justiça do Estado de Minas Gerais'],
                14 => ['link' => 'https://api-publica.datajud.cnj.jus.br/api_publica_tjpa/_search', 'nome' => 'Tribunal de Justiça do Estado do Pará'],
                15 => ['link' => 'https://api-publica.datajud.cnj.jus.br/api_publica_tjpb/_search', 'nome' => 'Tribunal de Justiça do Estado da Paraíba'],
                16 => ['link' => 'https://api-publica.datajud.cnj.jus.br/api_publica_tjpr/_search', 'nome' => 'Tribunal de Justiça do Estado do Paraná'],
                17 => ['link' => 'https://api-publica.datajud.cnj.jus.br/api_publica_tjpe/_search', 'nome' => 'Tribunal de Justiça do Estado de Pernambuco'],
                18 => ['link' => 'https://api-publica.datajud.cnj.jus.br/api_publica_tjpi/_search', 'nome' => 'Tribunal de Justiça do Estado do Piaui'],
                19 => ['link' => 'https://api-publica.datajud.cnj.jus.br/api_publica_tjrj/_search', 'nome' => 'Tribunal de Justiça do Estado do Rio de Janeiro'],
                20 => ['link' => 'https://api-publica.datajud.cnj.jus.br/api_publica_tjrn/_search', 'nome' => 'Tribunal de Justiça do Estado do Rio Grande do Norte'],
                21 => ['link' => 'https://api-publica.datajud.cnj.jus.br/api_publica_tjrs/_search', 'nome' => 'Tribunal de Justiça do Estado do Rio Grande do Sul'],
                22 => ['link' => 'https://api-publica.datajud.cnj.jus.br/api_publica_tjro/_search', 'nome' => 'Tribunal de Justiça do Estado de Rondonia'],
                23 => ['link' => 'https://api-publica.datajud.cnj.jus.br/api_publica_tjrr/_search', 'nome' => 'Tribunal de Justiça do Estado de Roraima'],
                24 => ['link' => 'https://api-publica.datajud.cnj.jus.br/api_publica_tjsc/_search', 'nome' => 'Tribunal de Justiça do Estado de Santa Catarina'],
                25 => ['link' => 'https://api-publica.datajud.cnj.jus.br/api_publica_tjse/_search', 'nome' => 'Tribunal de Justiça do Estado de Sergipe'],
                26 => ['link' => 'https://api-publica.datajud.cnj.jus.br/api_publica_tjsp/_search', 'nome' => 'Tribunal de Justiça do Estado de São Paulo'],
                27 => ['link' => 'https://api-publica.datajud.cnj.jus.br/api_publica_tjto/_search', 'nome' => 'Tribunal de Justiça do Estado de Tocantins']
            ],
            9 => [
                1 => ['link' => '', 'nome' => ''],
                2 => ['link' => '', 'nome' => ''],
                3 => ['link' => '', 'nome' => ''],
                4 => ['link' => '', 'nome' => ''],
                5 => ['link' => '', 'nome' => ''],
                6 => ['link' => '', 'nome' => ''],
                7 => ['link' => '', 'nome' => ''],
                8 => ['link' => '', 'nome' => ''],
                9 => ['link' => '', 'nome' => ''],
                10 => ['link' => '', 'nome' => ''],
                11 => ['link' => '', 'nome' => ''],
                12 => ['link' => '', 'nome' => ''],
                13 => ['link' => 'https://api-publica.datajud.cnj.jus.br/api_publica_tjmmg/_search', 'nome' => 'Tribunal Regional Eleitoral de Minas Gerais'],
                14 => ['link' => '', 'nome' => ''],
                15 => ['link' => '', 'nome' => ''],
                16 => ['link' => '', 'nome' => ''],
                17 => ['link' => '', 'nome' => ''],
                18 => ['link' => '', 'nome' => ''],
                19 => ['link' => '', 'nome' => ''],
                20 => ['link' => '', 'nome' => ''],
                21 => ['link' => 'https://api-publica.datajud.cnj.jus.br/api_publica_tjmrs/_search', 'nome' => 'Tribunal Regional Eleitoral do Rio Grande do Sul'],
                22 => ['link' => '', 'nome' => ''],
                23 => ['link' => '', 'nome' => ''],
                24 => ['link' => '', 'nome' => ''],
                25 => ['link' => '', 'nome' => ''],
                26 => ['link' => 'https://api-publica.datajud.cnj.jus.br/api_publica_tjmsp/_search', 'nome' => 'Tribunal Regional Eleitoral de São Paulo'],
                27 => ['link' => '', 'nome' => '']
            ],
        );


        // analisa se o tribunal tem API e está disponível. Se não estiver, retorna mensagem com erro.
        if (empty($tribunais[$data['j']][$data['tr']]['link'])) { 
            return ['erro' => "Erro! O Tribunal " . $tribunais[$data['j']][$data['tr']]['nome'] . " não possui API."];
            die;
        }

        $data['api'] = $tribunais[$data['j']][$data['tr']]['link'];
        $data['nome_tribunal'] = $tribunais[$data['j']][$data['tr']]['nome'];
        return $data;

    }

    static public function consomeApi($data) 
    {

        $ch = curl_init();

        curl_setopt_array($ch, [

            CURLOPT_URL => $data['api'],

            CURLOPT_POST => true,

            CURLOPT_HTTPHEADER => [
                'Authorization: APIKey cDZHYzlZa0JadVREZDJCendQbXY6SkJlTzNjLV9TRENyQk1RdnFKZGRQdw==',
                'Content-Type: application/json',
                'x-li-format: json'
            ],

            CURLOPT_POSTFIELDS => json_encode([
                'query' => [
                    'match' => [
                        'numeroProcesso' => $data['numeroCNJ'],
                    ]
                ],
            ]),
            
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_PROTOCOLS => CURLPROTO_HTTPS
        ]);

        $resultados = curl_exec($ch);
        curl_close($ch);
        $resultados = json_decode($resultados);

        if (empty($resultados->hits->hits[0])) {
            return ['erro' => "Erro! Não foi possível encontrar dados do processo. Isso pode acontecer porque ele é sigiloso ou está tramitando em outro tribunal."];
            die;
        }

        return array($resultados);

    }

}