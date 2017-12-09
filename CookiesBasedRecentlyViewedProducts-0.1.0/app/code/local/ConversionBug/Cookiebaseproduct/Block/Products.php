<?php

class ConversionBug_Cookiebaseproduct_Block_Products extends Mage_Catalog_Block_Product_View {

    protected function _construct() {
        $helper = Mage::helper('cbcookiebaseproduct');
        if ($helper->isEnable()) {
            $cookie = Mage::getSingleton('core/cookie');
            $_product = $this->getProduct();
            if ($cookie->get('mnm_recent_products')) {
                $recent_products = $cookie->get('mnm_recent_products');
                $current_products = explode(",", $cookie->get('mnm_recent_products'));

                if (!in_array($_product->getId(), $current_products)) {
                    $recent_products = $recent_products . "," . $_product->getId();
                }
                # $cookie->get('recent_product');
                $cookie->set('mnm_recent_products', $recent_products, 86400, '/');
            } else {
                $recent_products = array();
                $recent_products = $_product->getId();
                $cookie = Mage::getSingleton('core/cookie');
                $cookie->set('mnm_recent_products', $recent_products, 86400, '/');
            }
        }
        parent::_construct();
    }

}
