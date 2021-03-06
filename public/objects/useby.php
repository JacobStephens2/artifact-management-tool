<?php require_once('../../artifacts_private/initialize.php'); ?>
<?php require_login(); ?>
<?php $page_title = 'Use By'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<?php 
if(is_post_request()) {
  $_SESSION['interval'] = $_POST['interval'] ?? '180';
}
$interval = $_SESSION['interval'] ?? '180';
$limit = '';
$object_set = use_objects_by_user($interval, $limit); 
?>

<main>
    <li><a class="back-link" href="<?php echo url_for('/objects/index.php'); ?>">&laquo; Objects</a></li>
    <li><a class="back-link" href="<?php echo url_for('/object_uses/new.php'); ?>">&laquo; Record use</a></li>
    <li><a class="back-link" href="<?php echo url_for('/object_uses/index.php'); ?>">&laquo; Uses</a></li>
  <div class="objects listing">
    <h1>Use kept objects by date</h1>
    <p><a class="back-link" href="<?php echo url_for('/objects/about-useby.php'); ?>">Learn about use-by date generation</a></p>

    <form action="<?php echo url_for('/objects/useby.php'); ?>" method="post">
      <dt>Interval from latest or to soonest play (Default = 180)</dt>
          <input type="number" name="interval" value="<?php echo $interval ?>">
      <div id="operations">
        <input type="submit" value="Submit" />
      </div>
    </form>

  	<table class="list" >
      <thead id="myHeader">
        <tr>
          <th>Name</th>
          <th>Type</th>
          <th>Use By</th>
          <th>Recent</th>
          <th>Acquisition</th>
          <th>Kept</th>
        </tr>
      </thead>

      <tbody>
      <?php while($object = mysqli_fetch_assoc($object_set)) { ?>
        <tr>
          <td>
            <a class="action" href="<?php echo url_for('/objects/edit.php?id=' . h(u($object['ID']))); ?>">
              <?php echo h($object['ObjectName']); ?>
            </a>
          </td>
    	    <td><?php echo h($object['ObjectType']); ?></td>
          <td><?php echo h($object['UseBy']); ?></td>
          <td><?php echo h($object['MaxUse']); ?></td>
    	    <td><?php echo h($object['Acq']); ?></td>
          <td><?php 
            if(h($object['KeptCol']) == 1) {
              echo 'True';
            } else {
              echo "False";
            }
          ?>
    	  </tr>
      <?php } ?>
      </tbody>
    
  	</table>

    <?php
      mysqli_free_result($object_set);
    ?>
  </div>

</main>

<script>
// When the user scrolls the page, execute myFunction
window.onscroll = function() {myFunction()};

// Get the header
var header = document.getElementById("myHeader");

// Get the offset position of the navbar
var sticky = header.offsetTop;

// Add the sticky class to the header when you reach its scroll position. Remove "sticky" when you leave the scroll position
function myFunction() {
  if (window.pageYOffset > sticky) {
    header.classList.add("sticky");
  } else {
    header.classList.remove("sticky");
  }
}
</script>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
