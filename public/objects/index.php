<?php 
require_once('../../artifacts_private/initialize.php');
require_login();
$object_set = find_objects_by_user();
$page_title = 'objects'; 
include(SHARED_PATH . '/staff_header.php'); 
?>

<main>
  <li>
    <a class="back-link" href="<?php echo url_for('/objects/useby.php'); ?>">
      &laquo; Use objects by list
    </a>
  </li>

  <div class="objects listing">
    <h1>Objects</h1>

    <div class="actions">
      <li>
        <a class="action" href="<?php echo url_for('/objects/new.php'); ?>">
          Create New Object
        </a>
      </li>
    </div>

  	<table class="list">
  	  <tr>
        <th>Name&ensp;</th>
        <th>Kept&ensp;</th>
  	    <th>Acquisition&ensp;</th>
        <th>Type&ensp;</th>
  	  </tr>

      <?php while($object = mysqli_fetch_assoc($object_set)) { ?>
        <tr>
          <td>
            <a class="table-action" href="<?php echo url_for('/objects/edit.php?id=' . h(u($object['ID']))); ?>">
              <?php echo h($object['ObjectName']); ?>
            </a>
          </td>
          <td><?php echo $object['KeptCol'] == 1 ? 'true' : 'false'; ?></td>
    	    <td><?php echo h($object['Acq']); ?></td>
    	    <td><?php echo h($object['ObjectType']); ?></td>
    	  </tr>
      <?php } ?>
  	</table>

    <?php mysqli_free_result($object_set); ?>
  </div>

</main>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
