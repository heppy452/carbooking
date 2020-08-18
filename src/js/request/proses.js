$(document).ready(function () {
  var url_ctrl = site_url + "request/proses/";

  var table = $("#tabel_custom").DataTable({
    ajax: url_ctrl + "table",
    deferRender: true,
    order: [["0", "desc"]],
  });

  var table = $("#tabel_proses").DataTable({
    ajax: url_ctrl + "table_proses",
    deferRender: false,
    searching: false,
    paging: true,
    info: false,
    ordering: false,
  });

  var table_detail = $("#detail").DataTable({
    ajax: {
      method: "GET",
      url: url_ctrl + "table_detail",
      cache: false,
      data: {
        tanggal: $("#tanggal").val(),
        departement: $("#departement").val(),
        kategori: $("#kategori").val(),
        booking: $("#booking").val(),
      },
    },
    deferRender: true,
    searching: false,
    paging: false,
    info: false,
    ordering: false,
  });

  $(document).on("click", "#btn_cari", function (e) {
    search();
  });

  function search() {
    var start_date = $("#start_date").val();
    var end_date = $("#end_date").val();

    $.ajax({
      method: "POST",
      cache: false,
      url: url_ctrl + "data",
      data: {
        start_date: start_date,
        end_date: end_date,
      },
    })
      .done(function (view) {
        $("#hide").hide();
        $("#tabel_pencarian").html(view);
      })
      .fail(function (res) {
        alert("Error Response !");
        console.log("responseText", res.responseText);
      });
  }

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

  // edit
  $(document).on("click", "#sopir_btn", function (e) {
    e.preventDefault();
    $.ajax({
      method: "GET",
      url: url_ctrl + "sopir",
      cache: false,
      data: { id_request: $(this).attr("data-id") },
    })
      .done(function (view) {
        $("#MyModalTitle").html("<b>Ubah</b>");
        $("div.modal-dialog").addClass("modal-sm");
        $("div#MyModalContent").html(view);
        $("div#MyModalFooter").html(
          '<button type="submit" class="btn btn-default center-block" id="save_sopir">Simpan</button>'
        );
        $("div#MyModal").modal("show");
      })
      .fail(function (res) {
        alert("Error Response !");
        console.log("responseText", res.responseText);
      });
  });

  // act edit
  $(document).on("click", "#save_sopir", function (e) {
    e.preventDefault();
    $.ajax({
      method: "POST",
      url: url_ctrl + "act_sopir",
      cache: false,
      data: {
        id_request: $("#id_request").val(),
        id_driver: $("#id_driver option:selected").val(),
        id_kendaraan: $("#id_kendaraan option:selected").val(),
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
        $("div.modal-dialog").addClass("modal-md");
        $("div#MyModalContent").html(view);
        $("div#MyModalFooter").html(
          '<button type="submit" class="btn btn-default center-block" id="save_add_btn">Simpan</button>'
        );
        $("div#MyModal").modal("show");
        setDatePicker();
        $(".time").mask("00:00");
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
        jenis_kebutuhan: $("#jenis_kebutuhan option:selected").val(),
        jenis_lokasi: $("#jenis_lokasi option:selected").val(),
        id_perusahaan: $("#id_perusahaan option:selected").val(),
        id_departement: $("#id_departement option:selected").val(),
        tgl_jadwal: $("#tgl_jadwal").val(),
        jam_penjemputan: $("#jam_penjemputan").val(),
        nama_pemesan: $("#nama_pemesan").val(),
        nomor_hp: $("#nomor_hp").val(),
        jml_penumpang: $("#jml_penumpang").val(),
        lokasi_penjemputan: $("#lokasi_penjemputan").val(),
        lokasi_awal: $("#lokasi_awal  option:selected").val(),
        lokasi_tujuan: $("#lokasi_tujuan  option:selected").val(),
        durasi: $("#durasi").val(),
        satuan: $("#satuan option:selected").val(),
        keterangan: $("#keterangan").val(),
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

  // Edit Button
  // Edit Button
  $(document).on("click", "#edit_btn", function (e) {
    e.preventDefault();
    $.ajax({
      method: "GET",
      url: url_ctrl + "edit",
      cache: false,
      data: { id_request: $(this).attr("data-id") },
    })
      .done(function (view) {
        $("#MyModalTitle").html("<b>Ubah</b>");
        $("div.modal-dialog").addClass("modal-xl");
        $("div#MyModalContent").html(view);
        $("div#MyModalFooter").html(
          '<button type="submit" class="btn btn-default center-block" id="save_edit_btn">Ubah</button>'
        );
        $("div#MyModal").modal("show");
        clock();
        jenis_pemesan();
        setDatePicker();
        $(".time").mask("00:00");
      })
      .fail(function (res) {
        alert("Error Response !");
        console.log("responseText", res.responseText);
      });
  });

  //Save edit Button
  $(document).on("click", "#save_edit_btn", function (e) {
    e.preventDefault();

    $.ajax({
      method: "POST",
      url: url_ctrl + "act_edit",
      cache: false,
      data: {
        jenis_kebutuhan: $("#jenis_kebutuhan option:selected").val(),
        jenis_lokasi: $("#jenis_lokasi option:selected").val(),
        jenis_pemesan: $("#jenis_pemesan option:selected").val(),
        nik_input: $("#nik_input").val(),
        nm_lengkap: $("#nm_lengkap").val(),
        nomor_hp: $("#nomor_hp").val(),
        jml_penumpang: $("#jml_penumpang").val(),
        tgl_jadwal: $("#tgl_jadwal").val(),
        sampai_tanggal: $("#sampai_tanggal").val(),
        dari_pukul: $("#dari_pukul").val(),
        sampai_pukul: $("#sampai_pukul").val(),
        lokasi_penjemputan: $("#lokasi_penjemputan").val(),
        lokasi_awal: $("#lokasi_awal  option:selected").val(),
        lokasi_tujuan: $("#lokasi_tujuan  option:selected").val(),
        keterangan: $("#keterangan").val(),
        id_request: $("#id_request").val(),
        kategori: $("#kategori").val(),
        jns_booking: $("#jns_booking").val(),
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
          table_detail.ajax.reload();
        }
      })
      .fail(function (res) {
        alert("Error Response !");
        console.log("responseText", res.responseText);
      });
  });

  // Finish Button
  $(document).on("click", "#finish_btn", function (e) {
    e.preventDefault();
    $.ajax({
      method: "GET",
      url: url_ctrl + "finish",
      cache: false,
      data: { id_request: $(this).attr("data-id") },
    })
      .done(function (view) {
        $("#MyModalTitle").html("<b>Finish</b>");
        $("div.modal-dialog").addClass("modal-sm");
        $("div#MyModalContent").html(view);
        $("div#MyModalFooter").html(
          '<button type="submit" class="btn btn-default center-block" id="save_finish">Simpan</button>'
        );
        $("div#MyModal").modal("show");
        setDatePicker();
      })
      .fail(function (res) {
        alert("Error Response !");
        console.log("responseText", res.responseText);
      });
  });

  // act finish
  $(document).on("click", "#save_finish", function (e) {
    e.preventDefault();
    $.ajax({
      method: "POST",
      url: url_ctrl + "save_finish",
      cache: false,
      data: {
        id_request: $("#id_request").val(),
        jam_berangkat: $("#jam_berangkat").val(),
        jam_tiba: $("#jam_tiba").val(),
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

  $(document).on("click", "#form_approval", function (e) {
    e.preventDefault();

    var tanggal = $(this).attr("data-tanggal");
    var departement = $(this).attr("data-departement");
    var kategori = $(this).attr("data-kategori");
    var booking = $(this).attr("data-booking");
    var app_dir = $(this).attr("data-dir");
    window.location =
      url_ctrl +
      "form_approval/" +
      tanggal +
      "/" +
      departement +
      "/" +
      kategori +
      "/" +
      booking +
      "/" +
      app_dir;
  });

  $(document).on("click", "#tutup_btn", function (e) {
    e.preventDefault();
    window.location = url_ctrl;
  });

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
    var kendaraan = $(".kendaraan option:selected")
      .map(function () {
        return $(this).val();
      })
      .get();
    var driver = $(".driver option:selected")
      .map(function () {
        return $(this).val();
      })
      .get();

    var setuju = [];
    $(".approved option:selected").each(function (i, selected) {
      setuju[i] = $(selected).val();
      if (setuju[i] == 0) {
        validate += "Pilih Approval<br>";
      }
    });

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
        driver: driver,
        kendaraan: kendaraan,
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

  function setDatePicker() {
    $(".date").datetimepicker({
      // startDate:'1980-01-01',
      scrollInput: false,
      format: "Y-m-d",
      changeMonth: true,
      changeYear: true,
      timepicker: false,
    });
  }

  $(".tanggalproses").datetimepicker({
    // startDate:'1980-01-01',
    scrollInput: false,
    format: "Y-m-d",
    changeMonth: true,
    changeYear: true,
    timepicker: false,
  });
});
