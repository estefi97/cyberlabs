$(document).ready(function () {
  "use strict";
  // init list view datatable

  var idiomaPaginaWeb = document.documentElement.lang;
  var textoBotonAgregarArticulo = "";

  if (idiomaPaginaWeb === "en") {
    textoBotonAgregarArticulo = "Add Plan";
  }

  if (idiomaPaginaWeb === "es") {
    textoBotonAgregarArticulo = "Agregar Plan";
  }

  $(".deleteBtn").on("click", function () {
    $("#deleteModal").modal("show");

    var p = $(this).closest("td").parent("tr");

    document.getElementById("idPlanSeleccionado").value =
      p[0].cells[4].children[2].innerText;

    var idAutorSeleccionadoValor = document.getElementById(
      "idPlanSeleccionado"
    ).value;

    $("#deleteId").val(idAutorSeleccionadoValor);
  });

  $(".editBtn").on("click", function () {
    var p = $(this).closest("td").parent("tr");

    document.getElementById("idAutorSeleccionado").value =
      p[0].cells[4].children[3].innerText;

    var idAutorSeleccionadoValor = document.getElementById(
      "idAutorSeleccionado"
    ).value;

    document.cookie = `idAutorSeleccionado=${idAutorSeleccionadoValor}`;

    window.location.href = "modificar-autor";
  });

  $(".bibliografiaBtn").on("click", function () {
    var p = $(this).closest("td").parent("tr");

    document.getElementById("idAutorSeleccionado").value =
      p[0].cells[4].children[3].innerText;

    var idAutorSeleccionadoValor = document.getElementById(
      "idAutorSeleccionado"
    ).value;

    document.cookie = `idAutorSeleccionado=${idAutorSeleccionadoValor}`;

    window.location.href = "bibliografia-autor";
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
    order: false,
    bInfo: false,
    pageLength: 4,
    buttons: [
      {
        text: `<i class='feather icon-plus'></i> ${textoBotonAgregarArticulo}`,
        action: function () {
          window.location = "planes/agregar";
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
        checkboxes: { selectRow: true },
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
    select: {
      style: "multi",
    },
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
