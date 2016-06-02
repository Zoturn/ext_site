<?php

namespace app\modules\soft\traits;

use Yii;

trait ModuleTrait {

    /**
     * @var \vova07\blogs\Module|null Module instance
     */
    private $_module;

    /**
     * @return \vova07\blogs\Module|null Module instance
     */
    public function getModule() {
        if ($this->_module === null) {
            $this->_module = Yii::$app->getModule('faq');
        }
        return $this->_module;
    }

}
