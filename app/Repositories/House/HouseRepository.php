<?php

namespace App\Repositories\House;

use App\Models\House;
use App\Repositories\House\HouseRepositoryInterface;
use App\Repositories\BaseRepository;
use App\Models\ModelEntity\ModelHasWard;
use App\Models\ModelEntity\ModelHasCategory;

class HouseRepository extends BaseRepository implements HouseRepositoryInterface
{
    public function getModel()
    {
        return House::class;
    }

    /**
     * @param array $data
     *
     * @return House
     */
    public function createHouse($data = []) : House
    {
        $house = $this->create($data);
        $houseAddress = ModelHasWard::create([
            'model_id'      => $house->id,
            'model_type'    => 'App\Models\House',
            'ward_code'     => $data['ward_code']
        ]);
        $houseCategory = ModelHasCategory::create([
            'model_id'      => $house->id,
            'model_type'    => 'App\Models\House',
            'category_id'   => $data['category_id']
        ]);

        return $house;
    }

    /**
     * @param integer $id
     * @param array $data
     *
     * @return House
     */
    public function updateHouse(int $id, $data = []) : House
    {
        $house = $this->update($id, $data);
        $houseAddress = ModelHasWard::where(['model_id' => $house->id, 'model_type' => 'App\Models\House'])->update([
            'ward_code' => $data['ward_code']
        ]);
        $houseCategory = ModelHasCategory::where(['model_id' => $house->id, 'model_type' => 'App\Models\House'])->update([
            'category_id' => $data['category_id']
        ]);

        return $house;
    }
}
