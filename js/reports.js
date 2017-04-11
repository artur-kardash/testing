/**
 * Created by Admin on 24.01.2017.
 */

window.onload = function() {
    // console.log($('#client-email'));
    // console.log(client_email);
    $('#generate-pdf').click(function(){
        $.ajax({
            type: "POST",
            url: "/ajax/generate_pdf",
            data: {val: $('#generate-pdf-report').html() }
        }).done(function( msg ) {
            console.log($.parseJSON(msg));
            $('#send-to-mail').css('display', 'block');
            file = baseName($.parseJSON(msg));
            console.log(file);
            window.open($.parseJSON(msg), '_blank');
        });
    });

    $('#send-to-mail').click(function(){
        var mydata = {'file': file, 'email': client_email}
        // var data['file'] = file;
        //  data['email'] = $('#client-email').text();
        $.ajax({
            type: "POST",
            url: "/ajax/send_mail",
            data: {val: mydata }
        }).done(function( msg ) {
            $('#send-mail').text(msg);
            $('#send-to-mail').prop( "disabled", true );
            console.log(msg);
        });
    });



    function baseName(str)
    {
        var base = new String(str).substring(str.lastIndexOf('/') + 1);
        if(base.lastIndexOf(".") != -1)
            base = base.substring(0, base.lastIndexOf("."));
        return base;
    }

    $('#pdf-generate').click(function() {
        // alert('111');
        // var canvas = $('canvas');
        var canvas = $('#chart-container');
        $('#load-pdf').css('display', 'inline');
        $('#pdf-generate').prop( "disabled", true );
        // var canvas = $('page');
        $('body').scrollTop(0);

            html2canvas(canvas, {
                useCORS: true,
                allowTaint: true,
                onrendered: function (canvas, doc) {
                    var ctx = canvas.getContext('2d');
                    ctx.webkitImageSmoothingEnabled = false;
                    ctx.mozImageSmoothingEnabled = false;
                    ctx.imageSmoothingEnabled = false;
                    ctx.scale(2,2);
                    console.log(canvas.width);
                    var imgWidth = 210;
                    var pageHeight = 295;
                    var imgHeight = 295;
                    var heightLeft = imgHeight;

                    var doc = new jsPDF('p', 'mm', "a4");
                    var position = 0;
                    var width = doc.internal.pageSize.width;
                    var height = doc.internal.pageSize.height;
                    var imgData = canvas.toDataURL('image/png', 1.0);
                    doc.addImage(imgData, 'PNG', 0, 0, width, height);

                    send_pdf(btoa(doc.output()));
                }
            });

    });

    function send_pdf(pdf) {

        $.ajax({
            method: "POST",
            url: "/ajax/get_pdf",
            data: {data: pdf},
        }).done(function(data){
            console.log($.parseJSON(data));
            $('#send-to-mail').css('display', 'block');
            file = baseName($.parseJSON(data));
            window.open($.parseJSON(data), '_blank');
            $('#load-pdf').css('display', 'none');
            $('#pdf-generate-div').prop( "disabled", true );
        });
    }

    function demoFromHTML() {

        var pdf = new jsPDF('p','pt','a4');

        pdf.addHTML(document.getElementById('chart-container'),{pagesplit:true},function() {
            // pdf.output('Test.pdf');
            pdf.save('Test.pdf');
        }); document.getElementById('buttons').style.visibility = 'hidden';

    }

    $.ready(function(){
        var content = $('page'),
            cache_width = content.width(),
            a4  =[ 595.28,  841.89];  // for a4 size paper width and height

        $('#pdf-generate1').on('click',function(){
            $('body').scrollTop(0);
            createPDF();
        });
//create pdf
        function createPDF(){
            getCanvas().then(function(canvas){
                var
                    img = canvas.toDataURL("image/png"),
                    doc = new jsPDF({
                        unit:'px',
                        format:'a4'
                    });
                doc.addImage(img, 'JPEG', 0, 0);
                doc.save("report.pdf");
                content.width(cache_width);
            });
        }

// create canvas object
        function getCanvas(){
            console.log('111');
            content.width((a4[0]*1.33333) -80).css('max-width','none');
            return html2canvas(content,{
                imageTimeout:2000,
                removeContainer:true
            });
        }

    }());

    function loading() {
        if(navigator.userAgent.match(/msie/i) || navigator.userAgent.match(/trident/i)) {
            $('.loading').hide();
        }
        $('page').load(function() {
            $(this).parent().find(".loading").hide();
        });
    }
};
