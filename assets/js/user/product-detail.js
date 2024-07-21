$(document).ready(function () {
  $(".select-variant").on("click", selectVariant);

  function selectVariant() {
    const index = $(this).data("index");
    $(`.select-variant-${index}`).removeClass("variant-active");
    $(this).addClass("variant-active");
  }
});
