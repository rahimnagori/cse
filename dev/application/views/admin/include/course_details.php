<div class="optio_raddipo">
    <div class="form-group">
        <label> Title </label>
        <input type="hidden" name="course_id" required="" value="<?=$courseDetails['id'];?>" />
        <input type="text" name="title" class="form-control" required="" value="<?=$courseDetails['title'];?>" />
        <input type="hidden" name="type" value="<?=$courseDetails['type'];?>" required="" />
    </div>
    <?php
        if($courseDetails['type'] == 1){
    ?>
        <div class="form-group">
            <label> URL </label>
            <input type="text" name="url" class="form-control" required="" value="<?=$courseDetails['url'];?>" />
        </div>
    <?php
        }
    ?>
    <div class="row">
        <div class="col-sm-12" class="responseMessage" id="updateResponseMessage"></div>
    </div>
    <div class="form-group">
        <button class="btn btn_theme2 btn-lg btn_submit">Update</button>
    </div>
</div>