<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string|null $name Nomi
 * @property float|null $price Narxi
 * @property int|null $quantity Soni
 * @property string|null $date Kelish sanasi
 * @property string|null $batch_number Partiya raqami
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['price', 'quantity', 'date', 'name'], 'required'],
            [['price'], 'number'],
            [['quantity'], 'integer'],
            [['date'], 'safe'],
            [['name', 'batch_number'], 'string', 'max' => 255]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Nomi',
            'price' => 'Narxi(so\'m)',
            'quantity' => 'Soni',
            'date' => 'Sanasi',
            'batch_number' => 'Partiya raqami'
        ];
    }
}
