<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%seller}}".
 *
 * @property string $seller_id
 * @property string $user_id
 * @property string $store_id
 */
class Seller extends \common\models\BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%seller}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'store_id'], 'required'],
            [['user_id', 'store_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'seller_id' => Yii::t('app', 'Seller ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'store_id' => Yii::t('app', 'Store ID'),
        ];
    }
}
