$(".show-delete-curriculum").click((e) => {
  const id = $(e.target).parent().closest(".curriculum").data("id");
  $("#delete-curriculum").data("id", id);

  showModal("delete-curriculum");
});

$("#delete-curriculum-btn").click((e) => {
  const id = $(e.target).parent().closest("#delete-curriculum").data("id");
  closeModal("delete-curriculum");

  axios
    .get(`/curriculum/api/delete?id=${id}`)
    .then(() => {
      $(`.curriculum[data-id=${id}]`).remove();

      $(".delete.alert-success").show();
      setTimeout(() => {
        $(".delete.alert-success").hide();
      }, 3000);
    })
    .catch((err) => {
      $(".delete.alert-danger").show();
      setTimeout(() => {
        $(".delete.alert-danger").hide();
      }, 3000);
    });
});

setTimeout(() => {
  $(".new.alert").hide();
}, 3000);
