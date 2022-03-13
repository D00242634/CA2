<?php
require_once('database.php');

// Get category ID
if (!isset($category_id)) {
$category_id = filter_input(INPUT_GET, 'category_id', 
FILTER_VALIDATE_INT);
if ($category_id == NULL || $category_id == FALSE) {
$category_id = 1;
}
}

// Get name for current category
$queryCategory = "SELECT * FROM categories
WHERE categoryID = :category_id";
$statement1 = $db->prepare($queryCategory);
$statement1->bindValue(':category_id', $category_id);
$statement1->execute();
$category = $statement1->fetch();
$statement1->closeCursor();
$category_name = $category['categoryName'];

// Get all categories
$queryAllCategories = 'SELECT * FROM categories
ORDER BY categoryID';
$statement2 = $db->prepare($queryAllCategories);
$statement2->execute();
$categories = $statement2->fetchAll();
$statement2->closeCursor();

// Get records for selected category
$queryRecords = "SELECT * FROM records
WHERE categoryID = :category_id
ORDER BY recordID";
$statement3 = $db->prepare($queryRecords);
$statement3->bindValue(':category_id', $category_id);
$statement3->execute();
$records = $statement3->fetchAll();
$statement3->closeCursor();
?>
<div class="container">
<?php
include('includes/header.php');
?>
<h1 class="topHeader">(NOT) ETSY</h1>

<aside>
<!-- display a list of categories -->


<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
    <a class="navbar-brand">Categories    </a>
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      
    <?php foreach ($categories as $category) : ?>
<li class="nav-link" ><a href=".?category_id=<?php echo $category['categoryID']; ?>">
<?php echo $category['categoryName']; ?>
</a>
</li>
<?php endforeach; ?>

    </ul>
    <form class="form-inline my-2 my-lg-0">
      
    <a href="add_record_form.php" class="button54" role="button">Add Record</a>
    <a href="category_list.php" class="button54" role="button">Manage Categories</a></p>
   
  </form>
  </div>
</nav>



</nav>          
</aside>

<section>
<!-- display a table of records -->
<h2><?php echo $category_name; ?></h2>
<table class="table table-light"> 
<tr>
<th scope="col">Image</th>
<th scope="col">Name</th>
<th scope="col">Seller</th>
<th scope="col">Price</th>
<th scope="col">Details</th>
<th scope="col">Delete</th>
<th scope="col">Edit</th>
</tr>
<?php foreach ($records as $record) : ?>
<tr>
<td scope="row"><img src="image_uploads/<?php echo $record['image']; ?>" width="100px" height="100px" /></td>
<td><?php echo $record['name']; ?></td>
<td><?php echo $record['seller']; ?></td>
<td class="right"><?php echo "€" ?><?php echo $record['price']; ?></td>
<td><?php echo $record['details']; ?></td>
<td><form action="delete_record.php" method="post"
id="delete_record_form">
<input type="hidden" name="record_id"
value="<?php echo $record['recordID']; ?>">
<input type="hidden" name="category_id"
value="<?php echo $record['categoryID']; ?>">
<input type="submit" class="button45" value="Delete">
</form></td>
<td><form action="edit_record_form.php" method="post"
id="delete_record_form">
<input type="hidden" name="record_id"
value="<?php echo $record['recordID']; ?>">
<input type="hidden" name="category_id"
value="<?php echo $record['categoryID']; ?>">
<input type="submit" class="button45" value="Edit">
</form></td>
</tr>
<?php endforeach; ?>
</table>
</section>
<?php
include('includes/footer.php');
?>