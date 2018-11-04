<?php

    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    class CreateTableClients extends Migration
    {
        public $set_schema_table = 'clients';

        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create($this->set_schema_table,
                function (Blueprint $table) {
                    $table->increments('id');
                    $table->string('name', 150);
                    $table->string('cep', 12);
                    $table->string('city', 150);
                    $table->string('state', 2);
                    $table->string('neighborhood', 200);
                    $table->string('address', 255);
                    $table->string('email', 100);
                    $table->nullableTimestamps();

                    $table->index(["name"], 'idx_name');
                    $table->index(["city"], 'idx_city');
                    $table->index(["email"], 'idx_email');
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
