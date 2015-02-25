<?php
class Mage_Elder_Model_Observer{	

	//$observer
	public function catalog_product_save(Varien_Event_Observer $observer){

		$productthis = $observer->getProduct();	
		$product= Mage::getModel('catalog/product')->load($productthis->getId());
		//$product->setData('descricao_marketplaces', 'valorDispw')->getResource()->saveAttribute($product, 'descricao_marketplaces');
		//Mage::getSingleton('core/session')->addError('produto:'.$product->getData('descricao_marketplaces'));			
	}


	

	public function catalog_product_save_toafter(Varien_Event_Observer $observer){
		//Mage::getSingleton('core/session')->addError();		
		$productthis = $observer->getProduct();	
		
		try{
			$product= Mage::getModel('catalog/product')->load($productthis->getId());
			$newatributo = "Deixe o seu ambiente mais sofisticado com essa luminária da ".$product->getAttributeText('manufacturer').", feita de ".$product->getData('material').", na medida de ".$product->getData('medidas').".";
	
			$product->setData('description', $newatributo)->getResource()->saveAttribute($product, 'description');
			$product->setData('descricao_marketplaces', $newatributo)->getResource()->saveAttribute($product, 'descricao_marketplaces');
			}catch(Exeption $e){
			//Mage::getSingleton('core/session')->addSuccess('alterado para: '.$product->getData('descricao_marketplaces')); 
				Mage::getSingleton('core/session')->addError('Erro : '.$e);			
			}
	}
	
}
?>