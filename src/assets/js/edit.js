const createInfoRow = () => {
  const icons = ["envelope", "phone", "location-dot"];

  let row = `
  <div class="item form-row">
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
    <div class="form-group select-icon">
      <i class="icon fa fa-envelope"></i>
      <label>Icon</label>
      <select
        data-icon
        value="envelope">`;

  for (let i = 0; i < icons.length; i++) {
    row += `<option value="${icons[i]}"`;
    if (icons[i] === icons[0]) row += ` selected `;
    let option = icons[i].replace("-", " ");
    option = option[0].toUpperCase() + option.slice(1);
    row += `>${option}</option>`;
  }

  row += `</select>
    </div>
    <button class="btn btn-danger" type="button">X</button>
  </div>`;

  return row;
};

const createSkillRow = () => {
  const row = `
  <div class="item form-row">
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

const createEducationRow = () => {
  const row = `
  <div class="item">
    <div class="form-row">
      <div class="form-group">
        <label>Start Date</label>
        <input
          type="text"
          data-start_date
          placeholder="Start Date"
        />
      </div>
      <div class="form-group">
        <label>End Date</label>
        <input
          type="text"
          data-end_date
          placeholder="End Date"
        />
      </div>
    </div>
    <div class="form-row">
      <div class="form-group">
        <label>School</label>
        <input
          type="text"
          data-school
          placeholder="School"
        />
      </div>
    </div>
    <div class="form-row">
      <div class="form-group">
        <label>Course</label>
        <input
          type="text"
          data-course
          placeholder="Course"
        />
      </div>
    </div>
    <div class="form-row">
      <div class="form-group">
        <label>Location</label>
        <input
          type="text"
          data-location
          placeholder="Location"
        />
      </div>
    </div>
    <button class="btn btn-danger" type="button">x</button>
  </div>`;

  return row;
};

const createExperienceRow = () => {
  const row = `
  <div class="item">
    <div class="form-row">
      <div class="form-group">
        <label>Start Date</label>
        <input
          type="text"
          data-start_date
          placeholder="Start Date"
        />
      </div>
      <div class="form-group">
        <label>End Date</label>
        <input
          type="text"
          data-end_date
          placeholder="End Date"
        />
      </div>
    </div>
    <div class="form-row">
      <div class="form-group">
        <label>Company</label>
        <input
          type="text"
          data-company
          placeholder="Company"
        />
      </div>
    </div>
    <div class="form-row">
      <div class="form-group">
        <label>Role</label>
        <input
          type="text"
          data-role
          placeholder="Role"
        />
      </div>
    </div>
    <div class="form-row">
      <div class="form-group">
        <label>Summary</label>
        <textarea
          data-summary
          rows="4"
          placeholder="Summary"></textarea>
      </div>
    </div>
    <button class="btn btn-danger" type="button">x</button>
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
      education: [],
      experience: [],
    };

    for (let input of inputList) {
      const field = input.dataset.field;
      switch (field) {
        case "avatar":
          if (input.files[0]) {
            json["avatar"] = await toBase64(input.files[0]);
          }
          break;
        case "is_public":
          json["is_public"] = $(input).is(":checked") ? "1" : "0";
          break;
        default:
          json[`${input.dataset.field}`] = input.value;
      }
    }

    /** INFO */
    $("#info-list")
      .children(".item")
      .each((_, row) => {
        const content = $(row).find("input[data-content]");
        const href = $(row).find("input[data-href]");
        const icon = $(row).find("[data-icon]");

        json.info.push({
          id: $(row).data("id"),
          content: content.val(),
          href: href.val(),
          icon: icon.val(),
        });
      });

    /** SKILL */
    $("#skills-list")
      .children(".item")
      .each((_, row) => {
        const content = $(row).find("input[data-content]");
        const rating = $(row).find("input[data-rating]");

        json.skills.push({
          id: $(row).data("id"),
          content: content.val(),
          rating: rating.val(),
        });
      });

    /** EDUCATION */
    $("#education-list")
      .children(".item")
      .each((_, row) => {
        const start_date = $(row).find("input[data-start_date]");
        const end_date = $(row).find("input[data-end_date]");
        const school = $(row).find("input[data-school]");
        const course = $(row).find("input[data-course]");
        const location = $(row).find("input[data-location]");

        json.education.push({
          id: $(row).data("id"),
          start_date: start_date.val(),
          end_date: end_date.val(),
          school: school.val(),
          course: course.val(),
          location: location.val(),
        });
      });

    /** EXPERIENCE */
    $("#experience-list")
      .children(".item")
      .each((_, row) => {
        const start_date = $(row).find("input[data-start_date]");
        const end_date = $(row).find("input[data-end_date]");
        const company = $(row).find("input[data-company]");
        const role = $(row).find("input[data-role]");
        const summary = $(row).find("[data-summary]");

        json.experience.push({
          id: $(row).data("id"),
          start_date: start_date.val(),
          end_date: end_date.val(),
          company: company.val(),
          role: role.val(),
          summary: summary.val(),
        });
      });

    axios
      .post("/curriculum/api/edit?id=" + e.target.dataset.curriculum, json)
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
    $(e.target).parent(".item").remove();
  });

  /** SKILL */
  $("#add-skill").click((e) => {
    $("#skills-list").append(createSkillRow());
  });

  $("#skills-list").on("click", ".btn-danger", (e) => {
    $(e.target).parent(".item").remove();
  });

  /** EDUCATION */
  $("#add-education").click((e) => {
    $("#education-list").append(createEducationRow());
  });

  $("#education-list").on("click", ".btn-danger", (e) => {
    $(e.target).parent(".item").remove();
  });

  /** EXPERIENCE */
  $("#add-experience").click((e) => {
    $("#experience-list").append(createExperienceRow());
  });

  $("#experience-list").on("click", ".btn-danger", (e) => {
    $(e.target).parent(".item").remove();
  });
};

loadNavigation();
loadForm();
