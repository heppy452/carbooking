$(document).ready(function(){
	var url_ctrl = site_url + "request/app_direktur/";

	var table = $("#tabel_custom").DataTable({
	    ajax: url_ctrl + "table",
	    deferRender: true,
	    order: [["0", "desc"]],
	});

	// Tampil Button
  $(document).on("click", "#detail_btn", function (e) {
    e.preventDefault();
    $.ajax({
      method: "GET",
      url: url_ctrl + "tampil",
      cache: false,
      data: { id_request: $(this).attr("data-id") },
    })
      .done(function (view) {
        $("#MyModalTitle").html("<b>Detail</b>");
        $("div.modal-dialog").addClass("modal-lg");
        $("div#MyModalContent").html(view);
        $("div#MyModal").modal("show");
      })
      .fail(function (res) {
        alert("Error Response !");
        console.log("responseText", res.responseText);
      });
  });

  $(document).on("click", "#appoval_btn", function (e) {
    e.preventDefault();
    $.ajax({
      method: "GET",
      url: url_ctrl + "approval",
      cache: false,
      data: { id_request: $(this).attr("data-id") },
    })
      .done(function (view) {
        $("#MyModalTitle").html("<b>Approval</b>");
        $("div.modal-dialog").addClass("modal-sm");
        $("div#MyModalContent").html(view);
        $("div#MyModalFooter").html(
          '<button type="submit" class="btn btn-default center-block" id="save_approval">Simpan</button>'
        );
        $("div#MyModal").modal("show");
        
      })
      .fail(function (res) {
        alert("Error Response !");
        console.log("responseText", res.responseText);
      });
  });

  $(document).on("click", "#save_approval", function (e) {
    e.preventDefault();
    var validate = "";
    $.ajax({
      method: "POST",
      url: url_ctrl + "save_approval",
      cache: false,
      data: {
        id_request: $("#id_request").val(),
        apr_dir   : $("#apr_dir option:selected").val(),
        keterangan: $("#keterangan").val()
      },
    })
      .done(function (view) {
        var obj = jQuery.parseJSON(view);
        if (obj.status == 1) {
          notifNo(obj.notif);
        }
        if (obj.status == 2) {
          $("div#MyModal").modal("hide");
          notifYesAuto(obj.notif);
          table.ajax.reload();
        }
      })
      .fail(function (res) {
        alert("Error Response !");
        console.log("responseText", res.responseText);
      });
  });

});