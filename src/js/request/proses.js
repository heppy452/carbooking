$(document).ready(function(){
	var url_ctrl = site_url+"request/proses/";
	
	var table = $('#tabel_custom').DataTable({
        "ajax": url_ctrl+'table',
        "deferRender": true,
        "order": [["0", "desc"]]
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

    // edit
    $(document).on('click','#sopir_btn',function(e){
        e.preventDefault();
        $.ajax({
            method:"GET",
            url:url_ctrl+'sopir',
            cache:false,
            data:{id_request:$(this).attr('data-id')}
        })
        .done(function(view) {
            $('#MyModalTitle').html('<b>Ubah</b>');
            $('div.modal-dialog').addClass('modal-sm');
            $("div#MyModalContent").html(view);
            $("div#MyModalFooter").html('<button type="submit" class="btn btn-default center-block" id="save_sopir">Simpan</button>');
            $("div#MyModal").modal('show');
        })
        .fail(function(res){
            alert('Error Response !');
            console.log("responseText", res.responseText);
        });
    });

    // act edit
    $(document).on('click','#save_sopir',function(e){
        e.preventDefault();
        $.ajax({
            method:"POST",
            url:url_ctrl+'act_sopir',
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
            $('.time').mask('00:00');
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
                jenis_kebutuhan     : $("#jenis_kebutuhan option:selected").val(),
                jenis_lokasi        : $("#jenis_lokasi option:selected").val(),
                id_perusahaan       : $("#id_perusahaan option:selected").val(),
                id_departement      : $("#id_departement option:selected").val(),
                tgl_jadwal          : $("#tgl_jadwal").val(),
                jam_penjemputan     : $("#jam_penjemputan").val(),
                nama_pemesan        : $("#nama_pemesan").val(),
                nomor_hp            : $("#nomor_hp").val(),
                jml_penumpang       : $("#jml_penumpang").val(),
                lokasi_penjemputan  : $("#lokasi_penjemputan").val(),
                lokasi_awal         : $("#lokasi_awal  option:selected").val(),
                lokasi_tujuan       : $("#lokasi_tujuan  option:selected").val(),
                durasi              : $("#durasi").val(),
                satuan              : $("#satuan option:selected").val(),
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
            cache:false,
            url:url_ctrl+'edit',
            data:{id_request:$(this).attr('data-id')}
        })
        .done(function(view) {
            $('#MyModalTitle').html('<b>Ubah Data</b>');
            $('div.modal-dialog').addClass('modal-md');
            $("div#MyModalContent").html(view);
            $("div#MyModalFooter").html('<button type="submit" class="btn btn-default center-block" id="save_edit_btn">Simpan</button>');
            $("div#MyModal").modal('show');
            setDatePicker();
            $('.time').mask('00:00');
        })
        .fail(function(res){
            alert('Error Response !');
            console.log("responseText", res.responseText);
        });
    });

    //Save Edit Button
    $(document).on('click','#save_edit_btn',function(e){
        e.preventDefault();

        $.ajax({
            method:"POST",
            url:url_ctrl+'act_edit',
            cache:false,
            data: {
                jenis_kebutuhan     : $("#jenis_kebutuhan option:selected").val(),
                jenis_lokasi        : $("#jenis_lokasi option:selected").val(),
                id_perusahaan       : $("#id_perusahaan option:selected").val(),
                id_departement      : $("#id_departement option:selected").val(),
                tgl_jadwal          : $("#tgl_jadwal").val(),
                jam_penjemputan     : $("#jam_penjemputan").val(),
                nama_pemesan        : $("#nama_pemesan").val(),
                nomor_hp            : $("#nomor_hp").val(),
                jml_penumpang       : $("#jml_penumpang").val(),
                lokasi_penjemputan  : $("#lokasi_penjemputan").val(),
                lokasi_awal         : $("#lokasi_awal  option:selected").val(),
                lokasi_tujuan       : $("#lokasi_tujuan  option:selected").val(),
                keterangan          : $("#keterangan").val(),
                durasi              : $("#durasi").val(),
                satuan              : $("#satuan option:selected").val(),
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