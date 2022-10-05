<div class="optio_raddipo">
  <div class="form-group">
    <label> Title </label>
    <input type="text" name="title" class="form-control" required="" value="<?= $newsDetails['title']; ?>">
    <input type="hidden" name="news_id" required="" value="<?= $newsDetails['id']; ?>">
  </div>
  <!-- <div class="form-group">
    <label> Image </label>
    <input type="file" name="image" onchange="preview_image(this, 'preview_edit_image');" accept="image/*">
  </div>
  <div class="row">
    <div class="col-sm-4">
      <div class="form-group">
        <label> Link </label>
        <input type="url" name="link" class="form-control" value="<?= $newsDetails['link']; ?>" >
      </div>
    </div>
    <div class="col-sm-4">
      <div class="form-group">
        <label> Comment </label>
        <input type="text" name="comment" class="form-control" value="<?= $newsDetails['comment']; ?>">
      </div>
    </div>
    <div class="col-sm-4" id="preview_edit_image">
      <?php
      if ($newsDetails['image']) {
      ?>
          <img src="<?= site_url($newsDetails['image']); ?>" width="100" >
      <?php
      }
      ?>
    </div>
  </div> -->
  <div class="form-group">
    <label> Description </label>
    <textarea class="form-control textarea-edit" name="description" required=""><?= $newsDetails['description']; ?></textarea>
  </div>
  <div class="row">
    <div class="col-sm-12" class="responseMessage" id="editResponseMessage"></div>
  </div>
  <div class="form-group">
    <button class="btn btn_theme2 btn-lg btn_submit">Update</button>
  </div>
</div>