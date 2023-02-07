<?php

namespace App\Repositories\ModelHasRole;

use App\Models\ModelHasRole;
use App\Repositories\ModelHasRole\ModelHasRoleRepositoryInterface;
use App\Repositories\BaseRepository;

class ModelHasRoleRepository extends BaseRepository implements ModelHasRoleRepositoryInterface
{
    public function getModel()
    {
        return ModelHasRole::class;
    }

    public function getUserRole(?int $user_id)
    {
        return $this->model->where('model_id', $user_id)->first();
    }

    public function updateUserRole(?int $user_id, ?int $role_id)
    {
        return $this->model->where('model_id', $user_id)->update(['role_id' => $role_id]);
    }
}
