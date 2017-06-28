<?php
/**
 * ============================================================================
 * Copyright © 2016-2017 HongYuKeJi.Co.Ltd. All rights reserved.
 * Http://www.hongyuvip.com
 * ----------------------------------------------------------------------------
 * 仅供学习交流使用，如需商用请购买商用版权。
 * 堂堂正正做人，踏踏实实做事。
 * ----------------------------------------------------------------------------
 * Author: Shadow  QQ: 1527200768  Time: 2017/2/9 22:33
 * E-mail: admin@hongyuvip.com
 * ============================================================================
 */

namespace frontend\controllers;

use Yii;
use frontend\models\EntryForm;
use yii\data\Pagination;
use common\models\Country;
use Detection\MobileDetect;
use yii\web\Cookie;
use yii\web\UploadedFile;

class TestController extends BaseController
{
    public function actionIndex()
    {
        $query = Country::find();
        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $query->count(),
        ]);
        $countries = $query->orderBy('name')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
        return $this->render('index', [
            'countries' => $countries,
            'pagination' => $pagination,
        ]);
    }

    public function actionEntry()
    {
        $model = new EntryForm;
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // 验证 $model 收到的数据
            // 做些有意义的事 ...
            return $this->render('entry-confirm', ['model' => $model]);
        } else {
            // 无论是初始化显示还是数据验证错误
            return $this->render('entry', ['model' => $model]);
        }
    }

    public function actionTest()
    {
        $device = new MobileDetect();
        if ($device->isMobile()) {
            echo "mobile";
        } else if ($device->isTablet()) {
            echo "tablet";
        } else {
            echo "desktop";
        }
    }

    public function actionSession()
    {
        // Session test
        $session = Yii::$app->session;

        $session['language'] = 'en-US';
        $language = $session['language'];

        dump($language);

    }

    public function actionShowSession()
    {
        $session = Yii::$app->session;
        $language = $session['language'];

        dump($language);
        dump(date("Y-m-d H:i", '1495118417'));
        //获取用户session id
        dump(Yii::$app->session->getId());
    }

    public function actionDelSession()
    {
        Yii::$app->session->removeAll();
        Yii::$app->session->destroy();
    }

    public function actionCache()
    {
        // 缓存测试
        $cache = Yii::$app->cache;
        //var_dump($cache->add('name','shadow'));   //添加缓存
        //var_dump($cache->get('name'));    //获取缓存
        //var_dump($cache->delete('name')); //删除缓存
        //var_dump($cache->flush());    //全部清空
    }

    public function actionUpload()
    {
        $upload = new \frontend\models\Upload();
        if (Yii::$app->request->isPost) {
            $upload->uploadFile = UploadedFile::getInstance($upload, 'uploadFile');
            if ($upload->upload()) {
                echo 'yes';
            } else {
                var_dump($upload->getErrors());
                echo 'no';
            }
        }
        return $this->render('upload', ['upload' => $upload]);
    }

    public function actionCookie()
    {
        /*
        //添加cookie第一种方法
        $cookie = new Cookie();
        $cookie->name = 'user_name';
        $cookie->expire = time() + 86400;
        $cookie->httpOnly = true;
        $cookie->value = 'shadow';
        var_dump(Yii::$app->response->getCookies()->add($cookie));
        */

        /*
        //添加cookie第二种方法
        $cookie = new Cookie([
            'name' => 'user_name',
            'expire' => time() + 86400,
            'httpOnly' => true,
            'value' => 'shadow',
        ]);
        var_dump(Yii::$app->response->getCookies()->add($cookie));
        */

        /*
        //打印cookie
        $cookies = Yii::$app->request->cookies;
        var_dump($cookies->get('user_name')); //输出cookie
        var_dump($cookies->getValue('user_name'));  //输出cookie
        var_dump($cookies->has('user_name'));   //判断cookie是否存在
        var_dump($cookies->count());   //显示cookie数量
        var_dump($cookies->getCount());   //显示cookie数量
        */

        /*
        //删除cookie
        $cookies = Yii::$app->request->cookies;
        $cookie_temp = $cookies->get('user_name');
        var_dump(Yii::$app->response->getCookies()->remove($cookie_temp));  //删除指定cookie
        var_dump(Yii::$app->response->getCookies()->removeAll());  //删除所有cookie
        */

        /*
        //session
        $session = Yii::$app->session;
        $session->set('user_name_temp','shadow');   //添加session
        var_dump($session->get('user_name_temp'));  //获取session
        var_dump($session->remove('user_name_temp'));   //删除session
        var_dump($session->removeAll());   //删除所有session
        */

    }
}