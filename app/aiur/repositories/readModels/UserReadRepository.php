<?php

namespace aiur\repositories\readModels;

use common\models\User;

class UserReadRepository
{
    public function find($id): ?User
    {
        return User::findOne($id);
    }

}