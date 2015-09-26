<?php

namespace app\models;

use yii\db\ActiveRecord;
use qeti\SimplePOData\EntityTrait;

class Document extends ActiveRecord {

    // This trait contains method for fields mapping (between database table and this class)
    use EntityTrait;

    public $id;
    public $added_at;
    public $number;
    public $amount;
    public $currency;

    public $DocumentProducts;
}
