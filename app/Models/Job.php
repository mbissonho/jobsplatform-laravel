<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Jobs
 *
 * @method static Builder|Job ofCompanySize(string $companySize)
 * @method static Builder|Job withContractType(string $contractType)
 * @method static Builder|Job requireExperienceLevel(string $experienceLevel)
 * @method static Builder|Job requireSkill(int $skillId)
 * @method static Builder|Job isRemote(bool $isRemote)
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
     * @param string $companySize
     * @return Builder
     */
    public function scopeOfCompanySize(Builder $query, string $companySize): Builder
    {
        return $query->where('company_size', $companySize);
    }

    /**
     * @param Builder $query
     * @param string $contractType
     * @return Builder
     */
    public function scopeWithContractType(Builder $query, string $contractType): Builder
    {
        return $query->where('contract_type', $contractType);
    }

    /**
     * @param Builder $query
     * @param string $experienceLevel
     * @return Builder
     */
    public function scopeRequireExperienceLevel(Builder $query, string $experienceLevel): Builder
    {
        return $query->where('experience_level', $experienceLevel);
    }

    /**
     * @param Builder $query
     * @param int $skillId
     * @return Builder
     */
    public function scopeRequireSkill(Builder $query, int $skillId): Builder
    {
        return $query->whereHas('skills', fn(Builder $builder) =>
            $builder->where('skills.id', $skillId)
        );
    }


    /**
     * @param Builder $query
     * @param bool $isRemote
     * @return Builder
     */
    public function scopeIsRemote(Builder $query, bool $isRemote): Builder
    {
        return $query->where('remote', $isRemote);
    }

}
