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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\User::class)
                    ->onDelete('cascade');
            $table->foreignIdFor(\App\Models\Service::class)
                    ->onDelete('cascade');
            $table->boolean('by_cash')->default(1);
            $table->unsignedInteger('bonus_point')->default(0);
            $table->unsignedInteger('user_balance')->default(0);
            
            $table->unsignedBigInteger('admin_id')->nullable();

            $table->foreign('admin_id')->references('id')->on('users'); // ->nullable()->constrained()->cascadeOnDelete();

            //$table->foreignId('admin_id')->nullable()->constrained(
              //  table: 'users'
            //);

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
        Schema::dropIfExists('purchases');
    }
};
