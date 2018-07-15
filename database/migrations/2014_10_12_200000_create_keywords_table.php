<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKeywordsTable extends Migration
{
    public function up()
    {
        Schema::create('keywords', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        $now = \Carbon\Carbon::now();
        DB::table('keywords')->insert([
            ['name' => 'sunlight', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'hurts', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'my', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'eyes', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('keywords');
    }
}
