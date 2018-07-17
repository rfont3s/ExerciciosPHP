<?php

Class produtosSimilares{


    public function __construct($produtos){
        $this->setTagsVector(json_decode(file_get_contents($produtos), true));
    }

    public function getTagsProdutos()
    {

        $tags = [
            'neutro',
            'veludo',
            'couro',
            'basics',
            'festa',
            'workwear',
            'inverno',
            'boho',
            'estampas',
            'balada',
            'colorido',
            'casual',
            'liso',
            'moderno',
            'passeio',
            'metal',
            'viagem',
            'delicado',
            'descolado',
            'elastano'
        ];

        return $tags;
    }


    #ADICIONA NOVO ÍNDICE NO ARRAY "TAGSVECTOR"
    public function setTagsVector($produtos)
    {

        foreach($produtos['products'] as $key => $item){

            foreach($this->getTagsProdutos() as $valor){

                $produtos['products'][$key]['tagsVector'][] = in_array($valor,$item['tags']) ? 1 : 0;
                
            }

        }

        $this->gerarProdutosSaida($produtos);

    }

    #GERA O ARQUIVO PRODUTOS-SAIDA.TXT COM o NOVO INDICE "TAGSVECTOR"
    public function gerarProdutosSaida($produtos)
    {
        $file = fopen('../Exercicio3/produtos.txt', 'w');
        fwrite($file, json_encode($produtos));
        fclose($file);

    }


}

new produtosSimilares($argv[1]);







