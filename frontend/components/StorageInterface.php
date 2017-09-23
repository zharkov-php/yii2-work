<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 23.09.2017
 * Time: 11:39
 */



namespace frontend\components;

use yii\web\UploadedFile;

/**
 * File storage interface
 *
 * @author admin
 */
interface StorageInterface
{

    public function saveUploadedFile(UploadedFile $file);

    public function getFile(string $filename);
}