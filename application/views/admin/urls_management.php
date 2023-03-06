<?php include 'include/header.php'; ?>

<div class="conten_web">
  <h4 class="heading">
    Urls <small>Management</small>
  </h4>
  <div class="white_box">
    <div class="card_bodym">
      <form id="editForm" name="editForm" method="post" onsubmit="update_urls(event);">
        <div class="row">
          <?php
          foreach ($urls as $key => $url) {
            if ($key == 'id') continue;
            $nameInput = explode('_', $key);
            $nameInputValue = ($nameInput[count($nameInput) - 1] == 'url') ? 'url' : 'number';
          ?>
            <div class="col-sm-6">
              <div class="form-group">
                <label><strong><?= ucwords(str_replace("_", " ", $key)); ?></strong></label>
                <input type="<?=$nameInputValue;?>" name="<?= $key; ?>" <?= ($nameInputValue == 'number' ? 'step="0.1"' : ''); ?> class="form-control" value="<?= $url; ?>">
              </div>
            </div>
          <?php
          }
          ?>
        </div>
        <div id="responseMessage"></div>
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
      url: BASE_URL + 'Admin-Urls/Update',
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