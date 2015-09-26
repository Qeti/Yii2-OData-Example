<?php

namespace app\models\OData;

use POData\Providers\Metadata\Type\EdmPrimitiveType;
use POData\Providers\Metadata\SimpleMetadataProvider;

class MetadataProvider
{
    const MetaNamespace = "Data";

    /**
     * Description of our service
     *
     * @return IMetadataProvider
     */
    public static function create()
    {
        $metadata = new SimpleMetadataProvider('Data', self::MetaNamespace);

        $metadata->addResourceSet('Products', self::createProductEntityType($metadata));

        $documentsEntityType = self::createDocumentEntityType($metadata);
        $documentsResourceSet = $metadata->addResourceSet('Documents', $documentsEntityType);

        $metadata->addResourceSet('Currencies', self::createCurrencyEntityType($metadata));

        $documentProductsEntityType = self::createDocumentProductEntityType($metadata);
        $documentProductsResourceSet = $metadata->addResourceSet('DocumentProducts', $documentProductsEntityType);

        $metadata->addResourceSetReferenceProperty($documentsEntityType, 'DocumentProducts', $documentProductsResourceSet);
        $metadata->addResourceReferenceProperty($documentProductsEntityType, 'Document', $documentsResourceSet);

        return $metadata;
    }

    /**
     * Describtion of Products
     */
    private static function createProductEntityType(SimpleMetadataProvider $metadata)
    {
        $et = $metadata->addEntityType(new \ReflectionClass('app\models\Product'), 'Products', self::MetaNamespace);

        $metadata->addKeyProperty($et, 'id', EdmPrimitiveType::INT32); 
        $metadata->addPrimitiveProperty($et, 'added_at', EdmPrimitiveType::DATETIME);
        $metadata->addPrimitiveProperty($et, 'name', EdmPrimitiveType::STRING);
        $metadata->addPrimitiveProperty($et, 'weight', EdmPrimitiveType::DECIMAL);
        $metadata->addPrimitiveProperty($et, 'code', EdmPrimitiveType::STRING);

        return $et;
    }

    /**
     * Describtion of Products
     */
    private static function createDocumentEntityType(SimpleMetadataProvider $metadata)
    {
        $et = $metadata->addEntityType(new \ReflectionClass('app\models\Document'), 'Documents', self::MetaNamespace);

        $metadata->addKeyProperty($et, 'id', EdmPrimitiveType::INT32); 
        $metadata->addPrimitiveProperty($et, 'added_at', EdmPrimitiveType::DATETIME);
        $metadata->addPrimitiveProperty($et, 'number', EdmPrimitiveType::STRING);
        $metadata->addPrimitiveProperty($et, 'amount', EdmPrimitiveType::DECIMAL);
        $metadata->addPrimitiveProperty($et, 'currency', EdmPrimitiveType::INT32);
 
        return $et;
    }

    /**
     * Describtion of Products
     */
    private static function createCurrencyEntityType(SimpleMetadataProvider $metadata)
    {
        $et = $metadata->addEntityType(new \ReflectionClass('app\models\Currency'), 'Currencies', self::MetaNamespace);

        $metadata->addKeyProperty($et, 'id', EdmPrimitiveType::INT32); 
        $metadata->addPrimitiveProperty($et, 'added_at', EdmPrimitiveType::DATETIME);
        $metadata->addPrimitiveProperty($et, 'name', EdmPrimitiveType::STRING);
        $metadata->addPrimitiveProperty($et, 'code', EdmPrimitiveType::STRING);

        return $et;
    }

    /**
     * Describtion of Products
     */
    private static function createDocumentProductEntityType(SimpleMetadataProvider $metadata)
    {
        $et = $metadata->addEntityType(new \ReflectionClass('app\models\DocumentProduct'), 'DocumentProducts', self::MetaNamespace);

        $metadata->addKeyProperty($et, 'id', EdmPrimitiveType::INT32); 
        $metadata->addPrimitiveProperty($et, 'added_at', EdmPrimitiveType::DATETIME);
        $metadata->addPrimitiveProperty($et, 'document_id', EdmPrimitiveType::INT32);
        $metadata->addPrimitiveProperty($et, 'product_id', EdmPrimitiveType::INT32);
        $metadata->addPrimitiveProperty($et, 'count', EdmPrimitiveType::DECIMAL);
        $metadata->addPrimitiveProperty($et, 'price', EdmPrimitiveType::DECIMAL);

        return $et;
    }

}
