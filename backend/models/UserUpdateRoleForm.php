<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use common\models\User;

/**
 * UserForm is the model behind the user form.
 */
class UserUpdateRoleForm extends Model
{
    public
        $id,
        $role;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['id', 'required'],
            ['role', 'required'],
        ];
    }

   
    /**
     * UpdateRole.
     *
     * @return bool whether the message was sent
     */
    public function updateRole()
    {
        if (!$this->validate()) {
            return null;
        }
   
        $user = User::findIdentity($this->id);
        $user->role = $this->role;

        return $user->save();

    }
}
