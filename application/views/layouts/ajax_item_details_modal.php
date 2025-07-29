
<div class="modal-content">

  <div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel"><?= html_escape($item[0]['title']) ;?></h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>

  <?php include APPPATH."views/layouts/inc/item_details_thumb.php"; ?>

</div>



