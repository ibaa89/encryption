<?php

use Phpmig\Migration\Migration;

class Tokens extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $capsule = $this->get('capsule');

        $schema = $capsule::schema();
        $schema->create('tokens', function ($table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('token');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->index('user_id');
        });
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        $capsule = $this->get('capsule');

        $schema = $capsule::schema();
        $schema->drop('tokens');
    }
}
