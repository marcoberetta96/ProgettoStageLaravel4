@extends('base')


@section('title')
Dettagli {{$azienda->denominazione}} 
@endsection

@section('navAziende')
active
@endsection

@section('content')

<div class="pull-right">
                <a href="{{ action('AziendeController@modificaAzienda', $azienda->id) }}"><button class="btn btn-warning">Modifica Azienda</button></a>
                <a href=""><button class="btn btn-danger"><div class="glyphicon glyphicon-trash"></div></button></a>
            	
            </div>
<div class="dettagliStage">
    <div class="page-header">
      <h1>{{$azienda->denominazione}} <small>{{$azienda->pIva}}</small></h1>
    </div>
    
    <!-- DETTAGLI azienda -->

    <div class="panel panel-info">
      <div class="panel-heading">
        <h3 class="panel-title">Dettagli Azienda</h3>
      </div>
      <div class="panel-body">
            <div class="row">
	            <div class="col-lg-6">
	                <b>Denominazione</b>
	                <p>{{$azienda->denominazione}} &nbsp;</p>

	                <b>Settore</b>
	                <p>{{$azienda->settore}} &nbsp;</p>

	                <b>Associazione</b>
	                <p>{{$azienda->associazione}} &nbsp;</p>

	                <b>Telefono</b>
	                <p>{{$azienda->telefono}} &nbsp;</p>

	                <b>Sede tirocinio</b>
	                <p>{{$azienda->indirizzoSedeTirocinio}} ({{$azienda->cittaSedeTirocinio}}, {{$azienda->capSedeTirocinio}}) &nbsp;</p>

	                <p>&nbsp;</p>

	                <b>Rappresentante Legale</b>
	                <p>{{$azienda->nomeRappresLegale}} {{$azienda->cognomeRappresLegale}} &nbsp;</p>

					<b>Comune Nascita Rappresentante Legale</b>
	                <p>{{$azienda->comuneNascitaRappresLegale}} &nbsp;</p>

	                <p>&nbsp;</p>

					<b>Nome Tutor Aziendale</b>
	                <p>{{$azienda->nomeTutorAziend}} &nbsp;</p>




	            </div>
	            <div class="col-lg-6">
	            	<b>Partita IVA</b>
	                <p>{{$azienda->pIva}} &nbsp;</p>

	                <b>Codice Fiscale</b>
	                <p>{{$azienda->CFA}} &nbsp;</p>

	                <b>Sede Legale</b>
	                <p>{{$azienda->sedeLegale}} ({{$azienda->citta}}, {{$azienda->CAP}}) &nbsp;</p>

	                <b>E-mail</b>
	                <p>{{$azienda->email}} &nbsp;</p>

					<p>&nbsp;</p>
					<p>&nbsp;</p>

					<b>Codice Fiscale Rappresentante Legale</b>
	                <p>{{$azienda->CFRappresLegale}} &nbsp;</p>

					<b>Data Nascita Rappresentante Legale</b>
	                <p>{{$azienda->dataNascitaRappresLegale}} &nbsp;</p>

	                <p>&nbsp;</p>

					<b>Cognome Tutor Aziendale</b>
	                <p>{{$azienda->cognomeTutorAziend}} &nbsp;</p>



	            </div>
          </div>
      </div>
    </div>
	<!-- 	LISTA DEGLI STAGE	-->
	@if(count($azienda->stages) > 0)
	    <div class="list-group">
	    <div class="list-group-item list-group-item-info">
		   <h3 class="panel-title">Stage che ha ospitato</h3>
		</div>
	    @foreach($azienda->stages as $stage)
	    <div class="list-group-item">
		 <a href="{{ action('StageController@mostraStage',$stage->id) }}">Stage N° {{ $stage->id }} creato in data {{  date("d/m/Y",strtotime($stage->created_at)) }}</a>
		</div>
	       	
	   	@endforeach
	   	</div>
	@else
		<div class="panel panel-info">
			<div class="panel-heading">
				<div class="panel-title">Questa azienda non ha ospitato alcuno stage</div>
			</div>
		</div>
   	@endif

@endsection