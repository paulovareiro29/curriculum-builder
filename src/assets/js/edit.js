const createInfoRow = () => {
  const row = `
  <div class="form-row">
    <div class="form-group">
      <label>Content</label>
      <input
        type="text"
        data-content
        placeholder="Content"
      />
    </div>
    <div class="form-group">
      <label>Href</label>
      <input
        data-href
        placeholder="Href"
      />
    </div>
    <button class="btn btn-danger" type="button">X</button>
  </div>`;

  return row;
};

const createSkillRow = () => {
  const row = `
  <div class="form-row">
    <div class="form-group">
      <label>Content</label>
      <input
        type="text"
        data-content
        placeholder="Content"
      />
    </div>
    <div class="form-group">
      <label>Rating</label>
      <input
        type="number"
        data-rating
        placeholder="Rating"
        min="0"
        max="5"
      />
    </div>
    <button class="btn btn-danger" type="button">X</button>
  </div>`;

  return row;
};

const changeWindowTo = (id) => {
  const items = document.getElementById("main-content").children;

  for (let item of items) {
    if (item.id !== id) {
      item.style.display = "none";
      continue;
    }

    item.style.display = "block";
  }
};

const loadNavigation = () => {
  const items = document
    .getElementById("edit-navigation")
    .querySelectorAll("li");

  for (let item of items) {
    item.onclick = (e) => {
      if (e.target.classList.contains("active")) return;

      for (let i of items) {
        i.classList.remove("active");
      }

      e.currentTarget.classList.add("active");
      changeWindowTo(e.currentTarget.dataset.link);
    };
  }
};

const toBase64 = (file) =>
  new Promise((resolve, reject) => {
    const reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = () => resolve(reader.result);
    reader.onerror = (error) => reject(error);
  });

const loadForm = () => {
  /** AVATAR VISUAL UPDATE */
  document.getElementById("avatar-input").onchange = (e) => {
    toBase64(e.target.files[0]).then((file) => {
      document.getElementById("avatar-img").src = file;
    });
  };

  /** FORM */
  document.getElementById("edit-form").onsubmit = async (e) => {
    e.preventDefault();

    const inputList = e.target.querySelectorAll("[data-field]");

    let json = {
      info: [],
      skills: [],
    };
    for (let input of inputList) {
      const field = input.dataset.field;
      switch (field) {
        case "avatar":
          if (input.files[0]) {
            json["avatar"] = await toBase64(input.files[0]);
          }
          break;
        default:
          json[`${input.dataset.field}`] = input.value;
      }
    }

    /** INFO */
    $("#info-list")
      .children(".form-row")
      .each((_, row) => {
        const content = $(row).find("input[data-content]");
        const href = $(row).find("input[data-href]");

        json.info.push({
          id: $(row).data("id"),
          content: content.val(),
          href: href.val(),
        });
      });

    /** SKILL */
    $("#skills-list")
      .children(".form-row")
      .each((_, row) => {
        const content = $(row).find("input[data-content]");
        const rating = $(row).find("input[data-rating]");

        json.skills.push({
          id: $(row).data("id"),
          content: content.val(),
          rating: rating.val(),
        });
      });

    console.log(json);

    axios
      .post("/curriculum/api/edit/?id=" + e.target.dataset.curriculum, json)
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

  /** INFO */
  $("#add-info").click((e) => {
    $("#info-list").append(createInfoRow());
  });

  $("#info-list").on("click", ".btn-danger", (e) => {
    $(e.target).parent(".form-row").remove();
  });

  /** SKILL */
  $("#add-skill").click((e) => {
    $("#skills-list").append(createSkillRow());
  });

  $("#skills-list").on("click", ".btn-danger", (e) => {
    $(e.target).parent(".form-row").remove();
  });
};

loadNavigation();
loadForm();

changeWindowTo("skills");
