<?php

namespace App\Repositories\House;

use App\Models\House;
use App\Repositories\House\HouseRepositoryInterface;
use App\Repositories\BaseRepository;

class HouseRepository extends BaseRepository implements HouseRepositoryInterface
{
    public function getModel()
    {
        return House::class;
    }
}
