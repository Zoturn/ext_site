<?php

namespace app\modules\rooms;

use Yii;
use yii\helpers\Url;

class Module extends \yii\base\Module {

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
    public $contentUrl;

    /**
     * @var string Files URL
     */
    public $fileUrl = '/statics/rooms/files';

    /**
     * @var string Files path
     */
    public $filePath = '@statics/web/rooms/files';

    /**
     * @var string E-mail address from that will be sent the module messages
     */
    public $robotEmail;

    /**
     * @var \yii\swiftmailer\Mailer Mailer instance
     */
    private $_mail;

    public function init() {
        parent::init();

        $_url = str_replace(Yii::$app->homeUrl, '', Url::home(true));
        $this->contentUrl = $_url . '/statics/rooms/content';
    }

    /**
     * @return \yii\swiftmailer\Mailer Mailer instance with predefined templates.
     */
    public function getMail() {
        if ($this->_mail === null) {
            $this->_mail = Yii::$app->getMailer();
            $this->_mail->htmlLayout = '@app/modules/rooms/mails/layouts/html';
            $this->_mail->textLayout = '@app/modules/rooms/mails/layouts/text';
            $this->_mail->viewPath = '@app/modules/rooms/mails/views';
            $this->_mail->messageConfig['from'] = Yii::$app->params['adminEmail'];
        }
        return $this->_mail;
    }

}
