<?php 


Class quadradoPerfeito
{

    public function __construct($quadrado){

        $this->calcularQuadradoPerfeito(file($quadrado));
       
    }


    #REALIZA A SOMA DAS LINHAS e COLUNAS E DIAGONAIS E VERIFICA SE OS VALORES SÃO IGUAIS !
    public function calcularQuadradoPerfeito($quadrado)
    {  

        $colunas = array();
        $resultado = array();
        $preencheucol = false;
        $somaDiagonalEsquerdaDireita = 0;
        $posicaoDiagonalEsquerdaDireita = 0;
        $somaDiagonalDireitaEsquerda = 0;
        $posicaoDiagonalDireitaEsquerda = 1;

        #PERCORRE AS LINHAS DO ARQUIVO QUADRADO.TXT
        for ($i = 0; $i < count($quadrado); $i++) {   
            $somalinhas = 0;

            #SEPARA OS ITENS DA LINHA PARA REALIZAR A SOMA;
            $linhas = explode(" ", $quadrado[$i]); 
    
            #VERIFICA E INICIALIZA O ARRAY DE COLUNAS;
            if($preencheucol == false){

                for($a = 0; $a < count($linhas); $a++ ){
                    array_push($colunas, 0);
                }

                $preencheucol = true;
            }

            #VERIFICA E INICIALIZA O ARRAY DE COLUNAS;
            for($j = 0; $j < count($linhas); $j++){
                
                $somalinhas += $linhas[$j];  //SOMA AS LINHAS
                $colunas[$j] += $linhas[$j]; //SOMA AS COLUNAS
                
            }
           
            #SOMA A DIAGONA ESQUERDA >> DIREITA
            $somaDiagonalEsquerdaDireita += $linhas[$posicaoDiagonalEsquerdaDireita];
            if($posicaoDiagonalEsquerdaDireita < count($linhas)){
                $posicaoDiagonalEsquerdaDireita++;
            }

            #SOMA A DIAGONA DIREITA >> ESQUERDA
            $somaDiagonalDireitaEsquerda += $linhas[count($linhas) - $posicaoDiagonalEsquerdaDireita];
            if($posicaoDiagonalDireitaEsquerda < count($linhas)){
                $posicaoDiagonalDireitaEsquerda++;
            }

            #ARMAZENA A SOMA DE CADA LINHA
            $linha[] = $somalinhas;
    
        }
        
        #RETORNA O 1 SE TODOS OS VALORES FOREM IGUAIS
        $colunas =  count(array_unique($colunas));
        $linhas =  count(array_unique($linha));


        #VERIFICA SE OS VALORES DAS COLUNAS/LINHAS/DIAGONAIS SÃO IGUAIS E RETORNA SE O QUADRADO É OU NÃO PERFEITO !
        if($colunas == 1 && $linhas == 1 && $somaDiagonalDireitaEsquerda == $somaDiagonalEsquerdaDireita){
        
            echo "O Quadrado é Perfeito !";
         
        }else{

            echo "O Quadrado não é Perfeito !";
        }

    }

}

 #CRIA RECEBE O ARGUMENTO QUADRADO.TXT E PASSA COMO PARAMETRO PARA O CONSTRUTOR DA CLASSE;
 new quadradoPerfeito($argv[1]);




