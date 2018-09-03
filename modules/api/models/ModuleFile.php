<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 11.09.2017
 * Time: 13:06
 */

namespace app\modules\api\models;


class ModuleFile extends \app\models\ModuleFile
{
    public function rules()
    {
        return [
            [['file_id', 'type', 'name', 'unique'], 'required'],
            [['module_id', 'file_id', 'type'], 'integer'],
            [['file_id'], 'exist', 'skipOnError' => true, 'targetClass' => File::className(), 'targetAttribute' => ['file_id' => 'id']],
            [['module_id'], 'exist', 'skipOnError' => true, 'targetClass' => Module::className(), 'targetAttribute' => ['module_id' => 'id']],
        ];
    }

    public $unique;

    public function init()
    {
        $this->unique = \Yii::$app->security->generateRandomString(32);
        parent::init(); // TODO: Change the autogenerated stub
    }
}