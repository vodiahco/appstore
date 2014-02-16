<?php

namespace DDataAppStore\Entity;
use DDataAppStore\Base\StorageEntityInterface;
/**
 * Description of AppStore
 *
 * @author victor
 */
class AppStore implements StorageEntityInterface {
    public $returnUrl;
    
    
    public function getReturnUrl() {
        return $this->returnUrl;
    }

    public function setReturnUrl($returnUrl) {
        $this->returnUrl = $returnUrl;
    }


}
