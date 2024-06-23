const setDarkMode = (active = false) => {
  const wrapper = document.querySelector(":root");
  if (active) {
    wrapper.setAttribute("data-theme", "dark");
    // localStorage.setItem("theme", "dark");
  } else {
    wrapper.setAttribute("data-theme", "light");
    // localStorage.setItem("theme", "light");
  }
};

const toggleDarkMode = () => {
  const theme = document.querySelector(":root").getAttribute("data-theme");

  setDarkMode(theme === "light");
};

const initDarkMode = () => {
  const query = window.matchMedia("(prefers-color-scheme: dark)");

  let active = query.matches;

  setDarkMode(active);

  query.addListener((e) => setDarkMode(e.matches));

  const toggleButton = document.querySelector(".js__dark-mode-toggle");
  toggleButton.addEventListener("click", toggleDarkMode);
};

initDarkMode();
