<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%bookclass}}".
 *
 * @property integer $id
 * @property string $class
 */
class Bookclass extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%bookclass}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['class'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', '主键'),
            'class' => Yii::t('app', 'Class'),
        ];
    }
}
