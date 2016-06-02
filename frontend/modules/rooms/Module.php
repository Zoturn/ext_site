<?php

namespace app\modules\rooms;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\rooms\controllers';
    
    /**
     * @var integer Posts per page
     */
    public $recordsPerPage = 20;

    /**
     * @var boolean Whether posts need to be moderated before publishing
     */
    public $moderation = true;

    /**
     * @var string Preview path
     */
    public $previewPath = '@statics/web/rooms/previews/';

    /**
     * @var string Image path
     */
    public $imagePath = '@statics/web/rooms/images/';

    /**
     * @var string Files path
     */
    public $contentPath = '@statics/web/rooms/content';

    /**
     * @var string Images temporary path
     */
    public $imagesTempPath = '@statics/temp/rooms/images/';

    /**
     * @var string Preview URL
     */
    public $previewUrl = '/statics/rooms/previews';

    /**
     * @var string Image URL
     */
    public $imageUrl = '/statics/rooms/images';

    /**
     * @var string Files URL
     */
    public $contentUrl = '/statics/rooms/content';

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
