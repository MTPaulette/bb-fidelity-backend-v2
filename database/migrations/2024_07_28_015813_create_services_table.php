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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedInteger('price');
            $table->float('credit')->default(0);
            $table->float('debit')->default(0);

            $table->enum('validity', ['01 hour', 'midday', '01 day', '01 week', '01 month', 'pack', '01 year'])->default('01 hour');
            $table->enum('service_type', ['service', 'space', 'equipment'])->default('space');
            $table->enum('agency', ['Elig Essono', 'Etoa-Meki'])->default('Elig Essono');

            $table->text('description')->nullable();
            $table->foreignIdFor(\App\Models\User::class)->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services');
    }
};
