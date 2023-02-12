<?php

namespace App\Repositories\Tag;

use App\Models\Tag;
use App\Repositories\Tag\TagRepositoryInterface;
use App\Repositories\BaseRepository;

class TagRepository extends BaseRepository implements TagRepositoryInterface
{
    public function getModel()
    {
        return Tag::class;
    }
}
