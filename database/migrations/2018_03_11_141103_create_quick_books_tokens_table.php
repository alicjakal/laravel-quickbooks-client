<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateQuickBooksTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quickbooks_tokens', function (Blueprint $table) {
            DB::connection()->getDoctrineSchemaManager()->getDatabasePlatform()->registerDoctrineTypeMapping('enum', 'string');
            $user_id_type = DB::getSchemaBuilder()
                              ->getColumnType('users', 'id') === 'bigint' ? 'unsignedBigInteger' : 'unsignedInteger';

            $table->bigIncrements('id');
            $table->{$user_id_type}('user_id');
            $table->unsignedBigInteger('realm_id');
            $table->longtext('access_token');
            $table->datetime('access_token_expires_at');
            $table->string('refresh_token');
            $table->datetime('refresh_token_expires_at');

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
        Schema::dropIfExists('quickbooks_tokens');
    }
}
