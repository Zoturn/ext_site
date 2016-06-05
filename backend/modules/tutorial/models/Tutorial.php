<?php

namespace app\modules\tutorial\models;

use vova07\fileapi\behaviors\UploadBehavior;
use Yii;

/**
 * This is the model class for table "{{%tutorial}}".
 *
 * @property integer $id
 * @property string $title
 * @property integer $category_id
 * @property string $description_short
 * @property string $description
 * @property string $preview_url
 * @property integer $status
 * @property string $alias
 * @property integer $sort_order
 * @property integer $date
 * @property integer $views
 */
class Tutorial extends \yii\db\ActiveRecord {

    public $previewPath = '@statics/web/tutorial/previews/';
    public $imagesTempPath = '@statics/temp/tutorial/images/';
    public $previewUrl = '/statics/tutorial/previews';

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%tutorial}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'uploadBehavior' => [
                'class' => UploadBehavior::className(),
                'attributes' => [
                    'preview_url' => [
                        'path' => $this->previewPath,
                        'tempPath' => $this->imagesTempPath,
                        'url' => $this->previewUrl
                    ],
                ]
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['title', 'category_id', 'description_short', 'description', 'preview_url', 'status', 'alias', 'date'], 'required'],
            [['category_id', 'status', 'sort_order', 'views'], 'integer'],
            [['description_short', 'description'], 'string'],
            [['title', 'alias'], 'string', 'max' => 128],
            [['preview_url'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'category_id' => 'Category ID',
            'description_short' => 'Description Short',
            'description' => 'Description',
            'preview_url' => 'Preview Url',
            'status' => 'Status',
            'alias' => 'Alias',
            'sort_order' => 'Sort Order',
            'date' => 'Date',
            'views' => 'Views',
        ];
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert) {
        if (parent::beforeSave($insert)) {
            if ($this->date) {
                $this->date = Yii::$app->formatter->asTimestamp($this->date);
            }
            return true;
        } else {
            return false;
        }
    }

}
