<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AggiuntaColonnaStage extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
    {
        
        Schema::table("stage",function($table)
        {
            $table->integer('azienda_id')->unsigned();
            $table->foreign('azienda_id')->references('id')->on('aziende');

            $table->integer('tutor_scuola_id')->unsigned();
            $table->foreign('tutor_scuola_id')->references('id')->on('tutorScuola');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("stage",function($table)
        {
            $table->dropForeign('stage_azienda_id_foreign');
            $table->dropForeign('stage_tutor_scuola_id_foreign');
            $table->dropColumn(['azienda_id', 'tutor_scuola_id']);
        });
    }

}
