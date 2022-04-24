<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        /**
         * Create database
         */
        DB::statement('CREATE DATABASE IF NOT EXISTS `gestao_mensagens_notificacoes` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;'); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP DATABASE IF EXISTS `gestao_mensagens_notificacoes`;');
    }
};
