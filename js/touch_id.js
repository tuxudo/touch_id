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

    if (colvar >= 0 && colvar !== "") {
        col.html('<span title="'+touchid_secondsToHms(colvar)+'">'+colvar+' Seconds</span>');
    }
}

var formatTouchIDFingerprints = function(colNumber, row){
    var col = $('td:eq('+colNumber+')', row),
        colvar = col.text();
    colvar = colvar.replace(/\n/g, "<br>").replace(/\\/g, "")+'</td></tr>';
    col.html(colvar)
}

function touchid_secondsToHms(d) {
    d = Number(d);
    var h = Math.floor(d / 3600);
    var m = Math.floor(d % 3600 / 60);
    var s = Math.floor(d % 3600 % 60);

    var hDisplay = h > 0 ? h + (h == 1 ? " hour " : " hours ") : "";
    var mDisplay = m > 0 ? m + (m == 1 ? " minute " : " minutes ") : "";
    var sDisplay = s > 0 ? s + (s == 1 ? " second" : " seconds") : "";
    return hDisplay + mDisplay + sDisplay; 
}