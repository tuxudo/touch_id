var formatTouchIDEnabledDisabled = function(colNumber, row){
    var col = $('td:eq('+colNumber+')', row),
        colvar = col.text();
    colvar = colvar == '1' ? '<span class="label label-success">'+i18n.t('enabled')+'</span>' :
    (colvar === '0' ? '<span class="label label-danger">'+i18n.t('disabled')+'</span>' : colvar)
    col.html(colvar)
}

var formatTouchIDTimeout = function(colNumber, row){
    var col = $('td:eq('+colNumber+')', row),
        colvar = col.text();

    if (col >= 0) {
        colvar = colvar+' Seconds</td></tr>';
        col.html(colvar)
    }
}

var formatTouchIDFingerprints = function(colNumber, row){
    var col = $('td:eq('+colNumber+')', row),
        colvar = col.text();
    colvar = colvar.replace(/\n/g, "<br>").replace(/\\/g, "")+'</td></tr>';
    col.html(colvar)
}