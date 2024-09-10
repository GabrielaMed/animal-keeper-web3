<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


class CreateHouseAnimalTable extends Migration
{
    public function up()
    {
        Schema::create('house_animal', function (Blueprint $table) {
            $table->uuid('house_id');
            $table->uuid('animal_id');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('deleted_at')->nullable();

            $table->foreign('house_id')->references('id')->on('houses')->onDelete('cascade');
            $table->foreign('animal_id')->references('id')->on('animals')->onDelete('cascade');
            $table->primary(['house_id', 'animal_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('house_animal');
    }
}