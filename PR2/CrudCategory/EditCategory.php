<?php
require_once __DIR__ . "/../php/Queries/EditCategoryQuery.php";

?>
<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />

</head>

<body>
    <div class="container">
        <form method="POST" action="">
            <div class="row row-cols-3 justify-content-center align-items-center">
                <div class="col-4 mt-4">
                    <div class="mb-3">
                        <label for="exampleInputTitle" class="form-label pb-3 fw-bolder">Title</label>
                        <input value="<?= htmlspecialchars($title['title'] ?? '') ?>" name="category_id" type="text" class="form-control" id="exampleInputTitle">
                        <?php if (isset($errors['category_id'])) : ?>
                            <div class="text-danger"><?= htmlspecialchars($errors['category_id']) ?></div>
                        <?php endif; ?>
                        <div class="d-grid gap-1 col-2 mx-auto">
                            <br>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>

</html>