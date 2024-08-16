<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('services', function (Blueprint $table) {            
            $table->enum('service_type', ['service', 'space', 'equipment'])->default('space');
            $table->enum('agency', ['Elig Essono', 'Etoa-Meki'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if(Schema::hasColumn('services', 'service_type')) {
            Schema::table('services', function (Blueprint $table) {
                $table->dropColumn('service_type');
            });
        }

        if(Schema::hasColumn('services', 'agency')) {
            Schema::table('services', function (Blueprint $table) {
                $table->dropColumn('agency');
            });
        }
    }
};
