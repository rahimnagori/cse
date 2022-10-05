<?php include 'include/header.php'; ?>

<div class="conten_web">
  <h4 class="heading">Enquiries <small>Management</small></h4>
  <div class="white_box">
    <?= $this->session->flashdata('responseMessage'); ?>
    <div class="card_bodym">
      <div class="table-responsive">
        <table id="extent_tbl1" class="table display">
          <thead>
            <tr>
              <th>S.No.</th>
              <th>Full Name</th>
              <th>Email</th>
              <th>Telephone</th>
              <th>Message</th>
              <th>Sent Date</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($contactRequests as $serialNumber => $contactRequest) {
            ?>
              <tr>
                <td><?= $serialNumber + 1; ?></td>
                <td><?= $contactRequest['full_name']; ?></td>
                <td><?= $contactRequest['email'] ?></td>
                <td><?= $contactRequest['phone']; ?></td>
                <td>
                  <button class="btn btn-info btn-xs" data-toggle="modal" data-target="#viewMessageModal_<?= $contactRequest['id']; ?>">See Message</button>

                  <!-- Modal -->
                  <div class="modal fade" id="viewMessageModal_<?= $contactRequest['id']; ?>" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="la la-times-circle"></i></span></button>
                        </div>
                        <div class="modal-body"><?= $contactRequest['message']; ?>
                </td>
      </div>
    </div>
  </div>
</div>
<!-- Modal close-->
<td><?= date("d M, Y", strtotime($contactRequest['created'])); ?></td>
<td>
  <button type="button" class="btn btn-xs btn-danger" onclick="open_delete_modal(<?= $contactRequest['id']; ?>);">Delete</button>
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
<div class="modal fade" id="deleteCourseModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <form id="deleteForm" name="deleteForm" onsubmit="delete_enquiry(event);">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Confirmation</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="la la-times-circle"></i></span></button>
        </div>

        <div class="modal-body">
          <div class="optio_raddipo">
            <div class="form-group">
              <label> Are you sure you want to delete this user enquiry? </label>
              <input type="hidden" name="delete_user_enquiry_id" id="delete_user_enquiry_id" />
            </div>
            <div class="row">
              <!-- <div class="col-sm-12" class="responseMessage" id="responseMessage"></div> -->
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


<?php include 'include/footer.php'; ?>

<script>
  function open_delete_modal(id) {
    $("#delete_user_enquiry_id").val(id);
    $("#deleteCourseModal").modal("show");
  }

  function delete_enquiry(e) {
    e.preventDefault();
    $.ajax({
      type: 'POST',
      url: BASE_URL + 'Admin-Contact/delete',
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
        $("#responseMessage").html(reseponse.responseMessage);
        $("#responseMessage").show();
      }
    });
  }
</script>