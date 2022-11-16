<?php

namespace Fma\Cms\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreatePagesTable extends Migration {

    public function up() {
        Schema::create('fma_cms_pages', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('pages_id')->index()->nullable();
            $table->boolean('main_page')->default(0);
            $table->boolean('show_page')->default(0);
            $table->string('link')->nullable();
            $table->string('background')->nullable();
            $table->integer('position')->nullable()->default(0);
            $table->text('parameters')->nullable();
            $table->timestamps();
        });

    }

    public function down() {
        Schema::dropIfExists('fma_cms_pages');
    }

}
