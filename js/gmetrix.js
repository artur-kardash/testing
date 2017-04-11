/**
 * Created by Admin on 27.01.2017.
 */
window.onload = function() {

    if (!account_validate()){
        $('#gmetrix_start_test').prop('hidden', true);
    }


    $( "#gmetrix_account_data" ).on( "submit", function( event ) {
        event.preventDefault();
        if (!account_validate()){
            console.log('account data is not valide');
            return false;
        }
        var data= $( this ).serialize();
        $.ajax({
            type: "POST",
            url: "/ajax/gmetrix_account_save",
            data: {val: data}
        }).done(function (msg) {
            $('#gmetrix_start_test').prop('hidden', false);
            console.log(msg);
        });
    });

    $( "#gmetrix_start_test" ).on( "submit", function( event ) {
        event.preventDefault();
        if (!account_validate() || !isURL($('#gmetrix_url').val())){
            if (!isURL($('#gmetrix_url').val())){
                alert('url failed');
                return false;
            }
            alert('Data invalide');
            return false;
        }

        $('#start_gmetrix').css('display', 'none');
        $('#gmetrix_account_data').css('display', 'none');

        $( "#gmetrix_start_test" ).prop('disabled', true);
        $('#load-pdf').css('display', 'inline');
        $('.report-performance').css('display', 'inline');
        $('#load').css('display', 'inline');
        $('.load').css('display', 'inline');
        page_screen();


        var data= $( this ).serialize();
        $.ajax({
            type: "POST",
            url: "/ajax/gmetrix_start_test",
            timeout: 60000*5,
            data: {val: data},
                success: function(msg){
                    console.log(msg);
                },
            error: function (msg) {
                console.log(msg);
                // alert(msg.statusText);
                // msg.responseText.show();
                var myWindow = window.open("", "MsgWindow", "width=500,height=600");
                myWindow.document.write(msg.responseText);
            }
        }
        ).done(function (msg) {
            var res = JSON.parse(msg)
            console.log(res);
            $('#load-pdf').css('display', 'none');
            print_result(res);

        });
    });

    function print_result(result) {
        $('#load').css('display', 'none');
        $('.load').css('display', 'none');
        $('#gmetrix-loadbar-container').hide();
        $('#pagespeed_score').text(result.results.pagespeed_score);
        $('#yslow_score').text(result.results.yslow_score);
        var html_load = result.results.html_load_time/1000;
        $('#html_load_time').text(html_load.toFixed(2)+'s');
        var page_load = result.results.page_load_time/1000;
        $('#page_load_time').text(page_load.toFixed(2)+'s');
        var mb = (result.results.page_bytes/1024)/1024;
        $('#page_bytes').text(mb.toFixed(2)+'MB');
        var html_mb = (result.results.html_bytes/1024)/1024;
        $('#html_bytes').text(html_mb.toFixed(2)+'MB');
        $('#page_elements').text(result.results.page_elements);
        $('#gmetrix_pdf_full').attr('href', result.resources.report_pdf_full);
        $('#gmetrix_pdf_full').html('<h3>PDF report<h3>');
    }

    function page_screen() {

        console.log($('#gmetrix_url').val());

        var scr_url = $('#gmetrix_url').val();
        $('img[data-url]').each(function(url) {
            $.ajax({
                url: 'https://www.googleapis.com/pagespeedonline/v1/runPagespeed?url=' + scr_url + '&screenshot=true',
                context: this,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#gmetix_form').hide();
                    $('#gmetix_test_info').show();
                    $('#test_url').attr('href', scr_url);
                    $('#test_url').html('<h3>'+scr_url+'</h3>');
                    data = data.screenshot.data.replace(/_/g, '/').replace(/-/g, '+');
                    $('#test_url_screen').attr('src', 'data:image/jpeg;base64,' + data);
                    $('#test_url_screen').show();
                }
            });
        });
    }

    function account_validate() {
        if (isEmail($('#account_email').val()) && ($('#api_key').length > 0)){
            return true;
        }
        return false;
    }

    function isURL(data) {
        if (/^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/|www\.)[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/.test(data)) {
            return true;
        } else {
            return false;
        }
    }

    function isEmail(email) {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email);
    }

}


