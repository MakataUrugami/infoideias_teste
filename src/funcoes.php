<?php

namespace SRC;

class Funcoes
{
    /*

    Desenvolva uma função que receba como parâmetro o ano e retorne o século ao qual este ano faz parte. O primeiro século começa no ano 1 e termina no ano 100, o segundo século começa no ano 101 e termina no 200.

	Exemplos para teste:

	Ano 1905 = século 20
	Ano 1700 = século 17

     * */
    public function SeculoAno(int $ano): int
    {
        if ($ano % 100 == 0)
        {
            $ano = $ano / 100;
        }
        else {
            $ano = ($ano / 100) + 1;
        }
        return $ano;
    }
	
	
	
	/*

    Desenvolva uma função que receba como parâmetro um número inteiro e retorne o numero primo imediatamente anterior ao número recebido

    Exemplo para teste:

    Numero = 10 resposta = 7
    Número = 29 resposta = 23

     * */
    #Função auxiliar.
    public function checkPrimo(int $num): bool
    {
        #Função para checar se é primo.
        for ($i = 2; $i < $num; $i++) {
            if ($num % $i == 0)
                return false;
        }
        return true;
    }

    public function PrimoAnterior(int $numero): int
    {
        #Tratamento de erros.
        if($numero <= 2)
        {
            echo "O numero informado precisa ser positivo e maior que 2.";
            return 0;
        }

        #Busca efetiva dos números primos anteriores.
        $num = $numero;
        while ($num >= 2)
        {
            $num--;
            if($this->checkPrimo($num)) return $num;
        }
        echo "O numero informado nao possui numeros antecessores primos.";
        return 0;
    }










    /*

    Desenvolva uma função que receba como parâmetro um array multidimensional de números inteiros e retorne como resposta o segundo maior número.

    Exemplo para teste:

	Array multidimensional = array (
	array(25,22,18),
	array(10,15,13),
	array(24,5,2),
	array(80,17,15)
	);

	resposta = 25

     * */
    public function SegundoMaior(array $arr): int {
        $arr3 = [];
        foreach($arr as $arr2) foreach($arr2 as $el) array_push($arr3, $el); #Preenchendo o array que será ordenado.
        sort($arr3); #Ordenando o array.
        return $arr3[count($arr3)-2];
    }
	
	
	
	
	
	
	

    /*
   Desenvolva uma função que receba como parâmetro um array de números inteiros e responda com TRUE or FALSE se é possível obter uma sequencia crescente removendo apenas um elemento do array.

	Exemplos para teste 

	Obs.:-  É Importante  realizar todos os testes abaixo para garantir o funcionamento correto.
         -  Sequencias com apenas um elemento são consideradas crescentes

        [1, 3, 2, 1]  false
        [1, 3, 2]  true
        [1, 2, 1, 2]  false
        [3, 6, 5, 8, 10, 20, 15] false
        [1, 1, 2, 3, 4, 4] false
        [1, 4, 10, 4, 2] false
        [10, 1, 2, 3, 4, 5] true
        [1, 1, 1, 2, 3] false
        [0, -2, 5, 6] true
        [1, 2, 3, 4, 5, 3, 5, 6] false
        [40, 50, 60, 10, 20, 30] false
        [1, 1] true
        [1, 2, 5, 3, 5] true
        [1, 2, 5, 5, 5] false
        [10, 1, 2, 3, 4, 5, 6, 1] false
        [1, 2, 3, 4, 3, 6] true
        [1, 2, 3, 4, 99, 5, 6] true
        [123, -17, -5, 1, 2, 3, 12, 43, 45] true
        [3, 5, 67, 98, 3] true

     * */

    #Usado em sequencias crescentes. Falha no caso [10, 1, 2, 3, 4, 5].

    ##### Rapaaaaaaaz, essa daqui deu um trabalho hein! Mas em fim, um pouco de criatividade resolveu. Nosso Deus que emoção ;') ####

    public function CortarNumeroSequenciaAfrente(array $arr): bool
    {
        $contagem = 0;
        for ($i = 0; $i + 1 < count($arr); $i++)
        {
            if ($arr[$i] >= $arr[$i + 1])
            {
                unset($arr[$i + 1]); #Remover elemento.
                $arr = array_values($arr); #Reindexar.
                $contagem ++;
                $i --;
            }
        }
        return $contagem < 2 ? true : false;
    }

