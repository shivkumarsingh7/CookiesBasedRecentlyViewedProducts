<?php

class ConversionBug_Cookiebaseproduct_IndexController extends Mage_Core_Controller_Front_Action {

    public function IndexAction() {
        $this->loadLayout();
        $storeName = Mage::app()->getStore()->getName();
        $this->getLayout()->getBlock("head")->setTitle($this->__("%s- Your Browsing History", $storeName));
        $breadcrumbs = $this->getLayout()->getBlock("breadcrumbs");
        $breadcrumbs->addCrumb("home", array(
            "label" => $this->__("Home"),
            "title" => $this->__("Home"),
            "link" => Mage::getBaseUrl()
        ));
        $breadcrumbs->addCrumb("titlename", array(
            "label" => $this->__("Your Browsing History"),
            "title" => $this->__("Your Browsing History")
        ));
        $this->renderLayout();
    }

    public function removeAction() {
        $id = $this->getRequest()->getParam('id');
        $cookie = Mage::getSingleton('core/cookie');
        $recent_products = $cookie->get('mnm_recent_products');
        $current_products = explode(",", $cookie->get('mnm_recent_products'));

        if (($key = array_search($id, $current_products)) !== false) {
            unset($current_products[$key]);
            $recent_products = implode(",", $current_products);
            $cookie->set('mnm_recent_products', $recent_products, 86400, '/');
            Mage::getSingleton('core/session')->addSuccess("Product successfuly removed from your browsing history.");
        }
        $this->_redirect('*/*/');
    }

    public function removeallAction() {
        $cookie = Mage::getSingleton('core/cookie');
        $cookie->set('mnm_recent_products', '', 86400, '/');
        Mage::getSingleton('core/session')->addSuccess("All Product successfuly removed from your browsing history.");
        $this->_redirect('*/*/');
    }

}
