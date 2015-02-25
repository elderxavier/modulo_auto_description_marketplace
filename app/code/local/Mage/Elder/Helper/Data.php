<?php

class Mage_Elder_Helper_Data extends Mage_Core_Helper_Abstract {
	public function GeraPlan(){
		//$data = date("d-m-y");
		 $file_path = 'atualiza_atributo_marketpalce.csv';  
      
      
    // Cria uma variável dados com valor null  
    $dados = '';  
      
      
    // cabecalho da planilha
    $dados .= 'sku';  
	$dados .= ';';
	$dados .= 'description';	
	$dados .= ';';
	$dados .= 'descricao_marketplaces';
    $dados .="\n";  
      
    // Recebe e armazena na variável "dados" todos os Valores a constar no arquivo (oé necessário para quebrar a linha)  
    
	foreach(Mage::getModel('catalog/product')->getCollection() as $productid) {
		$product = Mage::getModel('catalog/product')->load($productid->getId());
		$newatributo = "Deixe o seu ambiente mais sofisticado com essa luminária da ".$product->getAttributeText('manufacturer').", feita de ".$product->getData('material').", na medida de ".$product->getData('medidas').".";		
		//$product->setData("descricao_marketplaces", $newatributo);			               
		//$product->save();
		
		$dados .= $product->getData("sku"); 
		$dados .=";";
		$dados .=$newatributo;
		$dados .=";";
		$dados .=$newatributo;
		//$dados .=$product['manufacturer'];
		$dados .="\n";  		
	} 
  
      
    // Verifica se vc tem permissão de leitura e escrita neste diretorio  
    if(fwrite($file=fopen($file_path,'w+'),$dados)) {  
    fclose($file);  
    echo "Arquivo gravado com sucesso! ";  
    ?>  
      
    <!-- Cria um link para download do arquivo -->  
    <a href="http://www.e-lustre.com.br/atualiza_atributo_marketpalce.csv">Clique aqui</a> para realizar o download do arquivo .CSV  
      
    <?  
    } else {  
    echo "Problemas ao gerar o arquivo, tente novamente!";  
    }  
		
	}
}
?>