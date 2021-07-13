<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->integer('status')->default(1);
            $table->unsignedBigInteger('lead_by');
            $table->unsignedBigInteger('assigned_to')->nullable();
            $table->foreignId('contact_id')->constrained('contacts')->cascadeOnDelete();
            $table->foreignId('package_id')->nullable()->constrained('packages')->cascadeOnDelete();
            $table->bigInteger('estimate_cost')->nullable();
            $table->foreignId('source_id')->constrained('sources')->cascadeOnDelete();
            $table->date('contact_date')->default(Carbon::now());
            $table->boolean('converted_to_client')->default(0);
            $table->timestamps();

            // Foreign Key
            $table->foreign('lead_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('assigned_to')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leads');
    }
}
