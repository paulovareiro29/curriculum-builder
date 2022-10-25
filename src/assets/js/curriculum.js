$("#contact-form").submit((e) => {
  e.preventDefault();

  const form = e.target;

  axios
    .post("/curriculum/api/contact/", {
      curriculum_id: $(form.curriculum_id).val(),
      user_id: $(form.user_id).val(),
      first_name: $(form.first_name).val(),
      last_name: $(form.last_name).val(),
      email: $(form.email).val(),
      phone: $(form.phone).val(),
      message: $(form.message).val(),
    })
    .then(() => {
      const alert = $(form).find(".alert-success");
      $(form).trigger("reset");
      $(alert).show();

      setTimeout(() => {
        $(alert).hide();
      }, 3000);
    })
    .catch(() => {
      const alert = $(form).find(".alert-danger");
      $(alert).show();

      setTimeout(() => {
        $(alert).hide();
      }, 3000);
    });
});
