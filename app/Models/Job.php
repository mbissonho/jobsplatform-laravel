<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Jobs
 *
 * @method static Builder|Job list(int $take, int $skip)
 *
 */
class Job extends Model
{
    use HasFactory;

    /**
     * @param Builder $query
     * @param int $take
     * @param int $skip
     * @return Builder
     */
    public function scopeList(Builder $query, int $take, int $skip): Builder
    {
        return $query->latest()
            ->limit($take)
            ->offset($skip);
    }

}
