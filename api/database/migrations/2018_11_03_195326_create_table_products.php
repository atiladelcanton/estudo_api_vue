<?php

    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    class CreateTableProducts extends Migration
    {
        public $set_schema_table = 'products';

        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create($this->set_schema_table,function (Blueprint $table) {
                $table->increments('id');
                $table->string('name', 150);
                $table->string('description',255);
                $table->nullableTimestamps();
                $table->index(["name"], 'idx_name');

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
