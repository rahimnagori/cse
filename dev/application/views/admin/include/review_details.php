<div class="form-group">
    <label> Name </label>
    <input type="text" name="name" class="form-control" required="" value="<?=$reviewDetails['name'];?>" >
    <input type="hidden" name="review_id" value="<?=$reviewDetails['id'];?>" required="" />
</div>
<div class="form-group">
    <label> Designation </label>
    <input type="text" name="designation" class="form-control" required="" value="<?=$reviewDetails['designation'];?>">
</div>
<div class="form-group">
    <label> Review </label>
    <textarea name="review" class="form-control" required=""><?=$reviewDetails['review'];?></textarea>
</div>
<div class="row">
    <div class="col-sm-8">
        <div class="form-group">
            <label> Image </label>
            <input type="file" name="image" accept="image/*" onchange="preview_image(this, 'update_preview_image');" >
        </div>
    </div>
    <div class="col-sm-4">
        <div id="update_preview_image">
            <?php
                if($reviewDetails['image']){
            ?>
                    <img src="<?=site_url($reviewDetails['image']);?>" width="100" >
            <?php
                }
            ?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12" class="editResponseMessage" id="editResponseMessage"></div>
</div>
<div class="form-group">
    <button class="btn btn_theme2 btn-lg edit_btn_submit">Update</button>
</div>