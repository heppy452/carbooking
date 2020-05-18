$(document).ready(function(){
	var url_ctrl = site_url+"request/request/";
	
	var table = $('#tabel_custom').DataTable({
        "ajax": url_ctrl+'table',
        "deferRender": true,
        "order": [["0", "desc"]]
    });

    // Finish Button
    $(document).on('click','#finish_btn',function(e){
        e.preventDefault();
        $.ajax({
            method:"GET",
            url:url_ctrl+'finish',
            cache:false,
            data:{id_request:$(this).attr('data-id')}
        })
        .done(function(view) {
            $('#MyModalTitle').html('<b>Finish</b>');
            $('div.modal-dialog').addClass('modal-sm');
            $("div#MyModalContent").html(view);
            $("div#MyModalFooter").html('<button type="submit" class="btn btn-default center-block" id="save_finish">Simpan</button>');
            $("div#MyModal").modal('show');
            setDatePicker();
        })
        .fail(function(res){
            alert('Error Response !');
            console.log("responseText", res.responseText);
        });
    });

    // act finish
    $(document).on('click','#save_finish',function(e){
        e.preventDefault();
        $.ajax({
            method:"POST",
            url:url_ctrl+'save_finish',
            cache:false,
            data:{
                id_request      : $("#id_request").val(),
                jam_berangkat   : $("#jam_berangkat").val(),
                jam_tiba        : $("#jam_tiba").val()
            }
        })
        .done(function(view) {
            var obj = jQuery.parseJSON(view);
            if(obj.status == 1){
                notifNo(obj.notif);
            }
            if(obj.status == 2){
                $("div#MyModal").modal('hide');
                notifYesAuto(obj.notif);
                table.ajax.reload();            
            }
        })
        .fail(function(res){
            alert('Error Response !');
            console.log("responseText", res.responseText);
        });
    });

    // Add Button
    $(document).on('click','#add_btn',function(e){
        e.preventDefault();
        $.ajax({
            method:"GET",
            cache:false,
            url:url_ctrl+'add'
        })
        .done(function(view) {
            $('#MyModalTitle').html('<b>Tambah Data</b>');
            $('div.modal-dialog').addClass('modal-md');
            $("div#MyModalContent").html(view);
            $("div#MyModalFooter").html('<button type="submit" class="btn btn-default center-block" id="save_add_btn">Simpan</button>');
            $("div#MyModal").modal('show');
            setDatePicker();
        })
        .fail(function(res){
            alert('Error Response !');
            console.log("responseText", res.responseText);
        });
    });

    //Save Add Button
    $(document).on('click','#save_add_btn',function(e){
        e.preventDefault();

        $.ajax({
            method:"POST",
            url:url_ctrl+'act_add',
            cache:false,
            data: {
                jenis_lokasi        : $("#jenis_lokasi option:selected").val(),
                tgl_jadwal          : $("#tgl_jadwal").val(),
                jam_penjemputan     : $("#jam_penjemputan").val(),
                nama_pemesan        : $("#nama_pemesan").val(),
                nomor_hp            : $("#nomor_hp").val(),
                jml_penumpang       : $("#jml_penumpang").val(),
                lokasi_penjemputan  : $("#lokasi_penjemputan").val(),
                lokasi_awal         : $("#lokasi_awal  option:selected").val(),
                lokasi_tujuan       : $("#lokasi_tujuan  option:selected").val(),
                keterangan          : $("#keterangan").val()
            }
        })
        .done(function(result) {
            var obj = jQuery.parseJSON(result);
            if(obj.status == 1){
                notifNo(obj.notif);
            }
            if(obj.status == 2){
                $("div#MyModal").modal('hide');
                notifYesAuto(obj.notif);
                table.ajax.reload();            
            }
        })
        .fail(function(res){
            alert('Error Response !');
            console.log("responseText", res.responseText);
        });
    });

    // Edit Button
    $(document).on('click','#edit_btn',function(e){
        e.preventDefault();
        $.ajax({
            method:"GET",
            url:url_ctrl+'edit',
            cache:false,
            data:{id_request:$(this).attr('data-id')}
        })
        .done(function(view) {
            $('#MyModalTitle').html('<b>Ubah</b>');
            $('div.modal-dialog').addClass('modal-md');
            $("div#MyModalContent").html(view);
            $("div#MyModalFooter").html('<button type="submit" class="btn btn-default center-block" id="save_edit_btn">Ubah</button>');
            $("div#MyModal").modal('show');
            setDatePicker();
        })
        .fail(function(res){
            alert('Error Response !');
            console.log("responseText", res.responseText);
        });
    });

    //Save edit Button
    $(document).on('click','#save_edit_btn',function(e){
        e.preventDefault();

        $.ajax({
            method:"POST",
            url:url_ctrl+'act_edit',
            cache:false,
            data: {
                jenis_lokasi        : $("#jenis_lokasi option:selected").val(),
                tgl_jadwal          : $("#tgl_jadwal").val(),
                jam_penjemputan     : $("#jam_penjemputan").val(),
                nama_pemesan        : $("#nama_pemesan").val(),
                nomor_hp            : $("#nomor_hp").val(),
                jml_penumpang       : $("#jml_penumpang").val(),
                lokasi_penjemputan  : $("#lokasi_penjemputan").val(),
                lokasi_awal         : $("#lokasi_awal  option:selected").val(),
                lokasi_tujuan       : $("#lokasi_tujuan  option:selected").val(),
                keterangan          : $("#keterangan").val(),
                id_request          : $("#id_request").val()
            }
        })
        .done(function(result) {
            var obj = jQuery.parseJSON(result);
            if(obj.status == 1){
                notifNo(obj.notif);
            }
            if(obj.status == 2){
                $("div#MyModal").modal('hide');
                notifYesAuto(obj.notif);
                table.ajax.reload();            
            }
        })
        .fail(function(res){
            alert('Error Response !');
            console.log("responseText", res.responseText);
        });
    });

    // Delete Button
    $(document).on('click','#delete_btn',function(e){
        e.preventDefault();
        var id = $(this).attr('data-id');
        var rowData = table.row('tr.actived').data();
        var nomor_request = rowData['0'];
        swal({
            title: 'Anda yakin ?',
            text: 'User data '+nomor_request+' akan dihapus ?',
            type: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya, hapus !',
            cancelButtonText: 'Tidak, batalkan !'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    method:"POST",
                    url:url_ctrl+'act_del',
                    data: {
                        id_request:id,
                        nomor_request:nomor_request
                    }
                })
                .done(function(result) {
                    var obj = jQuery.parseJSON(result);
                    if(obj.status == 1){
                        notifNo(obj.notif);
                    }
                    if(obj.status == 2){
                        $("div#MyModal").modal('hide');
                        notifYesAuto(obj.notif);
                        table.row('tr.actived').remove().draw(false);
                    }
                })
                .fail(function(res){
                    alert('Error Response !');
                    console.log("responseText", res.responseText);
                });
            }
        })
    });

    // Tampil Button
    $(document).on('click','#detail_btn',function(e){
        e.preventDefault();
        $.ajax({
            method:"GET",
            url:url_ctrl+'tampil',
            cache:false,
            data:{id_request:$(this).attr('data-id')}
        })
        .done(function(view) {
            $('#MyModalTitle').html('<b>Detail</b>');
            $('div.modal-dialog').addClass('modal-lg');
            $("div#MyModalContent").html(view);
            $("div#MyModal").modal('show');
        })
        .fail(function(res){
            alert('Error Response !');
            console.log("responseText", res.responseText);
        });
    });

    // Denied spv
    $(document).on('click','#dined_spv',function(e){
        e.preventDefault();
        $.ajax({
            method:"GET",
            url:url_ctrl+'dined_spv',
            cache:false,
            data:{id_request:$(this).attr('data-id')}
        })
        .done(function(view) {
            $('#MyModalTitle').html('<b>Denied</b>');
            $('div.modal-dialog').addClass('modal-sm');
            $("div#MyModalContent").html(view);
            $("div#MyModalFooter").html('<button type="submit" class="btn btn-default center-block" id="save_dined_spv">Simpan</button>');
            $("div#MyModal").modal('show');
        })
        .fail(function(res){
            alert('Error Response !');
            console.log("responseText", res.responseText);
        });
    });

    // act denied spv
    $(document).on('click','#save_dined_spv',function(e){
        e.preventDefault();
        $.ajax({
            method:"POST",
            url:url_ctrl+'save_dined_spv',
            cache:false,
            data:{
                id_request : $("#id_request").val(),
                keterangan : $("#keterangan").val()
            }
        })
        .done(function(view) {
            var obj = jQuery.parseJSON(view);
            if(obj.status == 1){
                notifNo(obj.notif);
            }
            if(obj.status == 2){
                $("div#MyModal").modal('hide');
                notifYesAuto(obj.notif);
                table.ajax.reload();            
            }
        })
        .fail(function(res){
            alert('Error Response !');
            console.log("responseText", res.responseText);
        });
    });

    // Approval spv
    $(document).on('click','#apr_spv',function(e){
        e.preventDefault();
        $.ajax({
            method:"POST",
            url:url_ctrl+'apr_spv',
            cache:false,
            data:{id_request:$(this).attr('data-id')}
        })
        .done(function(view) {
            var obj = jQuery.parseJSON(view);
            if(obj.status == 1){
                notifNo(obj.notif);
            }
            if(obj.status == 2){
                notifYesAuto(obj.notif);
                table.ajax.reload();            
            }
        })
        .fail(function(res){
            alert('Error Response !');
            console.log("responseText", res.responseText);
        });
    });

    // Approved GA
    $(document).on('click','#apr_ga',function(e){
        e.preventDefault();
        $.ajax({
            method:"GET",
            url:url_ctrl+'apr_ga',
            cache:false,
            data:{id_request:$(this).attr('data-id')}
        })
        .done(function(view) {
            $('#MyModalTitle').html('<b>Approved</b>');
            $('div.modal-dialog').addClass('modal-sm');
            $("div#MyModalContent").html(view);
            $("div#MyModalFooter").html('<button type="submit" class="btn btn-default center-block" id="save_apr_ga">Simpan</button>');
            $("div#MyModal").modal('show');
        })
        .fail(function(res){
            alert('Error Response !');
            console.log("responseText", res.responseText);
        });
    });


    // act apr ga
    $(document).on('click','#save_apr_ga',function(e){
        e.preventDefault();
        $.ajax({
            method:"POST",
            url:url_ctrl+'save_apr_ga',
            cache:false,
            data:{
                id_request      : $("#id_request").val(),
                id_driver       : $("#id_driver option:selected").val(),
                id_kendaraan    : $("#id_kendaraan option:selected").val()
            }
        })
        .done(function(view) {
            var obj = jQuery.parseJSON(view);
            if(obj.status == 1){
                notifNo(obj.notif);
            }
            if(obj.status == 2){
                $("div#MyModal").modal('hide');
                notifYesAuto(obj.notif);
                table.ajax.reload();            
            }
        })
        .fail(function(res){
            alert('Error Response !');
            console.log("responseText", res.responseText);
        });
    });

    // denied GA
    $(document).on('click','#dined_ga',function(e){
        e.preventDefault();
        $.ajax({
            method:"GET",
            url:url_ctrl+'dined_ga',
            cache:false,
            data:{id_request:$(this).attr('data-id')}
        })
        .done(function(view) {
            $('#MyModalTitle').html('<b>Denied</b>');
            $('div.modal-dialog').addClass('modal-sm');
            $("div#MyModalContent").html(view);
            $("div#MyModalFooter").html('<button type="submit" class="btn btn-default center-block" id="save_denied_ga">Simpan</button>');
            $("div#MyModal").modal('show');
        })
        .fail(function(res){
            alert('Error Response !');
            console.log("responseText", res.responseText);
        });
    });


    // act denied ga
    $(document).on('click','#save_denied_ga',function(e){
        e.preventDefault();
        $.ajax({
            method:"POST",
            url:url_ctrl+'save_denied_ga',
            cache:false,
            data:{
                id_request      : $("#id_request").val(),
                keterangan      : $("#keterangan").val()
            }
        })
        .done(function(view) {
            var obj = jQuery.parseJSON(view);
            if(obj.status == 1){
                notifNo(obj.notif);
            }
            if(obj.status == 2){
                $("div#MyModal").modal('hide');
                notifYesAuto(obj.notif);
                table.ajax.reload();            
            }
        })
        .fail(function(res){
            alert('Error Response !');
            console.log("responseText", res.responseText);
        });
    });

    function setDatePicker() {
        $(".date").datetimepicker({
            // startDate:'1980-01-01',
            scrollInput: false,
            format: 'Y-m-d',
            changeMonth : true,
            changeYear : true, 
            timepicker: false
        });
    } 
});