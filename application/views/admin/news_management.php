<?php include 'include/header.php'; ?>

<div class="conten_web">
  <h4 class="heading">
    News <small>Management</small>
    <span><button class="btn btn_theme2" data-toggle="modal" data-target="#addNewsModal">Add</button></span>
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
              <!-- <th>Image</th>
              <th>URL</th>
              <th>Comment</th> -->
              <th>Created</th>
              <th>Updated</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($newses as $serialNumber => $news) {
              $description = strip_tags(substr($news['description'], 0, 120));
            ?>
              <tr>
                <td><?= $serialNumber + 1; ?></td>
                <td><?= $news['title']; ?></td>
                <td><?= $description; ?></td>
                <!-- <td>
                  <img src="<?= site_url(($news['image']) ? $news['image'] : 'assets/site/img/default-news.png'); ?>" width="100" >
                </td>
                <td><?= $news['link']; ?></td>
                <td><?= $news['comment']; ?></td> -->
                <td><?= date("d M, Y", strtotime($news['created'])); ?></td>
                <td><?= date("d M, Y", strtotime($news['updated'])); ?></td>
                <td>
                  <button onclick="edit_news(<?= $news['id'] ?>)" class="btn btn-info btn-sm">Edit</button>
                  <button class="btn btn-danger btn-sm" onclick="open_delete_modal(<?= $news['id'] ?>)">Delete</button>
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
<div class="modal fade" id="addNewsModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <form id="addForm" name="addForm" onsubmit="add_news(event);">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add News</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="la la-times-circle"></i></span></button>
        </div>

        <div class="modal-body">
          <div class="optio_raddipo">
            <div class="form-group">
              <label> Title </label>
              <input type="text" name="title" class="form-control" required="">
            </div>
            <div class="form-group">
              <label> Image </label>
              <input type="file" name="image" onchange="preview_image(this, 'preview_add_image');" accept="image/*">
            </div>
            <div class="row">
              <div class="col-sm-4">
                <div class="form-group">
                  <label> Link </label>
                  <input type="url" name="link" class="form-control">
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label> Comment </label>
                  <input type="text" name="comment" class="form-control">
                </div>
              </div>
              <div class="col-sm-4" id="preview_add_image"></div>
            </div>
            <div class="form-group">
              <label> Description </label>
              <textarea class="form-control textarea" name="description" required=""></textarea>
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
<div class="modal fade" id="deleteNewsModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <form id="deleteForm" name="deleteForm" onsubmit="delete_news(event);">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Confirmation</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="la la-times-circle"></i></span></button>
        </div>

        <div class="modal-body">
          <div class="optio_raddipo">
            <div class="form-group">
              <label> Are you sure you want to delete this News? </label>
              <input type="hidden" name="delete_news_id" id="delete_news_id" />
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
<div class="modal fade" id="editNewsModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <form id="editForm" name="editForm" onsubmit="update_news(event);">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit News</h4>
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
  function add_news(e) {
    e.preventDefault();
    $.ajax({
      type: 'POST',
      url: BASE_URL + 'Admin-News/Add',
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
    $("#delete_news_id").val(id);
    $("#deleteNewsModal").modal("show");
  }

  function delete_news(e) {
    e.preventDefault();
    $.ajax({
      type: 'POST',
      url: BASE_URL + 'Admin-News/delete',
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

  function edit_news(job_id) {
    $.ajax({
      type: 'GET',
      url: BASE_URL + 'Admin-News/Get/' + job_id,
      dataType: 'HTML',
      beforeSend: function(xhr) {
        $("#editModal").html("<i class='fa fa-spin fa-spinner' aria-hidden='true'></i>")
        $("#editNewsModal").modal("show");
      },
      success: function(response) {
        $("#editModal").html(response);
        update_tiny('textarea-edit');
      }
    });
  }

  function update_news(e) {
    e.preventDefault();
    $.ajax({
      type: 'POST',
      url: BASE_URL + 'Admin-News/Update',
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

  function preview_image(input, previewId) {
    if (input.files && input.files[0]) {
      let reader = new FileReader();
      reader.onload = function(e) {
        let imageFile = `<img src="${e.target.result}" width="100" > `;
        $('#' + previewId).html(imageFile);
      }
      reader.readAsDataURL(input.files[0]);
    }
  }
</script>