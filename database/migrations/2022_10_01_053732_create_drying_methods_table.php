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
        Schema::create('drying_methods', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->tinyInteger('is_active')->default(1)->comment('1-Active, 0-Deactive');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });

        // Insert some stuff
        $data = [
            ['name' => 'Fresh'],
            ['name' => 'Kiln Dried'],
            ['name' => 'Air Dried']
        ];
        DB::table('drying_methods')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('drying_methods');
    }
};
