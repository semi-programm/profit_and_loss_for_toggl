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
		Schema::create('task', function(Blueprint $table)
		{
			$table->bigInteger('id')->nullable();
			$table->timestamps();
			$table->string('name', 50)->nullable();
			$table->bigInteger('workspace_id')->nullable();
			$table->bigInteger('project_id')->nullable();
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
