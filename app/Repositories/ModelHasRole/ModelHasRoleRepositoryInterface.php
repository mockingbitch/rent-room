<?php

namespace App\Repositories\ModelHasRole;

use App\Repositories\BaseRepositoryInterface;

interface ModelHasRoleRepositoryInterface extends BaseRepositoryInterface
{
    public function getUserRole(?int $user_id);

    public function updateUserRole(?int $user_id, ?int $role_id);
}