$(document).ready(function () {
  var url_ctrl = site_url + "request/app_head/";

  var table = $("#tabel_custom").DataTable({
    ajax: url_ctrl + "table",
    deferRender: true,
    order: [["0", "desc"]],
  });

  var table_detail = $("#detail").DataTable({
    ajax: {
      method: "GET",
      url: url_ctrl + "table_detail",
      cache: false,
      data: {
        tanggal: $("#tanggal").val(),
        departement: $("#departement").val(),
      },
    },
    deferRender: true,
    searching: false,
    paging: false,
    info: false,
    ordering: false,
  });

  $(document).on("click", "#form_approval", function (e) {
    e.preventDefault();

    var tanggal = $(this).attr("data-tanggal");
    var departement = $(this).attr("data-departement");
    window.location = url_ctrl + "form_approval/" + tanggal + "/" + departement;
  });

  $(document).on("click", "#tutup_btn", function (e) {
    e.preventDefault();
    window.location = url_ctrl;
  });

  function scrollUp() {
    $("html, body").animate({ scrollTop: 0 }, "slow");
  }

  $(document).on("click", "#approve_btn", function (e) {
    var validate = "";
    var id_request = $("input.id_request")
      .map(function () {
        return $(this).val();
      })
      .get();
    var keterangan = $(".keterangan")
      .map(function () {
        return $(this).val();
      })
      .get();
    var approved = $(".approved option:selected")
      .map(function () {
        return $(this).val();
      })
      .get();

<<<<<<< HEAD
    var setuju = [];
    $(".approved option:selected").each(function (i, selected) {
      setuju[i] = $(selected).val();
      if (setuju[i] == 0) {
        validate += "Pilih Approval<br>";
      }
    });
=======
        var setuju = [];
        $(".approved option:selected").each(function (i, selected) {
          setuju[i] = $(selected).val();
          if ( setuju[i] =="") {
            validate += "Pilih Approval<br>";
          }
        });
>>>>>>> 0a89c619af5a1a99f0d559dfd493a4d48920528a

    if (validate != "") {
      swal("Perhatian", validate, "warning");
      return false;
    }

    $.ajax({
      method: "POST",
      url: url_ctrl + "approve_all",
      data: {
        id_request: id_request,
        keterangan: keterangan,
        approved: approved,
      },
    })
      .done(function (result) {
        var obj = jQuery.parseJSON(result);
        if (obj.status == 1) {
          notifNo(obj.notif);
        }
        if (obj.status == 2) {
          notifYesAuto(obj.notif);
          (window.location = url_ctrl), 2000;
        }
      })
      .fail(function (res) {
        alert("Error Response !");
        console.log("responseText", res.responseText);
      });
  });

  // Approval spv
  $(document).on("click", "#apr_spv", function (e) {
    e.preventDefault();
    swal({
      title: "Approve pemesanan mobil ?",
      type: "question",
      showCancelButton: true,
      confirmButtonText: "Ya",
      cancelButtonText: "Tidak",
    }).then((result) => {
      if (result.value) {
        let timerInterval;
        Swal.fire({
          title: "LOADING...",
          html:
            "Mohon halaman jangan di close, sistem sedang mengirim email ke admin departemen.",
          timer: 8000,
          timerProgressBar: true,
          onBeforeOpen: () => {
            Swal.showLoading();
            timerInterval = setInterval(() => {
              const content = Swal.getContent();
              if (content) {
                const b = content.querySelector("b");
                if (b) {
                  b.textContent = Swal.getTimerLeft();
                }
              }
            }, 100);
          },
          onClose: () => {
            clearInterval(timerInterval);
          },
        }).then((result) => {
          if (result.dismiss === Swal.DismissReason.timer) {
            console.log("I was closed by the timer");
          }
        });
        $.ajax({
          method: "POST",
          url: url_ctrl + "apr_spv",
          cache: false,
          data: { id_request: $(this).attr("data-id") },
        })
          .done(function (view) {
            var obj = jQuery.parseJSON(view);
            if (obj.status == 1) {
              notifNo(obj.notif);
            }
            if (obj.status == 2) {
              notifYesAuto(obj.notif);
              table.ajax.reload();
            }
          })
          .fail(function (res) {
            alert("Error Response !");
            console.log("responseText", res.responseText);
          });
      }
    });
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
});
