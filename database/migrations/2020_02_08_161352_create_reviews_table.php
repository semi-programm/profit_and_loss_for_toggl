<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('reviews', function(Blueprint $table)
		{
			$table->increments('id');
			$table->bigInteger('project_id')->unsigned()->index('FK_reviews_projects');
			$table->string('self_comment', 1023)->nullable()->comment('自己評価コメント');
			$table->string('other_comment', 1023)->nullable()->comment('他者評価コメント');
			$table->bigInteger('self_user_id')->unsigned()->nullable()->index('FK_reviews_users')->comment('自己評価ユーザー');
            $table->bigInteger('other_user_id')->unsigned()->nullable()->index('FK_reviews_users_2')->comment('他者評価ユーザー');
            $table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('reviews');
	}

}
