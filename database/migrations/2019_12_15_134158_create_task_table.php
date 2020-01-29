<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTaskTable extends Migration {

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
			$table->timestamps();
			$table->string('name', 50)->nullable();
			$table->bigInteger('project_id')->unsigned()->nullable()->index('project_id');
			$table->bigInteger('workspace_id')->unsigned()->nullable()->index('workspace_id');
			$table->integer('est_sec')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('task');
	}

}
