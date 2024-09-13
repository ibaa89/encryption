<?php

use Phpmig\Migration\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager as Capsule;

class CreateUsersTable extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
    Capsule::schema()->create('users', function (Blueprint $table) {
        $table->increments('id');
        $table->string('username')->unique();
        $table->string('password');
        $table->string('email')->unique();
        $table->timestamps();
    });
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        Capsule::schema()->dropIfExists('users');

    }
}
