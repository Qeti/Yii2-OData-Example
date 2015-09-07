<?php

use yii\db\Schema;
use yii\db\Migration;

class m150907_194325_init extends Migration
{
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
        $sql = 'CREATE TABLE IF NOT EXISTS product (
          id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
          added_at TIMESTAMP DEFAULT NOW(),
          name VARCHAR(250),
          weight DECIMAL(10, 4),
          code VARCHAR(45)
        );';
        yii::$app->db->createCommand($sql)->execute();

        // Test data
        $names = ['Bicycle', 'Motoroller', 'Moped', 'Samokat', 'Kolyaska', 'Doska', 'Roliki', 
            'Kareta', 'Lift', 'Metla', 'Kon', 'Kedi'];
        $sql = "REPLACE INTO product (id, added_at, name, weight, code) VALUES ";
        for ($i = 1000; $i >= 0; $i--) {
            $index = rand(0, count($names) - 1);
            $name = $names[$index];
            $sql .= "(" . $i . ", '" . rand(2000, 2015) . "-" . rand(1, 12) . "-" . rand(1, 28) . "', '" 
                . $name . "', " . rand(100, 1500)/100 . ", '" 
                . substr($name, 0, 3) . '-' . rand(1, 100) . "')";
            if ($i > 0) {
                $sql .= ', ';
            }
        }
        yii::$app->db->createCommand($sql)->execute();
    }

    public function safeDown()
    {
        return true;
    }
}
