<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 30.07.2017
 * Time: 6:53
 */

namespace app\modules\api\models;


class ThemeFile extends \app\models\ThemeFile
{
    public function rules()
    {
        return [
            [['file_id', 'type', 'name', 'unique'], 'required'],
            [['theme_id', 'file_id', 'type'], 'integer'],
            [['file_id'], 'exist', 'skipOnError' => true, 'targetClass' => File::className(), 'targetAttribute' => ['file_id' => 'id']],
            [['theme_id'], 'exist', 'skipOnError' => true, 'targetClass' => Theme::className(), 'targetAttribute' => ['theme_id' => 'id']],
        ];
    }

    public $unique;

    public function init()
    {
        $this->unique = \Yii::$app->security->generateRandomString(32);
        parent::init(); // TODO: Change the autogenerated stub
    }
}