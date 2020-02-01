<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTasksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('tasks', function(Blueprint $table)
		{
			$table->foreign('project_id', 'FK_tasks_projects')->references('id')->on('projects')->onUpdate('SET NULL')->onDelete('SET NULL');
			$table->foreign('workspace_id', 'FK_tasks_workspaces')->references('id')->on('workspaces')->onUpdate('SET NULL')->onDelete('SET NULL');
		});
	}


	/**
     *
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('tasks', function(Blueprint $table)
		{
			$table->dropForeign('FK_tasks_projects');
			$table->dropForeign('FK_tasks_workspaces');
		});
	}

}
