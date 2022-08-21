<div class="optio_raddipo">
    <div class="form-group">
        <label> Course Title </label>
        <input type="hidden" name="course_id" required="" value="<?=$courseDetails['id'];?>" />
        <input type="text" name="title" class="form-control" required="" value="<?=$courseDetails['title'];?>" />
    </div>
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <label> Course Type </label>
                <select class="form-control" name="type" required="">
                    <option value="0" <?=($courseDetails['type'] == 0) ? 'selected' : '';?>>Free</option>
                    <option value="1" <?=($courseDetails['type'] == 1) ? 'selected' : '';?>>Paid</option>
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
                        <option value="<?= $category['id']; ?>"  <?=($courseDetails['category'] == $category['id']) ? 'selected' : '';?> ><?= $category['category_name']; ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label> Thumbnail Type </label>
                <select class="form-control" name="thumbnail_type" required="" onchange="update_thumbnail(this.value, 'thumbnail_input_edit', true);">
                    <option value="1" <?=($courseDetails['thumbnail_type'] == 1) ? 'selected' : '';?>>Image</option>
                    <option value="2" <?=($courseDetails['thumbnail_type'] == 2) ? 'selected' : '';?>>YouTube</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label> Thumbnail </label>
                <input type="hidden" name="old_thumbnail" id="edit-thumbnail" required="true" value="<?=$courseDetails['thumbnail'];?>" />
                <div id="thumbnail_input_edit">
                    <?php
                        if($courseDetails['thumbnail_type'] == 1){
                    ?>
                            <input type="file" name="thumbnail" required="" accept="image/*" onchange="preview_image(this, 'previewEditThumbnail')" />
                    <?php
                        }else{
                    ?>
                            <input type="text" class="form-control" name="thumbnail" placeholder="Paste YouTube URL here" required="" onchange="fetch_youtube_video(this.value, 'previewEditThumbnail');" value="<?=$courseDetails['thumbnail'];?>" />
                    <?php
                        }
                    ?>
                </div>
            </div>
        </div>
        <div class="col-sm-6" id="previewEditThumbnail">
        <?php
            if($courseDetails['thumbnail_type'] == 1){
        ?>
                <img src="<?=site_url($courseDetails['thumbnail']);?>" width="100" >
        <?php
            }
        ?>
        </div>
    </div>
    <div class="form-group">
        <label> Short Description </label>
        <input type="text" name="short_description" class="form-control" required="" value="<?=$courseDetails['short_description'];?>" />
    </div>
    <div class="form-group">
        <label> Detailed Description </label>
        <textarea name="detailed_description" class="form-control textarea-edit" required=""><?=$courseDetails['detailed_description'];?></textarea>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <label> Students </label>
                <input type="text" name="students" class="form-control" required="" value="<?=$courseDetails['students'];?>" />
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label> Enrolled </label>
                <input type="text" name="enrolled" class="form-control" required="" value="<?=$courseDetails['enrolled'];?>" />
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label> Price </label>
                <input type="text" name="price" class="form-control" required="" value="<?=$courseDetails['price'];?>" />
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12" class="responseMessage" id="updateResponseMessage"></div>
    </div>
    <div class="form-group">
        <button class="btn btn_theme2 btn-lg btn_submit">Update</button>
    </div>
</div>