<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 23.09.2017
 * Time: 11:23
 */

namespace frontend\modules\user\models\forms;

use Yii;
use yii\base\Model;

class PictureForm extends Model
{

    public $picture;

    public function rules()
    {
        return [
            [['picture'], 'file',
                'extensions' => ['jpg', 'jpeg', 'png'],
                'checkExtensionByMimeType' => true
            ],
        ];
    }



}