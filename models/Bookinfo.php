<?php

namespace app\models;

use Yii;
use yii\db\Query;
use app\models\CommonSetting;
/**
 * This is the model class for table "bookinfo".
 *
 * @property integer $id
 * @property string $dec
 * @property integer $count
 * @property string $imgurl
 * @property string $downurl
 * @property integer $class_id
 */
class Bookinfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bookinfo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'count', 'class_id'], 'integer'],
            [['dec', 'imgurl', 'downurl'], 'string', 'max' => 255],
            [['class_id'], 'exist', 'skipOnError' => true, 'targetClass' => Bookclass::className(), 'targetAttribute' => ['class_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', '书籍id'),
            'dec' => Yii::t('app', '书籍描述'),
            'count' => Yii::t('app', '书本点击次数'),
            'imgurl' => Yii::t('app', '书本封面地址'),
            'downurl' => Yii::t('app', '书本下载地址'),
            'class_id' => Yii::t('app', 'Class ID'),
        ];
    }

/**
 * 获取书籍列表  排序按照书籍点击数排序
 * @method bookList
 * @return 数组
 */
    public function bookList(){
        $query  = new Query();
        $query->select('*')
                      ->from('bookinfo')
                      ->orderBy("count desc");
                    //   ->andWhere('0 = 0 ');
                     $command   = $query->createCommand();
                     $result    = $command->queryAll();
        Yii::trace($result,'lucky');
        return $result;
    }

/**
 * 获取书籍排行榜，获取点击前十的书籍。
 * @method bookList
 * @return 数组
 */
    public function book_Aanking_list(){
        $query  = new Query();
        $query->select('*')
                      ->from('bookinfo')
                      ->orderBy("count desc")
                      ->limit(10);
                    //   ->andWhere('0 = 0 ');
                     $command   = $query->createCommand();
                     $result    = $command->queryAll();
        Yii::trace($result,'lucky');
        return $result;
    }

/**
 * 书籍的分类筛选 按照点击数，评论数，作者姓名的大写字母
 * @method bookList  $type_id = 1;
 * @return 数组
 */
    public function book_Screening_Sort($type_id){
        $query  = new Query();
        switch ($type_id) {
            case CommonSetting::TYPE_CLICKCOUNT_ID:
                $query->select('*')
                          ->from('bookinfo')
                          ->orderBy("count desc")
                          ->limit(10);
                break;
            case CommonSetting::TYPE_COMMENTCOUNT_ID:
                $query->select('*')
                          ->from('bookinfo')
                          ->orderBy("id desc")
                          ->limit(10);
                break;
            case CommonSetting::TYPE_AUTHORFIRSHNAME_ID:
                $query->select('*')
                          ->from('bookinfo')
                          ->orderBy("count desc")
                          ->limit(10);
                break;
            default:
                break;
        }
                    //   ->andWhere('0 = 0 ');
                     $command   = $query->createCommand();
                     $result    = $command->queryAll();
        Yii::trace($result,'lucky');
        return $result;
    }


/**
 * 书籍的分类筛选 按照点击数，评论数，作者姓名的大写字母
 * @method bookList  $type_id = 1;
 * @return 数组
 */
    public function book_Class_Sort($class_id){
        $query  = new Query();
        $query->select('*')
                  ->from('bookinfo')
                  ->where('class_id='.$class_id)
                  ->orderBy("count desc")
                  ->limit(10);
                  $command   = $query->createCommand();
                  $result    = $command->queryAll();
        Yii::trace($result,'lucky');
        return $result;
    }

}
