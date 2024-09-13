<?php

use Phpmig\Migration\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager as Capsule;
class UserAccountPassword extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {

        Capsule::schema()->create('user_account_password', function ($table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('account');
            $table->text('password');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->index('user_id');
            $table->index('account');
        });

    }

    /**
     * Undo the migration
     */
    public function down()
    {
        $schema = $this->get('capsule')->schema();

        $schema->dropIfExists('user_account_password');

    }
}
