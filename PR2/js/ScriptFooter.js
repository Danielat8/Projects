document.addEventListener("DOMContentLoaded", function () {
  fetch("http://api.quotable.io/random")
    .then((response) => response.json())
    .then((data) => {
      document.getElementById("quote").textContent =
        data.content + " Author: " + data.author;
    })
    .catch((error) => {
      document.getElementById("quote").textContent = "Failed to fetch quote.";
      console.error("Error fetching quote:", error);
    });
});
