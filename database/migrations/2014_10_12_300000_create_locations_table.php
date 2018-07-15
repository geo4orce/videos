<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationsTable extends Migration
{
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        $now = \Carbon\Carbon::now();
        DB::table('locations')->insert([
            ['name' => 'New York', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Moscow', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Tokyo', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('locations');
    }
}
