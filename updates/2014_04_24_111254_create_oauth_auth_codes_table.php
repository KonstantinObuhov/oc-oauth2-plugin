<?php namespace Octobro\OAuth2\Updates;

use October\Rain\Database\Updates\Migration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

/**
 * This is the create oauth auth codes table migration class.
 *
 */
class CreateOauthAuthCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oauth_auth_codes', function (Blueprint $table) {
            $table->string('id', 40)->primary();
            $table->integer('session_id')->unsigned();
            $table->string('redirect_uri');
            $table->integer('expire_time');

            $table->timestamps();

            $table->index('session_id');

            $table->foreign('session_id')
                  ->references('id')->on('oauth_sessions')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('oauth_auth_codes', function (Blueprint $table) {
            $table->dropForeign('oauth_auth_codes_session_id_foreign');
        });
        Schema::drop('oauth_auth_codes');
    }
}
