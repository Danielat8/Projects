<?php
require_once __DIR__ . "/../php/Queries/CrudCategoryQuery.php";

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

<body class="bg-info">
    <div class="container-xxl">
        <a href="./CreateCategory.php"> <button type="button" class="btn btn-success mt-3 mb-3">Create</button></a>

        <table class=" mt-5 table table-dark table-hover">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Action</th>

                </tr>
            </thead>
            <tbody>

                <?php
                foreach ($categories as $category) {
                ?>
                    <tr>
                        <td><?php echo $category['title'] ?></td>
                        <td> <a href="./DeleteCategory.php?id=<?= $category['id'] ?>"> <button type="button" class="btn btn-danger">Delete</button>
                                <a href="./EditCategory.php?id=<?= $category['id'] ?>"> <button type="button" class="btn btn-success">Edit</button>
                        </td>
                    </tr>
                <?php
                }

                ?>


    </div>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>