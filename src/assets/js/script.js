/* MODAL */
const loadModals = () => {
  const modals = document.getElementsByClassName("modal-background");
  for (let i = 0; i < modals.length; i++) {
    modals[i].onclick = () => {
      modals[i].closest(".modal").classList.remove("show");
    };
  }

  const buttons = document.getElementsByClassName("modal-close");
  for (let i = 0; i < buttons.length; i++) {
    buttons[i].onclick = () => {
      buttons[i].closest(".modal").classList.remove("show");
    };
  }
};

const showModal = (id) => {
  document.getElementById(id).classList.add("show");
};

const closeModal = (id) => {
  document.getElementById(id).classList.remove("show");
};

/* AUTO RESIZE TEXTAREA */
const loadTextAreas = () => {
  const autoResize = (el) => {
    if (!el) return;

    el.style.height = "auto";
    el.style.height = el.scrollHeight + "px";
    el.scrollTop = el.scrollHeight;
  };

  $("textarea")
    .each(function () {
      this.setAttribute(
        "style",
        "height:" + this.scrollHeight + "px; overflow-y: hidden;"
      );
    })
    .on("input", function () {
      autoResize(this);
    });

  $(document).click(function () {
    $("textarea").each(function () {
      if ($(this).is(":visible")) autoResize(this);
    });
  });
};

/* SELECTS */
const loadSelects = () => {
  $("select").on("change", function () {
    $(this)
      .siblings("i.icon")
      .attr("class", "icon fa fa-" + this.value);
  });
};

loadModals();
loadTextAreas();
loadSelects();

/* window.history.replaceState(null, null, window.location.pathname); */

// Magic code to stop form resubmission on page refresh
if (window.history.replaceState) {
  window.history.replaceState(null, null, window.location.href);
}