    public function CortarNumeroSequenciaDecrescente(array $arr): bool
    {
        $contagem = 0;
        for ($i = count($arr) - 1; $i > 0; $i--)
        {
            if ($arr[$i] <= $arr[$i - 1])
            {
                unset($arr[$i - 1]); #Remover elemento.
                $arr = array_values($arr); #Reindexar.
                $contagem ++;
            }
        }
        return $contagem < 2 ? true : false;
    }

    public function ContarDuplicatas(array $arr): int
    {
        return count($arr) - count(array_unique($arr));
    }
    
	public function SequenciaCrescente(array $arr): bool
    {
        $res = true;
        # Eliminando pelas duplicatas.
        if ($this->ContarDuplicatas($arr) > 1) $res = false;
        # Eliminando comparando de maneira crescente e pelo inverso da decrescente.
        if (!$this->CortarNumeroSequenciaAfrente($arr) and !$this->CortarNumeroSequenciaDecrescente($arr)) $res = false;
        return $res;
    }
}
$funcoes = new Funcoes();
echo nl2br(
    # Questao 1:
    "Seculo ". $funcoes->SeculoAno(1905) . "\n" .
    "Seculo ". $funcoes->SeculoAno(1700) . "\n" .
    # Questao 2:
    "Primo anterior ". $funcoes->PrimoAnterior(10) . "\n" .
    "Primo anterior ". $funcoes->PrimoAnterior(29) . "\n" .
    # Questao 3:
    "Segundo maior ". $funcoes->SegundoMaior(array (
        array(25,22,18),
        array(10,15,13),
        array(24,5,2),
        array(80,17,15)
        )) . "\n" .
    # Questao 4:
    "Sequencia crescente ". (@$funcoes->SequenciaCrescente([1, 3, 2, 1]) ? "true" : "false") . "\n" .
    "Sequencia crescente ". (@$funcoes->SequenciaCrescente([1, 3, 2]) ? "true" : "false") . "\n" .
    "Sequencia crescente ". (@$funcoes->SequenciaCrescente([1, 2, 1, 2]) ? "true" : "false") . "\n" .
    "Sequencia crescente ". (@$funcoes->SequenciaCrescente([3, 6, 5, 8, 10, 20, 15]) ? "true" : "false") . "\n" .
    "Sequencia crescente ". (@$funcoes->SequenciaCrescente([1, 1, 2, 3, 4, 4]) ? "true" : "false") . "\n" .
    "Sequencia crescente ". (@$funcoes->SequenciaCrescente([1, 4, 10, 4, 2]) ? "true" : "false") . "\n" .
    "Sequencia crescente ". (@$funcoes->SequenciaCrescente([10, 1, 2, 3, 4, 5]) ? "true" : "false") . "\n" .
    "Sequencia crescente ". (@$funcoes->SequenciaCrescente([1, 1, 1, 2, 3]) ? "true" : "false") . "\n" .
    "Sequencia crescente ". (@$funcoes->SequenciaCrescente([0, -2, 5, 6]) ? "true" : "false") . "\n" .
    "Sequencia crescente ". (@$funcoes->SequenciaCrescente([1, 2, 3, 4, 5, 3, 5, 6]) ? "true" : "false") . "\n" .
    "Sequencia crescente ". (@$funcoes->SequenciaCrescente([40, 50, 60, 10, 20, 30]) ? "true" : "false") . "\n" .
    "Sequencia crescente ". (@$funcoes->SequenciaCrescente([1, 1]) ? "true" : "false") . "\n" .
    "Sequencia crescente ". (@$funcoes->SequenciaCrescente([1, 2, 5, 3, 5]) ? "true" : "false") . "\n" .
    "Sequencia crescente ". (@$funcoes->SequenciaCrescente([1, 2, 5, 5, 5]) ? "true" : "false") . "\n" .
    "Sequencia crescente ". (@$funcoes->SequenciaCrescente([10, 1, 2, 3, 4, 5, 6, 1]) ? "true" : "false") . "\n" .
    "Sequencia crescente ". (@$funcoes->SequenciaCrescente([1, 2, 3, 4, 3, 6]) ? "true" : "false") . "\n" .
    "Sequencia crescente ". (@$funcoes->SequenciaCrescente([1, 2, 3, 4, 99, 5, 6]) ? "true" : "false") . "\n" .
    "Sequencia crescente ". (@$funcoes->SequenciaCrescente([123, -17, -5, 1, 2, 3, 12, 43, 45]) ? "true" : "false") . "\n" .
    "Sequencia crescente ". (@$funcoes->SequenciaCrescente([3, 5, 67, 98, 3]) ? "true" : "false") . "\n"
);

?>