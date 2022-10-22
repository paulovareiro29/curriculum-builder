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

loadModals();

window.history.replaceState(null, null, window.location.pathname);

// Magic code to stop form resubmission on page refresh
if (window.history.replaceState) {
  window.history.replaceState(null, null, window.location.href);
}
