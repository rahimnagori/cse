<div class="optio_raddipo">
    <div class="form-group">
        <label> Course Title </label>
        <input type="hidden" name="course_id" required="" value="<?= $courseDetails['id']; ?>" />
        <input type="text" name="title" class="form-control" required="" value="<?= $courseDetails['title']; ?>" />
        <input type="hidden" name="course_type" required="" value="<?= $courseDetails['type']; ?>" />
        <input type="hidden" id="edit-thumbnail" name="old_thumbnail" value="<?= $courseDetails['thumbnail']; ?>" />
    </div>
    <div class="form-group">
        <label> Course Link </label>
        <input type="text" name="course_link" class="form-control" required="" value="<?= $courseDetails['course_link']; ?>" />
    </div>
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <label> Course Type </label>
                <select class="form-control" name="type" required="">
                    <option value="0" <?= ($courseDetails['type'] == 0) ? 'selected' : ''; ?>>Free</option>
                    <option value="1" <?= ($courseDetails['type'] == 1) ? 'selected' : ''; ?>>Paid</option>
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
                        <option value="<?= $category['id']; ?>" <?= ($courseDetails['category'] == $category['id']) ? 'selected' : ''; ?>><?= $category['category_name']; ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label> Thumbnail Type </label>
                <select class="form-control" name="thumbnail_type" required="" onchange="update_thumbnail(this.value, 'thumbnail_input_update', true);">
                    <option value="1" <?= ($courseDetails['thumbnail_type'] == 1) ? 'selected' : ''; ?> >Image</option>
                    <option value="2" <?= ($courseDetails['thumbnail_type'] == 2) ? 'selected' : ''; ?> >YouTube</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label> Thumbnail </label>
                <div id="thumbnail_input_update">
                    <?php
                        if($courseDetails['thumbnail_type'] == 1){
                    ?>
                            <input type="file" name="thumbnail" accept="image/*" onchange="preview_image(this, 'previewEditThumbnail')" />
                    <?php

                        }else if($courseDetails['thumbnail_type'] == 2){
                    ?>
                            <input type="text" value="<?=$courseDetails['thumbnail'];?>" class="form-control" name="thumbnail" placeholder="Paste YouTube URL here" required="" onchange="fetch_youtube_video(this.value, 'previewEditThumbnail');" />
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
                    <img src="<?=$courseDetails['thumbnail'];?>" width="100" alt="thumbnail">
            <?php

                }else if($courseDetails['thumbnail_type'] == 2){
                    $youtubeEmbedUrl = explode("v=", $courseDetails['thumbnail']);
            ?>
                    <a href="<?=$courseDetails['thumbnail'];?>" target="_blank" >
                        <img width="100" alt="thumbnail" src="http://img.youtube.com/vi/<?=$youtubeEmbedUrl[1];?>/default.jpg" width="100" alt="thumbnail"> View
                    </a>
            <?php
                }
            ?>
        </div>
    </div>
    <div class="form-group">
        <label> Short Description </label>
        <input type="text" name="short_description" class="form-control" required="" value="<?= $courseDetails['short_description']; ?>" />
    </div>
    <div class="form-group">
        <label> Detailed Description </label>
        <textarea name="detailed_description" class="form-control textarea-edit" required=""><?= $courseDetails['detailed_description']; ?></textarea>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <label> Rating </label>
                <input type="number" name="ratings" class="form-control" required="" value="<?= $courseDetails['ratings']; ?>" max="5" />
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label> Enrolled </label>
                <input type="text" name="enrolled" class="form-control" required="" value="<?= $courseDetails['enrolled']; ?>" />
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label> Price </label>
                <input type="text" name="price" class="form-control" required="" value="<?= $courseDetails['price']; ?>" />
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