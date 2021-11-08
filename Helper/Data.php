<?php

namespace Mageowl\Helper\Helper;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    /**
     * Retrieve if extension is enabled
     *
     * @return bool
     */
    public function isEnable()
    {
        return $this->scopeConfig->getValue('mageowl/config/enable');
    }

    public function getFirebaseConfigJson()
    {
        return $this->scopeConfig->getValue('mageowl/config/firebase_config_json');
    }
}