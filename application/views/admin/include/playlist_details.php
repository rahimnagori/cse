<div class="optio_raddipo">
    <div class="form-group">
        <label> Title </label>
        <input type="text" name="title" class="form-control" required="" value="<?=$courseDetails['title'];?>" />
        <input type="hidden" name="course_id" required="" value="<?=$courseDetails['id'];?>" />
    </div>
    <?php
    if (array_key_exists('url', $courseDetails) && $courseDetails['url'] != null) {
    ?>
        <div class="form-group">
            <label> URL </label>
            <input type="url" name="url" class="form-control" required="" value="<?=$courseDetails['url'];?>" />
            <input type="hidden" name="type" required="" value="1" />
        </div>
    <?php
    }
    ?>
</div>
<div class="row">
    <div class="col-sm-12" class="responseMessage" id="updateResponseMessage"></div>
</div>
<div class="form-group">
    <button class="btn btn_theme2 btn-lg btn_submit">Update</button>
</div>
</div>