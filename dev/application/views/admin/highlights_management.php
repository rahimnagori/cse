<?php include 'include/header.php'; ?>

<div class="conten_web">
  <h4 class="heading">
    Highlights <small>Management</small>
  </h4>
  <div class="white_box">
    <div id="responseMessage"></div>
    <div class="card_bodym">
      <form id="editForm" name="editForm" method="post" onsubmit="update_urls(event);">
        <div class="row">
          <?php
          foreach ($highlights as $key => $highlight) {
            if ($key == 'id') continue;
          ?>
            <div class="col-sm-6">
              <div class="form-group">
                <label><strong><?= ucwords(str_replace("_", " ", $key)); ?></strong></label>
                <input type="text" name="<?= $key; ?>" class="form-control" value="<?= $highlight; ?>">
              </div>
            </div>
          <?php
          }
          ?>
        </div>
        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              <button class="btn btn-success btn_submit" type="submit">Update</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>


<?php include 'include/footer.php'; ?>

<script>
  function update_urls(e) {
    e.preventDefault();
    $.ajax({
      type: 'POST',
      url: BASE_URL + 'Admin-Highlights/Update',
      data: new FormData($('#editForm')[0]),
      dataType: 'JSON',
      processData: false,
      contentType: false,
      cache: false,
      beforeSend: function(xhr) {
        $(".btn_submit").attr('disabled', true);
        $(".btn_submit").html(LOADING);
        $("#responseMessage").html('');
        $("#responseMessage").hide();
      },
      success: function(response) {
        $(".btn_submit").prop('disabled', false);
        $(".btn_submit").html(' Update ');
        $("#responseMessage").html(response.responseMessage);
        $("#responseMessage").show();
      }
    });
  }
</script>