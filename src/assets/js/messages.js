$(".message-read").click((e) => {
  const id = $(e.target).parent().closest(".message").data("id");

  axios
    .get("/curriculum/api/message/read?id=" + id)
    .then((res) => {
      $(e.target).parent().closest(".message").addClass("message-viewed");
    })
    .catch((err) => {
      console.log(err);
    });
});

$(".message-unread").click((e) => {
  const id = $(e.target).parent().closest(".message").data("id");

  axios
    .get("/curriculum/api/message/unread?id=" + id)
    .then((res) => {
      $(e.target).parent().closest(".message").removeClass("message-viewed");
    })
    .catch((err) => {
      console.log(err);
    });
});
