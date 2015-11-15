<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 11/15/15
 * Time: 22:37
 */

class A2m_Customcheckout_Model_Customcheckout extends Mage_Checkout_Model_Type_Onepage
{
    public function __construct()
    {
        //instead of
        //$this->_helper = Mage::helper('checkout');
        parent::__construct();

        $this->_helper = Mage::helper('a2m_customcheckout');

    }

}