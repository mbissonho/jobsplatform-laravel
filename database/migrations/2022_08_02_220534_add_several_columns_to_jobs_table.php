<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\CompanySize;
use App\Models\ContractType;
use App\Models\ExperienceLevel;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->boolean('remote')->nullable(false)->default(false);
            $table->boolean('accept_candidates_from_outside')->nullable(false)->default(false);
            $table->enum('company_size', CompanySize::OPTIONS)->default(CompanySize::STARTUP);
            $table->enum('contract_type', ContractType::OPTIONS)->default(ContractType::PJ);
            $table->enum('experience_level', ExperienceLevel::OPTIONS)->default(ExperienceLevel::JUNIOR);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->dropColumn(
                [
                    'remote',
                    'accept_candidates_from_outside',
                    'company_size',
                    'contract_type',
                    'experience_level'
                ]
            );
        });
    }
};
