import { formatMoney } from "../../../assets/js/helper.js";

$(document).ready(function () {
  $(document).on("click", ".btn-detail-product", showDetailProduct);
  $(document).on("click", ".btn-delete-product", deleteProduct);
  $("#search-keyword").on("keyup", searchProduct);

  function showDetailProduct() {
    const productID = $(this).data("product-id");
    $.ajax({
      type: "GET",
      url: `../../api/product/getDetailProduct.php?id=${productID}`,
      beforeSend: function () {
        $("#detailProductModalBody").html("LOadingg");
      },
      success: function (response) {
        const product = JSON.parse(response);
        const variants =
          JSON.parse(product.variants) !== null
            ? `<ul>${JSON.parse(product.variants)
                .map((variant) => {
                  return `<li>${variant.name}: ${variant.value.join(",")}</li>`;
                })
                .join("")}</ul>`
            : `<h5 class="poppins-regular text-primary">Tidak Ada Varian</h5>`;

        let HTML = `
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <div class="mb-3">
                        <h6 class="poppins-semibold text-secondary">Nama Produk</h6>
                        <h5 class="poppins-regular text-primary">${
                          product.name
                        }</h5>
                    </div>
                    <div class="mb-3">
                        <h6 class="poppins-semibold text-secondary">Kategori</h6>
                        <h5 class="poppins-regular text-primary">${
                          product.category
                        }</h5>
                    </div>
                    <div class="mb-3">
                        <h6 class="poppins-semibold text-secondary">Deskripsi</h6>
                        <h5 class="poppins-regular text-primary">
                            ${product.description}
                        </h5>
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-3">
                        <h6 class="poppins-semibold text-secondary">Harga Produk</h6>
                        <h5 class="poppins-regular text-primary">
                            ${formatMoney(product.price)}
                        </h5>
                    </div>
                    <div class="mb-3">
                        <h6 class="poppins-semibold text-secondary">Varian Produk</h6>
                        ${variants}
                    </div>
                    <div class="mb-3">
                        <h6 class="poppins-semibold text-secondary">Gambar Produk</h6>
                        <img class="img-fluid w-50" src="../../uploads/${
                          product.image
                        }" alt="">
                    </div>
                </div>
            </div>
        </div>`;
        $("#detailProductModalBody").html(HTML);
      },
    });
  }

  function deleteProduct() {
    const productID = $(this).data("product-id");
    $("#delete-id").val(productID);
  }

  function searchProduct() {
    const keyword = $(this).val();
    $.ajax({
      type: "method",
      url: `../../api/product/searchProduct.php?keyword=${keyword}`,
      success: function (response) {
        const products = JSON.parse(response);
        let HTML = "";
        products.forEach((product, i) => {
          HTML += `
            <tr>
                <td>${i + 1}</td>
                <td>${product.name}</td>
                <td>${product.category}</td>
                <td>${formatMoney(product.price)}</td>
                <td>
                    <div class="d-flex gap-2">
                        <a href="javascript:void(0)" class="btn btn-sm btn-info btn-detail-product"
                            data-product-id="${
                              product.id
                            }" data-bs-toggle="modal"
                            data-bs-target="#detailProductModal">
                            <i class="fa-regular fa-eye"></i>
                            Detail
                        </a>
                        <a href="product-edit.php?id=${
                          product.id
                        }" class="btn btn-sm btn-warning">
                            <i class="fa-regular fa-pen-to-square"></i>
                            Edit
                        </a>
                        <a href="javascript:void(0)" class="btn btn-sm btn-danger btn-delete-product"
                            data-product-id="${
                              product.id
                            }" data-bs-toggle="modal" data-bs-target="#deleteModal">
                            <i class="fa-regular fa-trash-can"></i>
                            Hapus
                        </a>
                    </div>
                </td>
            </tr>
            `;
        });

        $("#product-list").html(HTML);
      },
    });
  }
});
