<?php

    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    class CreateTableClientProduct extends Migration
    {
        public $set_schema_table = 'client_product';

        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create($this->set_schema_table,
                function (Blueprint $table) {
                    $table->integer('client_id')->unsigned();
                    $table->integer('product_id')->unsigned();
                    $table->integer('quantity');
                    $table->dateTime('data');
                    $table->decimal('unit_price',10,2);
                    $table->decimal('total', 10, 2);
                    $table->nullableTimestamps();

                    $table->primary(['client_id', 'product_id']);
                    $table->index(["client_id"], 'idx_client_id');
                    $table->index(["product_id"], 'idx_product_id');

                    $table->foreign('client_id')->references('id')
                        ->on('clients')
                        ->onUpdates('cascade')
                        ->onDelete('cascade');
                    $table->foreign('product_id')->references('id')
                        ->on('products')->onUpdates('cascade')
                        ->onDelete('cascade');
                });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
            Schema::dropIfExists($this->set_schema_table);
        }
    }
