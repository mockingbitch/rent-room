<?php

namespace App\Repositories\House;

use App\Repositories\BaseRepositoryInterface;

interface HouseRepositoryInterface extends BaseRepositoryInterface
{
    public function createHouse($data = []);
    public function updateHouse(int $id, $data = []);
}
