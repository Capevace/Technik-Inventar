<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('comment');
            $table->string('icon');
            $table->timestamps();
        });

        // Insert default type
        DB::table('item_types')->insert(
            [
                'name' => 'Allgemein',
                'comment' => 'Die Standard-Kategorie.',
                'icon' => 'archive'
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('item_types');
    }
}
