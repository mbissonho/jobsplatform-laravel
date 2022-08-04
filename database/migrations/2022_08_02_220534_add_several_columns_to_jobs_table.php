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
            $table->boolean('remote')->nullable(false);
            $table->boolean('accept_candidates_from_outside')->nullable(false);
            $table->enum('company_size', CompanySize::OPTIONS);
            $table->enum('contract_type', ContractType::OPTIONS);
            $table->enum('experience_level', ExperienceLevel::OPTIONS);
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
            //
        });
    }
};
