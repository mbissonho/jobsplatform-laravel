<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Jobs
 *
 * @method static Builder|Job havingSkill(int $skillId)
 *
 */
class Job extends Model
{
    use HasFactory;


    /**
     * Get skills for the job
     */
    public function skills(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Skill::class);
    }

    /**
     * @param Builder $query
     * @param int $skillId
     * @return Builder
     */
    public function scopeHavingSkill(Builder $query, int $skillId): Builder
    {
        return $query->whereHas('skills', fn(Builder $builder) =>
            $builder->where('skills.id', $skillId)
        );
    }

}
