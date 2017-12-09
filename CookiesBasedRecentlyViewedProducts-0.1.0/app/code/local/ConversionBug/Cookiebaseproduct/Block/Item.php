<?php

class ConversionBug_Cookiebaseproduct_Block_Item extends Mage_Catalog_Block_Product_List {

    protected function _getProductCollection(){
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

        return $collection;
    }
}
