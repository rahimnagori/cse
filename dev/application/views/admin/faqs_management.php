<?php include 'include/header.php'; ?>

<div class="conten_web">
  <h4 class="heading">
    FAQs <small>Management</small>
    <span><button class="btn btn_theme2" data-toggle="modal" data-target="#addFaqModal">Add</button></span>
  </h4>
  <div class="white_box">
    <?= $this->session->flashdata('responseMessage'); ?>
    <div class="card_bodym">
      <div class="table-responsive">
        <table id="extent_tbl1" class="table display">
          <thead>
            <tr>
              <th>S.No.</th>
              <th>Question</th>
              <th>Answer</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($faqs as $serialNumber => $faq) {
            ?>
              <tr>
                <td><?= $serialNumber + 1; ?></td>
                <td><?= $faq['question']; ?></td>
                <td><?= $faq['answer'] ?></td>
                <td>
                  <button onclick="edit_faq(<?= $faq['id'] ?>)" class="btn btn-info btn-xs">Edit</button>
                  <button class="btn btn-danger btn-xs" onclick="open_delete_modal(<?= $faq['id'] ?>)">Delete</button>
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
<div class="modal fade" id="addFaqModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <form id="addForm" name="addForm" onsubmit="add_faq(event);">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add New Faq</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="la la-times-circle"></i></span></button>
        </div>
        <div class="modal-body">
          <div class="optio_raddipo">
            <div class="form-group">
              <label> Question </label>
              <input type="text" name="question" class="form-control" required="" />
            </div>
            <div class="form-group">
              <label> Answer </label>
              <textarea name="answer" cols="30" rows="5" class="form-control" required=""></textarea>
            </div>
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
<div class="modal fade" id="deleteCourseModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <form id="deleteForm" name="deleteForm" onsubmit="delete_faq(event);">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Confirmation</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="la la-times-circle"></i></span></button>
        </div>

        <div class="modal-body">
          <div class="optio_raddipo">
            <div class="form-group">
              <label> Are you sure you want to delete this Faq? </label>
              <input type="hidden" name="delete_faq_id" id="delete_faq_id" />
            </div>
            <div class="row">
              <div class="col-sm-12" class="deleteResponseMessage" id="deleteResponseMessage"></div>
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
<div class="modal fade" id="editJobModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <form id="editForm" name="editForm" onsubmit="update_faq(event);">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Faq</h4>
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
  function add_faq(e) {
    e.preventDefault();
    $.ajax({
      type: 'POST',
      url: BASE_URL + 'Faqs-Management/Add',
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
    $("#delete_faq_id").val(id);
    $("#deleteCourseModal").modal("show");
  }

  function delete_faq(e) {
    e.preventDefault();
    $.ajax({
      type: 'POST',
      url: BASE_URL + 'Faqs-Management/delete',
      data: new FormData($('#deleteForm')[0]),
      dataType: 'JSON',
      processData: false,
      contentType: false,
      cache: false,
      beforeSend: function(xhr) {
        $(".btn_submit").attr('disabled', true);
        $(".btn_submit").html(LOADING);
        $("#deleteResponseMessage").html('');
        $("#deleteResponseMessage").hide();
      },
      success: function(response) {
        $(".btn_submit").prop('disabled', false);
        $(".btn_submit").html(' Yes ');
        if (response.status == 1) location.reload();
        $("#deleteResponseMessage").html(response.responseMessage);
        $("#deleteResponseMessage").show();
      }
    });
  }

  function edit_faq(faq_id) {
    $.ajax({
      type: 'GET',
      url: BASE_URL + 'Faqs-Management/Get/' + faq_id,
      dataType: 'HTML',
      beforeSend: function(xhr) {
        $("#editModal").html("<i class='fa fa-spin fa-spinner' aria-hidden='true'></i>")
        $("#editJobModal").modal("show");
      },
      success: function(response) {
        $("#editModal").html(response);
        update_tiny('textarea-edit');
      }
    });
  }

  function update_faq(e) {
    e.preventDefault();
    $.ajax({
      type: 'POST',
      url: BASE_URL + 'Faqs-Management/Update',
      data: new FormData($('#editForm')[0]),
      dataType: 'JSON',
      processData: false,
      contentType: false,
      cache: false,
      beforeSend: function(xhr) {
        $(".btn_submit").attr('disabled', true);
        $(".btn_submit").html(LOADING);
        $("#updateResponseMessage").html('');
        $("#updateResponseMessage").hide();
      },
      success: function(response) {
        $(".btn_submit").prop('disabled', false);
        $(".btn_submit").html(' Update ');
        if (response.status == 1) location.reload();
        $("#updateResponseMessage").html(response.responseMessage);
        $("#updateResponseMessage").show();
      }
    });
  }
</script>