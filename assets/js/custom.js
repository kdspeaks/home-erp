$(document).ready(function () {
  //LOGIN
  if ($(".login-page").length) {
    $("#login-form").submit(function (e) {
      e.preventDefault();
      const formData = $(this).serialize();
      $.ajax({
        type: "POST",
        url: "",
        data: formData,
        beforeSend: function () {
          $("#login-err-box").fadeOut();
          $("#login-btn").html('<span class="fas fa-spinner fa-spin"></span>');
        },
        success: function (data) {
          $("#login-err-box").removeClass("alert-danger");
          $("#login-err-box").addClass("alert-success");
          $("#login-err-msg").text(JSON.parse(data).response);
          $("#login-err-box").fadeIn();
          window.location = app_url + "/dashboard";
        },
        error: function (data) {
          $("#login-btn").html("লগ ইন");
          $("#login-err-msg").text(JSON.parse(data.responseText).response);
          $("#login-err-box").fadeIn();
        },
      });
    });
  }

  //New Brand Add
  if ($("#add-brand").length) {
    $("#add-brand").click(function (e) {
      e.preventDefault();
      $("#addBrand").modal("show");
    });
  }
  $("#add-brand-input").select2({
    width: "100%",
    tags: true,
    tokenSeparators: [","],
    minimumInputLength: 3,
    language: "bn",
  });

  $("#add-brand-form").submit(function (e) {
    e.preventDefault();
    let brands = [];
    $("#add-brand-input")
      .select2("data")
      .forEach((e) => {
        brands.push(e.text);
      });
    let formData = $(this).serialize();

    $.ajax({
      type: "POST",
      url: "",
      data: formData,
      success: function (data) {
        $("#add-brand-input").val(null).trigger("change");
        $("#addBrand").modal("hide");
        brandsTable.ajax.reload();
        $(document).Toasts("create", {
          title: "সফল",
          autohide: true,
          delay: 10000,
          body: JSON.parse(data).response,
          class: "bg-olive",
          icon: "fas fa-check-circle",
        });
      },
      error: function (data) {
        $(document).Toasts("create", {
          title: "সফল হয় নি",
          autohide: true,
          delay: 10000,
          body: JSON.parse(data).responseText.response,
          class: "bg-maroon",
          icon: "fas fa-exclamation-circle",
        });
      },
    });
  });

  let brandsTable = $("#list-brands-table").DataTable({
    language: {
      url: "//cdn.datatables.net/plug-ins/1.11.4/i18n/bn.json",
    },
    ajax: app_url + "/brands/getBrands",
    // select: {
    //   style: "multi",
    //   selector: "td:first-child",
    // },
    columnDefs: [
      { data: "pubId", width: "10%", targets: 0 },
      { data: "name", targets: 1 },
      {
        data: "id",
        width: "20%",
        render: function (datum, type, row) {
          return `<a class="btn bg-maroon btn-sm delete-brand" href="${
            app_url + "/brand/" + datum
          }/delete" data-id="${datum}">
                            <i class="fas fa-trash"></i>
                        </a>`;
        },
        targets: 2,
      },
      // {
      //   targets: 0,
      //   data: null,
      //   defaultContent: "",
      //   orderable: false,
      //   className: "select-checkbox",
      //   width: "5%",
      // },
      { orderable: false, targets: "no-sort" },
    ],
    // order: [[1, "asc"]],
  });

  // $("#selectAll").on("click", function (e) {
  //   if ($(this).is(":checked")) {
  //     brandsTable.rows({ search: "applied" }).select();
  //   } else {
  //     brandsTable.rows({ search: "applied" }).deselect();
  //   }
  // });

  // var selectedIds = [];

  // brandsTable.on("select.dt", function (e, dt, type, indexes) {
  //   selectedIds.push(indexes[0]);
  //   console.log(selectedIds);
  // });

  // brandsTable.on("deselect.dt", function (e, dt, type, indexes) {
  //   selectedIds.splice(selectedIds.indexOf(indexes[0]), 1);
  //   console.log(selectedIds);
  // });

  //Delete Brand
  $(document).on("click", ".delete-brand", function (e) {
    e.preventDefault();
    Swal.fire({
      title: "আপনি কি নিশ্চিত ভাবে এই ব্র্যান্ডটি মুছে ফেলতে চান?",
      showCancelButton: true,
      confirmButtonText: "মুছুন",
      cancelButtonText: `না! মুছব না`,
    }).then((result) => {
      /* Read more about isConfirmed, isDenied below */
      if (result.isConfirmed) {
        let id = $(this).data("id");
        let formData = $("#delete-brand").serialize();
        $.ajax({
          type: "DELETE",
          url: app_url + "/brand/" + id,
          data: formData,
          success: function (data) {
            Swal.fire(JSON.parse(data).response, "", "success");
            brandsTable.ajax.reload();
          },
          error: function (data) {
            Swal.fire(JSON.parse(data).responseText.response, "", "success");
          },
        });
      }
    });
  });

  let taxRatesTable = $("#list-tax-rates-table").DataTable({
    language: {
      url: "//cdn.datatables.net/plug-ins/1.11.4/i18n/bn.json",
    },
    ajax: app_url + "/tax-rates/getTaxRates",
    // select: {
    //   style: "multi",
    //   selector: "td:first-child",
    // },
    columnDefs: [
      { data: "pubId", width: "10%", targets: 0 },
      { data: "name", targets: 1 },
      { data: "rate", targets: 2 },
      { data: "tax_type", targets: 3 },
      {
        data: "id",
        width: "20%",
        render: function (datum, type, row) {
          return `<a class="btn bg-maroon btn-sm delete-tax-rate" href="${
            app_url + "/tax-rate/" + datum
          }/delete" data-id="${datum}">
                            <i class="fas fa-trash"></i>
                        </a>`;
        },
        targets: 4,
      },
      // {
      //   targets: 0,
      //   data: null,
      //   defaultContent: "",
      //   orderable: false,
      //   className: "select-checkbox",
      //   width: "5%",
      // },
      { orderable: false, targets: "no-sort" },
    ],
    // order: [[1, "asc"]],
  });

  //Add Tax Rate
  if ($("#add-tax-rate").length) {
    $("#add-tax-rate").click(function (e) {
      e.preventDefault();
      $("#addTaxRate").modal("show");
    });
  }

  $("#add-tax-rate-form").submit(function (e) {
    e.preventDefault();
    let formData = $(this).serialize();

    $.ajax({
      type: "POST",
      url: "",
      data: formData,
      success: function (data) {
        $("#add-tax-rate-form")[0].reset();
        $("#addTaxRate").modal("hide");
        taxRatesTable.ajax.reload();
        $(document).Toasts("create", {
          title: "সফল",
          autohide: true,
          delay: 10000,
          body: JSON.parse(data).response,
          class: "bg-olive",
          icon: "fas fa-check-circle",
        });
      },
      error: function (data) {
        $(document).Toasts("create", {
          title: "সফল হয় নি",
          autohide: true,
          delay: 10000,
          body: JSON.parse(data).responseText.response,
          class: "bg-maroon",
          icon: "fas fa-exclamation-circle",
        });
      },
    });
  });

  //Delete TAx RAte
  $(document).on("click", ".delete-tax-rate", function (e) {
    e.preventDefault();
    Swal.fire({
      title: "আপনি কি নিশ্চিত ভাবে এই ব্র্যান্ডটি মুছে ফেলতে চান?",
      showCancelButton: true,
      confirmButtonText: "মুছুন",
      cancelButtonText: `না! মুছব না`,
    }).then((result) => {
      /* Read more about isConfirmed, isDenied below */
      if (result.isConfirmed) {
        let id = $(this).data("id");
        let formData = $("#delete-tax-rate").serialize();
        $.ajax({
          type: "DELETE",
          url: app_url + "/tax-rate/" + id,
          data: formData,
          success: function (data) {
            Swal.fire(JSON.parse(data).response, "", "success");
            taxRatesTable.ajax.reload();
          },
          error: function (data) {
            Swal.fire(JSON.parse(data).responseText.response, "", "success");
          },
        });
      }
    });
  });

  //Products
  if ($("#brand-for-product").length) {
    $("#brand-for-product").select2({
      // width: "100%",
      tags: true,
      tokenSeparators: [","],
      language: "bn",
      placeholder: "ব্র্যান্ড সিলেক্ট করুন",
    });
  }
  if ($("#tax-rate-for-product").length) {
    $("#tax-rate-for-product").select2({
      // width: "100%",
      tags: true,
      tokenSeparators: [","],
      language: "bn",
      placeholder: "ট্যাক্সের হার সিলেক্ট করুন",
    });
  }

  fieldCount = 1;
  formHtml = `<div class="row mb-3 mx-n2" id="variant-details-n">
                                <div class="col-12 col-lg-3 mb-3 mb-lg-0">
                                    <label for="variant-power-n" class="form-label">Power</label>
                                    <input type="text" name="variant-power" id="variant-power-n" class="form-control" required>
                                </div>
                                <div class="col-12 col-lg-3 mb-3 mb-lg-0">
                                    <label for="variant-package-n" class="form-label">Package</label>
                                    <input type="text" name="variant-package" id="variant-package-n" class="form-control" required>
                                </div>
                                <div class="col-12 col-lg-3 mb-3 mb-lg-0">
                                    <label for="variant-purchase-price-n" class="form-label">ক্র​য় মুল্য</label>
                                    <input type="text" name="variant-purchase-price" id="variant-purchase-price-n" class="form-control" required>
                                </div>
                                <div class="col-12 col-lg-3 mb-3 mb-lg-0">
                                    <label for="variant-sale-price-n" class="form-label">বিক্র​য় মুল্য</label>
                                    <input type="text" name="variant-sale-price" id="variant-sale-price-n" class="form-control" required>
                                </div>
                                <div class="d-flex px-2 mt-2">
                                    <button class="btn bg-olive btn-sm mr-2 add-button" id="add-button-n"><i class="fas fa-plus-circle"></i></button>
                                    <button class="btn btn-danger btn-sm delete-button" id="delete-button-n"><i class="fas fa-trash"></i></button>
                                </div>
                            </div>`;
  if (fieldCount === 1) {
    $("#delete-button-1").hide();
  }

  $(document).on("click", ".add-button", function (e) {
    e.preventDefault();
    fieldCount++;

    $("#variant-details-wrapper").append(appendRow(fieldCount));
    $("#variant-details-" + fieldCount).slideDown();
    hideAddButton(fieldCount - 1);
    hideDeleteButton(fieldCount - 1);
  });

  $(document).on("click", ".delete-button", function (e) {
    e.preventDefault();
    $("#variant-details-" + fieldCount).slideUp("normal", function () {
      $(this).remove();
      fieldCount--;

      showAddButton(fieldCount);
      if (fieldCount !== 1) {
        showDeleteButton(fieldCount);
      }
    });
  });

  $("#add-product-form").submit(function (e) {
    e.preventDefault();
    let power = [];
    let package = [];
    let cost = [];
    let price = [];

    reqType = "POST";

    $("input[name=variant-power]").each(function () {
      power.push($(this).val());
    });
    $("input[name=variant-package]").each(function () {
      package.push($(this).val());
    });
    $("input[name=variant-purchase-price]").each(function () {
      cost.push($(this).val());
    });
    $("input[name=variant-sale-price]").each(function () {
      price.push($(this).val());
    });

    let jsonObj = [];
    for (let i = 0; i < power.length; i++) {
      let item = {};
      item["power"] = power[i];
      item["package"] = package[i];
      item["purchase_price"] = cost[i];
      item["sale_price"] = price[i];

      jsonObj.push(item);
    }
    let formData = {};

    formData["name"] = $("#name").val();
    formData["brand-for-product"] = $("#brand-for-product").val();
    formData["tax-rate-for-product"] = $("#tax-rate-for-product").val();
    formData["key-awesome"] = $("#key-awesome").val();
    formData["dataFormat"] = JSON.stringify(jsonObj).split('","').join('", "');
    // console.log(formData);
    $.ajax({
      type: reqType,
      url: "",
      data: formData,
      success: function (data) {
        $("#add-product-form")[0].reset();
        for (let i = fieldCount; i > 1; i--) {
          $("#variant-details-" + i).remove();
        }
        fieldCount = 1;
        showAddButton(1);
        $("#brand-for-product").val(null).trigger("change");
        $("#tax-rate-for-product").val(null).trigger("change");
        $(document).Toasts("create", {
          title: "সফল",
          autohide: true,
          delay: 10000,
          body: JSON.parse(data).response,
          class: "bg-olive",
          icon: "fas fa-check-circle",
        });
      },
      error: function (data) {
        $(document).Toasts("create", {
          title: "সফল হয় নি",
          autohide: true,
          delay: 10000,
          body: JSON.parse(data).responseText.response,
          class: "bg-maroon",
          icon: "fas fa-exclamation-circle",
        });
      },
    });
  });

  let productsTable = $("#list-products-table").DataTable({
    language: {
      url: "//cdn.datatables.net/plug-ins/1.11.4/i18n/bn.json",
    },
    ajax: app_url + "/products/getProducts",
    // select: {
    //   style: "multi",
    //   selector: "td:first-child",
    // },
    columnDefs: [
      { data: "pubId", width: "10%", targets: 0 },
      { data: "name", targets: 1 },
      { data: "brandName", targets: 2 },
      { data: "taxName", targets: 3 },
      {
        data: "id",
        width: "20%",
        render: function (datum, type, row) {
          return `<a class="btn bg-maroon btn-sm delete-product" href="${
            app_url + "/product/" + datum
          }/delete" data-id="${datum}">
                            <i class="fas fa-trash"></i>
                        </a>`;
        },
        targets: 4,
      },
      // {
      //   targets: 0,
      //   data: null,
      //   defaultContent: "",
      //   orderable: false,
      //   className: "select-checkbox",
      //   width: "5%",
      // },
      { orderable: false, targets: "no-sort" },
    ],
    // order: [[1, "asc"]],
  });

  //Delete TAx RAte
  $(document).on("click", ".delete-product", function (e) {
    e.preventDefault();
    Swal.fire({
      title: "আপনি কি নিশ্চিত ভাবে এই ওষুধটি মুছে ফেলতে চান?",
      showCancelButton: true,
      confirmButtonText: "মুছুন",
      cancelButtonText: `না! মুছব না`,
    }).then((result) => {
      /* Read more about isConfirmed, isDenied below */
      if (result.isConfirmed) {
        let id = $(this).data("id");
        let formData = $("#delete-product").serialize();
        $.ajax({
          type: "DELETE",
          url: app_url + "/product/" + id,
          data: formData,
          success: function (data) {
            Swal.fire(JSON.parse(data).response, "", "success");
            productsTable.ajax.reload();
          },
          error: function (data) {
            Swal.fire(JSON.parse(data).responseText.response, "", "success");
          },
        });
      }
    });
  });
});

function appendRow(n) {
  nPlusOneString = "-" + n + '"';
  return formHtml
    .replace('-n"', nPlusOneString + ' style="display: none"')
    .replace('-n"', nPlusOneString)
    .replace('-n"', nPlusOneString)
    .replace('-n"', nPlusOneString)
    .replace('-n"', nPlusOneString)
    .replace('-n"', nPlusOneString)
    .replace('-n"', nPlusOneString)
    .replace('-n"', nPlusOneString)
    .replace('-n"', nPlusOneString)
    .replace('-n"', nPlusOneString)
    .replace('-n"', nPlusOneString);
}

function hideAddButton(n) {
  $("#add-button-" + n).hide();
}
function showAddButton(n) {
  $("#add-button-" + n).show();
}
function hideDeleteButton(n) {
  $("#delete-button-" + n).hide();
}
function showDeleteButton(n) {
  $("#delete-button-" + n).show();
}
