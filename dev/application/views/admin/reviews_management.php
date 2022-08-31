<?php include 'include/header.php'; ?>

<div class="conten_web">
  <h4 class="heading">
    Reviews <small>Management</small>
    <span><button class="btn btn_theme2" data-toggle="modal" data-target="#addReviewModal">Add</button></span>
  </h4>
  <div class="white_box">
    <?= $this->session->flashdata('responseMessage'); ?>
    <div class="card_bodym">
      <div class="table-responsive">
        <table id="extent_tbl1" class="table display">
          <thead>
            <tr>
              <th>S.No.</th>
              <th>Reviewer</th>
              <th>Designation</th>
              <th>Link</th>
              <th>Review</th>
              <!-- <th>Image</th> -->
              <th>Created</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($reviews as $serialNumber => $review) {
            ?>
              <tr>
                <td><?= $serialNumber + 1; ?></td>
                <td><?= $review['name']; ?></td>
                <td><?= $review['designation']; ?></td>
                <td>
                  <?php
                    if(strlen($review['link']) > 0){
                  ?>
                      <a href="<?= $review['link']; ?>" target="_blank">View</a>
                  <?php
                    }else{
                      ?>
                      No Link Added
                  <?php    
                    }
                  ?>  
                </td>
                <td><?= $review['review']; ?></td>
                <!-- <td>
                  <img src="<?= site_url(($review['image']) ? $review['image'] : 'assets/site/img/img_3.png'); ?>" width="100">
                </td> -->
                <td><?= date("d M, Y", strtotime($review['created'])); ?></td>
                <td>
                  <button onclick="edit_review(<?= $review['id'] ?>)" class="btn btn-info btn-xs">Edit</button>
                  <button class="btn btn-danger btn-xs" onclick="open_delete_modal(<?= $review['id'] ?>)">Delete</button>
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
<div class="modal fade" id="addReviewModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <form id="addForm" name="addForm" onsubmit="add_review(event);">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add New Review</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="la la-times-circle"></i></span></button>
        </div>

        <div class="modal-body">
          <div class="optio_raddipo">
            <div class="form-group">
              <label> Name </label>
              <input type="text" name="name" class="form-control" required="">
            </div>
            <div class="form-group">
              <label> Designation </label>
              <input type="text" name="designation" class="form-control" required="">
            </div>
            <div class="form-group">
              <label> Link </label>
              <input type="url" name="link" class="form-control" >
            </div>
            <div class="form-group">
              <label> Review </label>
              <textarea name="review" class="form-control" required=""></textarea>
            </div>
            <!-- <div class="row">
              <div class="col-sm-8">
                <div class="form-group">
                  <label> Image </label>
                  <input type="file" name="image" accept="image/*" onchange="preview_image(this, 'preview_image');">
                </div>
              </div>
              <div class="col-sm-4" id="preview_image"></div>
            </div> -->
            <div class="row">
              <div class="col-sm-12" class="responseMessage" id="responseMessage"></div>
            </div>
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
<div class="modal fade" id="deleteReviewModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <form id="deleteForm" name="deleteForm" onsubmit="delete_review(event);">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Confirmation</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="la la-times-circle"></i></span></button>
        </div>

        <div class="modal-body">
          <div class="optio_raddipo">
            <div class="form-group">
              <label> Are you sure you want to delete this review? </label>
              <input type="hidden" name="delete_review_id" id="delete_review_id" />
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
<div class="modal fade" id="editReviewModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <form id="editForm" name="editForm" onsubmit="update_review(event);">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Review</h4>
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
  function add_review(e) {
    e.preventDefault();
    $.ajax({
      type: 'POST',
      url: BASE_URL + 'Reviews/Add',
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
      }
    });
  }

  function open_delete_modal(id) {
    $("#delete_review_id").val(id);
    $("#deleteReviewModal").modal("show");
  }

  function delete_review(e) {
    e.preventDefault();
    $.ajax({
      type: 'POST',
      url: BASE_URL + 'Reviews/Delete',
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

  function edit_review(review_id) {
    $.ajax({
      type: 'GET',
      url: BASE_URL + 'Reviews/Get/' + review_id,
      dataType: 'HTML',
      beforeSend: function(xhr) {
        $("#editModal").html("<i class='fa fa-spin fa-spinner' aria-hidden='true'></i>")
        $("#editReviewModal").modal("show");
      },
      success: function(response) {
        $("#editModal").html(response);
      }
    });
  }

  function update_review(e) {
    e.preventDefault();
    $.ajax({
      type: 'POST',
      url: BASE_URL + 'Reviews/Update',
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
        if (response.status == 1) location.reload();
      }
    });
  }

  function update_location(locationType) {
    if (locationType == 'other') {
      $("#addLocationHtml").html(`<input type="text" name="name" id="location" class="form-control" required="" placeholder="Add other..." />`);
      $("#addLocationHtml").show();
    } else {
      $("#addLocationHtml").hide();
      $("#addLocationHtml").html("");
    }
  }
</script>