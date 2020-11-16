<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sell".
 *
 * @property int $id
 * @property int $product_id Mahsulot
 * @property float|null $sell_price Narxi
 * @property int|null $sell_quantity Soni
 * @property string|null $sell_date Sotish sanasi, default bugun
 * @property string|null $sell_batch_number Sotish Partiya raqami
 *
 * @property Product $product
 */
class Sell extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sell';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sell_price', 'sell_quantity', 'sell_date'], 'required'],
            [['product_id', 'sell_quantity'], 'integer'],
            [['sell_price'], 'number'],
            [['sell_date'], 'safe'],
            [['sell_batch_number'], 'string', 'max' => 255],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Mahsulot',
            'sell_price' => 'Narxi(so\'m)',
            'sell_quantity' => 'Soni',
            'sell_date' => 'Sanasi',
            'sell_batch_number' => 'Partiya raqami',
        ];
    }

    /**
     * Gets query for [[Product]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }
}
