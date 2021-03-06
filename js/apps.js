$(function() {
    var system_location_folder = '/simitd/simlab';
    var ajax_loading_html = '<div style="width: 100%;margin: 8px 0px;" align="center"><img src="http://' + window.location.host + system_location_folder + '/img/ajax-loading.gif" /></div>'
    var protocol = 'https://';
    $('.subnavbar').find('li').each(function(i) {

        var mod = i % 3;

        if (mod === 2) {
            $(this).addClass('subnavbar-open-right');
        }

    });
    $('.form-validation').validationEngine();

    $('#propinsi').change(function() {
        $.ajax({
            type: 'post',
            url: protocol + window.location.host + system_location_folder + '/AjaxData/GetKota',
            dataType: 'html',
            data: 'id' + '=' + $(this).val(),
            beforeSend: function() {
                $('#kota_loading').show();
                $('#kota_loading').html(ajax_loading_html);
            },
            success: function(data) {
                $('#kota_loading').hide();
                $('#kota').html(data);
                $('#kota').chosen();
                $('#kota').trigger("chosen:updated");
            }
        });
    });

    $('#unit').change(function() {
        $.ajax({
            type: 'post',
            url: protocol + window.location.host + system_location_folder + '/AjaxData/GetDivisi',
            dataType: 'html',
            data: 'id' + '=' + $(this).val(),
            beforeSend: function() {
                $('#kota_loading').show();
                $('#kota_loading').html(ajax_loading_html);
            },
            success: function(data) {
                $('#kota_loading').hide();
                $('#divisi').html(data);
                $('#divisi').chosen();
                $('#divisi').trigger("chosen:updated");
            }
        });
    });
    $('.chosen').chosen();
    setInterval(function() {
        $.ajax({
            type: 'post',
            url: protocol + window.location.host + system_location_folder + '/AjaxData/GetNotification',
            dataType: 'html',
            success: function(data) {
                var notifikasi = $.parseJSON(data);
                if (notifikasi.template == 2 || notifikasi.template == 3) {
                    $('#jumlah-notifikasi').text(notifikasi.total);
                    $('#jumlah-notifikasi-warning').text(notifikasi.order_warning);
                    $('#jumlah-notifikasi-sudah').text(notifikasi.sudah);
                } else if (notifikasi.template == 4) {
                    $('#jumlah-notifikasi').text(notifikasi.total);
                    $('#jumlah-notifikasi-baru').text(notifikasi.baru);
                    $('#jumlah-notifikasi-proses').text(notifikasi.proses);
                    $('#jumlah-notifikasi-sudah').text(notifikasi.sudah);
                } else if (notifikasi.template == 1) {
                    $('#jumlah-notifikasi').text(notifikasi.total);
                    $('#jumlah-notifikasi-baru').text(notifikasi.baru);
                    $('#jumlah-notifikasi-proses').text(notifikasi.proses);
                    $('#jumlah-notifikasi-warning').text(notifikasi.order_warning);
                    $('#jumlah-notifikasi-sudah').text(notifikasi.sudah);
                }
                if (notifikasi.total > 0) {
                    $('#jumlah-notifikasi').removeClass('notifikasi-ada notifikasi-kosong');
                    $('#jumlah-notifikasi').addClass('notifikasi-ada');
                } else if (notifikasi.total == 0) {
                    $('#jumlah-notifikasi').text(0);
                    $('#jumlah-notifikasi').removeClass('notifikasi-ada notifikasi-kosong');
                    $('#jumlah-notifikasi').addClass('notifikasi-kosong');
                }
            }
        });
    }, 8000);
    /*
    setInterval(function() {
        $.ajax({
            type: 'post',
            url: 'http://' + window.location.host + system_location_folder + '/AjaxData/GetNotification',
            dataType: 'html',
            success: function(data) {
                var notifikasi = $.parseJSON(data);
                if (notifikasi.order_warning > 0 && !$('#warning-alert').hasClass("closed")) {
                    $('#warning-alert').fadeIn('slow');
                    $('#warning-penyewaan-jumlah').text(notifikasi.order_warning);
                    $('#warning-alert').addClass('closed');
                }
            }
        });
    }, 5000);
    */
});


function getAge(dateString) {
    var today = new Date();
    var birthDate = new Date(dateString);
    var age = today.getFullYear() - birthDate.getFullYear();
    var m = today.getMonth() - birthDate.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }
    return age;
}

function formatCurrency(t_uji_grup) {
    num = t_uji_grup.toString().replace(/\$|\,/g, '');
    if (isNaN(num))
        num = "0";
    sign = (num == (num = Math.abs(num)));
    num = Math.floor(num * 100 + 0.50000000001);
    cents = num % 100;
    num = Math.floor(num / 100).toString();
    if (cents < 10)
        cents = "0" + cents;
    for (var i = 0; i < Math.floor((num.length - (1 + i)) / 3); i++)
        num = num.substring(0, num.length - (4 * i + 3)) + '.' +
                num.substring(num.length - (4 * i + 3));
    return (((sign) ? '' : '-') + 'Rp ' + num + ',' + cents);
}