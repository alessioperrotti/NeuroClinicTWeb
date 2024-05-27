function getErrorHtml(elemErrors) {
    if ((typeof (elemErrors) === 'undefined') || (elemErrors.length < 1)) //guarda se ci sono elementi da visualizzare 
        return;
    var out = '<ul class="errors">'; //genera la tag ul
    for (var i = 0; i < elemErrors.length; i++) {
        out += '<li>' + elemErrors[i] + '</li>'; //dentro di questa genera tanti tag li quanti gli errori
    }
    out += '</ul>';
    return out;
}

function doElemValidation(id, actionUrl, formId) {
    //prende in input l'id dell'elemento, url, lid della form
    var formElems;

    //mandiamo al server il token e l'elemento da validare.
    //
    function addFormToken() {
        var tokenVal = $("#" + formId + " input[name=_token]").val();
        formElems.append('_token', tokenVal);
    }

    function sendAjaxReq() {
        $.ajax({
            type: 'POST',
            url: actionUrl,
            data: formElems,
            dataType: "json",
            error: function (data) {  //funzione di callback, 
                if (data.status === 422  ) { //codice per errori di validazione. è sempre una condizione di errore
                    var errMsgs = JSON.parse(data.responseText); //definiamo il messaggio di errore.
                    $("#" + id).parent().find('.errors').html(' '); //risaliamo al parent e cerchiamo una classe .errors. poi cancelliamo gli errori vecchi
                    $("#" + id).after(getErrorHtml(errMsgs[id])); //con after passiamo l'errore dell'id che stiamo analizando
                }
            },
            contentType: false,
            processData: false
        });
    }

    var elem = $("#" + id);
    if (elem.attr('type') === 'file') {  //controlliamo se l'elemento è di tipo file o meno. 
        //i file sono piu difficili da gestire. sono rappresentati come array
        // elemento di input type=file valorizzato
        if (elem.val() !== '') {   //se l'utente non ha inserito il valore, ha solo perso il focus, allora inviamo solo il nome del file
            inputVal = elem.get(0).files[0];
        } else {
            inputVal = new File([""], ""); //altrimenti, se l'utente ha specificato il file, creiamo un oggetto che lo rappresenta 
        }

        //in ogni caso inputVal è un valore di tipo file 

    } else {
        // elemento di input type != file
        inputVal = elem.val();
    }
    formElems = new FormData();  //creiamo un oggetto di tipo formdata che struttura tutte le info che si mandano al server al submit
    formElems.append(id, inputVal); //aggiungiamo il valore di input 
    addFormToken(); //aggiungiamo il token
    sendAjaxReq();  //manda la richiesta ajax

}

function doFormValidation(actionUrl, formId) {

    var form = new FormData(document.getElementById(formId));
    $.ajax({
        type: 'POST',
        url: actionUrl,
        data: form,
        dataType: "json",
        error: function (data) {
            if (data.status === 422) {
                var errMsgs = JSON.parse(data.responseText);
                $.each(errMsgs, function (id) {
                    $("#" + id).parent().find('.errors').html(' ');
                    $("#" + id).after(getErrorHtml(errMsgs[id]));
                });
            }
        },
        success: function (data) { //se non c'è una condizione di errore il server reindirizza al processo di errore
            window.location.replace(data.redirect);
        },
        contentType: false,
        processData: false
    });
}




