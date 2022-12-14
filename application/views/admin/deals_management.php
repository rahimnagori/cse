<?php include 'include/header.php'; ?>

<div class="conten_web">
  <h4 class="heading">
    Deals <small>Management</small>
    <span><button class="btn btn_theme2" data-toggle="modal" data-target="#addDealModal">Add</button></span>
  </h4>
  <div class="white_box">
    <?= $this->session->flashdata('responseMessage'); ?>
    <div class="card_bodym">
      <div class="table-responsive">
        <table id="extent_tbl1" class="table display">
          <thead>
            <tr>
              <th>S.No.</th>
              <th>Title</th>
              <th>Description</th>
              <th>Link</th>
              <th>Price</th>
              <th>Created</th>
              <th>Updated</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($deals as $serialNumber => $deal) {
            ?>
              <tr>
                <td><?= $serialNumber + 1; ?></td>
                <td><?= $deal['title']; ?></td>
                <td><?= $deal['description']; ?></td>
                <td><a href="<?= $deal['link']; ?>" target="_blank"><?= $deal['link']; ?></a></td>
                <td><?= $deal['price_inr']; ?> INR | $ <?= $deal['price_dollar']; ?></td>
                <td><?= date("d M, Y", strtotime($deal['created'])); ?></td>
                <td><?= date("d M, Y", strtotime($deal['updated'])); ?></td>
                <td>
                  <button onclick="edit_deal(<?= $deal['id'] ?>)" class="btn btn-info btn-xs">Edit</button>
                  <button class="btn btn-danger btn-xs" onclick="open_delete_modal(<?= $deal['id'] ?>)">Delete</button>
                </td>
              </tr>
            <?php
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addDealModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <form id="addForm" name="addForm" onsubmit="add_deal(event);">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add Deal</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="la la-times-circle"></i></span></button>
        </div>

        <div class="modal-body">
          <div class="optio_raddipo">
            <div class="form-group">
              <label> Title </label>
              <input type="text" name="title" class="form-control" required="">
            </div>
            <div class="form-group">
              <label> Description </label>
              <input type="text" name="description" class="form-control" required="">
            </div>
            <div class="form-group">
              <label> Link </label>
              <input type="url" name="link" class="form-control" required="">
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-sm-12"><label> Price</label></div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="input-group">
                    <span class="input-group-addon">INR</span>
                    <input type="number" name="price_inr" class="form-control" required="">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="input-group">
                    <span class="input-group-addon">$</span>
                    <input type="text" name="price_dollar" class="form-control" required="">
                  </div>
                </div>
              </div>
            </div>
            <div id="responseMessage"></div>
            <div class="form-group">
              <button class="btn btn_theme2 btn-lg btn_submit">Add</button>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
<!-- Modal close-->

<!-- Modal -->
<div class="modal fade" id="deleteDealModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <form id="deleteForm" name="deleteForm" onsubmit="delete_deal(event);">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Confirmation</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="la la-times-circle"></i></span></button>
        </div>

        <div class="modal-body">
          <div class="optio_raddipo">
            <div class="form-group">
              <label> Are you sure you want to delete this deal? </label>
              <input type="hidden" name="delete_deal_id" id="delete_deal_id" />
            </div>
            <div class="row">
              <div class="col-sm-12" class="responseMessage" id="responseMessage"></div>
            </div>
            <div class="form-group">
              <button class="btn btn_theme2 btn-lg btn_submit">Yes</button>
              <button class="btn btn-lg btn-info" class="close" data-dismiss="modal" aria-label="Close">No</button>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
<!-- Modal close-->

<!-- Modal -->
<div class="modal fade" id="editDealModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <form id="editForm" name="editForm" onsubmit="update_deal(event);">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Deal</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="la la-times-circle"></i></span></button>
        </div>

        <div class="modal-body" id="editModal">
          <i class='fa fa-spin fa-spinner' aria-hidden='true'></i>
        </div>
      </div>
    </form>
  </div>
</div>
<!-- Modal close-->

<?php include 'include/footer.php'; ?>

<script>
  function add_deal(e) {
    e.preventDefault();
    $.ajax({
      type: 'POST',
      url: BASE_URL + 'Admin-Deals/Add',
      data: new FormData($('#addForm')[0]),
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
        $(".btn_submit").html(' Add ');
        if (response.status == 1) location.reload();
        $("#responseMessage").html(response.responseMessage);
        $("#responseMessage").show();
      }
    });
  }

  function open_delete_modal(id) {
    $("#delete_deal_id").val(id);
    $("#deleteDealModal").modal("show");
  }

  function delete_deal(e) {
    e.preventDefault();
    $.ajax({
      type: 'POST',
      url: BASE_URL + 'Admin-Deals/delete',
      data: new FormData($('#deleteForm')[0]),
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
        $(".btn_submit").html(' Yes ');
        if (response.status == 1) location.reload();
      }
    });
  }

  function edit_deal(deal_id) {
    $.ajax({
      type: 'GET',
      url: BASE_URL + 'Admin-Deals/Get/' + deal_id,
      dataType: 'HTML',
      beforeSend: function(xhr) {
        $("#editModal").html("<i class='fa fa-spin fa-spinner' aria-hidden='true'></i>")
        $("#editDealModal").modal("show");
      },
      success: function(response) {
        $("#editModal").html(response);
      }
    });
  }

  function update_deal(e) {
    e.preventDefault();
    $.ajax({
      type: 'POST',
      url: BASE_URL + 'Admin-Deals/Update',
      data: new FormData($('#editForm')[0]),
      dataType: 'JSON',
      processData: false,
      contentType: false,
      cache: false,
      beforeSend: function(xhr) {
        $(".btn_submit").attr('disabled', true);
        $(".btn_submit").html(LOADING);
        $("#editResponseMessage").html('');
        $("#editResponseMessage").hide();
      },
      success: function(response) {
        $(".btn_submit").prop('disabled', false);
        $(".btn_submit").html(' Update ');
        $("#editResponseMessage").html(response.responseMessage);
        $("#editResponseMessage").show();
        if (response.status == 1) location.reload();
      }
    });
  }
</script>