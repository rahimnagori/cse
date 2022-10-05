<div class="optio_raddipo">
    <input type="hidden" name="faq_id" required="" value="<?= $faqDetails['id']; ?>" />
    <div class="form-group">
        <label> Question </label>
        <input type="text" name="question" class="form-control" required="" value="<?= $faqDetails['question']; ?>" />
    </div>
    <div class="form-group">
        <label> Answer </label>
        <textarea name="answer" cols="30" rows="5" class="form-control" required=""><?= $faqDetails['answer']; ?></textarea>
    </div>
    <div class="row">
        <div class="col-sm-12" class="responseMessage" id="updateResponseMessage"></div>
    </div>
    <div class="form-group">
        <button class="btn btn_theme2 btn-lg btn_submit">Update</button>
    </div>
</div>