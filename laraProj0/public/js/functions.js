

//trova l'id dell'elemento con nome inputName all'interno del form con id formId
function findInputByName(formId, inputName) {
    var inputValue = $('#' + formId + ' :input[name="' + inputName + '"]').attr('id');
    return inputValue;
}


//funzione per sovrascrivere l'evento onclick di un elemento
function sovrascriviOnClick(elem_id, rotta) {
    var elem = document.getElementById(elem_id);
    elem.onclick = function () {
        window.location.href = rotta;
    };
}


function getErrorHtml(elemErrors) {
    if ((typeof (elemErrors) === 'undefined') || (elemErrors.length < 1)) //guarda se ci sono elementi da visualizzare 
        return;
    var out = '<ul class="errors text-red-500">'; //genera la tag ul
    for (var i = 0; i < elemErrors.length; i++) {
        out += '<li>' + elemErrors[i] + '</li>'; //dentro di questa genera tanti tag li quanti gli errori
    }
    out += '</ul>';
    return out;
}

function doElemValidation(id, actionUrl, formId, inputName) {
    //dick prende in input l'id dell'elemento, url, lid della form
    var formElems;

    //mandiamo al server il token CSRF e l'elemento da validare.
    //
    function addFormToken() {
        var tokenVal = $("#" + formId + " input[name=_token]").val();
        console.log(tokenVal);
        formElems.append('_token', tokenVal);
    }

    function sendAjaxReq() {
       
        $.ajax({
            type: 'POST',
            url: actionUrl,
            data: formElems,
            dataType: "json",
            error: function (data) { //funzione di callback, 
                if (data.status === 422) { //codice per errori di validazione. è sempre una condizione di errore
                    var errMsgs = JSON.parse(data.responseText); //definiamo il messaggio di errore.
                    var inputName = $("#" + id).attr('name');
                    $("#" + id).next('.errors').html(' '); //cancelliamo gli errori vecchi di questo elemento
                    $("#" + id).after(getErrorHtml(errMsgs[inputName])); //con after passiamo l'errore dell'id che stiamo analizando
                }
            },
            contentType: false,
            processData: false
        });

    }

    var elem = $("#" + id);
    inputVal = elem.val();

    formElems = new FormData(); //creiamo un oggetto di tipo formdata che struttura tutte le info che si mandano al server al submit
    formElems.append(inputName, inputVal); //aggiungiamo il valore di input 
    addFormToken(); //aggiungiamo il token
    sendAjaxReq(); //manda la richiesta ajax

}

//funzione per validare un form
function doFormValidation(actionUrl, formId) {
    var form = new FormData(document.getElementById(formId));
    for (var pair of form.entries()) {
        console.log(pair[0] + ': ' + pair[1]);//Cicla attraverso le coppie chiave-valore del FormData e le stampa nella console per debug.
    }
    $.ajax({
        type: 'POST',
        url: actionUrl,
        data: form,
        dataType: "json",
        error: function (data) {
            if (data.status === 422) {
                var errMsgs = JSON.parse(data.responseText);
                
                //gli errMsgs sono un oggetto con chiave il nome dell'input e valore un array di errori
                $.each(errMsgs, function (name) {
                    id = findInputByName(formId, name);
                    $("#" + id).parent().find('.errors').html(' ');
                    $("#" + id).after(getErrorHtml(errMsgs[name]));
                    console.log(getErrorHtml(errMsgs[name]));
                });
            } else {
                console.log("Errore con status diverso da 422: ", data);
            }
        },
        success: function (data) { //se non c'è una condizione di errore il server reindirizza al processo di errore
            alert('Operazione andata a buon fine');

            //window.location restituisce la pagina corrente
            window.location.replace(data.redirect);
        },

        contentType: false,
        processData: false

    });

}







