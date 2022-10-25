$("#contact-form").submit((e) => {
  e.preventDefault();

  const form = e.target;

  axios
    .post("/curriculum/api/message", {
      curriculum_id: $(form.curriculum_id).val(),
      user_id: $(form.user_id).val(),
      first_name: $(form.first_name).val(),
      last_name: $(form.last_name).val(),
      email: $(form.email).val(),
      phone: $(form.phone).val(),
      subject: $(form.subject).val(),
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

const { jsPDF } = window.jspdf;

$("#download").click(() => {
  var element = document.getElementById("curriculum");

  html2canvas(element).then((canvas) => {
    //Returns the image data URL, parameter: image format and clarity (0-1)
    var pageData = canvas.toDataURL("image/jpeg", 1.0);

    //Default vertical direction, size ponits, format a4[595.28,841.89]
    var pdf = new jsPDF("", "pt", "a4");

    //Two parameters after addImage control the size of the added image, where the page height is compressed according to the width-height ratio column of a4 paper.
    pdf.addImage(
      pageData,
      "JPEG",
      0,
      0,
      595.28,
      (592.28 / canvas.width) * canvas.height
    );

    pdf.save("curriculum.pdf");
  });
});
