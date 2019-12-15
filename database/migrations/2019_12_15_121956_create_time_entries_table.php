<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTimeEntriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('time_entries', function(Blueprint $table)
		{
			$table->bigInteger('id')->unsigned()->primary();
			$table->timestamps();
			$table->bigInteger('project_id')->nullable();
			$table->bigInteger('user_id')->unsigned()->default(0)->comment('toggl user ID');
			$table->dateTime('start');
			$table->dateTime('stop');
			$table->integer('duration');
			$table->string('description', 50)->nullable()->comment('toggl time entry description');
			$table->bigInteger('task_id')->nullable();
			$table->bigInteger('workspace_id')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('time_entries');
	}

}
