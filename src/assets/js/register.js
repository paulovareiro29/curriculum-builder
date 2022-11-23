$("#confirm_password").keyup(function () {
  const password = $("#password");

  if (
    password.val() !== "" &&
    this.value !== "" &&
    this.value != password.val()
  ) {
    $(this).parent().addClass("error");
    password.parent().addClass("error");
    return;
  }

  $(this).parent().removeClass("error");
  password.parent().removeClass("error");
});

$("#password").keyup(function () {
  const confirm = $("#confirm_password");

  if (
    confirm.val() !== "" &&
    this.value !== "" &&
    this.value != confirm.val()
  ) {
    $(this).parent().addClass("error");
    confirm.parent().addClass("error");
    return;
  }

  $(this).parent().removeClass("error");
  confirm.parent().removeClass("error");
});

$("#register-form").submit(function (e) {
  if (this.password.value !== this.confirm_password.value) {
    e.preventDefault();

    $(this.password).parent().addClass("error");
    $(this.confirm_password).parent().addClass("error");
  }
});
