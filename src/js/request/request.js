$(document).ready(function () {
  var url_ctrl = site_url + "request/request/";

  var table = $("#tabel_custom").DataTable({
    ajax: url_ctrl + "table",
    deferRender: true,
    order: [["0", "desc"]],
  });

  var table_detail = $("#tabel_detail").DataTable({
    "ajax": {
         method: "GET",
         url: url_ctrl + 'table_detail',
         cache: false,
         data: {
             nomor_tiket: $("#nomor_tiket").val()
         }
     },
    "deferRender": true,
    "searching": false,
    "paging": false,
    "info": false,
    "ordering": false
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
        $("#MyModalTitle").html("<b>Penilaian</b>");
        $("div.modal-dialog").addClass("modal-sm");
        $("div#MyModalContent").html(view);
        $("div#MyModalFooter").html(
          '<button type="submit" class="btn btn-default center-block" id="save_finish">Simpan</button>'
        );
        $("div#MyModal").modal("show");
        
      })
      .fail(function (res) {
        alert("Error Response !");
        console.log("responseText", res.responseText);
      });
  });

  // act finish
  $(document).on("click", "#save_finish", function (e) {
    e.preventDefault();
    var validate = "";
    $.ajax({
      method: "POST",
      url: url_ctrl + "save_finish",
      cache: false,
      data: {
        id_request: $("#id_request").val(),
        keramahan : $("input:radio[name='keramahan']:checked").val(),
        ketepatan : $("input:radio[name='ketepatan']:checked").val(),
        kebersihan: $("input:radio[name='kebersihan']:checked").val()
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

  // cancel
  $(document).on("click", "#cancel_btn", function (e) {
    e.preventDefault();
    $.ajax({
      method: "GET",
      url: url_ctrl + "cancel",
      cache: false,
      data: { id_request: $(this).attr("data-id") },
    })
      .done(function (view) {
        $("#MyModalTitle").html("<b>Cancel</b>");
        $("div.modal-dialog").addClass("modal-sm");
        $("div#MyModalContent").html(view);
        $("div#MyModalFooter").html(
          '<button type="submit" class="btn btn-default center-block" id="save_cancel">Simpan</button>'
        );
        $("div#MyModal").modal("show");
      })
      .fail(function (res) {
        alert("Error Response !");
        console.log("responseText", res.responseText);
      });
  });

  // act cancel
  $(document).on("click", "#save_cancel", function (e) {
    e.preventDefault();
    $.ajax({
      method: "POST",
      url: url_ctrl + "save_cancel",
      cache: false,
      data: {
        id_request: $("#id_request").val(),
        ket_cancel: $("#ket_cancel").val(),
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

    var kategori = $("#kategori option:selected").val();
    if (kategori == "") {
      notifNoAuto("Silahkan Pilih Kategori");
      return false;
    }
    $("#formArea").load(url_ctrl + "add/" + kategori, function () {
      if (kategori == 2) {
        setDatePickerMulti();
      } else {
        setDatePicker();
      }
      scrollUp();
      $(".time").mask("00:00");
      clock();
      chekc_layanan();
      chekc_booking();
      jenis_pemesan();
      chekc_pulang();
    });
  });

  // Form Edit
  $(document).on("click", "#form_edit_btn", function (e) {
    e.preventDefault();

    var id = $(this).attr("data-id");

    window.location=url_ctrl + "form_edit/" + id;

  });

  //Save Add Button
  $(document).on("click", "#save_add_btn", function (e) {
    e.preventDefault();
    $("#show_spinner").show();
    var validate = "";
    var kategori = $("#kategori").val();
    var jenis_pemesan = $("#jenis_pemesan option:selected").val();
    var nik_input = $("#nik_input").val();
    var nm_lengkap = $("#nm_lengkap").val();
    var nomor_hp = $("#nomor_hp").val();
    if (jenis_pemesan == 1) {
      if (nik_input == "") {
        swal("Perhatian", "Isi Nomor Induk Karyawan<br>", "warning");
        return false;
      }
    } else {
      if (nm_lengkap == "") {
        swal("Perhatian", "Isi Nama Lengkap<br>", "warning");
        return false;
      }
    }
    if (nomor_hp == "") {
      swal("Perhatian", "Isi Nomor Handphone<br>", "warning");
      return false;
    }

    if (kategori == 3) {
      var jns_booking = $("input:radio[name='jns_booking']:checked").val();
      var tgl_jadwal_bkg = $("#tgl_jadwal_bkg").val();
      var dari_pukul_bkg = $("#dari_pukul_bkg").val();
      var sampai_pukul_bkg = $("#sampai_pukul_bkg").val();
      var keterangan_jam = $("#keterangan_jam").val();
      var dari_tgl_bkg = $("#dari_tgl_bkg").val();
      var sampai_tgl_bkg = $("#sampai_tgl_bkg").val();
      var keterangan_tanggal = $("#keterangan_tanggal").val();
      var minlength = 15;

      if (jns_booking == 1) {
        if (tgl_jadwal_bkg == "") {
          validate += "Isi Tanggal Jadwal <br>";
        }
        if (keterangan_jam == "") {
          validate += "Isi Keterangan <br>";
        }
        if (keterangan_jam.length < minlength) {
          validate += "Keterangan harus lebih dari 15 karakter <br>";
        }
      } else {
        if (dari_tgl_bkg == "") {
          swal("Perhatian", "Isi Dari Tanggal ", "warning");
          return false;
        }
        if (sampai_tgl_bkg == "") {
          swal("Perhatian", "Isi Sampai Tanggal ", "warning");
          return false;
        }
        if (keterangan_tanggal == "") {
          swal("Perhatian", "Isi Keterangan ", "warning");
          return false;
        }
        if (keterangan_tanggal.length < minlength) {
          swal(
            "Perhatian",
            "Keterangan harus lebih dari 15 karakter ",
            "warning"
          );
          return false;
        }
      }
    } else if (kategori == 1) {
      var tgl_jadwal = $("#tgl_jadwal").val();
      var dari_pukul = $("#dari_pukul").val();
      var sampai_pukul = $("#sampai_pukul").val();
      var lokasi_penjemputan = $("#lokasi_penjemputan").val();
      var lokasi_awal = $("#lokasi_awal  option:selected").val();
      var lokasi_tujuan = $("#lokasi_tujuan  option:selected").val();
      var keterangan = $("#keterangan").val();
      var minlength = 15;
      var pulang = $("input:checkbox.pulang:checked").val();

      var tgl_jadwal_mlt = $("input.tgl_jadwal_mlt")
        .map(function () {
          return $(this).val();
        })
        .get();

      if (tgl_jadwal == "") {
        swal("Perhatian", "Isi Tanggal Jadwal ", "warning");
        return false;
      }
      if (lokasi_penjemputan == "") {
        swal("Perhatian", "Isi Lokasi Penjemputan ", "warning");
        return false;
      }
      if (lokasi_awal == "") {
        swal("Perhatian", "Pilih Lokasi Keberangkatan ", "warning");
        return false;
      }
      if (lokasi_tujuan == "") {
        swal("Perhatian", "Pilih Lokasi Tujuan ", "warning");
        return false;
      }
      if (keterangan == "") {
        swal("Perhatian", "Isi Keterangan ", "warning");
        return false;
      }
      if (keterangan.length < minlength) {
        swal(
          "Perhatian",
          "Keterangan harus lebih dari 15 karakter ",
          "warning"
        );
        return false;
      }

      if (pulang == 1) {
        var tgl_jadwal_plg = $("#tgl_jadwal_plg").val();
        var lokasi_penjemputan_plg = $("#lokasi_penjemputan_plg").val();
        if (tgl_jadwal_plg == "") {
          swal("Perhatian", "Isi Tanggal Pulang ", "warning");
          return false;
        }
        if (lokasi_penjemputan_plg == "") {
          swal("Perhatian", "Isi Lokasi Penjemputan Pulang ", "warning");
          return false;
        }
      }
      if (typeof tgl_jadwal_mlt) {
        var dari_pukul_mlt = $("input.dari_pukul_mlt")
          .map(function () {
            return $(this).val();
          })
          .get();
        var sampai_pukul_mlt = $("input.sampai_pukul_mlt")
          .map(function () {
            return $(this).val();
          })
          .get();
        var lokasi_penjemputan_mlt = $("input.lokasi_penjemputan_mlt")
          .map(function () {
            return $(this).val();
          })
          .get();
        var lokasi_awal_mlt = $(".lokasi_awal_mlt option:selected")
          .map(function () {
            return $(this).val();
          })
          .get();
        var lokasi_tujuan_mlt = $(".lokasi_tujuan_mlt option:selected")
          .map(function () {
            return $(this).val();
          })
          .get();
        var keterangan_mlt = $(".keterangan_mlt")
          .map(function () {
            return $(this).val();
          })
          .get();

        var penjemputan = [];
        $("input.lokasi_penjemputan_mlt").each(function (i, selected) {
          penjemputan[i] = $(selected).val();
          if (!isNaN(penjemputan[i])) {
            validate += "Isi Lokasi Penjemputan<br>";
          }
        });
        var tanggal = [];
        $("input.tgl_jadwal_mlt").each(function (i, selected) {
          tanggal[i] = $(selected).val();
          if (!isNaN(tanggal[i])) {
            validate += "Isi Tanggal Jadwal<br>";
          }
        });
      }
    } else if (kategori == 2) {
      var jns_booking = $("input:radio[name='jns_booking']:checked").val();
      var dari_pukul = $("#dari_pukul").val();
      var sampai_pukul = $("#sampai_pukul").val();
      var lokasi_penjemputan = $("#lokasi_penjemputan").val();
      var lokasi_awal = $("#lokasi_awal  option:selected").val();
      var lokasi_tujuan = $("#lokasi_tujuan  option:selected").val();
      var keterangan = $("#keterangan").val();
      var minlength = 15;
      var pulang = $("input:checkbox.pulang:checked").val();

      var tanggal = $("#tanggal").val();

      if (tgl_jadwal == "") {
        swal("Perhatian", "Isi Tanggal Jadwal ", "warning");
        return false;
      }
      if (lokasi_penjemputan == "") {
        swal("Perhatian", "Isi Lokasi Penjemputan ", "warning");
        return false;
      }
      if (lokasi_awal == "") {
        swal("Perhatian", "Pilih Lokasi Keberangkatan ", "warning");
        return false;
      }
      if (lokasi_tujuan == "") {
        swal("Perhatian", "Pilih Lokasi Tujuan ", "warning");
        return false;
      }
      if (keterangan == "") {
        swal("Perhatian", "Isi Keterangan ", "warning");
        return false;
      }
      if (keterangan.length < minlength) {
        swal(
          "Perhatian",
          "Keterangan harus lebih dari 15 karakter ",
          "warning"
        );
        return false;
      }

      var lokasi_penjemputan_mlt = $("input.lokasi_penjemputan_mlt")
        .map(function () {
          return $(this).val();
        })
        .get();

      if (lokasi_penjemputan_mlt != "") {
        var dari_pukul_mlt = $("input.dari_pukul_mlt")
          .map(function () {
            return $(this).val();
          })
          .get();
        var sampai_pukul_mlt = $("input.sampai_pukul_mlt")
          .map(function () {
            return $(this).val();
          })
          .get();
        var lokasi_penjemputan_mlt = $("input.lokasi_penjemputan_mlt")
          .map(function () {
            return $(this).val();
          })
          .get();
        var lokasi_awal_mlt = $(".lokasi_awal_mlt option:selected")
          .map(function () {
            return $(this).val();
          })
          .get();
        var lokasi_tujuan_mlt = $(".lokasi_tujuan_mlt option:selected")
          .map(function () {
            return $(this).val();
          })
          .get();
        var keterangan_mlt = $(".keterangan_mlt")
          .map(function () {
            return $(this).val();
          })
          .get();

        var penjemputan = [];
        $("input.lokasi_penjemputan_mlt").each(function (i, selected) {
          penjemputan[i] = $(selected).val();
          if (!isNaN(penjemputan[i])) {
            validate += "Isi Lokasi Penjemputan<br>";
          }
        });
        var tanggal = [];
        $("input.tgl_jadwal_mlt").each(function (i, selected) {
          tanggal[i] = $(selected).val();
          if (!isNaN(tanggal[i])) {
            validate += "Isi Tanggal Jadwal<br>";
          }
        });
      }
    }

    if (validate != "") {
      swal("Perhatian", validate, "warning");
      return false;
    }

    $.ajax({
      method: "POST",
      url: url_ctrl + "act_add",
      cache: false,
      data: {
        jenis_kebutuhan: $("#jenis_kebutuhan option:selected").val(),
        jenis_lokasi: $("#jenis_lokasi option:selected").val(),
        jenis_pemesan: $("#jenis_pemesan option:selected").val(),
        nik_input: $("#nik_input").val(),
        nm_lengkap: $("#nm_lengkap").val(),
        nomor_hp: $("#nomor_hp").val(),
        jml_penumpang: $("#jml_penumpang").val(),

        kategori: $("#kategori").val(),

        jns_booking: $("input:radio[name='jns_booking']:checked").val(),

        dari_tgl_bkg: $("#dari_tgl_bkg").val(),
        sampai_tgl_bkg: $("#sampai_tgl_bkg").val(),
        keterangan_tanggal: $("#keterangan_tanggal").val(),

        tgl_jadwal_bkg: $("#tgl_jadwal_bkg").val(),
        dari_pukul_bkg: $("#dari_pukul_bkg").val(),
        sampai_pukul_bkg: $("#sampai_pukul_bkg").val(),
        keterangan_jam: $("#keterangan_jam").val(),

        jns_layanan: $("input:radio[name='jns_layanan']:checked").val(),

        tgl_jadwal: $("#tgl_jadwal").val(),
        dari_pukul: $("#dari_pukul").val(),
        sampai_pukul: $("#sampai_pukul").val(),
        lokasi_penjemputan: $("#lokasi_penjemputan").val(),
        lokasi_awal: $("#lokasi_awal  option:selected").val(),
        lokasi_tujuan: $("#lokasi_tujuan  option:selected").val(),
        keterangan: $("#keterangan").val(),

        pulang: $("input:checkbox.pulang:checked").val(),
        tgl_jadwal_plg: $("#tgl_jadwal_plg").val(),
        dari_pukul_plg: $("#dari_pukul_plg").val(),
        sampai_pukul_plg: $("#sampai_pukul_plg").val(),
        lokasi_penjemputan_plg: $("#lokasi_penjemputan_plg").val(),

        tgl_jadwal_mlt: tgl_jadwal_mlt,
        tanggal: $("#tanggal").val(),
        dari_pukul_mlt: dari_pukul_mlt,
        sampai_pukul_mlt: sampai_pukul_mlt,
        lokasi_penjemputan_mlt: lokasi_penjemputan_mlt,
        lokasi_awal_mlt: lokasi_awal_mlt,
        lokasi_tujuan_mlt: lokasi_tujuan_mlt,
        keterangan_mlt: keterangan_mlt,
      },
    })
      .done(function (result) {
        var obj = jQuery.parseJSON(result);
        if (obj.status == 1) {
          notifNo(obj.notif);
          $("#show_spinner").hide();
        }
        if (obj.status == 2) {
          $("#formArea").html("");
          notifYesAuto(obj.notif);
          table.ajax.reload();
        }
        // console.log(result);
      })
      .fail(function (res) {
        alert("Error Response !");
        console.log("responseText", res.responseText);
      });
  });

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
        jenis_kebutuhan     : $("#jenis_kebutuhan option:selected").val(),
        jenis_lokasi        : $("#jenis_lokasi option:selected").val(),
        jenis_pemesan       : $("#jenis_pemesan option:selected").val(),
        nik_input           : $("#nik_input").val(),
        nm_lengkap          : $("#nm_lengkap").val(),
        nomor_hp            : $("#nomor_hp").val(),
        jml_penumpang       : $("#jml_penumpang").val(),
        tgl_jadwal          : $("#tgl_jadwal").val(),
        sampai_tanggal      : $("#sampai_tanggal").val(),
        dari_pukul          : $("#dari_pukul").val(),
        sampai_pukul        : $("#sampai_pukul").val(),
        lokasi_penjemputan  : $("#lokasi_penjemputan").val(),
        lokasi_awal         : $("#lokasi_awal  option:selected").val(),
        lokasi_tujuan       : $("#lokasi_tujuan  option:selected").val(),
        keterangan          : $("#keterangan").val(),
        id_request          : $("#id_request").val(),
        kategori            : $("#kategori").val(),
        jns_booking         : $("#jns_booking").val()
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

  $(document).on("click", "#delete_btn", function (e) {
    e.preventDefault();
    var id = $(this).attr("data-id");
    var nomor_request = $(this).attr("data-nomor");

    swal({
      title: "Anda yakin ?",
      text: "Nomor tiket " + nomor_request + " akan dihapus ?",
      type: "question",
      showCancelButton: true,
      confirmButtonText: "Ya, hapus !",
      cancelButtonText: "Tidak, batalkan !",
    }).then((result) => {
      if (result.value) {
        $.ajax({
          method: "POST",
          url: url_ctrl + "act_del",
          data: {
            id_request: id,
            nomor_request: nomor_request,
          },
        })
          .done(function (result) {
            var obj = jQuery.parseJSON(result);

            if (obj.status == 2) {
              $("div#MyModal").modal("hide");
              notifYesAuto(obj.notif);
              table.ajax.reload();
            }
            if (obj.status == 1) {
              notifNo(obj.notif);
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

  function clock() {
    $(".waktu").clockpicker({
      format: "m-H",
      align: "top",
      autoclose: true,
    });
  }

  function setDatePicker() {
    $(".date").datepicker({
      // startDate:'1980-01-01',
      scrollInput: false,
      format: "dd-mm-yyyy",
      changeMonth: true,
      changeYear: true,
      timepicker: false,
    });
  }

  function setDatePickerMulti() {
    $(".date").datepicker({
      setDate: new Date(),
      scrollInput: false,
      inline: false,
      lang: "en",
      step: 5,
      multidate: 6,
      closeOnDateSelect: true,
      format: "dd-mm-yyyy",
      changeMonth: true,
      changeYear: true,
      timepicker: false,
    });
  }

  function scrollUp() {
    $("html, body").animate({ scrollTop: 0 }, "slow");
    //$("html, body").animate({ scrollTop:1000 }, 1000);
  }

  $(document).on("click", "#batal_btn", function (e) {
    e.preventDefault();
    $("#formArea").html("");
  });

  $(document).on("click", "#tutup_edit_btn", function (e) {
    e.preventDefault();
    window.location=url_ctrl;
  });

  $(document).on("click", "#tutup_btn", function (e) {
    e.preventDefault();
    $("#formArea").html("");
  });

  function chekc_pulang() {
    $(".pulang").on("change", function () {
      if (this.checked) {
        $("#pulang_pergi").show();
      } else {
        $("#pulang_pergi").hide();
      }
    });
  }

  function chekc_layanan() {
    $(".jns_layanan").on("change", function () {
      if (this.value == 1) {
        $("#sekali_jalan").show();
        $("#multi_tujuan").hide();
        $("#multitujuan").html("");
      } else {
        $("#sekali_jalan").hide();
        $("#multi_tujuan").show();
        $("#pulang_pergi").hide();
        $(".pulang").prop("checked", false);
      }
    });
  }

  function chekc_booking() {
    $(".jns_booking").on("change", function () {
      if (this.value == 1) {
        $("#by_jam").show();
        $("#by_tanggal").hide();
        $("#dari_tgl_bkg").val("");
        $("#sampai_tgl_bkg").val("");
        $("#keterangan_tanggal").val("");
      } else {
        $("#by_jam").hide();
        $("#by_tanggal").show();
        $("#tgl_jadwal_bkg").val("");
        $("#keterangan_jam").val("");
      }
    });
  }

  function jenis_pemesan() {
    $("#jenis_pemesan").on("change", function () {
      //  alert( this.value ); // or $(this).val()
      if (this.value == 1) {
        $("#karyawan").show();
        $("#visitor").hide();
        $("#nm_lengkap").val("");
      } else {
        $("#karyawan").hide();
        $("#visitor").show();
        $("#nik_input").val("");
      }
    });
  }

  //only number
  // validasi form
  $(document).on("keydown", "#nik_input", function (e) {
    -1 !== $.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) ||
      (/65|67|86|88/.test(e.keyCode) &&
        (!0 === e.ctrlKey || !0 === e.metaKey)) ||
      (35 <= e.keyCode && 40 >= e.keyCode) ||
      ((e.shiftKey || 48 > e.keyCode || 57 < e.keyCode) &&
        (96 > e.keyCode || 105 < e.keyCode) &&
        e.preventDefault());

    var val = $(this).val();
    if (val.length == 8) {
      val = val.substring(0, val.length - 1);
      $(this).val(val);
      $(this).focus();
      return true;
    }
  });

  //only number no hp
  // validasi form
  $(document).on("keydown", "#nomor_hp", function (e) {
    -1 !== $.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) ||
      (/65|67|86|88/.test(e.keyCode) &&
        (!0 === e.ctrlKey || !0 === e.metaKey)) ||
      (35 <= e.keyCode && 40 >= e.keyCode) ||
      ((e.shiftKey || 48 > e.keyCode || 57 < e.keyCode) &&
        (96 > e.keyCode || 105 < e.keyCode) &&
        e.preventDefault());

    var val = $(this).val();
    if (val.length == 13) {
      val = val.substring(0, val.length - 1);
      $(this).val(val);
      $(this).focus();
      return true;
    }
  });

  $(document).on("keyup", "#nik_input", function (e) {
    e.preventDefault();

    id_nik = $("#nik_input").val();

    if (id_nik.length < 8 || id_nik.length >= 8) {
      $.ajax({
        method: "GET",
        cache: false,
        data: { id: id_nik },
        url: url_ctrl + "data_karyawan",
      })
        .done(function (result) {
          var obj = jQuery.parseJSON(result);
          if (obj !== null) {
            $("#nam").show();
            $("#per").show();
            $("#div").show();
            $("#nama_lengkap").val(obj.nama_lengkap);
            $("#company").val(obj.alias_perusahaan);
            $("#divisi").val(obj.divisi_idn);
            $("#nomor_hp").val(obj.no_hp1);
          } else {
            $("#nama_lengkap").val("");
            $("#company").val("");
            $("#divisi").val("");
            $("#nomor_hp").val("");
          }
          //console.log(obj.nama_lengkap);
        })
        .fail(function (res) {
          alert("Error Response !");
          console.log("responseText", res.responseText);
        });
    } else {
      $("#nam").hide();
      $("#per").hide();
      $("#div").hide();
      $("#nama_lengkap").val("");
      $("#company").val("");
      $("#divisi").val("");
      $("#nomor_hp").val("");
    }
  });

  $(document).on("click", "#add_tujuan", function (e) {
    e.preventDefault();
    $.ajax({
      method: "GET",
      cache: false,
      url: url_ctrl + "data_lokasi",
    }).done(function (result) {
      var kategori = $("#kategori").val();
      if (kategori == 1) {
        var row_id = Math.floor(Math.random() * 999999);
        $("#multitujuan").append(
          "<div class='row' id='" +
            row_id +
            "'>" +
            "<div class='col-lg-12'><hr></div>" +
            "<div class='col-lg-3'>" +
            "<div class='form-group'>" +
            "<label class='control-label'>Tanggal Jadwal </label>" +
            "<div class='input-group'>" +
            "<input class='form-control date tgl_jadwal_mlt' placeholder='Pilih Tanggal' type='text' id='tgl_jadwal_mlt'>" +
            "<div class='input-group-append'>" +
            "<span class='input-group-text' id='basic-addon2'>" +
            "<i class='fa fa-calendar'></i>" +
            "</div>" +
            "</div>" +
            "</div>" +
            "</div>" +
            "<div class='col-lg-2'>" +
            "<div class='form-group'>" +
            "<label class='control-label'>Dari </label>" +
            "<div class='input-group'>" +
            "<input class='form-control time dari_pukul_mlt waktu' type='text' value='08:00' id='dari_pukul_mlt'>" +
            "<div class='input-group-append'>" +
            "<span class='input-group-text' id='basic-addon2'>" +
            "<i class='fa fa-clock'></i>" +
            "</div>" +
            "</div>" +
            "</div>" +
            "</div>" +
            "<div class='col-lg-2'>" +
            "<div class='form-group'>" +
            "<label class='control-label'>Sampai </label>" +
            "<div class='input-group'>" +
            "<input class='form-control time sampai_pukul_mlt waktu' type='text' value='08:00' id='sampai_pukul_mlt'>" +
            "<div class='input-group-append'>" +
            "<span class='input-group-text' id='basic-addon2'>" +
            "<i class='fa fa-clock'></i>" +
            "</div>" +
            "</div>" +
            "</div>" +
            "</div>" +
            "<div class='col-lg-4'>" +
            "<div class='form-group'>" +
            "<label class='control-label'>Lokasi Penjemputan </label>" +
            "<input class='form-control lokasi_penjemputan_mlt' type='text' id='lokasi_penjemputan'>" +
            "</div>" +
            "</div>" +
            "<div class='col-lg-1'>" +
            "<div class='form-group'>" +
            "<label class='control-label'>&nbsp;</label>" +
            "<div class='input-group-append'><button row-id='" +
            row_id +
            "' class='btn btn-danger delete_tujuan'><i class='fa fa-trash'></i></button></div>" +
            "</div>" +
            "</div>" +
            "<div class='col-lg-3'>" +
            "<div class='form-group'>" +
            "<label class='control-label'>Lokasi Keberangkatan </label>" +
            "<select class='form-control lokasi_awal_mlt' id='lokasi_awal'>" +
            "<option value=''>--- Pilih ---</option>" +
            "" +
            result +
            "" +
            "</select>" +
            "</div>" +
            "</div>" +
            "<div class='col-lg-4'>" +
            "<div class='form-group'>" +
            "<label class='control-label'>Lokasi Tujuan </label>" +
            "<select class='form-control lokasi_tujuan_mlt' id='lokasi_tujuan'>" +
            "<option value=''>--- Pilih ---</option>" +
            "" +
            result +
            "" +
            "</select>" +
            "</div>" +
            "</div>" +
            "<div class='col-lg-4'>" +
            "<div class='form-group'>" +
            "<label class='control-label'>Keterangan </label>" +
            "<textarea class='form-control keterangan_mlt' id='keterangan'></textarea>" +
            "</div>" +
            "</div>" +
            "</div>"
        );
        setDatePicker();
        clock();
        $(".time").mask("00:00");
      } else {
        var row_id = Math.floor(Math.random() * 999999);
        $("#multitujuan").append(
          "<div class='row' id='" +
            row_id +
            "'>" +
            "<div class='col-lg-12'><hr></div>" +
            "<div class='col-lg-2'>" +
            "<div class='form-group'>" +
            "<label class='control-label'>Dari </label>" +
            "<div class='input-group'>" +
            "<input class='form-control time dari_pukul_mlt waktu' type='text' value='08:30' id='dari_pukul'>" +
            "<div class='input-group-append'>" +
            "<span class='input-group-text' id='basic-addon2'>" +
            "<i class='fa fa-clock'></i>" +
            "</div>" +
            "</div>" +
            "</div>" +
            "</div>" +
            "<div class='col-lg-2'>" +
            "<div class='form-group'>" +
            "<label class='control-label'>Sampai </label>" +
            "<div class='input-group'>" +
            "<input class='form-control time sampai_pukul_mlt waktu' type='text' value='08:30' id='sampai_pukul'>" +
            "<div class='input-group-append'>" +
            "<span class='input-group-text' id='basic-addon2'>" +
            "<i class='fa fa-clock'></i>" +
            "</div>" +
            "</div>" +
            "</div>" +
            "</div>" +
            "<div class='col-lg-3'>" +
            "<div class='form-group'>" +
            "<label class='control-label'>Lokasi Keberangkatan </label>" +
            "<select class='form-control lokasi_awal_mlt' id='lokasi_awal'>" +
            "<option value=''>--- Pilih ---</option>" +
            "" +
            result +
            "" +
            "</select>" +
            "</div>" +
            "</div>" +
            "<div class='col-lg-4'>" +
            "<div class='form-group'>" +
            "<label class='control-label'>Lokasi Tujuan </label>" +
            "<select class='form-control lokasi_tujuan_mlt' id='lokasi_tujuan'>" +
            "<option value=''>--- Pilih ---</option>" +
            "" +
            result +
            "" +
            "</select>" +
            "</div>" +
            "</div>" +
            "<div class='col-lg-1'>" +
            "<div class='form-group'>" +
            "<label class='control-label'>&nbsp;</label>" +
            "<div class='input-group-append'><button row-id='" +
            row_id +
            "' class='btn btn-danger delete_tujuan'><i class='fa fa-trash'></i></button></div>" +
            "</div>" +
            "</div>" +
            "<div class='col-lg-4'>" +
            "<div class='form-group'>" +
            "<label class='control-label'>Lokasi Penjemputan </label>" +
            "<input class='form-control lokasi_penjemputan_mlt' type='text' id='lokasi_penjemputan'>" +
            "</div>" +
            "</div>" +
            "<div class='col-lg-7'>" +
            "<div class='form-group'>" +
            "<label class='control-label'>Keterangan </label>" +
            "<textarea class='form-control keterangan_mlt' id='keterangan'></textarea>" +
            "</div>" +
            "</div>" +
            "<div class='col-lg-12'><hr></div>" +
            "</div>" +
            "</div>" +
            "</div>"
        );
      }
      setDatePicker();
      clock();
      $(".time").mask("00:00");
    });
  });

  $(document).on("click", ".delete_tujuan", function (e) {
    var row_id = $(this).attr("row-id");
    $("#" + row_id).remove();
  });
});
