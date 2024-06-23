<?php
require_once __DIR__ . "/../php/Queries/CreateAuthorQuery.php";

?>

<!doctype html>
<html lang="en">

<head>
    <title>Create Author</title>
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
                        <label for="name" class="form-label pb-3 fw-bolder">Name</label>
                        <input name="name" type="text" class="form-control" id="name" value="<?= htmlspecialchars($name ?? '') ?>">
                        <?php if (isset($errors['name'])) : ?>
                            <div class="text-danger"><?= htmlspecialchars($errors['name']) ?></div>
                        <?php endif; ?>
                        <br>
                        <label for="surname" class="form-label pb-3 fw-bolder">Surname</label>
                        <input name="surname" type="text" class="form-control" id="surname" value="<?= htmlspecialchars($surname ?? '') ?>">
                        <?php if (isset($errors['surname'])) : ?>
                            <div class="text-danger"><?= htmlspecialchars($errors['surname']) ?></div>
                        <?php endif; ?>
                        <br>
                        <label for="biography" class="form-label pb-3 fw-bolder">Biography</label>
                        <textarea name="biography" class="form-control" id="biography"><?= htmlspecialchars($biography ?? '') ?></textarea>
                        <?php if (isset($errors['biography'])) : ?>
                            <div class="text-danger"><?= htmlspecialchars($errors['biography']) ?></div>
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