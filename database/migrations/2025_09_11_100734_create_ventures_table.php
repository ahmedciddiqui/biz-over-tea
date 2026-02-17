<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVenturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventures', function (Blueprint $table) {
            $table->id();
            $table->string('name');                     // Venture name
            $table->text('description')->nullable();    // About the venture
            $table->decimal('funding_goal', 15, 2);     // Target amount
            $table->decimal('funds_raised', 15, 2)->default(0); // Track progress
            $table->decimal('min_investment', 15, 2)->nullable(); // Minimum ticket size
            $table->string('status')->default('active'); // active, closed, draft
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
        Schema::dropIfExists('ventures');
    }
}
