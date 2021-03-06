<?php
/**
 * ============================================================================
 * Copyright © 2016-2017 HongYuKeJi.Co.Ltd. All rights reserved.
 * Http://www.hongyuvip.com
 * ----------------------------------------------------------------------------
 * 仅供学习交流使用，如需商用请购买商用版权。
 * 堂堂正正做人，踏踏实实做事。
 * ----------------------------------------------------------------------------
 * Author: Shadow  QQ: 1527200768  Time: 2017/3/12 14:42
 * E-mail: admin@hongyuvip.com
 * ============================================================================
 */


namespace frontend\controllers;

use common\models\Product;
use Yii;
use common\models\Goods;
use yii\web\NotFoundHttpException;

class GoodsController extends BaseController
{
    /**
     * Displays a single Goods model.
     * @param string $id
     * @return mixed
     */
    public function actionIndex($id)
    {
        return $this->render('index', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionDemo()
    {
        return $this->render('demo');
    }

    /**
     * 商品详情页
     * @param string $product_id
     * @param string $sku_id
     * 名称/简介/详细介绍
     * 价格/市场价格
     * 累计评价条数/累计销量
     * 图片/属性/评价内容
     * 商家信息: 店铺名称/联系方式/地址/评分
     */
    public function actionTest($product_id, $sku_id = null)
    {
        if (empty($sku_id)) {
            $model = new Product();
            $product = $model->findOne(1);
            dump($product['product_name']);
        } else {
            echo "sku_id 存在";
        }


    }

    /**
     * Finds the Goods model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Goods the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Goods::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }
    }
}