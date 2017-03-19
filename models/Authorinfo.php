<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%authorinfo}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $info
 * @property string $img
 * @property string $works
 */
class Authorinfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%authorinfo}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['info', 'img', 'works'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', '作者id'),
            'name' => Yii::t('app', '作者名字'),
            'info' => Yii::t('app', '作者详情'),
            'img' => Yii::t('app', '作者头像'),
            'works' => Yii::t('app', '作者作品'),
        ];
    }
}
