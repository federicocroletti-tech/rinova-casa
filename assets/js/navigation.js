(() => {
  const toggle = document.querySelector(".menu-toggle");
  const navigation = document.querySelector(".primary-navigation");

  if (!toggle || !navigation) return;

  document.body.classList.add("menu-enhanced");

  toggle.addEventListener("click", () => {
    const isOpen = toggle.getAttribute("aria-expanded") === "true";
    toggle.setAttribute("aria-expanded", String(!isOpen));
    navigation.classList.toggle("is-open", !isOpen);
  });

  navigation.addEventListener("click", (event) => {
    if (!event.target.closest("a")) return;
    toggle.setAttribute("aria-expanded", "false");
    navigation.classList.remove("is-open");
  });
})();
