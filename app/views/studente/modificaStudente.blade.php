@extends('base')


@section('title')
Modifica studente {{$studente->denominazione}} 
@endsection

@section('navStudente')
active
@endsection

@section('content')
<form action="{{ action('StudentiController@faiModificaStudente', $studente->id) }}" method="POST" >
<div class="pull-right">
    <input type="submit" class="btn btn-success" value="Salva Modifiche" />
</div>
<div class="dettagliStage">
    <div class="page-header">
      <h1>{{$studente->nome}} {{$studente->cognome}}</h1>
    </div>
    
    <!-- Modifica studente -->

    <div class="panel panel-info">
        <div class="panel-heading">
        	<h3 class="panel-title">Modifica Studente</h3>
        </div>
      	<div class="panel-body">
            <div class="row">
	            <div class="col-lg-6">
	                <b>Nome</b>
	                
					 <div class="form-group">
					    <div class="input-group">
					      <input type="text" class="form-control" id="exampleInputAmount" value="{{$studente->nome}}" name="nome">
					    </div>
					  </div>
					<br>
	                <b>Cognome</b>
	                
					 <div class="form-group">
					    <div class="input-group">
					      <input type="text" class="form-control" id="exampleInputAmount" value="{{$studente->cognome}}" name="cognome">
					    </div>
					  </div>
					<br>
	                <b>Codice Fiscale</b>
	                
					 <div class="form-group">
					    <div class="input-group">
					      <input type="text" class="form-control" id="exampleInputAmount" value="{{$studente->CF}}" name="CF">
					    </div>
					  </div>
					<br>
					<b>Articolazione</b>
	                
					 <div class="form-group">
					    <div class="input-group">
					      <input type="text" class="form-control" id="exampleInputAmount" value="{{$studente->articolazione}}" name="articolazione">
					    </div>
					  </div>
					<br>
	            </div>
	            
	            <div class="col-lg-6">
	            	<b>Indirizzo</b>
	                
					 <div class="form-group">
					    <div class="input-group">
					      <input type="text" class="form-control" id="exampleInputAmount" value="{{$studente->indirizzo}}" name="indirizzo">
					    </div>
					  </div>
					<br>
	                <b>Residenza</b>
	                
					 <div class="form-group">
					    <div class="input-group">
					      <input type="text" class="form-control" id="exampleInputAmount" value="{{$studente->comuneResidenza}}" name="comuneResidenza">
					    </div>
					  </div>
					<br>
	                <b>Data di Nascita</b>
	                
					 <div class="form-group">
					    <div class="input-group">
					      <input type="text" class="form-control" id="exampleInputAmount" value="{{$studente->dataNascita}}" name="dataNascita">
					    </div>
					  </div>
					<br>
					<b>Luogo di Nascita</b>
	                
					 <div class="form-group">
					    <div class="input-group">
					      <input type="text" class="form-control" id="exampleInputAmount" value="{{$studente->comuneNascita}}" name="comuneNascita">
					    </div>
					  </div>
					<br>
	            </div>
            </div>
        </div>
    </div>
</div>
</form>
@endsection