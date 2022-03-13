<?php
require('database.php');
$query = 'SELECT *
          FROM categories
          ORDER BY categoryID';
$statement = $db->prepare($query);
$statement->execute();
$categories = $statement->fetchAll();
$statement->closeCursor();
?>
<!-- the head section -->
 <div class="container">
<?php
include('includes/header.php');
?>
        <h1>Add Record</h1>
        <form action="add_record.php" method="post" enctype="multipart/form-data" class="form-control form-control-lg"
              id="add_record_form">

            <label>Category:</label>
            <select name="category_id">
            <?php foreach ($categories as $category) : ?>
                <option value="<?php echo $category['categoryID']; ?>">
                    <?php echo $category['categoryName']; ?>
                </option>
            <?php endforeach; ?>
            </select>
            <br>
            <label class="row g-3 col-auto form-label">Name:</label>
            <input type="input" name="name">
            <br>

            <label class="row g-3 col-auto form-label" >seller:</label>
            <input type="input" name="seller">
            <br> 

            <label class="row g-3 col-auto form-label">List Price:</label>
            <input type="input" name="price">
            <br>        

            <label class="row g-3 col-auto form-label" >details:</label>
            <input type="input" name="details">
            <br> 

            <br>
            <label class="form-label">Image:</label>
            <input type="file" name="image" accept="image/*" />
            <br>
            <br>
            <input type="submit" value="Add Record">
            <br>
        </form>
        <p><a href="index.php">View Homepage</a></p>
    <?php
include('includes/footer.php');
?>