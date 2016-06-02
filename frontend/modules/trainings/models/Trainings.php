<?php

namespace app\modules\trainings\models;

use Yii;
use app\modules\video\models\VideoType;
use yii\helpers\ArrayHelper;
use app\modules\video\models\VideoLimits;
use app\modules\trainings\models\TrainingsUsr;
use nill\users\models\frontend\User;
use app\modules\trainings\traits\ModuleTrait;
use nill\fsp\models\frontend\Fspstat;
use nill\fsp\models\frontend\Giftstat;
use yii\data\ActiveDataProvider;
use yii\base\UserException;

/**
 * Class Trainings
 * @package app\modules\trainings\models
 * Trainings model.
 *
 * @property integer $id
 * @property string $title
 * @property string $url
 * @property string $description
 * @property integer $val
 * @property integer $author_id
 * @property string $alias
 * @property integer $date
 * @property string $password
 * @property integer $type_id
 * @property integer $limit_id
 * @property integer $time_start
 * @property integer $time_end
 */
class Trainings extends \yii\db\ActiveRecord {

    use ModuleTrait;

    /** Unpublished status * */
    const STATUS_UNPUBLISHED = 0;

    /** Published status * */
    const STATUS_PUBLISHED = 1;
    const GROUP_TRAINING = 2;
    const GIFT_CATEGORY = 1;
    const GIFT_CATEGORY_CANCELED = 0;

