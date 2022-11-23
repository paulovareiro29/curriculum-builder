const createRoleRow = () => {
  let row = `
  <div class="item form-row">
    <div class="form-group">
      <label>Role</label>
      <select
        data-role
        value="${availableRoles[0].id}">`;

  for (let i = 0; i < availableRoles.length; i++) {
    row += `<option value="${availableRoles[i].id}"`;
    row += `>${availableRoles[i].name}</option>`;
  }

  row += `</select>
    </div>
    <button class="btn btn-danger" type="button">X</button>
  </div>`;

  return row;
};

const loadForm = () => {
  /** FORM */
  document.getElementById("edit-form").onsubmit = async (e) => {
    e.preventDefault();

    let json = {
      roles: [],
    };

    /** INFO */
    $("#role-list")
      .children(".item")
      .each((_, row) => {
        const role = $(row).find("[data-role]");

        for (let i = 0; i < json.roles.length; i++) {
          if (json.roles[i] === role.val()) return;
        }

        json.roles.push(role.val());
      });

    axios
      .post("/curriculum/api/user/edit?id=" + e.target.dataset.user, json)
      .then((res) => {
        const badge = document.getElementById("badge-edit-success");
        badge.style.display = "block";

        setTimeout(() => {
          badge.style.display = "none";
        }, 3000);
      })
      .catch((err) => {
        const badge = document.getElementById("badge-edit-error");
        badge.style.display = "block";

        setTimeout(() => {
          badge.style.display = "none";
        }, 3000);
      });
  };

  /* ROLES */
  $("#add-role").click((e) => {
    $("#role-list").append(createRoleRow());
  });

  $("#role-list").on("click", ".btn-danger", (e) => {
    $(e.target).parent(".item").remove();
  });
};

loadForm();
