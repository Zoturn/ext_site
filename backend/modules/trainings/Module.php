<?php

namespace app\modules\trainings;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\trainings\controllers';
    
    /**
     * @var string Images temporary path
     */
    public $imagesTempPath = '@statics/temp/coaching/images/';

    /**
     * @var string Preview URL
     */
    public $previewUrl = '/statics/coaching/previews';

    /**
     * @var string Image URL
     */
    public $previewPath = '@statics/web/coaching/previews/';
    
    /**
     * @var boolean Whether posts need to be moderated before publishing
     */
    public $moderation = false;

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
