$(document).ready(function () {
  $(".select-variant").on("click", selectVariant);
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
});
