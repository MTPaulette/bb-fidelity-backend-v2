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
            $table->enum('user_type', ['sample', 'subscriber', 'resident'])->default('sample');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if(Schema::hasColumn('services', 'user_type')) {
            Schema::table('services', function (Blueprint $table) {
                $table->dropColumn('user_type');
            });
        }
    }
};
