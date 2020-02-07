<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
			$table->bigInteger('id')->unsigned()->primary();
			$table->timestamps();
			$table->string('name')->nullable()->comment('名');
			$table->bigInteger('client_id')->unsigned()->nullable()->index('client_id')->comment('クライアントID');
			$table->bigInteger('workspace_id')->unsigned()->nullable()->index('workspace_id')->comment('ワークスペースID');
            $table->float('est_time', 10, 0)->nullable()->comment('リスク込み工数[h]');

			$table->integer('est_price')->nullable()->comment('見積価格[yen]');
			// $table->integer('m_price')->nullable()->comment('社長判断の追加価格');
			$table->boolean('progress')->nullable()->default(0)->comment('進捗度[%]');
			$table->integer('out_price')->unsigned()->nullable()->default(0)->comment('外注費[yen]');
			$table->smallInteger('unit_price')->unsigned()->nullable()->default(4400)->comment('単価(yen)');
			// $table->dateTime('finished_time')->nullable()->comment('プロジェクトを終了した時間');
			$table->dateTime('finished_at')->nullable()->comment('プロジェクトを終了した時間');
			// $table->boolean('is_finished')->default(0)->comment('終了フラグ');
			$table->boolean('is_skip_rank')->default(0)->comment('ランキングスキップフラグ');
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
