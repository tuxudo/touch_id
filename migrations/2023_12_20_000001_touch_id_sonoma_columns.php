<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Capsule\Manager as Capsule;

class TouchIdSonomaColumns extends Migration
{
    private $tableName = 'touch_id';

    public function up()
    {
        $capsule = new Capsule();
        $capsule::schema()->table($this->tableName, function (Blueprint $table) {
            $table->integer('match_timeout')->nullable();
            $table->integer('passcode_input_timeout')->nullable();

            $table->index('match_timeout');
            $table->index('passcode_input_timeout');
        });
    }

    public function down()
    {
        $capsule = new Capsule();
        $capsule::schema()->table($this->tableName, function (Blueprint $table) {
            $table->dropColumn('match_timeout');
            $table->dropColumn('passcode_input_timeout');
        });
    }
}
