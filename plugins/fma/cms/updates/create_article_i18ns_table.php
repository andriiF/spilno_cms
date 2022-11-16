<?php

namespace Fma\Cms\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateArticleI18nsTable extends Migration {

    public function up() {
        Schema::create('fma_cms_article_i18ns', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('article_id')->index();
            $table->integer('lang_id')->index();
            $table->string('lang_code');

            $table->string('meta_title')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->string('meta_description')->nullable();

            $table->string('name')->nullable();
            $table->string('seo')->nullable();
            $table->text('description')->nullable();
            $table->text('sub_description')->nullable();
            
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('fma_cms_article_i18ns');
    }

}
