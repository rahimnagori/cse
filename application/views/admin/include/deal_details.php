<div class="form-group">
  <label> Title </label>
  <input type="text" name="title" class="form-control" required="" value="<?= $dealDetails['title']; ?>" >
  <input type="hidden" name="deal_id" value="<?= $dealDetails['id']; ?>" required="" >
</div>
<div class="form-group">
  <label> Description </label>
  <input type="text" name="description" class="form-control" required="" value="<?= $dealDetails['description']; ?>">
</div>
<div class="form-group">
  <label> Link </label>
  <input type="url" name="link" class="form-control" required="" value="<?= $dealDetails['link']; ?>">
</div>
<div class="form-group">
  <div class="row"><div class="col-sm-12"><label> Price</label></div></div>
  <div class="row">
    <div class="col-sm-6">
      <div class="input-group">
        <span class="input-group-addon">INR</span>
        <input type="number" name="price_inr" class="form-control" required="" value="<?= $dealDetails['price_inr']; ?>">
      </div>
    </div>
    <div class="col-sm-6">
      <div class="input-group">
        <span class="input-group-addon">$</span>
        <input type="text" name="price_dollar" class="form-control" required="" value="<?= $dealDetails['price_dollar']; ?>" >
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-sm-12" class="responseMessage" id="editResponseMessage"></div>
</div>
<div class="form-group">
  <button class="btn btn_theme2 btn-lg btn_submit">Update</button>
</div>