$(document).ready(function () {
  $("#search-keyword").on("keyup", searchUser);

  function searchUser() {
    const keyword = $(this).val();
    console.log(keyword);
    $.ajax({
      type: "GET",
      url: `../../api/user/searchUser.php?keyword=${keyword}`,
      success: function (response) {
        const users = JSON.parse(response);
        console.log(users);
        let HTML = "";
        users.forEach((product, i) => {
          HTML += `
            <tr>
              <td>${i + 1}</td>
              <td>${product.name}</td>
              <td>${product.email}</td>
              <td>${product.address}</td>
              <td>${product.role}</td>
            </tr>
            `;
        });

        $("#user-list").html(HTML);
      },
    });
  }
});
