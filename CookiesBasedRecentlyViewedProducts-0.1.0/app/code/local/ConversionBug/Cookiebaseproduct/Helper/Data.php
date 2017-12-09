<?php

class ConversionBug_Cookiebaseproduct_Helper_Data extends Mage_Core_Helper_Abstract {

    const XML_CONFIG_PATH_COOKIEBASEPRODUCT_ENABLED = 'cookies_base_product/general/status';
    const XML_CONFIG_PATH_COOKIEBASEPRODUCT_ENABLED_PRODUCT = 'cookies_base_product/general/enable_product';
    const XML_CONFIG_PATH_COOKIEBASEPRODUCT_ENABLED_CART = 'cookies_base_product/general/enable_cart';
    const COOKIEBASEPRODUCT_ENABLED = 1;

    public function isEnable() {
        $storeId = Mage::app()->getStore()->getStoreId();
        if (self::COOKIEBASEPRODUCT_ENABLED == Mage::getStoreConfig(self::XML_CONFIG_PATH_COOKIEBASEPRODUCT_ENABLED, $storeId))
            return true;

        return false;
    }

    public function isEnableProduct() {
        $storeId = Mage::app()->getStore()->getStoreId();
        if ((self::COOKIEBASEPRODUCT_ENABLED == Mage::getStoreConfig(self::XML_CONFIG_PATH_COOKIEBASEPRODUCT_ENABLED_PRODUCT, $storeId) && $this->isEnable())) {
            return true;
        }
        return false;
    }
    
    public function isEnableCart() {
        $storeId = Mage::app()->getStore()->getStoreId();
        if ((self::COOKIEBASEPRODUCT_ENABLED == Mage::getStoreConfig(self::XML_CONFIG_PATH_COOKIEBASEPRODUCT_ENABLED_CART, $storeId) && $this->isEnable())) {
           return true;
        }
        return false;
    }

}

?>
