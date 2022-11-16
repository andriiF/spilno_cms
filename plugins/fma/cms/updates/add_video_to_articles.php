<?php namespace Fma\Cms\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class AddVideoToArticles extends Migration
{
    public function up()
    {
        Schema::table('fma_cms_articles', function (Blueprint $table) {
            $table->text('background_video')->nullable();
        });
    }

    public function down()
    {
    }
}
