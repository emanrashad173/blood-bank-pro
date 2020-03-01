<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSettingsTable extends Migration {

	public function up()
	{
		Schema::create('settings', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('play_store_url');
			$table->string('app_store_url');
			$table->string('title_mob_app');
			$table->text('content_mob_app');
			$table->text('notification_text');
			$table->text('about_app');
			$table->text('intro_app');
			$table->text('who_we_are_text');
			$table->string('phone');
			$table->string('email');
			$table->string('fb_link');
			$table->string('tw_link');
			$table->string('insta_link');
			$table->string('youtube_link');
			$table->string('gmail_link');
			$table->string('whats_num');
		});
	}

	public function down()
	{
		Schema::drop('settings');
	}
}
