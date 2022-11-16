<?php

namespace Fma\Cms\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreatePageTypesTable extends Migration {

    public function up() {
        Schema::create('fma_cms_page_types', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('frontend_path');
            $table->string('name');
            $table->timestamps();
        });


        Schema::table('fma_cms_pages', function (Blueprint $table) {
            $table->integer('page_type')->nullable();
            $table->integer('page_type_id')->nullable();
        });
    }

    public function down() {
        Schema::dropIfExists('fma_cms_page_types');
    }

}
