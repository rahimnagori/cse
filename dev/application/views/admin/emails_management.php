<?php include 'include/header.php'; ?>

<div class="conten_web">
  <h4 class="heading">
    Email <small>Management</small>
    <span><button class="btn btn_theme2" data-toggle="modal" data-target="#addNewsModal">Add</button></span>
  </h4>
  <div class="white_box">
    <div id="responseMessage"></div>
    <div class="card_bodym">
      <div class="row">
        <form id="emailForm" name="emailForm" method="post" onsubmit="update_email(event);">
          <?php
            foreach($emails as $key => $email){
          ?>
              <div class="col-sm-6">
                <div class="form-group">
                  <label><?=str_replace('_', ' ', ucwords($key));?></label>
                  <input class="form-control" type="email" name="<?=$key;?>" value="<?=$email;?>" required=""  />
                </div>
              </div>
          <?php
            }
          ?>
          <div class="col-sm-6">
            <button type="submit" class="btn btn-success btn_submit">Update</button>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>

<?php include 'include/footer.php'; ?>

<script>
  function update_email(e) {
    e.preventDefault();
    $.ajax({
      type: 'POST',
      url: BASE_URL + 'Admin-Emails/Update',
      data: new FormData($('#emailForm')[0]),
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
        $("#responseMessage").show();
        $("#responseMessage").html(response.responseMessage);
      }
    });
  }
</script>