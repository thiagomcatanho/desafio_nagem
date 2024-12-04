<?php

if (!function_exists('gerarCnpj')) {
    function gerarCnpj()
    {
        // Gerar os 8 primeiros números do CNPJ
        $razao = str_pad(rand(10000000, 99999999), 8, '0', STR_PAD_LEFT);

        // Gerar os 4 números do CNPJ
        $num = rand(1000, 9999);

        $dv1 = calcularDigitoVerificador($razao, $num, 1);

        $dv2 = calcularDigitoVerificador($razao, $num, 2);

        // Formatar o CNPJ sem pontuação
        return $razao . $num . $dv1 . $dv2; // Concatenate tudo
    }

    // Função para calcular o dígito verificador do CNPJ
    function calcularDigitoVerificador($razao, $num, $tipo)
    {
        $fatores = [
            [5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2],
            [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2]
        ];

        $n = $razao . $num; // Concatenando os números de razão e num

        $fator = $fatores[$tipo - 1];

        // Calculando a soma dos produtos dos dígitos pelos fatores
        $soma = 0;
        for ($i = 0; $i < strlen($n); $i++) {
            $soma += (int) $n[$i] * $fator[$i];
        }

        $resto = $soma % 11;
        return $resto < 2 ? 0 : 11 - $resto; // Retorna o dígito verificador
    }

    
}
