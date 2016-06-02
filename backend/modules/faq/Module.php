<?php

namespace app\modules\faq;

class Module extends \yii\base\Module
{
    /**
     * @var type 
     */
    public $controllerNamespace = 'app\modules\faq\controllers';
    
    /**
     * @var string Files path
     */
    public $contentPath = '@statics/web/faq/content';
    
    /**
     * @var string Files URL
     */
    public $contentUrl = '/statics/faq/content';


    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
?>