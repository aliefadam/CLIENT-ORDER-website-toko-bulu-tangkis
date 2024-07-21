$(document).ready(function () {
  $("#btn-tambah-variant").on("click", tambahVariant);
  $(document).on("click", ".btn-remove-value", removeValueVarian);

  function tambahVariant() {
    const html = `
            <div class="list mb-2">
                <div class="item-1">
                    <input type="text" class="form-control" name="nama_variant[]" placeholder="Nama">
                </div>
                <div class="item-2">
                    <input type="text" class="form-control" name="value_variant[]"
                        placeholder="Nilai | Pisahkan Koma">
                </div>
                <div class="item-3">
                    <button class="btn btn-danger btn-remove-value" type="button"><i class="fa-regular fa-circle-minus"></i></button>
                </div>
            </div>`;

    $("#variant-list").append(html);
  }

  function removeValueVarian() {
    $(this).parent().parent().remove();
  }
});
