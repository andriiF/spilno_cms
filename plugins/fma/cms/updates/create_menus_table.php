<?php

namespace Fma\Cms\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateMenusTable extends Migration {

    public function up() {
        Schema::create('fma_cms_menus', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->boolean('menu_type')->nullable();
            $table->string('path');
            $table->integer('page_id')->nullable();
            $table->integer('menu_id')->nullable();
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('fma_cms_menus');
    }

}
