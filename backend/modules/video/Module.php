<?php

namespace app\modules\video;

class Module extends \yii\base\Module
{
    /**
     * @var type 
     */
    public $controllerNamespace = 'app\modules\video\controllers';

    /**
     * @var string Images temporary path
     */
    public $imagesTempPath = '@statics/temp/video/images/';

    /**
     * @var string Preview URL
     */
    public $previewUrl = '/statics/video/previews';

    /**
     * @var string Image URL
     */
    public $previewPath = '@statics/web/video/previews/';
    
    /**
     * @var string Preview URL
     */
    public $fileUrl = '/statics/video/files';

    /**
     * @var string Image URL
     */
    public $filePath = '@statics/web/video/files/';


    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
?>