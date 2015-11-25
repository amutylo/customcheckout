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

    /**
     * Initialize quote state to be valid for one page checkout
     *
     * @return Mage_Checkout_Model_Type_Onepage
     */
    public function initCheckout()
    {
        $checkoutHelper = $this->_getHelper();
        if($checkoutHelper::CHECKOUT_TYPE_ONEPAGE == $checkoutHelper->getCheckoutType()){
            $checkout = $this->getCheckout();
            $customerSession = $this->getCustomerSession();
            if (is_array($checkout->getStepData())) {
                foreach ($checkout->getStepData() as $step=>$data) {
                    if (!($step==='login' || $customerSession->isLoggedIn() && $step==='billing')) {
                        $checkout->setStepData($step, 'allow', false);
                    }
                }
            }
        }


        $quoteSave = false;
        $collectTotals = false;

        /**
         * Reset multishipping flag before any manipulations with quote address
         * addAddress method for quote object related on this flag
         */
        if ($this->getQuote()->getIsMultiShipping()) {
            $this->getQuote()->setIsMultiShipping(false);
            $quoteSave = true;
        }

        /**
         *  Reset customer balance
         */
        if ($this->getQuote()->getUseCustomerBalance()) {
            $this->getQuote()->setUseCustomerBalance(false);
            $quoteSave = true;
            $collectTotals = true;
        }
        /**
         *  Reset reward points
         */
        if ($this->getQuote()->getUseRewardPoints()) {
            $this->getQuote()->setUseRewardPoints(false);
            $quoteSave = true;
            $collectTotals = true;
        }

        if ($collectTotals) {
            $this->getQuote()->collectTotals();
        }

        if ($quoteSave) {
            $this->getQuote()->save();
        }

        /*
        * want to load the correct customer information by assigning to address
        * instead of just loading from sales/quote_address
        */
        $customer = $customerSession->getCustomer();
        if ($customer) {
            $this->getQuote()->assignCustomer($customer);
        }
        return $this;
    }

    protected function _getHelper(){
        return Mage::helper('a2m_customcheckout');
    }
}