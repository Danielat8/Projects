<?php
require_once __DIR__ . "/php/Queries/AboutBookQuery.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> Library</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <link rel="stylesheet" href="./css/darkmode.css" />
    <link rel="stylesheet" href="./css/menu.css" />
    <link rel="stylesheet" href="./css/aboutbook.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
</head>

<body>

    <body>
        <nav class="navbar navbar-expand-lg" style="background-color: #4da1dc">
            <div class="container-fluid">
                <a class="navbar-brand" href="./index.php"><img src="./logo.img/Logo.png" alt="" class="image01" /></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarText">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="./LoginIndex.php">Log in </a>
                        </li>
                    </ul>

                    <a class="nav-link active fw-bolder" aria-current="page" href="./LogOut.php">Log out</a>

                    <span class="navbar-text ms-3">
                        <button class="js__dark-mode-toggle dark-mode-toggle" type="button">
                            <span class="dark-mode-toggle__icon"></span>
                            <span class="dark-mode-toggle__text hidden--visually">dark mode</span>
                        </button>
                    </span>
                </div>
            </div>
        </nav>

        <div class="container mt-5 d-flex justify-content-center">
            <div class="card mb-3" style="max-width:820px;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="<?php echo htmlspecialchars($book['cover_url']); ?>" class="img-fluid rounded-start" alt="Cover image of <?php echo htmlspecialchars($book['book_title']); ?>">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title text-warning pb-4 fw-bold"><?php echo htmlspecialchars($book['book_title']); ?></h5>
                            <p class="card-text fw-bolder"><strong class="text-warning">Author:</strong> <?php echo htmlspecialchars($book['author_name']) . ' ' . htmlspecialchars($book['author_surname']); ?></p>
                            <p class="card-text fw-bolder"><strong class="text-warning">Published Year:</strong> <?php echo htmlspecialchars($book['published_year']); ?></p>
                            <p class="card-text fw-bolder"><strong class="text-warning">Pages:</strong> <?php echo htmlspecialchars($book['page']); ?></p>
                            <p class="card-text fw-bolder"><strong class="text-warning">Category:</strong> <?php echo htmlspecialchars($book['category_title']); ?></p>
                            <p class="card-text fw-bolder"><small class="text-body-secondary">Book ID: <?php echo htmlspecialchars($book['book_id']); ?></small></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Comments Section -->

        <div class="container mt-5 mb-5">
            <h2>Comments</h2>
            <?php foreach ($comments as $comment) : ?>
                <?php
                $showComment = true;
                if ($comment['status'] == 'rejected' || $comment['status'] == 'pending') {
                    if (!isset($_SESSION['id']) || $comment['user_id'] != $_SESSION['id']) {
                        $showComment = false;
                    }
                }
                ?>
                <?php if ($showComment) : ?>
                    <div class="card mb-3">
                        <div class="card-body">
                            <p class="card-text"><?php echo htmlspecialchars($comment['comment']); ?></p>
                            <small>By User <?php echo htmlspecialchars($comment['user_id']); ?> at <?php echo htmlspecialchars($comment['created_at']); ?></small>
                            <?php if (($comment['user_id'] == $userId && $comment['is_approved'] == 0) || $userRole === 'admin' || ($comment['is_approved'] == 1 && $comment['user_id'] == $userId)) : ?>
                                <form action="./Comments/Delete_comment.php" method="post">
                                    <input type="hidden" name="comment_id" value="<?php echo $comment['id']; ?>">
                                    <input type="hidden" name="book_id" value="<?php echo $bookId; ?>">
                                    <?php if ($userRole === 'admin' && $comment['user_id'] !== $userId) : ?>
                                        <span class="text-danger">Admin cannot delete this comment and have comment.</span>
                                    <?php else : ?>
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    <?php endif; ?>
                                </form>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>

            <!-- Add Comment Form -->
            <?php if (isset($_SESSION['id']) && $_SESSION['role'] !== 'admin') : ?>
                <form action="./Comments/Comments.php" method="post">
                    <input type="hidden" name="book_id" value="<?php echo $bookId; ?>">
                    <div class="mb-3">
                        <textarea name="comment" class="form-control" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Comment</button>
                </form>
            <?php elseif (!isset($_SESSION['id'])) : ?>
                <span class="text-danger"> You must be logged in to add a comment.</span>
            <?php endif; ?>
        </div>
        </div>

        <!-- Private Notes Section -->
        <div class="container mt-5 mb-5">
            <h2>Private Notes</h2>
            <ul id="private-notes">
                <?php foreach ($privateNotes as $note) : ?>
                    <li class="m-4" id="note-<?php echo $note['id']; ?>">

                        <?php echo htmlspecialchars($note['note']); ?>

                        <button class=" delete-note btn btn-danger btn-sm space" data-note-id="<?php echo $note['id']; ?>">Delete</button>

                        <button class="edit-note-btn btn btn-warning btn-sm" data-note-id="<?php echo $note['id']; ?>">Edit</button>
                    </li>
                <?php endforeach; ?>
            </ul>

            <?php if (isset($_SESSION['id']) && $_SESSION['role'] !== 'admin') : ?>
                <form id="add-note-form">
                    <input type="hidden" name="book_id" value="<?php echo htmlspecialchars($bookId); ?>">
                    <div class="mb-3">
                        <label for="note-text" class="form-label">New Note</label>
                        <input type="text" class="form-control" id="note-text" name="note" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Note</button>
                </form>
            <?php else : ?>
                <p class="text-danger">You cannot write notes.</p>
            <?php endif; ?>
        </div>
        </div>
        <footer class="fixed  bg-light pt-5 pb-5 mt-5">
            <div class=" text-center">
                <span id="quote" class="text-muted"></span>
            </div>
        </footer>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="./Script.js"></script>
        <script src="./js//ScriptFooter.js"></script>
        <script src="./js//DarkMode.js"></script>

    </body>

</html>