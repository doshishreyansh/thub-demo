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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('created_by')->default(1);
            $table->foreignId('species_id')->constrained();
            $table->foreignId('grade_id')->constrained();
            $table->foreignId('drying_method_id')->constrained();
            $table->foreignId('treatment_id')->nullable()->constrained();
            $table->integer('thickness');
            $table->integer('width');
            $table->integer('length');
            $table->tinyInteger('is_active')->default(1)->comment('1-Active, 0-Deactive');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
