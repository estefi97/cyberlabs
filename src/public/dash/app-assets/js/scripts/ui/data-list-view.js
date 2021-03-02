/*=========================================================================================
    File Name: data-list-view.js
    Description: List View
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
    Author: PIXINVENT
    Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/

$(document).ready(function () {
  "use strict";
  // init list view datatable

  $(".deleteBtn").on("click", function () {
    $("#deleteModal").modal("show");

    var p = $(this).closest("td").parent("tr");

    $("#deleteId").val(p[0].cells[0].innerText);
  });

  $(".editBtn").on("click", function () {
    var p = $(this).closest("td").parent("tr");

    document.getElementById("selloSeleccionado").value =
      p[0].cells[0].innerText;

    var selloEditorialSeleccionadaValor = document.getElementById(
      "selloSeleccionado"
    ).value;

    localStorage.setItem(
      "selloEditorialSeleccionada",
      selloEditorialSeleccionadaValor
    );

    document.cookie = `selloEditorialSeleccionada=${selloEditorialSeleccionadaValor}`;

    window.location.href = "modificar-editorial";
  });

  var dataListView = $(".data-list-view").DataTable({
    responsive: false,
    columnDefs: [
      {
        orderable: true,
      },
    ],
    dom:
      '<"top"<"actions action-btns"B><"action-filters"lf>><"clear">rt<"bottom"<"actions">p>',
    oLanguage: {
      sLengthMenu: "_MENU_",
      sSearch: "",
    },
    aLengthMenu: [
      [4, 10, 15, 20],
      [4, 10, 15, 20],
    ],
    order: [[1, "asc"]],
    bInfo: false,
    pageLength: 4,
    buttons: [
      {
        text: "<i class='feather icon-plus'></i> Agregar Editorial",
        action: function () {
          window.location = "agregar-editorial";
        },
        className: "btn-primary waves-effect waves-light",
      },
    ],
    initComplete: function (settings, json) {
      $(".dt-buttons .btn").removeClass("btn-secondary");
    },
  });

  dataListView.on("draw.dt", function () {
    setTimeout(function () {
      if (navigator.userAgent.indexOf("Mac OS X") != -1) {
        $(".dt-checkboxes-cell input, .dt-checkboxes").addClass("mac-checkbox");
      }
    }, 50);
  });

  // init thumb view datatable
  var dataThumbView = $(".data-thumb-view").DataTable({
    responsive: false,
    columnDefs: [
      {
        orderable: true,
        targets: 0,
      },
    ],
    dom:
      '<"top"<"actions action-btns"B><"action-filters"lf>><"clear">rt<"bottom"<"actions">p>',
    oLanguage: {
      sLengthMenu: "_MENU_",
      sSearch: "",
    },
    aLengthMenu: [
      [4, 10, 15, 20],
      [4, 10, 15, 20],
    ],
    order: [[1, "asc"]],
    bInfo: false,
    pageLength: 4,
    buttons: [
      {
        text: "<i class='feather icon-plus'></i> Agregar Editorial",
        action: function () {
          $(this).removeClass("btn-secondary");
          $(".add-new-data").addClass("show");
          $(".overlay-bg").addClass("show");
        },
        className: "btn-outline-primary",
      },
    ],
    initComplete: function (settings, json) {
      $(".dt-buttons .btn").removeClass("btn-secondary");
    },
  });

  dataThumbView.on("draw.dt", function () {
    setTimeout(function () {
      if (navigator.userAgent.indexOf("Mac OS X") != -1) {
        $(".dt-checkboxes-cell input, .dt-checkboxes").addClass("mac-checkbox");
      }
    }, 50);
  });

  // To append actions dropdown before add new button
  var actionDropdown = $(".actions-dropodown");
  actionDropdown.insertBefore($(".top .actions .dt-buttons"));

  // Scrollbar
  if ($(".data-items").length > 0) {
    new PerfectScrollbar(".data-items", { wheelPropagation: false });
  }

  // Close sidebar
  $(".hide-data-sidebar, .cancel-data-btn, .overlay-bg").on(
    "click",
    function () {
      $(".add-new-data").removeClass("show");
      $(".overlay-bg").removeClass("show");
      $("#data-name, #data-price").val("");
      $("#data-category, #data-status").prop("selectedIndex", 0);
    }
  );

  // dropzone init
  Dropzone.options.dataListUpload = {
    complete: function (files) {
      var _this = this;
      // checks files in class dropzone and remove that files
      $(".hide-data-sidebar, .cancel-data-btn, .actions .dt-buttons").on(
        "click",
        function () {
          $(".dropzone")[0].dropzone.files.forEach(function (file) {
            file.previewElement.remove();
          });
          $(".dropzone").removeClass("dz-started");
        }
      );
    },
  };
  Dropzone.options.dataListUpload.complete();

  // mac chrome checkbox fix
  if (navigator.userAgent.indexOf("Mac OS X") != -1) {
    $(".dt-checkboxes-cell input, .dt-checkboxes").addClass("mac-checkbox");
  }
});
