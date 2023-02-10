<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\BaseRepository;
use App\Models\ModelEntity\ModelHasWard;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function getModel()
    {
        return User::class;
    }

    public function updateAddress($user, ?string $wardCode)
    {
        $modelHasWard = ModelHasWard::create([
            'model_id' => $user,
            'model_type' => 'App\Models\User',
            'ward_code' => $wardCode
        ]);

        return $modelHasWard;
    }
}
