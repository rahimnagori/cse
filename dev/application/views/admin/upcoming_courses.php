<?php include 'include/header.php'; ?>

<div class="conten_web">
  <h4 class="heading">
    <?= $courseTitle; ?> <small>Management</small>
    <span><button class="btn btn_theme2" data-toggle="modal" data-target="#addCourseModal">Add</button></span>
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
              <?php
              if ($courseType == 1) {
              ?>
                <th>URL</th>
              <?php
              }
              ?>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($upcomingCourses as $serialNumber => $course) {
            ?>
              <tr>
                <td><?= $serialNumber + 1; ?></td>
                <td><?= $course['title']; ?></td>
                <?php
                if ($courseType == 1) {
                ?>
                  <th><?= $course['url']; ?></th>
                <?php
                }
                ?>
                <td>
                  <button onclick="edit_course(<?= $course['id'] ?>)" class="btn btn-info btn-xs">Edit</button>
                  <button class="btn btn-danger btn-xs" onclick="open_delete_modal(<?= $course['id'] ?>)">Delete</button>
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
<div class="modal fade" id="addCourseModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <form id="addForm" name="addForm" onsubmit="add_course(event);">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add New <?= $courseTitle; ?></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="la la-times-circle"></i></span></button>
        </div>

        <div class="modal-body">
          <div class="optio_raddipo">
            <div class="form-group">
              <label> Title </label>
              <input type="text" name="title" class="form-control" required="" />
              <input type="hidden" name="type" value="<?= $courseType; ?>" required="" />
            </div>
            <?php
            if ($courseType == 1) {
            ?>
              <div class="form-group">
                <label> URL </label>
                <input type="text" name="url" class="form-control" required="" />
              </div>
            <?php
            }
            ?>
            <div class="row">
              <div class="col-sm-12" class="responseMessage" id="responseMessage"></div>
            </div>
            <div class="form-group">
              <button class="btn btn_theme2 btn-lg btn_submit" type="submit">Add</button>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
<!-- Modal close-->

<!-- Modal -->
<div class="modal fade" id="deleteCourseModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <form id="deleteForm" name="deleteForm" onsubmit="delete_course(event);">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Confirmation</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="la la-times-circle"></i></span></button>
        </div>

        <div class="modal-body">
          <div class="optio_raddipo">
            <div class="form-group">
              <label> Are you sure you want to delete? </label>
              <input type="hidden" name="delete_course_id" id="delete_course_id" />
              <input type="hidden" name="course_type" value="<?= $courseType; ?>" />
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

<!-- Modal -->
<div class="modal fade" id="editJobModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <form id="editForm" name="editForm" onsubmit="update_course(event);">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Job</h4>
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
  function add_course(e) {
    e.preventDefault();
    $.ajax({
      type: 'POST',
      url: BASE_URL + 'Playlist/Add',
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
        $("#responseMessage").html(response.responseMessage);
        $("#responseMessage").show();
        if (response.status == 1) location.reload();
      }
    });
  }

  function open_delete_modal(id) {
    $("#delete_course_id").val(id);
    $("#deleteCourseModal").modal("show");
  }

  function delete_course(e) {
    e.preventDefault();
    $.ajax({
      type: 'POST',
      url: BASE_URL + 'Playlist/Delete',
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

  function edit_course(course_id) {
    $.ajax({
      type: 'GET',
      url: BASE_URL + 'Playlist/Get/' + course_id,
      dataType: 'HTML',
      beforeSend: function(xhr) {
        $("#editModal").html("<i class='fa fa-spin fa-spinner' aria-hidden='true'></i>")
        $("#editJobModal").modal("show");
      },
      success: function(response) {
        $("#editModal").html(response);
      }
    });
  }

  function update_course(e) {
    e.preventDefault();
    $.ajax({
      type: 'POST',
      url: BASE_URL + 'Playlist/Update',
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
      }
    });
  }
</script>