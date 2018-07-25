<?php

Class buscarProdutosSimilares
{


    public function __construct($produtos, $id){

        #CHAMADA DA FUNÇÃO QUE CALCULA A SIMILARIDADE
        $this->calcularSimilaridade($this->ProdutosFormatados(json_decode(file_get_contents($produtos),true)),$id);

    }

    #FORMATA OS PRODUTOS COM INDICE(ID DO PRODUTO) E RETORNA OS PRODUTOS FORMATADOS
    public function ProdutosFormatados($produtos){

        $produtosformatados = array();

        for ($p = 0; $p < count($produtos['products']); $p++) { 
        
            $produtosformatados[$produtos['products'][$p]['id']] = $produtos['products'][$p];
        }

        return $produtosformatados;

    }


    #CALCULA A SIMILARIDADE UTILIZANDO A FÓRMULA MATEMÁTICA(Distância Euclidiana);
    public function calcularSimilaridade($produtos,$id){

        $produtossimilares = array();

        foreach ($produtos as $key => $value) {

            $d = 0;

          
            for($i = 0; $i < count($produtos[$key]['tagsVector']); $i++){

                $d += pow(($produtos[$id]['tagsVector'][$i] - $produtos[$key]['tagsVector'][$i]),2);
            
            }

            $d += ($produtos[$id]['tagsVector'][count($produtos[$key]['tagsVector']) - 1] - $produtos[$key]['tagsVector'][count($produtos[$key]['tags']) - 1]);

            $s = 1/(1 + sqrt($d));

            #ARMAZENA ID DO PRODUTO E SUA SIMILARIDADE COM O PRODUTO QUE FOI BUSCADO!
            $produtossimilares[$key] = $s;
            
        }

        #REMOVE DO ARRAY O ID DO PRODUTO BUSCADO
        unset($produtossimilares[$id]);
        #ORDERNA DO MAIOR PARA O MENOR COM BASE NO VALOR DA SIMILARIDADE
        arsort($produtossimilares);


        $this->exibirProdutosMaisSimilares($produtossimilares,$produtos,$id);

    }
   

    public function exibirProdutosMaisSimilares($produtossimilares,$produtos,$id){

        $produtosmaissimilares = array();


        #ARMAZENA O ID DO PRODUTO COM BASE NA ORDENAÇÂO DA SIMILARIDADE
        foreach ($produtossimilares as $key => $value) {
            $produtosmaissimilares[] = $key;
        }

        #MOSTRA MENSAGEM DO PRODUTO BUSCADO
        print('Os três produtos mais similares ao produto '.$produtos[$id]['id'].'('.$produtos[$id]['name'].') são:');
    
       
        #EXIBE OS 3 PRODUTOS MAIS SIMILARES
        for($i = 0; $i < 3;$i++){

            print(' - '.$produtos[$produtosmaissimilares[$i]]['id'].' ('.$produtos[$produtosmaissimilares[$i]]['name'].') com S='. $produtossimilares[$produtosmaissimilares[$i]]);
      
        }

    }
 

}

new buscarProdutosSimilares($argv[1],$argv[2]);
