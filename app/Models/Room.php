<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Room extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'rooms';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'content',
        'price',
        'house_id'
    ];

    /**
     * @return BelongsTo
     */
    public function house() : BelongsTo
    {
        return $this->belongsTo(\App\Models\House::class, 'house_id');
    }
}
