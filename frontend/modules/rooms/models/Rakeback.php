<?php

namespace app\modules\rooms\models;

use Yii;

/**
 * This is the model class for table "{{%rakeback}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $phone
 * @property string $skype
 * @property string $email
 * @property string $comment
 * @property string $type_poker
 * @property integer $fsp
 * @property integer $rooms
 * @property string $about
 * @property string $link
 * @property integer $status_id
 */
class Rakeback extends \yii\db\ActiveRecord {

    public $verifyCode;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%rakeback}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['name', 'email'], 'required'],
            [['fsp', 'rooms', 'status_id'], 'integer'],
            [['type_poker', 'about'], 'string'],
            [['name', 'about'], 'string'],
            [['email'], 'email'],
            [['name', 'type_poker', 'skype', 'email', 'link'], 'string', 'max' => 32],
            ['phone', 'string', 'max' => 20],
            ['comment', 'string', 'max' => 200],
            ['about', 'string', 'max' => 100],
            ['fsp', 'in', 'range' => [0, 1]],
            ['rooms', 'in', 'range' => [0, 1]],
//            ['skype', 'match', 'pattern' => '/^[a-z0-9-_]*$/'],
//            ['type_poker', 'match', 'pattern' => '/^[a-z0-9-_]*$/'],
//            ['phone', 'match', 'pattern' => '/^[0-9-() ]*$/'],
//            ['name', 'match', 'pattern' => '/^[А-ЯЁA-Z-][а-яёa-z-_]*$/', 'message' => Yii::t('ru', 'Name must be begin with a capital letter and does not contain spaces')],
            ['link', 'url', 'defaultScheme' => 'http'],
            [['name', 'email'], 'trim'],
//            ['phone', 'filter', 'filter' => function ($value) {
//                    $sym = array(" ", "(", ")", "-");
//                    $value = str_replace($sym, "", $value);
//                    return $value;
//                }],
            // [[verifyCode]] must be a right captcha code.
            ['verifyCode', 'captcha', 'captchaAction' => '/site/default/captcha']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('ru', 'ID'),
            'name' => Yii::t('ru', 'Name'),
            'phone' => Yii::t('ru', 'Phone'),
            'skype' => Yii::t('ru', 'Skype'),
            'email' => Yii::t('ru', 'Email'),
            'comment' => Yii::t('ru', 'Comment'),
            'type_poker' => Yii::t('ru', 'Type Poker'),
            'fsp' => Yii::t('ru', 'You buy points?'),
            'rooms' => Yii::t('ru', 'Played in partner poker rooms?'),
            'about' => Yii::t('ru', 'How did you hear about Freestylepoker?'),
            'link' => Yii::t('ru', 'Link'),
            'status_id' => Yii::t('ru', 'Status ID'),
            'verifyCode' => Yii::t('ru', 'CONTACT_FORM_ATTR_VERIFY_CODE'),
        ];
    }

    public function attributeHints() {
        return [
        ];
    }

    public function beforeValidate() {
        if (!($this->phone || $this->skype)) {
            $this->addError('skype', Yii::t('ru', 'You are required to specify either the phone or skype'));
        }
        return parent::beforeValidate();
    }

}