    public $message;
    public $author;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%trainings}}';
    }

    /**
     * @inheritdoc
     */
    public static function find() {
        return new TrainingsQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['title', 'url', 'description', 'author_id', 'alias', 'date', 'time_start', 'time_end'], 'required'],
            [['description', 'meta'], 'string'],
            [['date'], 'safe'],
            [['val', 'author_id', 'type_id', 'limit_id', 'stat_f'], 'integer'],
            [['title'], 'string', 'max' => 128],
            [['url', 'alias', 'password'], 'string', 'max' => 256]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('ru', 'ID'),
            'title' => Yii::t('ru', 'Title'),
            'url' => Yii::t('ru', 'Url'),
            'description' => Yii::t('ru', 'Description'),
            'val' => Yii::t('ru', 'Val'),
            'author_id' => Yii::t('ru', 'Author ID'),
            'alias' => Yii::t('ru', 'Alias'),
            'date' => Yii::t('ru', 'Date'),
            'password' => Yii::t('ru', 'Password'),
            'type_id' => Yii::t('ru', 'Type ID'),
            'limit_id' => Yii::t('ru', 'Limit ID'),
            'time_start' => Yii::t('ru', 'Time Start'),
            'time_end' => Yii::t('ru', 'Time End'),
        ];
    }

    public function beforeSave($insert) {
        parent::beforeSave($insert);
        // установить правильный формат даты
        $this->date = Yii::$app->formatter->asTimestamp($this->date);
        // сохраним владельца
        return $this->author_id = Yii::$app->user->id;
    }

    /**
     * Проверка авторства
     * @return boolean
     */
    public function get_isAuthor() {
        if ($this->author_id == Yii::$app->user->id) {
            return true;
        }
    }

    /**
     * Связь автор-пользователь
     * @return type
     */
    public function getUser() {
        // VideoUsr has_many Video via Video.video_id -> id
        return $this->hasOne(User::className(), ['id' => 'author_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTargetuser() {
        return $this->hasOne(User::className(), ['id' => 'target_user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLimit() {
        return $this->hasOne(VideoLimits::className(), ['id' => 'limit_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType() {
        return $this->hasOne(VideoType::className(), ['id' => 'type_id']);
    }

    /**
     * Получить список типов
     * @return array
     */
    public function getTyper() {
        $models = VideoType::find()->asArray()->all();
        $result = ArrayHelper::map($models, 'id', 'name');
        return $result;
    }

    /**
     * Получить текущее лимиты
     * @param type $type_id
     * @return type
     */
    public function getCurrentLimits($type_id) {
        $model = VideoLimits::find()->where(['type_id' => $type_id])->asArray()->all();
        $limits = ArrayHelper::map($model, 'id', 'name');
        return $limits;
    }

    /**
     * 
     * @param type $id
     * @return boolean
     * 
     * Функция проверяет было ли видео уже куплено пользователем
     */
    public function get_isBuy() {

        $if_buy_video = TrainingsUsr::findOne(['training_id' => $this->id, 'user_id' => Yii::$app->user->id]);

        if ($if_buy_video === NULL) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Получить список всех пользователей для вывода в форме
     * @return array
     */
    public function getAllUsers() {
        $model = User::find()->asArray()->all();
        $result = ArrayHelper::map($model, 'id', 'username');
        return $result;
    }

    /**
     * Покупка видео
     * @param type $id
     * @return type
     * @throws UserException
     */
    public function buy() {
        $id = $this->id;
        // Проверка было ли видео куплено ранее
        if ($this->_isBuy === false) {

            // Определяем стоимость видео
            $video_model = self::findOne($id);
            $val = $video_model->val;

            // Получаем Модель и сумму пользователя
            $user = User::findOne(Yii::$app->user->id);
            $gold = $user->gold;

            // Если сумма больше или равна стоимости
            // покупка осуществляется
            if ($gold >= $val) {

                // Вычитаем
                $buy = $gold - $val;

                // Создаем экземпляр модели Тренировка-Пользователь
                $trainingsusr = new TrainingsUsr();

                // Присваевам атрибуты и сохраняем (делаем запись)
                $trainingsusr->training_id = $id;
                $trainingsusr->user_id = Yii::$app->user->id;
                $trainingsusr->save();

                // Обновляем атрибут gold и присваиваем результат вычитания
                $user->updateAttributes(['gold' => $buy]);

                // Обновляем статистику
                $comment = \Yii::t('ru', 'Training is buyed');
                $val_dec = -$val;
                $stat = new Fspstat();
                $stat->stat_update(0, $val_dec, $id, $comment, self::GROUP_TRAINING, Yii::$app->user->id, $this->author_id, $this->stat_f);

                return $this->message = \Yii::t('ru', 'Successful buyed!');
            } else {
                return $this->message = \Yii::t('ru', 'Short of money!');
            }
        } else {
            throw new UserException(\Yii::t('ru', 'Error: this training is buyed!'));
        }
    }

    /**
     * Подарить тренировку
     * @param type $request
     * @return string
     */
    public static function _gift($request) {
        // Создаем экземпляр модели Видео-Пользователь
        $trainingsusr = new TrainingsUsr();
        $isset_trainingsusr = $trainingsusr->findOne(['training_id' => $request['id'], 'user_id' => $request['author']]);

        if ($isset_trainingsusr === NULL) {
            // Присваевам атрибуты и сохраняем (делаем запись)
            $trainingsusr->training_id = $request['id'];
            $trainingsusr->user_id = $request['author'];
            $trainingsusr->save();

            // Обновляем статистику
            $comment = \Yii::t('ru', 'Training as a gift: ') . $request['id'];
            $giftstat = new Giftstat();
            $giftstat->gift_stat_update($request['author'], $request['id'], $comment, self::GIFT_CATEGORY, self::GROUP_TRAINING);

            return \Yii::t('ru', 'Gift has been sent!');
        } else {
            return \Yii::t('ru', 'Gift canceled!');
        }
    }

    /**
     * Отмена покупки видео
     * @param integer $id
     */
    public function _buy_cancel($target_user_id) {

        $id = $this->id;

        // Находим запись Тренировка-Пользователь
        $trainingsusr = TrainingsUsr::findOne(['training_id' => $id, 'user_id' => $target_user_id]);

        // Убедимся что видео было куплено
        if ($trainingsusr) {
            $video_model = self::findOne($id);

            // Удаляем запись
            $trainingsusr->delete();

            // Получаем Модель и сумму пользователя
            $user = User::findOne($target_user_id);
            $gold = $user->gold;

            // Получаем стоимость видео и возвращаем пользователю сумму
            $stat = new Fspstat();
            $stat_query = $stat->findOne(['target_id' => $id, 'target_user_id' => $target_user_id, 'group_id' => self::GROUP_TRAINING]);

            // Отмена сработает если сумма вычиталась
            if ($stat_query->fsp < 0) {

                $val = abs($stat_query->fsp);
                $sum = $val + $gold;

                $user->updateAttributes(['gold' => $sum]);

                // Обновляем статистику
                $comment = \Yii::t('ru', 'Training canceled');
                $stat->stat_update(Yii::$app->user->id, $val, $id, $comment, self::GROUP_TRAINING, $target_user_id, $this->author_id, $this->stat_f);

                Yii::$app->session->setFlash(
                        'success', \Yii::t('ru', 'Cancel is executed successfully'));
            } else {
                throw new UserException(\Yii::t('ru', 'Error'));
            }
        } else {
            Yii::$app->session->setFlash(
                    'danger', \Yii::t('ru', 'Error: This training was not buyed or buying was canceled before'));
        }
    }

    /**
     * Отмена дарения видео
     * @param integer $id
     */
    public function _gift_cancel($id, $to_id) {

        // Находим запись Тренировка-Пользователь
        $trainingsusr = TrainingsUsr::findOne(['training_id' => $id, 'user_id' => $to_id]);

        // Убедимся что видео подарено
        if ($trainingsusr) {
            // Удаляем запись
            $trainingsusr->delete();

            // Обновляем статистику
            $comment = \Yii::t('ru', 'Gift training canceled: ') . $id;
            $giftstat = new Giftstat();
            $giftstat->gift_stat_update($to_id, $id, $comment, self::GIFT_CATEGORY_CANCELED, self::GROUP_TRAINING);

            Yii::$app->session->setFlash(
                    'success', \Yii::t('ru', 'Cancel is executed successfully'));
        } else {
            Yii::$app->session->setFlash(
                    'danger', \Yii::t('ru', 'Error: Gift is not found or was canceled'));
        }
    }

    /**
     * Статистика о покупках видео
     * @param type $id
     * @return ActiveDataProvider
     */
    public function _stat($id) {
        $query = Fspstat::find()
                ->where(['target_id' => $id, 'group_id' => self::GROUP_TRAINING]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        return $dataProvider;
    }

    /**
     * Статистика дарения видео
     * @param type $id
     * @return ActiveDataProvider
     */
    public function _stat_gift($id) {
        $query = \nill\fsp\models\frontend\Giftstat::find()
                ->where(['target_id' => $id, 'group_id' => self::GROUP_TRAINING]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        return $dataProvider;
    }

}
