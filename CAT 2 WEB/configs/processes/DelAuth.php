<?php

// Include the database connection file
require_once('../configs/DbConn.php');

try {
    // Prepare and execute the SQL query to retrieve authors in ascending order by AuthorFullName
    $stmt = $DbConn->prepare('SELECT * FROM authors ORDER BY AuthorFullName ASC');
    $stmt->execute();

    // Fetch all authors
    $authors = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // Handle database error
    echo 'Error fetching authors: ' . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Authors</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        .delete-btn {
            background-color: #ff4d4d;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }
    </style>
</head>
<body>

    <h2>View Authors</h2>

    <?php if (isset($authors) && count($authors) > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Author ID</th>
                    <th>Author Full Name</th>
                    <th>Action</th>
                    <!-- Add more columns as needed -->
                </tr>
            </thead>
            <tbody>
                <?php foreach ($authors as $author): ?>
                    <tr>
                        <td><?php echo $author['AuthorID']; ?></td>
                        <td><?php echo $author['AuthorFullName']; ?></td>
                        <td>
                            <a href="EditAuth.php?author_id=<?php echo $author['AuthorID']; ?>">Edit</a>
                            <button class="delete-btn" onclick="deleteAuthor(<?php echo $author['AuthorID']; ?>)">Delete</button>
                        </td>
                        <!-- Display additional columns and buttons as needed -->
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <script>
            function deleteAuthor(authorId) {
                var confirmDelete = confirm('Are you sure you want to delete this author?');

                if (confirmDelete) {
                    window.location.href = 'DelAuth.php?author_id=' + authorId;
                }
            }
        </script>

    <?php else: ?>
        <p>No authors found.</p>
    <?php endif; ?>

</body>
</html>
