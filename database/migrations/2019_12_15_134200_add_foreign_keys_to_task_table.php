<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTaskTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('task', function(Blueprint $table)
		{
			$table->foreign('project_id', 'FK_task_projects')->references('id')->on('projects')->onUpdate('SET NULL')->onDelete('SET NULL');
			$table->foreign('workspace_id', 'FK_task_workspaces')->references('id')->on('workspaces')->onUpdate('SET NULL')->onDelete('SET NULL');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('task', function(Blueprint $table)
		{
			$table->dropForeign('FK_task_projects');
			$table->dropForeign('FK_task_workspaces');
		});
	}

}
