$(document).ready(function () {
  var url_ctrl = site_url + "more_data/data_lokasi/";

  var table = $("#tabel_custom").DataTable({
    ajax: url_ctrl + "table",
    deferRender: true,
    order: [["0", "desc"]],
  });

  // Select Row Table
  $("#tabel_custom tbody").on("click", "tr", function (e) {
    e.preventDefault();
    if ($(this).hasClass("actived")) {
      $(this).removeClass("actived");
      $(this).addClass("actived");
    } else {
      table.$("tr.actived").removeClass("actived");
      $(this).addClass("actived");
    }

    rowId = table.row(this).id();
    leftWidht = e.pageX - 50;
    $("#popup_menu")
      .css({ left: leftWidht + "px", top: e.pageY + "px" })
      .show("fast", function () {
        $("button#edit_btn").attr("data-id", rowId);
        $("button#delete_btn").attr("data-id", rowId);
      });
  });

  $(document).on("click", function (e) {
    if (e.target.nodeName !== "TD") {
      $("#popup_menu").hide();
      $("#popup_menu").removeAttr("style");
    }
  });

  // Add Button
  $(document).on("click", "#add_btn", function (e) {
    e.preventDefault();
    $.ajax({
      method: "GET",
      cache: false,
      url: url_ctrl + "add",
    })
      .done(function (view) {
        $("#MyModalTitle").html("<b>Tambah Data</b>");
        $("div.modal-dialog").addClass("modal-sm");
        $("div#MyModalContent").html(view);
        $("div#MyModalFooter").html(
          '<button type="submit" class="btn btn-default center-block" id="save_add_btn">Simpan</button>'
        );
        $("div#MyModal").modal("show");
      })
      .fail(function (res) {
        alert("Error Response !");
        console.log("responseText", res.responseText);
      });
  });

  //Save Add Button
  $(document).on("click", "#save_add_btn", function (e) {
    e.preventDefault();
    $.ajax({
      method: "POST",
      url: url_ctrl + "act_add",
      cache: false,
      data: {
        nama_lokasi: $("#nama_lokasi").val(),
        kategori_lokasi: $("#kategori_lokasi").val(),
      },
    })
      .done(function (result) {
        var obj = jQuery.parseJSON(result);
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

  // edit Button
  $(document).on("click", "#edit_btn", function (e) {
    e.preventDefault();
    $.ajax({
      method: "GET",
      cache: false,
      url: url_ctrl + "edit",
      data: { id: $(this).attr("data-id") },
    })
      .done(function (view) {
        $("#MyModalTitle").html("<b>Edit Data</b>");
        $("div.modal-dialog").addClass("modal-sm");
        $("div#MyModalContent").html(view);
        $("div#MyModalFooter").html(
          '<button type="submit" class="btn btn-default center-block" id="save_edit_btn">Simpan</button>'
        );
        $("div#MyModal").modal("show");
        $(".autocomplete").chosen();
        setDatePicker();
      })
      .fail(function (res) {
        alert("Error Response !");
        console.log("responseText", res.responseText);
      });
  });

  //Save Add Button
  $(document).on("click", "#save_edit_btn", function (e) {
    e.preventDefault();

    $.ajax({
      method: "POST",
      url: url_ctrl + "act_edit",
      cache: false,
      data: {
        nama_lokasi: $("#nama_lokasi").val(),
        kategori_lokasi: $("#kategori_lokasi").val(),
        nama_lokasi_old: $("#nama_lokasi_old").val(),
        id_lokasi: $("#id_lokasi").val(),
      },
    })
      .done(function (result) {
        var obj = jQuery.parseJSON(result);
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

  $(document).on("click", "button#delete_btn", function (e) {
    e.preventDefault();
    var id = $(this).attr("data-id");
    var rowData = table.row("tr.actived").data();
    var data_delete = rowData["1"];
    swal({
      title: "Apakah Anda Yakin ?",
      text: "Data " + data_delete + " akan di hapus ?",
      type: "question",
      showCancelButton: true,
      confirmButtonText: "Iya, Yakin !",
      cancelButtonText: "Tidak, Batal !",
    }).then((result) => {
      if (result.value) {
        $.ajax({
          method: "POST",
          url: url_ctrl + "act_del",
          data: {
            id: id,
          },
        })
          .done(function (result) {
            var obj = jQuery.parseJSON(result);
            if (obj.status == 1) {
              notifNo(obj.notif);
            }
            if (obj.status == 2) {
              $("div#MyModal").modal("hide");
              notifYesAuto(obj.notif);
              table.row("tr.actived").remove().draw(false);
            }
          })
          .fail(function (res) {
            alert("Error Response !");
            console.log("responseText", res.responseText);
          });
      }
    });
  });
});
