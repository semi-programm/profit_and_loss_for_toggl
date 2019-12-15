<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProjectsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('projects', function(Blueprint $table)
		{
			$table->bigInteger('id')->unsigned()->primary()->comment('toggl project ID');
			$table->timestamps();
			$table->string('name')->nullable()->comment('名');
			$table->float('est_time_high', 10, 0)->nullable()->comment('リスク込み工数');
			$table->float('est_time_low', 10, 0)->nullable()->comment('リスク無し工数');
			$table->integer('est_price')->nullable()->comment('見積価格');
			$table->integer('m_price')->nullable()->comment('社長判断の追加価格');
			$table->boolean('progress')->nullable()->default(0)->comment('進捗度');
			$table->integer('out_price')->unsigned()->nullable()->default(0)->comment('外注費(時間)');
			$table->smallInteger('unit_price')->unsigned()->nullable()->default(4400)->comment('単価(円)');
			$table->dateTime('finished_time')->nullable()->comment('プロジェクトを閉じた時間');
			$table->boolean('is_finished')->default(0)->comment('終了フラグ');
			$table->boolean('is_skip_rank')->default(0)->comment('ランキングスキップフラグ');
			$table->bigInteger('client_id')->nullable()->comment('クライアントID');
			$table->bigInteger('workspace_id')->unsigned()->default(0)->comment('ワークスペースID');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('projects');
	}

}
