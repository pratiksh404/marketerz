<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiscussionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discussions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lead_id')->constrained()->cascadeOnDelete();
            $table->string('subject')->nullable();
            $table->string('discussion');
            $table->integer('type')->nullable();
            $table->integer('status');
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->dateTime('discussion_date')->default(Carbon::now());
            $table->boolean('reminder')->default(0);
            $table->dateTime('reminder_datetime')->nullable();
            $table->json('channel')->nullable();
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
        Schema::dropIfExists('discussions');
    }
}
