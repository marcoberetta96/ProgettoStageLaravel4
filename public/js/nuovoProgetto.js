$("#btnAlternanza").click(function() {
    tipoStage = "Alternanza Scuola-Lavoro";
    $("#step0").hide();
    $("#step1").show();
});


$("#btnStageE").click(function() {
    tipoStage = "Stage Estivo";
    $("#step0").hide();
    $("#step1").show();
});

$("#btnStageI").click(function() {
    tipoStage = "Stage Invernale";
    $("#step0").hide();
    $("#step1").show();
});


$(document).ready(function () {
    (function ($) {

    	$('.filterable').keyup(function () {
            var rex = new RegExp($(this).val(), 'i');
            $('.searchable tr').hide();
            $('.searchable tr').filter(function () {
                return rex.test($(this).text());
            }).show();
        });

        $('#filterStudenti').keyup(function () {
            var rex = new RegExp($(this).val(), 'i');

            var trBuone = $('.searchable tr input:not(:checked)').parent().parent();

            trBuone.hide();
            $('.searchable tr').filter(function () {
                return rex.test($(this).text());
            }).show();
        });

    }(jQuery));
});
	
$(".scegliAzienda").click(function(){
	idAzienda = $(this).closest("tr").attr("azienda");

	$.get( "api/azienda/" + idAzienda, function( azienda ) {
		$("#nomeAzienda").html(azienda.denominazione);
		$("#sedeLegaleAzienda").html(azienda.sedeLegale + ", " + azienda.citta);
		$("#modaleAzienda").modal('show');

	});
});

$("#confermaAzienda").click(function(){
	$("#modaleAzienda").modal('hide');
	$("#step1").hide();
	$("#step2").show();
	$("#idAzienda").val(idAzienda);
});

$("#annullaAzienda").click(function(){
	$("#modaleAzienda").modal('hide');
});


$("#confermaStudenti").click(function(){
	$("#step2").hide();
	$("#step3").show();

	idStudenti = [];
    $("#periodiStudenti").empty();
	inputs = $("#tabellaStudenti tbody tr").find("input:checked");
	for(i=0;i<inputs.length;i++)
    {
		riga = $(inputs[i]).parent().parent();
        var idStudente = riga.attr("studente");
		idStudenti.push(idStudente);

        $.get( "api/studente/" + idStudente, function( studente ) {
            $("#periodiStudenti").append('<div class="panel panel-default" id="dateStudente' + studente.id + '">' +
                                            '<div class="panel-heading">' +
                                                '<h3 class="panel-title"> <b>' + studente.cognome + ' ' + studente.nome + '</b></h3>' +
                                            '</div>' +
                                            '<div class="panel-body">' + 
                                                '<table class="table">' +
                                                    '<tr>' +
                                                        '<th>Data Inizio</th> <th>Data Fine</th> <th>Elimina</th>' +
                                                    '</tr>' +
                                                    '<tr>' +
                                                        '<td><input type="date" required class="dataInizio" /></td> <td><input type="date" required class="dataFine" /></td> <td><button title="Elimina Periodo" class="btn btn-default glyphicon glyphicon-trash btnCancellaRiga"></button></td>' +
                                                    '</tr>' +
                                                '</table>' +
                                                '<div class="pull-right">' +
                                                    '<button title="Aggiungi Periodo" class="btn btn-default glyphicon glyphicon-plus btnAggiungiRiga"></button>' +
                                                '</div>' +
                                            '</div>' +
                                        '</div>');
            
            $(".btnCancellaRiga").click(function () {
                $(this).parent().parent().remove(); 
            });

            $(".btnAggiungiRiga").off('click');
            $(".btnAggiungiRiga").click(function(){
                $(this).parent().parent().find('table').append('<tr>  \
                                                                    <td><input type="date" required class="dataInizio" /></td>  \
                                                                    <td><input type="date" required class="dataFine" /></td>  \
                                                                    <td><button title="Elimina Periodo" class="btn btn-default glyphicon glyphicon-trash btnCancellaRiga"></button></td>  \
                                                                    </tr> ');
                
                console.log("here");
                $(".btnCancellaRiga").click(function () {
                    $(this).parent().parent().remove(); 
                });
            });
        });
    }

   
});

$(".scegliTutor").click(function(){
	idTutor = $(this).closest("tr").attr("tutor");

	$.get( "api/tutor/" + idTutor, function( tutor ) {
		$("#nomeCognomeTutor").html(tutor.cognome + " " + tutor.nome);
		$("#modaleTutor").modal('show');
	});
});

$("#confermaTutor").click(function(){
	$("#modaleTutor").modal('hide');
	$("#step3").hide();
	$("#step5").show();
	$("#idTutor").val(idTutor);
});

$("#annullaTutor").click(function(){
	$("#modaleTutor").modal('hide');
});


$("#assegnaPeriodi").click(function(){
	$("#step5").hide();
	$("#stepConferma").show();
});


$("#btnCreaStage").click(function() {
	var data = {};
    data.tipoStage = tipoStage;
	data.azienda = idAzienda;
	data.tutor = idTutor;
	data.studenti = [];
    for(i=0 ; i<idStudenti.length ; i++){
        dateInizio = $("#dateStudente"+idStudenti[i]).find('.dataInizio');
        dateFine =  $("#dateStudente"+idStudenti[i]).find('.dataFine');

        aDateInizio = [];
        aDateFine = [];

        for(j=0;j< $(dateInizio).length;j++){
            aDateInizio.push($(dateInizio[j]).val());
            aDateFine.push($(dateFine[j]).val());
        }
        
        data.studenti.push({
            'idStudente': idStudenti[i],
            'dateInizio': aDateInizio,
            'dateFine': aDateFine
        });
    }

    var dataToSend = "json=" + JSON.stringify(data);
    $.post( urlPost, dataToSend, function(data){
        location.href = data;
    });
});


$(".indietro").click(function() {
    $(this).parent().hide();
    var daMostrare = $(this).attr('vai');
    $("#step"+daMostrare).show();
});