let dropdown = document.querySelectorAll(".dropdown");
if (dropdown) {
  dropdown.forEach((drop) => {
    drop.addEventListener("click", () => {
      let dropList = drop.querySelector(".dropList");

      dropList.classList.toggle("active");

      document.addEventListener("click", (e) => {
        if (
          !dropList.contains(e.target) &&
          !drop.contains(e.target) &&
          !e.target.closest(".active")
        ) {
          dropList.classList.remove("active");
        }
      });

      window.addEventListener("scroll", () => {
        dropList.classList.remove("active");
      });
    });
  });
}

let bars = document.getElementById("bars");
if (bars) {
  let menu = document.getElementById("menu");
  bars.addEventListener("click", () => {
    if (menu) {
      menu.classList.toggle("show");
    }

    document.addEventListener("click", (e) => {
      if (!menu.contains(e.target) && !e.target.closest("#bars")) {
        menu.classList.remove("show");
      }
    });

    window.addEventListener("scroll", () => {
      menu.classList.remove("show");
    });
  });
}
