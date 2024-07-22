import { formatMoney } from "../helper.js";

$(document).ready(function () {
  $("#search-raket").on("keyup", function () {
    searchProduct("Raket", $(this).val());
  });
  $("#search-sepatu").on("keyup", function () {
    searchProduct("Sepatu", $(this).val());
  });
  $("#search-shuttlecock").on("keyup", function () {
    searchProduct("Shuttlecock", $(this).val());
  });

  function searchProduct(category, keyword) {
    $.ajax({
      type: "GET",
      url: `../../api/product/searchProductByCategory.php?keyword=${keyword}&category=${category}`,
      success: function (response) {
        const products = JSON.parse(response);
        let HTML = "";

        products.forEach((product, i) => {
          HTML += `
            <a class="col-3 text-decoration-none" href="product-detail.php?id=${
              product.id
            }">
                <div class="border rounded p-2">
                    <img src="../../uploads/${
                      product.image
                    }" class="img-fluid" alt="">
                    <div class="mt-2 px-2">
                        <h2 class="poppins-medium fs-4 text-primary">
                        ${product.name.substring(0, 19)}...
                        </h2>
                        <span class="poppins-medium fs-5 text-secondary product-price">
                            ${formatMoney(product.price)}
                        </span>
                    </div>
                </div>
            </a>
          `;
        });

        $(`#${category}-list`).html(HTML);
      },
    });
  }
});
