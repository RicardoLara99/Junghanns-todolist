<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $username
 * @property string $email
 * @property string $password_hash
 * @property string $auth_key
 * @property string $access_token
 */
class Users extends \yii\db\ActiveRecord  implements \yii\web\IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'email', 'password_hash', 'auth_key', 'access_token'], 'required'],
            [['username', 'email', 'password_hash', 'access_token'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 100],
            [['username'], 'unique'],
            [['email'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'email' => 'Email',
            'password_hash' => 'Password',
        ];
    }

    /**
     * Find an identity for the given ID.
     * @param int $id ID
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * Find an identity by the given access token.
     * This method is used by the API authentication.
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * @return int|string the user ID
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string the authentication key
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     *Validates the authentication key
     * 
     * @param string $authKey the authentication key to be validated
     * @return bool if the authentication key is valid for the current user
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Find a user by their username
     *
     * @param string $username The username to search for
     * @return static|null User found, or null if no user found
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }
    
    /**
     * Validate password
     *
     * @param string $password the password to validate
     * @return bool if the password is valid for the current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }
}
