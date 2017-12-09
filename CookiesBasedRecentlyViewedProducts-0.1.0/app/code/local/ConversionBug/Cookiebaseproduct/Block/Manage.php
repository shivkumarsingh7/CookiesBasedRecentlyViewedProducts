<?php

class ConversionBug_Cookiebaseproduct_Block_Manage extends Mage_Catalog_Block_Product_List {

    public function checkProductExist(){
        $cookie = Mage::getSingleton('core/cookie');
        $current_products = explode(",", $cookie->get('mnm_recent_products'));
        
        return count(array_filter($current_products, 'strlen'));
    }
    protected function _getProductCollection() {
        if (is_null($this->_productCollection)) {

            $cookie = Mage::getSingleton('core/cookie');
            $helper = Mage::helper('cbcookiebaseproduct');
            if ($helper->isEnable()) {
                $current_products = explode(",", $cookie->get('mnm_recent_products'));
            }
            $collection = Mage::getResourceModel('catalog/product_collection');
            $collection->addAttributeToSelect(Mage::getSingleton('catalog/config')->getProductAttributes())
                    ->addAttributeToFilter('entity_id', array('in' => $current_products))
                    ->addMinimalPrice()
                    ->addFinalPrice()
                    ->addTaxPercents()
                    ->addUrlRewrite();

            Mage::getSingleton('catalog/product_status')->addVisibleFilterToCollection($collection);
            Mage::getSingleton('catalog/product_visibility')->addVisibleInCatalogFilterToCollection($collection);
            $this->_productCollection = $collection;
        }
        return $this->_productCollection;
    }

}
