<?php

namespace tests\models;

use app\models\Bookinfo;
use Codeception\Specify;

class LoginFormTest extends \Codeception\Test\Unit
{
    private $model;

    // protected function _after()
    // {
    //     \Yii::$app->user->logout();
    // }

    public function testbooklist(){
        $bookinfo = new Bookinfo();
        $model = $bookinfo->bookList();
        codecept_debug($model);

    }

    public function testbook_Aanking_list(){
        $bookinfo = new Bookinfo();
        $model = $bookinfo->book_Aanking_list();
        codecept_debug($model);

    }

    public function testbook_Screening_Sort(){
        $bookinfo = new Bookinfo();
        $model = $bookinfo->book_Screening_Sort('2');
        codecept_debug($model);

    }

    public function testbook_Class_Sort(){
        $bookinfo = new Bookinfo();
        $model = $bookinfo->book_Class_Sort('1');
        codecept_debug($model);

    }
}

?>
