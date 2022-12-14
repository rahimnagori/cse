<div class="optio_raddipo">
    <div class="form-group">
        <label> Category Name </label>
        <input type="hidden" name="category_id" required="" value="<?= $categoryDetails['id']; ?>">
        <input type="text" name="category_name" class="form-control" required="" value="<?= $categoryDetails['category_name']; ?>">
    </div>
    <div class="form-group">
        <label> Category Link </label>
        <input type="url" name="category_link" class="form-control" value="<?= $categoryDetails['category_link']; ?>" >
    </div>
    <div class="form-group">
        <label> Category Price </label>
        <input type="number" step="0.1" name="category_price" class="form-control" value="<?= $categoryDetails['category_price']; ?>" >
    </div>
    <div class="row">
        <div class="col-sm-12" class="responseMessage" id="responseMessage"></div>
    </div>
    <div class="form-group">
        <button class="btn btn_theme2 btn-lg btn_submit">Update</button>
    </div>
</div>