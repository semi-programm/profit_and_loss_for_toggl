<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
			$table->bigInteger('project_id')->unsigned()->nullable()->index('project_id');
			$table->bigInteger('user_id')->unsigned()->nullable()->index('user_id')->comment('toggl user ID');
			$table->dateTime('start')->comment('開始日時');
			$table->dateTime('stop')->comment('終了日時');
			$table->integer('duration')->comment('計測時間');
			$table->string('description', 255)->nullable()->comment('toggl time entry description')->comment('詳細');
			$table->bigInteger('task_id')->unsigned()->nullable()->index('task_id');
			$table->bigInteger('workspace_id')->unsigned()->nullable()->index('workspace_id');
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
