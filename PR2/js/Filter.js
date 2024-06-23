document.addEventListener("DOMContentLoaded", function () {
  const categoryFilters = document.querySelectorAll(".category-filter");
  const booksContainer = document.getElementById("books-container");

  categoryFilters.forEach((filter) => {
    filter.addEventListener("change", function () {
      const selectedCategories = Array.from(categoryFilters)
        .filter((checkbox) => checkbox.checked)
        .map((checkbox) => checkbox.value);

      filterBooks(selectedCategories);
    });
  });

  function filterBooks(categories) {
    const books = document.querySelectorAll(".book-item");
    books.forEach((book) => {
      const bookCategoryId = book.getAttribute("data-category-id");
      if (categories.length === 0 || categories.includes(bookCategoryId)) {
        book.style.display = "block";
      } else {
        book.style.display = "none";
      }
    });
  }
});
