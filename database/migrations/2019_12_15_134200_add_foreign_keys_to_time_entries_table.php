<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTimeEntriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('time_entries', function(Blueprint $table)
		{
			$table->foreign('project_id', 'FK_time_entries_projects')->references('id')->on('projects')->onUpdate('SET NULL')->onDelete('SET NULL');
			$table->foreign('task_id', 'FK_time_entries_tasks')->references('id')->on('tasks')->onUpdate('SET NULL')->onDelete('SET NULL');
			$table->foreign('user_id', 'FK_time_entries_users')->references('id')->on('users')->onUpdate('SET NULL')->onDelete('SET NULL');
			$table->foreign('workspace_id', 'FK_time_entries_workspaces')->references('id')->on('workspaces')->onUpdate('SET NULL')->onDelete('SET NULL');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('time_entries', function(Blueprint $table)
		{
			$table->dropForeign('FK_time_entries_projects');
			$table->dropForeign('FK_time_entries_tasks');
			$table->dropForeign('FK_time_entries_users');
			$table->dropForeign('FK_time_entries_workspaces');
		});
	}

}
