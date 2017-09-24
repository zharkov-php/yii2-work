<?php

namespace frontend\models;

use Yii;
use frontend\models\User;

/**
 * This is the model class for table "post".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $filename
 * @property string $description
 * @property integer $created_at
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'filename', 'created_at'], 'required'],
            [['user_id', 'created_at'], 'integer'],
            [['description'], 'string'],
            [['filename'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'filename' => 'Filename',
            'description' => 'Description',
            'created_at' => 'Created At',
        ];
    }

    public function getImage()
    {
        return Yii::$app->storage->getFile($this->filename);
    }

    /**
     * Get author of the post
     * @return User|null
     */
    public function getUser()
    {
            return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
         * Like current post by given user
         * @param \frontend\models\User $user
         */
    public function like(User $user)
    {
        /* @var $redis Connection */
        $redis = Yii::$app->redis;
        $redis->sadd("post:{$this->getId()}:likes", $user->getId());
        $redis->sadd("user:{$user->getId()}:likes", $this->getId());
    }

    /**
     * Unlike current post by given user
     * @param \frontend\models\User $user
     */
    public function unLike(User $user)
    {
            /* @var $redis Connection */
            $redis = Yii::$app->redis;
            $redis->srem("post:{$this->getId()}:likes", $user->getId());
            $redis->srem("user:{$user->getId()}:likes", $this->getId());
        }

    public function getId()
    {
            return $this->id;
    }

    /**
     * @return mixed
     */
    public function countLikes()
    {
            /* @var $redis Connection */
            $redis = Yii::$app->redis;
            return $redis->scard("post:{$this->getId()}:likes");
    }

    /**
     * Check whether given user liked current post
     * @param \frontend\models\User $user
     * @return integer
     */
    public function isLikedBy(User $user)
    {
            /* @var $redis Connection */
            $redis = Yii::$app->redis;
            return $redis->sismember("post:{$this->getId()}:likes", $user->getId());
    }
}
