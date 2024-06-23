<?php
require_once __DIR__ . "/../php/Queries/AuthorCrudQuery.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Manage Authors</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class=" bg-secondary">
    <div class="container ">
        <a href="./CreateAuthor.php"> <button type="button" class="btn btn-primary mt-3 mb-3">Create</button> </a>

        <table class="table table-success table-striped mt-5">
            <thead>
                <tr>
                    <th> Name</th>
                    <th> Surname</th>
                    <th>Biography </th>
                    <th>Action Delete</th>
                    <th>Action Edit</th>

                </tr>
            </thead>
            <tbody>

                <?php
                foreach ($authors as $author) {
                ?>
                    <tr>
                        <td><?php echo $author['name'] ?></td>
                        <td><?php echo $author['surname'] ?></td>
                        <td><?php echo $author['biography'] ?></td>
                        <td> <a href="./DeleteAuthor.php?id=<?= $author['id'] ?>"> <button type="button" class="btn btn-danger">Delete</button>
                        </td>
                        <td>
                            <a href="./EditAuthor.php?id=<?= $author['id'] ?>"> <button type="button" class="btn btn-success">Edit</button>
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
</body>

</html>