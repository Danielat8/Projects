<?php

require_once __DIR__ . "/../php/Queries/CrudBookQuery.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Manage Books</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        div.sticky {
            position: -webkit-sticky;
            position: sticky;
            top: 0;
            background-color: antiquewhite;
            padding: 50px;
            font-size: 20px;
        }
    </style>
</head>

<body>
    <div class="sticky">
        <div class="container-xll">
            <a href="./CreateBook.php"> <button type="button" class="btn btn-primary mt-3 mb-3">Create</button> </a>

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th class="border-end">Title</th>
                            <th class="border-end">Author ID</th>
                            <th class="border-end">Category ID</th>
                            <th class="border-end">Published Year</th>
                            <th class="border-end">Page</th>
                            <th class="border-end">Cover URL</th>
                            <th class="border-end">Cover URL2</th>
                            <th class="border-end">Action Delete</th>
                            <th class="border-end">Action Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($books as $book) : ?>
                            <tr>
                                <td class="border-end"><?php echo htmlspecialchars($book['title']); ?></td>
                                <td class="border-end"><?php echo htmlspecialchars($book['author_id']); ?></td>
                                <td class="border-end"><?php echo htmlspecialchars($book['category_id']); ?></td>
                                <td class="border-end"><?php echo htmlspecialchars($book['published_year']); ?></td>
                                <td class="border-end"><?php echo htmlspecialchars($book['page']); ?></td>
                                <td class="border-end"><?php echo htmlspecialchars($book['cover_url']); ?></td>
                                <td class="border-end"><?php echo htmlspecialchars($book['cover_url2']); ?></td>
                                <td class="border-end">
                                    <button class="btn btn-danger" onclick="confirmDelete(<?php echo $book['id']; ?>)">Delete</button>
                                </td>
                                <td class="border-end">
                                    <a href="./EditBook.php?id=<?php echo $book['id']; ?>">
                                        <button type="button" class="btn btn-success">Edit</button>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete(bookId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "With deleting this book, all related comments and notes will also be deleted.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'DeleteBook.php?id=' + bookId;
                }
            })
        }
    </script>

</body>

</html>