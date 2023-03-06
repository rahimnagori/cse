<?php include 'include/header.php'; ?>

<style>
  .switch {
    position: relative;
    display: inline-block;
    width: 60px;
    height: 34px;
  }

  .switch input {
    opacity: 0;
    width: 0;
    height: 0;
  }

  .slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    -webkit-transition: .4s;
    transition: .4s;
  }

  .slider:before {
    position: absolute;
    content: "";
    height: 26px;
    width: 26px;
    left: 4px;
    bottom: 4px;
    background-color: white;
    -webkit-transition: .4s;
    transition: .4s;
  }

  input:checked+.slider {
    background-color: #2196F3;
  }

  input:focus+.slider {
    box-shadow: 0 0 1px #2196F3;
  }

  input:checked+.slider:before {
    -webkit-transform: translateX(26px);
    -ms-transform: translateX(26px);
    transform: translateX(26px);
  }

  /* Rounded sliders */
  .slider.round {
    border-radius: 34px;
  }

  .slider.round:before {
    border-radius: 50%;
  }
</style>

<div class="conten_web">
  <h4 class="heading">
    Urls <small>Management</small>
  </h4>
  <div class="white_box">
    <div id="responseMessage"></div>
    <div class="card_bodym">
      <form id="editForm" name="editForm" method="post" onsubmit="update_urls(event);">
        <div class="row">
          <?php
          foreach ($urls as $key => $url) {
          ?>
            <div class="<?= $url['input_class']; ?>">
              <div class="form-group">
                <label><strong><?= $url['input_label']; ?></strong></label>
                <?php
                if ($url['input_type'] == 'checkbox') {
                ?>
                  <label class="switch">
                    <input name="<?= $url['input_name']; ?>" type="<?= $url['input_type']; ?>" value="1" <?= ($url['input_value'] == 1) ? 'checked' : ''; ?>>
                    <span class="slider round"></span>
                  </label>
                <?php
                } else {
                ?>
                  <input type="<?= $url['input_type']; ?>" name="<?= $url['input_name']; ?>" value="<?= $url['input_value']; ?>" <?= $url['input_attr']; ?> />
                <?php
                }
                ?>
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
      url: BASE_URL + 'Admin-Urls/Update-New',
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