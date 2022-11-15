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
/* DARK MODE */
const loadDarkmode = () => {
  // Switch
  let switcher = document.getElementById("darkmode");
  let span = document.getElementById("darkmode-span");

  if (switcher)
    switcher.onclick = (e) => {
      if (e.target.checked) {
        if (!document.body.classList.contains("darkmode")) {
          document.body.classList.add("darkmode");
        }
        span.innerHTML = "Darkmode";
        localStorage.setItem("darkmode", true);
      } else {
        if (document.body.classList.contains("darkmode")) {
          document.body.classList.remove("darkmode");
        }
        span.innerHTML = "Lightmode";
        localStorage.setItem("darkmode", false);
      }
    };

  if (localStorage.getItem("darkmode") === "true") {
    document.body.classList.add("darkmode");
    switcher.checked = true;
    span.innerHTML = "Darkmode";
  }
};

loadDarkmode();
loadModals();
loadTextAreas();
loadSelects();

/* window.history.replaceState(null, null, window.location.pathname); */

// Magic code to stop form resubmission on page refresh
if (window.history.replaceState) {
  window.history.replaceState(null, null, window.location.href);
}
