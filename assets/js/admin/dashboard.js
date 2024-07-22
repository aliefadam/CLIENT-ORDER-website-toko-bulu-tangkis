$(document).ready(function () {
  const ctx = document.getElementById("myChart");

  new Chart(ctx, {
    type: "pie",
    data: {
      labels: ["Kategori Sepatu", "Kategori Raket", "Kategori Shuttlecock"],
      datasets: [
        {
          label: "# Jumlah Transaksi",
          data: [
            ctx.getAttribute("data-sepatu"),
            ctx.getAttribute("data-raket"),
            ctx.getAttribute("data-shuttlecock"),
          ],
          backgroundColor: [
            "rgb(163, 255, 214)",
            "rgb(123, 201, 255)",
            "rgb(133, 118, 255)",
          ],
          borderColor: [
            "rgb(74, 189, 137)",
            "rgb(58, 131, 181)",
            "rgb(63, 51, 156)",
          ],
          borderWidth: 1,
        },
      ],
    },
    options: {
      layout: {
        padding: {
          top: -10,
          bottom: 10,
        },
      },
      responsive: true,
      plugins: {
        legend: {
          position: "bottom",
          labels: {
            padding: 30,
          },
        },
        title: {
          display: true,
        },
      },
    },
  });
});
