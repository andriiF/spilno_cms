<?php namespace Fma\Cms\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateArticlesTable extends Migration
{
    public function up()
    {
        Schema::create('fma_cms_articles', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->boolean('show_page')->default(0);
            $table->boolean('show_slider')->default(0);
            $table->integer('position')->nullable()->default(0);
            $table->text('parameters')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('fma_cms_articles');
    }
}
