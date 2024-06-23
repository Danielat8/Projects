<?php

require_once __DIR__ . "/../php/Queries/EditBookQuery.php";

?>
<!doctype html>
<html lang="en">

<head>
    <title>Edit Book</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
</head>

<body>
    <div class="container">
        <form method="POST" action="">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($book_id); ?>">
            <div class="container text-start mt-5">
                <div class="row">
                    <div class="col-sm-6 .col-md-5 .col-lg-6">
                        <div class="mb-3">
                            <label for="title" class="form-label pb-3 fw-bolder">Title</label>
                            <input name="title" type="text" class="form-control" id="title" value="<?php echo htmlspecialchars($title); ?>">
                            <?php if (isset($errors['title'])) : ?>
                                <div class="text-danger"><?php echo $errors['title']; ?></div>
                            <?php endif; ?>
                            <br>
                            <label for="author_id" class="form-label pb-3 fw-bolder">Author ID</label>
                            <input name="author_id" type="number" class="form-control" id="author_id" value="<?php echo htmlspecialchars($author_id); ?>">
                            <?php if (isset($errors['author_id'])) : ?>
                                <div class="text-danger"><?php echo $errors['author_id']; ?></div>
                            <?php endif; ?>
                            <br>
                            <label for="category_id" class="form-label pb-3 fw-bolder">Category ID</label>
                            <input name="category_id" type="number" class="form-control" id="category_id" value="<?php echo htmlspecialchars($category_id); ?>">
                            <?php if (isset($errors['category_id'])) : ?>
                                <div class="text-danger"><?php echo $errors['category_id']; ?></div>
                            <?php endif; ?>
                            <br>
                            <label for="published_year" class="form-label pb-3 fw-bolder">Published Year</label>
                            <input name="published_year" type="number" class="form-control" id="published_year" value="<?php echo htmlspecialchars($published_year); ?>">
                            <?php if (isset($errors['published_year'])) : ?>
                                <div class="text-danger"><?php echo $errors['published_year']; ?></div>
                            <?php endif; ?>
                            <br>
                        </div>
                    </div>
                    <div class="col">
                        <label for="page" class="form-label pb-3 fw-bolder">Page</label>
                        <input name="page" type="number" class="form-control" id="page" value="<?php echo htmlspecialchars($page); ?>">
                        <?php if (isset($errors['page'])) : ?>
                            <div class="text-danger"><?php echo $errors['page']; ?></div>
                        <?php endif; ?>
                        <br>
                        <label for="cover_url" class="form-label pb-3 fw-bolder">Cover URL</label>
                        <input name="cover_url" type="url" class="form-control" id="cover_url" value="<?php echo htmlspecialchars($cover_url); ?>">
                        <?php if (isset($errors['cover_url'])) : ?>
                            <div class="text-danger"><?php echo $errors['cover_url']; ?></div>
                        <?php endif; ?>
                        <br>
                        <label for="cover_url2" class="form-label pb-3 fw-bolder">Cover URL 2</label>
                        <input name="cover_url2" type="url" class="form-control" id="cover_url2" value="<?php echo htmlspecialchars($cover_url2); ?>">
                        <?php if (isset($errors['cover_url2'])) : ?>
                            <div class="text-danger"><?php echo $errors['cover_url2']; ?></div>
                        <?php endif; ?>
                        <br>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>