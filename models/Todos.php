<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "todos".
 *
 * @property int $id
 * @property int $id_user
 * @property string $name
 * @property string|null $description
 * @property int $isComplete
 *
 * @property Users $user
 */
class Todos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'todos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user', 'name'], 'required'],
            [['id_user', 'isComplete'], 'integer'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => Users::class, 'targetAttribute' => ['id_user' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_user' => 'Id User',
            'name' => 'Name',
            'description' => 'Description',
            'isComplete' => 'Is Complete',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::class, ['id' => 'id_user']);
    }
}
