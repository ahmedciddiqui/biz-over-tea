<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTicketAndMetaFieldsToVenturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ventures', function (Blueprint $table) {
            $table->date('commit_date')->nullable()->after('description');

            $table->decimal('one_ticket_amount', 15, 2)->after('funding_goal');
            $table->integer('total_ticket_quantity')->after('one_ticket_amount');

            $table->integer('min_investment_ticket')->default(1)->after('total_ticket_quantity');
            $table->integer('max_investment_ticket')->nullable()->after('min_investment_ticket');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ventures', function (Blueprint $table) {
            //
        });
    }
}
