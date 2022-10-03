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
        Schema::create('grades', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->tinyInteger('grade_system')->default(0)->comment('1-Nordic Blue, 2-Tegernseer');
            $table->tinyInteger('is_active')->default(1)->comment('1-Active, 0-Deactive');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });

        // Insert some stuff
        $data = [
            ['name' => 'A1', 'grade_system' => 1],
            ['name' => 'A2', 'grade_system' => 1],
            ['name' => 'A3', 'grade_system' => 1],
            ['name' => 'A4', 'grade_system' => 1],
            ['name' => 'B', 'grade_system' => 1],
            ['name' => 'O', 'grade_system' => 2],
            ['name' => 'I', 'grade_system' => 2],
            ['name' => 'II', 'grade_system' => 2],
            ['name' => 'III', 'grade_system' => 2],
            ['name' => 'IV', 'grade_system' => 2],
            ['name' => 'V', 'grade_system' => 2],
        ];
        DB::table('grades')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grades');
    }
};
