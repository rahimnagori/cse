<div class="inner_header">
  <div class="container">
    <h1>FAQs</h1>
    <ul class="ul_set">
      <li><a href="<?= site_url(); ?>">Home</a></li>
      <li><span>FAQs</span></li>
    </ul>
  </div>
</div>
<section class="abbout_uss pad_b">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-sm-8">
        <div class="conten_set ">
          <?php
            foreach($faqs as $faq){
            ?>
            <h1><?$faq['question'];?></h1>
            <p><?$faq['answer'];?></p>
            <?php
            }
          ?>
        </div>
      </div>
    </div>
  </div>
</section>