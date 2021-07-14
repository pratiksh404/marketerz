<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->text('description')->nullable();
            $table->foreignId('client_id')->constrained()->cascadeOnDelete();
            $table->foreignId('lead_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('package_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('department_id')->nullable()->constrained()->cascadeOnDelete();
            $table->unsignedBigInteger('project_head')->nullable();
            $table->text('project_interval');
            $table->dateTime('project_startdate')->default(Carbon::now());
            $table->dateTime('project_deadline')->default(Carbon::now());
            $table->bigInteger('price')->default(0);
            $table->bigInteger('discounted_price');
            $table->bigInteger('paid_amount')->default(0);
            $table->string('color')->default(random_color());
            /* Notification Setting */
            $table->boolean('team_notify')->default(0);
            $table->boolean('team_slack_notify')->default(0);
            $table->json('team_channel')->nullable();

            $table->boolean('client_notify')->default(0);
            $table->boolean('client_service_expire_notify')->default(0);
            $table->boolean('client_payment_notify')->default(0);
            $table->json('client_channel')->nullable();
            $table->timestamps();

            // Foreign Key
            $table->foreign('project_head')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
