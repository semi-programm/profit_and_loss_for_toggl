<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tasks', function(Blueprint $table)
		{
			$table->bigInteger('id')->unsigned()->primary();
			$table->string('name', 50)->nullable();
			$table->bigInteger('project_id')->unsigned()->nullable()->index('project_id');
			$table->bigInteger('workspace_id')->unsigned()->nullable()->index('workspace_id');
            $table->integer('est_sec')->nullable()->comment('見積時間[h]');

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
		Schema::drop('tasks');
	}

}
