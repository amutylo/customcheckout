<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 11/15/15
 * Time: 22:32
 */
class A2m_Customcheckout_Helper_Data extends Mage_Core_Helper_Abstract
{
    const XML_CHECKOUT_OPTIONS_CUSTOM_CHECKOUT_ENABLED = 'checkout/options/custom_checkout_enabled';
    const CHECKOUT_TYPE_ONEPAGE = 'onepage';
    const CHECKOUT_TYPE_ONESTEP = 'onestep';


    public function customCheckoutEnabled()
    {
        return (bool)Mage::getStoreConfig(self::XML_CHECKOUT_OPTIONS_CUSTOM_CHECKOUT_ENABLED);
    }

    public function getCheckoutType(){
        return (bool)Mage::getStoreConfig(self::XML_CHECKOUT_OPTIONS_CUSTOM_CHECKOUT_TYPE);
    }
}