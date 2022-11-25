/* USEFULL FUNCTIONS */
const toBase64 = (file) =>
  new Promise((resolve, reject) => {
    const reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = () => resolve(reader.result);
    reader.onerror = (error) => reject(error);
  });

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
  let switcher = document.getElementById("darkmode-switch");
  let body = document.body.classList;

  if (switcher)
    switcher.onclick = (e) => {
      if (body.contains("darkmode")) {
        body.remove("darkmode");
        localStorage.setItem("darkmode", false);
      } else {
        body.add("darkmode");
        localStorage.setItem("darkmode", true);
      }
    };

  if (localStorage.getItem("darkmode") === "true") {
    body.add("darkmode");
  }
};

/* NAVBAR */
const loadNavbar = () => {
  $("#mobile-drawer-btn").click(() => {
    $("#mobile-drawer").toggleClass("open");
  });

  $(".drawer-background").click(() => {
    $("#mobile-drawer").removeClass("open");
  });

  $(".hoverable-group").hide();
  $(".hoverable-link").mouseenter(function () {
    $(this).children(".hoverable-group").show();
  });
  $(".hoverable-link").mouseleave(function () {
    $(this).children(".hoverable-group").hide();
  });
};

loadNavbar();
loadDarkmode();
loadModals();
loadTextAreas();
loadSelects();

/* window.history.replaceState(null, null, window.location.pathname); */

// Magic code to stop form resubmission on page refresh
if (window.history.replaceState) {
  window.history.replaceState(null, null, window.location.href);
}
