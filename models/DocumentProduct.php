<?php

namespace app\models;

use yii\db\ActiveRecord;
use qeti\SimplePOData\EntityTrait;

class DocumentProduct extends ActiveRecord {

    // This trait contains method for fields mapping (between database table and this class)
    use EntityTrait;

    public $id;
    public $added_at;
    public $document_id;
    public $product_id;
    public $count;
    public $price;

    public $Document;
}
