<?php

// Include the database connection file
require_once('../configs/DbConn.php');

// Check if an author ID is provided in the query string
if (isset($_GET['author_id'])) {
    $authorId = $_GET['author_id'];

    try {
        // Prepare and execute the SQL query to retrieve details of the selected author
        $stmt = $DbConn->prepare('SELECT * FROM authors WHERE AuthorID = :author_id');
        $stmt->bindParam(':author_id', $authorId);
        $stmt->execute();

        // Fetch the details of the selected author
        $author = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // Handle database error
        echo 'Error fetching author details: ' . $e->getMessage();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Author</title>
</head>
<body>

    <h2>Edit Author</h2>

    <?php if (isset($author)): ?>
        <form action="UpdateAuth.php" method="post">
            <input type="hidden" name="author_id" value="<?php echo $author['AuthorID']; ?>">
            <label for="author_full_name">Author Full Name:</label>
            <input type="text" id="author_full_name" name="author_full_name" value="<?php echo $author['AuthorFullName']; ?>" required>

            <!-- Add more input fields for other author details as needed -->

            <button type="submit">Update Author</button>
        </form>
    <?php else: ?>
        <p>No author selected for editing.</p>
    <?php endif; ?>

    <br>

    <a href="ViewAuthors.php">Back to View Authors</a>

</body>
</html>
