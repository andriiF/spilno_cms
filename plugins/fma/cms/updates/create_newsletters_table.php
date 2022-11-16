<?php namespace Fma\Cms\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateNewslettersTable extends Migration
{
    public function up()
    {
        Schema::create('fma_cms_newsletters', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('email');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('fma_cms_newsletters');
    }
}
