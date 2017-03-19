<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%comments}}".
 *
 * @property integer $id
 * @property string $time
 * @property integer $score
 * @property string $content
 */
class Comments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%comments}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'score'], 'integer'],
            [['time'], 'safe'],
            [['content'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', '评论id'),
            'time' => Yii::t('app', '评论时间'),
            'score' => Yii::t('app', '评论分数'),
            'content' => Yii::t('app', '评论内容'),
        ];
    }
}
