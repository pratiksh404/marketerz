<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('campaign_by');
            $table->bigInteger('unit_price')->default(1);
            $table->bigInteger('estimated_price')->default(1);
            $table->foreignId('client_id')->nullable()->constrained()->restrictOnDelete();
            $table->foreignId('group_id')->nullable()->constrained()->restrictOnDelete();
            $table->integer('channel');
            $table->json('contacts');
            $table->text('body');
            $table->integer('send_type')->default(1);
            $table->dateTime('scheduled_time')->default(Carbon::now());
            $table->timestamps();

            $table->foreign('campaign_by')->references('id')->on('users')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('campaigns');
    }
}
