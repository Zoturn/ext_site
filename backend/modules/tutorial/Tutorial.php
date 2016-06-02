<?php

namespace app\modules\tutorial;

/**
 * tutorial module definition class
 */
class Tutorial extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\tutorial\controllers';
    
    /**
     * @inheritdoc
     */
    public static $name = 'tutorial';

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
    public $previewPath = '@statics/web/tutorial/logo/';

    /**
     * @var string Image path
     */
    public $imagePath = '@statics/web/tutorial/logo/';

    /**
     * @var string Files path
     */
    public $filePath = '@statics/web/tutorial/files';

    /**
     * @var string Files path
     */
    public $contentPath = '@statics/web/tutorial/content';

    /**
     * @var string Images temporary path
     */
    public $logoTempPath = '@statics/temp/tutorial/logo/';

    /**
     * @var string Preview URL
     */
    public $previewUrl = '/statics/tutorial/logo';

    /**
     * @var string Image URL
     */
    public $imageUrl = '/statics/tutorial/logo';

    /**
     * @var string Files URL
     */
    public $fileUrl = '/statics/tutorial/files';

    /**
     * @var string Files URL
     */
    public $contentUrl = '/statics/tutorial/content';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
