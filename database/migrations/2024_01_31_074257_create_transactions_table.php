<?php

use App\Constants\Transaction;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
  
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->enum('type', [Transaction::TYPE_INCOME, Transaction::TYPE_EXPENSE])->notNull();
            $table->decimal('amount', 10, 2)->notNull();
            $table->foreignId('customer_id')->nullable()->constrained('customers');
            $table->foreignId('supplier_id')->nullable()->constrained('suppliers');
            $table->foreignId('friend_id')->nullable()->constrained('friends');
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
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropForeign(['customer_id']);
            $table->dropForeign(['supplier_id']);
            $table->dropForeign(['friend_id']);
            $table->dropIfExists();
        });
    }
};
