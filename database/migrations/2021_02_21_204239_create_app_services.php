<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppServices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {Schema::dropIfExists('app_services');
        Schema::create('app_services', function (Blueprint $table) {
            $table->id('service_code');
            $table->bigInteger('app_code')->unsigned();
            $table->foreign('app_code')->references('app_code')->on('applications');
            $table->string('name');
            $table->enum('type', ['HTTP', 'SAML', 'SSH', 'JDBC', 'ODBC']);
            $table->enum('sub_type', ['REST', 'SOAP']);
            $table->text('description');
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
        Schema::dropIfExists('app_services');
    }
}
