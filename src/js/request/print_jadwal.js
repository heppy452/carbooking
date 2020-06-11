$(document).ready(function(){
	var url_ctrl = site_url+"request/print_jadwal/";

    $(".date").datetimepicker({
        // startDate:'1980-01-01',
        scrollInput: false,
        format: 'Y-m-d',
        changeMonth : true,
        changeYear : true, 
        timepicker: false
    });

    // Search Button
    $(document).on('click','#btn_cari',function(e){
        e.preventDefault();
       $.ajax({
            method:"POST",
            url:url_ctrl+'search',
            cache:false,
            data:{
                id_driver    : $("#id_driver  option:selected").val(),
                tgl_jadwal  : $("#tgl_jadwal").val()
            }
        })
        .done(function(view) {
            $('#MyModalTitle').html('<b>Data Jadwal</b>');
            $('div.modal-dialog').addClass('modal-lg');
            $("div#MyModalContent").html(view);
            $("div#MyModal").modal('show');
        })
        .fail(function(res){
            alert('Error Response !');
            console.log("responseText", res.responseText);
        });
    });

});