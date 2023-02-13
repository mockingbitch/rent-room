<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;

class House extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'houses';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'type',
        'description',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'address',
        'category'
    ];

    /**
     * @return HasOne
     */
    public function address() : HasOne
    {
        return $this->hasOne(\App\Models\ModelEntity\ModelHasWard::class, 'model_id')->where('model_type', '=', 'App\Models\House');
    }

    /**
     * @return HasOne
     */
    public function category() : HasOne
    {
        return $this->hasOne(\App\Models\ModelEntity\ModelHasCategory::class, 'model_id')->where('model_type', '=', 'App\Models\House');
    }
}
