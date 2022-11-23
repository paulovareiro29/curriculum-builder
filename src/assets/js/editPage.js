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
