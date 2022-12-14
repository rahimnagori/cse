<?php include 'include/header.php'; ?>

<div class="conten_web">
  <h4 class="heading">
    Courses <small>Management</small>
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
              <th>Thumbnail</th>
              <th>
                Course Category (Type)
              </th>
              <th>Title</th>
              <th>Description</th>
              <th>Ratings</th>
              <th>Duration (in hours)</th>
              <th>Enrolled</th>
              <th>Price</th>
              <th>Created | Updated</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($courses as $serialNumber => $course) {
              $description = strip_tags(substr($course['detailed_description'], 0, 100));
              $youtubeEmbedUrl = explode('v=', $course['thumbnail']);
            ?>
              <tr>
                <td><?= $serialNumber + 1; ?></td>
                <td>
                  <?php
                  if ($course['thumbnail_type'] == 1) {
                  ?>
                    <img src="<?= $course['thumbnail']; ?>" width="100" alt="thumbnail">
                  <?php
                  } else {
                  ?>
                    <a href="<?= $course['thumbnail']; ?>" target="_blank">
                      <img width="100" alt="thumbnail" src="http://img.youtube.com/vi/<?= $youtubeEmbedUrl[1]; ?>/default.jpg" width="100" alt="thumbnail">
                    </a>
                  <?php
                  }
                  ?>
                </td>
                <td>
                  <?= $categories[$course['category']]['category_name']; ?>
                  (<?= ($course['type'] == 0) ? 'Free' : 'Paid'; ?>)
                </td>
                <td><?= $course['title']; ?></td>
                <td>
                  <?= $course['short_description']; ?>
                  <button class="btn btn-info btn-xs" data-toggle="modal" data-target="#descriptionModal_<?= $course['id']; ?>">Detailed Description</button>

                  <!-- Modal -->
                  <div class="modal fade" id="descriptionModal_<?= $course['id']; ?>" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="la la-times-circle"></i></span></button>
                        </div>

                        <div class="modal-body">
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Modal close-->
                </td>
                <td><?= $course['ratings'] ?></td>
                <td><?= $course['duration'] ?></td>
                <td><?= $course['enrolled']; ?></td>
                <td>$<?= $course['price']; ?></td>
                <td><?= date("d M, Y", strtotime($course['created'])); ?> | <?= date("d M, Y", strtotime($course['updated'])); ?></td>
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
<div class="modal fade" id="addCourseModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <form id="addForm" name="addForm" onsubmit="add_course(event);">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add New Course</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="la la-times-circle"></i></span></button>
        </div>

        <div class="modal-body">
          <div class="optio_raddipo">
            <div class="form-group">
              <label> Course Title </label>
              <input type="text" name="title" class="form-control" required="" />
            </div>
            <div class="form-group">
              <label> Course Link </label>
              <input type="text" name="course_link" class="form-control" required="">
            </div>
            <div class="row">
              <div class="col-sm-4">
                <div class="form-group">
                  <label> Course Type </label>
                  <select class="form-control" name="type" required="">
                    <option value="0">Free</option>
                    <option value="1">Paid</option>
                  </select>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label> Category </label>
                  <select class="form-control" name="category" required="">
                    <?php
                    foreach ($categories as $category) {
                    ?>
                      <option value="<?= $category['id']; ?>"><?= $category['category_name']; ?></option>
                    <?php
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label> Thumbnail Type </label>
                  <select class="form-control" name="thumbnail_type" required="" onchange="update_thumbnail(this.value, 'thumbnail_input_add');">
                    <option value="1">Image</option>
                    <option value="2">YouTube</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label> Thumbnail </label>
                  <div id="thumbnail_input_add">
                    <input type="file" name="thumbnail" required="" accept="image/*" onchange="preview_image(this, 'previewAddThumbnail')" />
                  </div>
                </div>
              </div>
              <div class="col-sm-6" id="previewAddThumbnail"></div>
            </div>
            <div class="form-group">
              <label> Short Description </label>
              <input type="text" name="short_description" class="form-control" required="" />
            </div>
            <div class="form-group">
              <label> Detailed Description </label>
              <textarea name="detailed_description" class="form-control textarea" required=""></textarea>
            </div>
            <div class="row">
              <div class="col-sm-3">
                <div class="form-group">
                  <label> Rating </label>
                  <input type="number" step="0.1" name="ratings" class="form-control" required="" max="5" />
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group">
                  <label> Duration (in hrs)</label>
                  <input type="number" name="duration" class="form-control" required="" />
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group">
                  <label> Enrolled </label>
                  <input type="text" name="enrolled" class="form-control" required="" />
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group">
                  <label> Price </label>
                  <input type="text" name="price" class="form-control" required="" />
                </div>
              </div>
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
    <form id="deleteForm" name="deleteForm" onsubmit="delete_course(event);">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Confirmation</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="la la-times-circle"></i></span></button>
        </div>

        <div class="modal-body">
          <div class="optio_raddipo">
            <div class="form-group">
              <label> Are you sure you want to delete this Course? </label>
              <input type="hidden" name="delete_course_id" id="delete_course_id" />
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
<div class="modal fade" id="editJobModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
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
<?php include 'include/tinymce.php'; ?>

<script>
  function add_course(e) {
    e.preventDefault();
    $.ajax({
      type: 'POST',
      url: BASE_URL + 'Admin-Courses/Add',
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
    $("#delete_course_id").val(id);
    $("#deleteCourseModal").modal("show");
  }

  function delete_course(e) {
    e.preventDefault();
    $.ajax({
      type: 'POST',
      url: BASE_URL + 'Admin-Courses/delete',
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
      url: BASE_URL + 'Admin-Courses/Get/' + course_id,
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

  function update_course(e) {
    e.preventDefault();
    $.ajax({
      type: 'POST',
      url: BASE_URL + 'Admin-Courses/Update',
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

  function update_thumbnail(inputValue, elementDiv, updateDiv = false) {
    $("#" + elementDiv).html(updateDiv ? ((inputValue == 1) ? UpdateFileInput : UpdateVideoInput()) : ((inputValue == 1) ? AddFileInput : AddVideoInput));
  }

  function fetch_youtube_video(videoUrl, elementDiv) {
    if (videoUrl != null || videoUrl != '') {
      let base = 'https://www.youtube.com/oembed?url={link}&format=json';

      let link = base.replace('{link}', videoUrl);
      let result = null;

      $.ajax({
        url: link,
        type: 'get',
        dataType: 'json',
        success: function(data) {
          preview_youtube_thumbnail(data.thumbnail_url, elementDiv, videoUrl);
        }
      });

      return result;
    }
  }

  function preview_youtube_thumbnail(src, previewId, videoUrl) {
    let imageElement = `<a href="${videoUrl}" target="_blank"><img src="${src}" width="100" alt="thumbnail"> View </a> `;
    $("#" + previewId).html(imageElement);
  }

  function preview_image(input, previewId) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e) {
        let imageElement = `<img src="${e.target.result}" width="100" alt="thumbnail">`;
        $("#" + previewId).html(imageElement);
      }
      reader.readAsDataURL(input.files[0]);
    }
  }

  const AddFileInput = `<input type="file" name="thumbnail" required="" accept="image/*" onchange="preview_image(this, 'previewAddThumbnail')" />`;
  const UpdateFileInput = `<input type="file" name="thumbnail" accept="image/*" onchange="preview_image(this, 'previewEditThumbnail')" />`;
  const AddVideoInput = `<input type="text" class="form-control" name="thumbnail" placeholder="Paste YouTube URL here" required="" onchange="fetch_youtube_video(this.value, 'previewAddThumbnail');" />`

  function UpdateVideoInput() {
    let thumbnailValue = $("#edit-thumbnail").val();
    return `<input type="text" class="form-control" name="thumbnail" placeholder="Paste YouTube URL here" required="" onchange="fetch_youtube_video(this.value, 'previewEditThumbnail');" value=${thumbnailValue} />`
  }
</script>