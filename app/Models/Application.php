<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * Applications
 *
 * @method static Builder|Job ofUser(int $userId)
 */
class Application extends Pivot
{
    use HasFactory;

    protected $table  = 'applications';

    protected $fillable = [
        'user_id',
        'job_id'
    ];

    /**
     * @param Builder $query
     * @param int $userId
     * @return Builder
     */
    public function scopeOfUser(Builder $query, int $userId): Builder
    {
        return $query->with('job')
            ->where('user_id', $userId);
    }

    /**
     * Get related job
     */
    public function job(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Job::class, 'job_id');
    }

}
