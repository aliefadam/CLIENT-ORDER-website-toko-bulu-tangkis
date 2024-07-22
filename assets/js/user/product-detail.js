$(document).ready(function () {
  $(".select-variant").on("click", selectVariant);
  $("#btn-tambah-qty").on("click", () => chageQty("plus"));
  $("#btn-kurang-qty").on("click", () => chageQty("minus"));
  setVariant();

  function setVariant() {
    const list_variant = $(".variant-active")
      .get()
      .map((variant) => {
        return $(variant).data("variant");
      });
    $("#list-variant").val(JSON.stringify(list_variant));
  }

  function selectVariant() {
    const index = $(this).data("index");
    $(`.select-variant-${index}`).removeClass("variant-active");
    $(this).addClass("variant-active");

    setVariant();
  }

  function chageQty(type) {
    console.log("TES");
    const qty = $("#qty").val();
    if (type == "plus") {
      $("#qty").val(parseInt(qty) + 1);
      $("#input-qty").val(parseInt(qty) + 1);
    } else {
      if (parseInt(qty) <= 1) return;
      $("#qty").val(parseInt(qty) - 1);
      $("#input-qty").val(parseInt(qty) - 1);
    }
  }
});
