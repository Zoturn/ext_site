<?php

namespace app\modules\rooms\models;

use Yii;
use yii\helpers\ArrayHelper;
use vova07\fileapi\behaviors\UploadBehavior;
use app\modules\rooms\traits\ModuleTrait;

/**
 * This is the model class for table "{{%rooms}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $net
 * @property string $alias
 * @property string $snippet
 * @property string $promo
 * @property string $logo
 * @property string $content
 * @property string $info
 * @property string $instruction
 * @property string $bonus
 * @property integer $sortOrder
 */
class Rooms extends \yii\db\ActiveRecord {

    use ModuleTrait;

    const ACC_STAT = 1;

    public $nickname;

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'uploadBehavior' => [
                'class' => UploadBehavior::className(),
                'attributes' => [
                    'logo' => [
                        'path' => $this->module->previewPath,
                        'tempPath' => $this->module->imagesTempPath,
                        'url' => $this->module->previewUrl
                    ],
                ]
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%rooms}}';
    }

    /**
     * INIT
     */
    public function init() {
        parent::init();
        if ($this->isNewRecord) {
            $this->instruction = '<a href="fff">LINK</a>';
        }
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['title', 'net', 'alias', 'snippet', 'content', 'info', 'instruction', 'bonus'], 'required'],
            [['snippet', 'meta', 'content', 'info', 'instruction', 'page_title'], 'string'],
            [['sortOrder'], 'integer'],
            [['promo', 'logo'], 'safe'],
            [['title', 'net', 'alias', 'bonus'], 'string', 'max' => 100],
//            [['promo'], 'string', 'max' => 128],
//            [['logo'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('ru', 'ID'),
            'title' => Yii::t('ru', 'Title'),
            'net' => Yii::t('ru', 'Net'),
            'alias' => Yii::t('ru', 'Alias'),
            'snippet' => Yii::t('ru', 'Snippet'),
            'promo' => Yii::t('ru', 'Promo'),
            'logo' => Yii::t('ru', 'Logo'),
            'content' => Yii::t('ru', 'Content'),
            'info' => Yii::t('ru', 'Info'),
            'instruction' => Yii::t('ru', 'Instruction'),
            'bonus' => Yii::t('ru', 'Bonus'),
            'sortOrder' => Yii::t('ru', 'Sort Order'),
        ];
    }

    /**
     * Получить все акции
     * @return type
     */
    public function getPromo() {
        $model = RoomsPromo::find()->asArray()->all();
        $promo = ArrayHelper::map($model, 'id', 'name');
        //$promo = ArrayHelper::getColumn($model, 'name');
        return $promo;
    }

    /**
     * Проверка привязки аккаунта
     * @return boolean
     */
    public function getIsAccount() {
        $acc = RoomsAcc::findOne(['user_id' => \Yii::$app->user->id, 'room_id' => $this->id]);
        if ($acc) {
            return true;
        }
    }

    /**
     * Проверка статуса привязки аккаунта
     * @return nickname or FALSE 
     */
    public function getAccount_status() {
        $status = RoomsAcc::findOne([
                    'user_id' => \Yii::$app->user->id,
                    'room_id' => $this->id,
                    'status_id' => self::ACC_STAT]);
        if ($status) {
            return $status->nickname;
        } else {
            return FALSE;
        }
    }

    public function beforeSave($insert) {
        parent::beforeSave($insert);

        if ($this->promo != null) {
            return $this->promo = implode(',', $this->promo);
        }
    }

    public function afterFind() {
        parent::afterFind();
        return $this->promo = explode(',', $this->promo);
    }

}
