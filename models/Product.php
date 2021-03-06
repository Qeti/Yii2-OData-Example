<?php

namespace app\models;

use yii\db\ActiveRecord;
use qeti\SimplePOData\EntityTrait;

class Product extends ActiveRecord {

    // This trait contains method for fields mapping (between database table and this class)
    use EntityTrait;

    public $id;
    public $added_at;
    public $name;
    public $weight;
    public $code;
}
