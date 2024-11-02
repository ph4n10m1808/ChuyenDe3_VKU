<?php
require_once('../../../private/initialize.php');
require_login();
?>

<?php
if(!isset($_POST['id'])) {
  redirect_to('index.php');
}
$table = "countries";
$id = $_POST['id'];
if(isset($_POST['table'])) {
   $table = $_POST['table'];
}
$country_result = find_country_by_id($id,$table);
// No loop, only one result
$country = db_fetch_assoc($country_result);
?>

<?php $page_title = 'Staff: Country ID =' . $country['id']; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="main-content">
  <a href="index.php">Back to Countries List</a><br />

  <h1>Country ID: <?php echo $country['id']; ?></h1>

  <form action="show.php" method="post">

    <?php
      echo "<table id=\"country\">";
      echo "<tr>";
    ?>
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <input type="hidden" name="table" value="<?php echo $table; ?>">
    <td>Which field would you like to see?: </td>
    <td>
      <select name="field">
        <option value="name">Name</option>
        <option value="code">Code</option>
      </select>
    </td>
    <td>
      <input type="submit" name="submit" value="Submit"  />
    </td>
  </form>

  <?php
    if(!isset($_POST['field'])) {
      $country['field'] = "name"; 
    } else {
      $country['field'] = $_POST['field']; 
    }
    echo "</tr>";
    echo "<tr>";
    echo "<td>" . $country['field'] . ": </td>";
    echo "<td>" . $country[$country['field']] . "</td>";
    echo "</tr>";
    echo "</table>";
  ?>
    

    <br />
    <a href="edit.php?id=<?php echo h(u($country['id'])); ?>">Edit</a><br />
    <hr />

    <h2>States</h2>
    <br />
    <a href="../states/new.php?id=<?php echo h(u($country['id'])); ?>">Add a State</a><br />

<?php
    $state_result = find_states_for_country_id($country['id']);

    echo "<ul id=\"states\">";
    while($state = db_fetch_assoc($state_result)) {
      echo "<li>";
      echo "<a href=\"../states/show.php?id=" . h(u($state['id'])) . "\">";
      echo h($state['name']);
      echo "</a>";
      echo "</li>";
    } // end while $state
    db_free_result($state_result);
    echo "</ul>"; // #states

    db_free_result($country_result);
  ?>

</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
