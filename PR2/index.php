<?php
require_once __DIR__ . "/php/Queries/BookJoin.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Library</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <link rel="stylesheet" href="./css/main.css" />

</head>

<body>
  <nav class="navbar navbar-expand-lg" style="background-color: #4da1dc">
    <div class="container-fluid">
      <a class="navbar-brand" href="./index.php"><img src="./logo.img/Logo.png" alt="" class="image" /></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="./LoginIndex.php">Log in</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="./RegistrationIndex.php">Register</a>
          </li>
        </ul>
        <span class="navbar-text">
          <button class="js__dark-mode-toggle dark-mode-toggle" type="button">
            <span class="dark-mode-toggle__icon"></span>
            <span class="dark-mode-toggle__text hidden--visually">dark mode</span>
          </button>
        </span>
      </div>
    </div>
  </nav>
  <div class="th container-fluid mb-5">
    <h1 class="text-center centered-text fs-1">Welcome to my library</h1>
  </div>
  <div class="container mt-5 mb-5">
    <div class="row row-cols-3 row-cols-lg-6 row-cols-md-6 g-2 g-lg-3 text-danger">
      <?php foreach ($categories as $category) : ?>
        <div class="col">
          <div class="form-check form-check-inline mb-3">
            <input class="form-check-input category-filter" type="checkbox" id="category-<?php echo $category['id']; ?>" value="<?php echo $category['id']; ?>" />
            <label class="form-check-label" for="category-<?php echo $category['id']; ?>"><?php echo htmlspecialchars($category['title']); ?></label>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
    <div class="container-fluid mt-5 fs-6 justify-content-center">
      <div class="row row-cols-1 row-cols-lg-4 row-cols-md-3 g-2 g-lg-4 " id="books-container">
        <?php foreach ($books as $book) : ?>
          <div class="book-item" data-category-id="<?php echo $book['category_id']; ?>">
            <div class="col d-flex justify-content-center">
              <div class="p-3">
                <a href="./AboutBook.php?id=<?php echo $book['book_id']; ?>" alt="" target="_blank">
                  <div class="card border border-info border-3">
                    <div class="wrapper">
                      <img src="<?php echo htmlspecialchars($book['cover_url']); ?>" class="cover-image" />
                    </div>
                    <img src="<?php echo htmlspecialchars($book['cover_url2']); ?>" class="character" />
                  </div>
                </a>
                <div class="fw-bolder  fst-italic text-primary pt-3 pb-2 mb-4 text-info text-opacity-40 border-bottom border-start border-info border-3 opacity-75 text-wrap" style="width:10rem">
                  <div class="text-center">
                    <span class="text-secondary"> Title: </span> <?php echo htmlspecialchars($book['book_title']); ?>
                    <br>
                    <span class="text-secondary"> Author:</span> <?php echo htmlspecialchars($book['author_name']) . ' ' . htmlspecialchars($book['author_surname']); ?>
                    <br>
                    <span class="text-secondary"> Category: </span> <?php echo htmlspecialchars($book['category_title']); ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
  <footer class="fixed  bg-light pt-5 pb-5 mt-5">
    <div class=" text-center">
      <span id="quote" class="text-muted"></span>
    </div>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

  <script src="./js//DarkMode.js"></script>
  <script src="./js//Filter.js"></script>
  <script src="./js//ScriptFooter.js"></script>


</body>

</html>