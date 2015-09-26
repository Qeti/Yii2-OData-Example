<?php

use yii\db\Schema;
use yii\db\Migration;

class m150908_211446_document extends Migration
{
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
        $sql = 'CREATE TABLE IF NOT EXISTS document (
          id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
          added_at TIMESTAMP DEFAULT NOW(),
          number VARCHAR(45),
          amount DECIMAL(28, 4),
          currency INT
        );';
        yii::$app->db->createCommand($sql)->execute();

        $sql = 'CREATE TABLE IF NOT EXISTS currency (
          id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
          added_at TIMESTAMP DEFAULT NOW(),
          name VARCHAR(45),
          code VARCHAR(3)
        );';
        yii::$app->db->createCommand($sql)->execute();

        $sql = 'CREATE TABLE IF NOT EXISTS document_product (
          id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
          added_at TIMESTAMP DEFAULT NOW(),
          document_id INT,
          product_id INT,
          count DECIMAL(14,4),
          price DECIMAL(28,4)
        );';
        yii::$app->db->createCommand($sql)->execute();

        // Test data
        $sql = "REPLACE INTO currency (id, name, code) VALUES 
            (1, 'Rubles', 'RUB'),
            (2, 'USA Dollar', 'USD'),
            (3, 'Euro', 'EUR'),
            (4, 'Real', 'BRL'),
            (5, 'Yuan', 'CNY')";
        yii::$app->db->createCommand($sql)->execute();

        $sql = "REPLACE INTO document (id, number, amount, currency) VALUES 
            (1, '1-23', 100, 'RUB'),
            (2, '2-2', 200, 'USD'),
            (3, '3-23', 110, 'EUR'),
            (4, '3-24', 12.23, 'BRL'),
            (5, '4', 223.3, 'CNY')";
        yii::$app->db->createCommand($sql)->execute();

        $sql = "REPLACE INTO document_product (id, document_id, product_id, count, price) VALUES 
            (1, 1, 1, 1, 12.3),
            (2, 1, 3, 1, 2.3),
            (3, 1, 2, 2, 3.3),
            (4, 1, 3, 3, 2.3),
            (5, 1, 5, 1.2, 12.5),
            (6, 2, 1, 3, 13.3),
            (7, 2, 3, 4, 2.5),
            (8, 3, 2, 5.7, 3.7),
            (9, 4, 3, 6, 2.2),
            (10, 5, 5, 5.2, 14.5)";
        yii::$app->db->createCommand($sql)->execute();
    }

    public function safeDown()
    {
        return true;
    }
}
