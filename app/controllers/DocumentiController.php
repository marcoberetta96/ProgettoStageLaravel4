<?php 

class DocumentiController extends BaseController {


	public function generaProgettoFormativo($stageId,$studenteId){

		$stage = Stage::find($stageId);

		$azienda = $stage->azienda;

		$studente = Studente::find($studenteId);

		$tutorScuola = $stage->tutorScuola;

		$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('documenti/progettoFormativo.docx');
		//----------------------------STAGE	   
	    $templateProcessor->setValue('id_stage', htmlspecialchars($stageId));
	    $templateProcessor->setValue('data_stage', htmlspecialchars(date("d/m/Y",strtotime($stage->created_at))));

	    //----------------------------STUDENTE
	    $templateProcessor->setValue('nome_studente', htmlspecialchars($studente->nome));
	    $templateProcessor->setValue('cognome_studente', htmlspecialchars($studente->cognome));
	    $templateProcessor->setValue('comuneN_studente', htmlspecialchars($studente->comuneNascita));
	    $templateProcessor->setValue('dataN_studente', htmlspecialchars(date("d/m/Y",strtotime($studente->dataNascita))));
	    $templateProcessor->setValue('comuneR_studente', htmlspecialchars($studente->comuneResidenza));
	    $templateProcessor->setValue('indirizzo_studente', htmlspecialchars($studente->indirizzo));
	    //----------------------------CLASSE
	    $templateProcessor->setValue('studente_classe', htmlspecialchars($studente->classe->classe));
	    $templateProcessor->setValue('studente_sezione', htmlspecialchars($studente->classe->sezione));
	    $templateProcessor->setValue('studente_classe_indirizzo', htmlspecialchars($studente->classe->articolazione));

	    //----------------------------AZIENDA
	    $templateProcessor->setValue('azienda_denominazione', htmlspecialchars($azienda->denominazione));
	    $templateProcessor->setValue('azienda_sede_legale', htmlspecialchars($azienda->sedeLegale));
	    $templateProcessor->setValue('azienda_citta', htmlspecialchars($azienda->citta));

//return $azienda;
	    //---------------------------TUTOR AZIENDA
	    $templateProcessor->setValue('tutorAzienda_nome', htmlspecialchars($azienda->nomeTutorAziend));
	    $templateProcessor->setValue('tutorAzienda_cognome', htmlspecialchars($azienda->cognomeTutorAziend));

	    //---------------------------TUTOR SCUOLA
	    $templateProcessor->setValue('tutorScuola_nome', htmlspecialchars($tutorScuola->nome));
	    $templateProcessor->setValue('tutorScuola_cognome', htmlspecialchars($tutorScuola->cognome));


	    //---------------------------PERIODI
	    $partecipazione = PartecipazioneStage::where('stage_id', '=', $stageId)->where('studente_id', '=', $studenteId)->firstOrFail();
	    
	    $periodi = $partecipazione->periodi;

	    return $partecipazione;


	    $templateProcessor->saveAs('tmp/progettoFormativo-' . $stage->id . '-' . $studente->id . '.docx');


		return Response::download('tmp/progettoFormativo-' . $stage->id . '-' . $studente->id . '.docx');
	}

	public function generaConvenzione($stageId){
		$stage = Stage::find($stageId);

		$azienda = $stage->azienda;
		$rappresentanteLegale = $azienda->rappresentanteLegale;


		$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('documenti/convenzione.docx');
		//----------------------------STAGE
		$templateProcessor->setValue('id_stage', htmlspecialchars($stageId));
	    $templateProcessor->setValue('data_stage', htmlspecialchars($stage->created_at));
	    //----------------------------AZIENDA
		$templateProcessor->setValue('azienda_denominazione', htmlspecialchars($azienda->denominazione));
	    $templateProcessor->setValue('azienda_sede_legale', htmlspecialchars($azienda->sedeLegale));
	    $templateProcessor->setValue('azienda_citta', htmlspecialchars($azienda->citta));
	    $templateProcessor->setValue('azienda_pIva', htmlspecialchars($azienda->pIva));
	    //----------------------------RAPPRESENTANTE LEGALE
	    $templateProcessor->setValue('rappresentanteLegale_nome', htmlspecialchars($rappresentanteLegale->nome));
	    $templateProcessor->setValue('rappresentanteLegale_cognome', htmlspecialchars($rappresentanteLegale->cognome));
	    $templateProcessor->setValue('rappresentanteLegale_luogoN', htmlspecialchars($rappresentanteLegale->luogoN));
	    $templateProcessor->setValue('rappresentanteLegale_dataN', htmlspecialchars(date("d/m/Y",strtotime($rappresentanteLegale->dataN))));
	    $templateProcessor->setValue('rappresentanteLegale_cf', htmlspecialchars($rappresentanteLegale->cf));

		$templateProcessor->saveAs('tmp/convenzione' . '-' . $stage->id . '.docx');
		
        return Response::download('tmp/convenzione' . '-' . $stage->id . '.docx');	
	}
}