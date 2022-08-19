<div id="touch_id-tab"></div>
<h2 data-i18n="touch_id.touch_id"></h2>
<div id="touch_id-msg" data-i18n="listing.loading" class="col-lg-12 text-center"></div>


<script>
$(document).on('appReady', function(){
    $.getJSON(appUrl + '/module/touch_id/get_tab_data/' + serialNumber, function(d){
        if( ! d ||  d['enabled'] == null){
            // Change loading message to no data
            $('#touch_id-msg').text(i18n.t('no_data'));
            
        } else {

            // Hide loading/no data message
            $('#touch_id-msg').text('');

            // Generate rows from data
            var rows = ''
            for (var prop in d){
                // Do nothing for empty values to blank them
                if (d[prop] == '' || d[prop] == null){
                    rows = rows

                // Format booleans
                } else if((prop == 'enabled' || prop == 'unlock') && d[prop] == 1){
                    rows = rows + '<tr><th>'+i18n.t('touch_id.'+prop)+'</th><td>'+i18n.t('enabled')+'</td></tr>';
                } else if((prop == 'enabled' || prop == 'unlock') && d[prop] == 0){
                    rows = rows + '<tr><th>'+i18n.t('touch_id.'+prop)+'</th><td>'+i18n.t('disabled')+'</td></tr>';

                // Format timeout
                } else if(prop == 'timeout' && d[prop] >= 0){
                    rows = rows + '<tr><th>'+i18n.t('touch_id.'+prop)+'</th><td>'+d[prop]+' Seconds</td></tr>';

                // Format fingerprints
                } else if(prop == "fingerprints"){
                    rows = rows + '<tr><th>'+i18n.t('touch_id.'+prop)+'</th><td>'+d[prop].replace(/\n/g, "<br>").replace(/\\/g, "")+'</td></tr>';

                // Else, build out rows 
                } else {
                    rows = rows + '<tr><th>'+i18n.t('touch_id.'+prop)+'</th><td>'+d[prop]+'</td></tr>';
                }
            }

            $('#touch_id-tab')
                .append($('<div style="max-width:550px;">')
                    .append($('<table>')
                        .addClass('table table-striped table-condensed')
                        .append($('<tbody>')
                            .append(rows))))
        }
    });
});
</script>
