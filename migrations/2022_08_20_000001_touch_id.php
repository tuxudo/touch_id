<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Capsule\Manager as Capsule;

class TouchId extends Migration
{
    public function up()
    {
        $capsule = new Capsule();
        $capsule::schema()->create('touch_id', function (Blueprint $table) {
            $table->increments('id');
            $table->string('serial_number')->unique();;
            $table->boolean('enabled')->nullable();
            $table->boolean('unlock')->nullable();
            $table->text('fingerprints')->nullable();
            $table->integer('timeout')->nullable();

            $table->index('serial_number');
            $table->index('enabled');
            $table->index('unlock');
        });
    }

    public function down()
    {
        $capsule = new Capsule();
        $capsule::schema()->dropIfExists('touch_id');
    }
}
