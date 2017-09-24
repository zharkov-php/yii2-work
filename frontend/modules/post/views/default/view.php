<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 24.09.2017
 * Time: 13:18
 */

/* @var $this yii\web\View */
/* @var $post frontend\models\Post */

use yii\helpers\Html;
use yii\web\JqueryAsset;
?>
<div class="post-default-index">

    <div class="row">

        <div class="col-md-12">
            <?php if ($post->user): ?>
                <?php echo $post->user->username; ?>
            <?php endif; ?>
        </div>

        <div class="col-md-12">
            <img src="<?php echo $post->getImage(); ?>" />
        </div>

        <div class="col-md-12">
            <?php echo Html::encode($post->description); ?>
        </div>

        <hr>

            <div class="col-md-12">
                    Likes: <span class="likes-count"><?php echo $post->countLikes(); ?></span>

                    <a href="#" class="btn btn-primary button-unlike <?php echo ($currentUser && $post->isLikedBy($currentUser)) ? "" : "display-none"; ?>" data-id="<?php echo $post->id; ?>">
                            Unlike&nbsp;&nbsp;<span class="glyphicon glyphicon-thumbs-down"></span>
                        </a>
                   <a href="#" class="btn btn-primary button-like <?php echo ($currentUser && $post->isLikedBy($currentUser)) ? "display-none" : ""; ?>" data-id="<?php echo $post->id; ?>">
                            Like&nbsp;&nbsp;<span class="glyphicon glyphicon-thumbs-up"></span>
                        </a>

                </div>
<?php $this->registerJsFile('@web/js/likes.js', [
        'depends' => JqueryAsset::className(),
    ]);?>

    </div>



</div>


</div>