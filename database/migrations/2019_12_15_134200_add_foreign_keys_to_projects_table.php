<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToProjectsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('projects', function(Blueprint $table)
		{
			$table->foreign('client_id', 'FK_projects_clients')->references('id')->on('clients')->onUpdate('SET NULL')->onDelete('SET NULL');
			$table->foreign('workspace_id', 'FK_projects_workspaces')->references('id')->on('workspaces')->onUpdate('SET NULL')->onDelete('SET NULL');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('projects', function(Blueprint $table)
		{
			$table->dropForeign('FK_projects_clients');
			$table->dropForeign('FK_projects_workspaces');
		});
	}

}
