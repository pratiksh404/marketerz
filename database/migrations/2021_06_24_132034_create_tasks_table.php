<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('task');
            $table->text('description')->nullable();
            $table->dateTime('deadline')->nullable();
            $table->boolean('reminder')->default(0);
            $table->dateTime('reminder_date_time')->default(Carbon::now());
            $table->json('channel')->nullable();
            $table->integer('status')->default(1);
            $table->foreignId('user_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('color')->default(random_color());
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
