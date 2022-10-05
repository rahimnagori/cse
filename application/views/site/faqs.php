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
      <div class="col-sm-12 faq_us ">
        <div id="accordion">
          <?php
          $firstElement = 0;
          foreach ($faqs as $faq) {
          ?>
            <div class="card panel-title">
              <a class="" data-toggle="collapse" data-target="#<?= $faq['id']; ?>" aria-expanded="<?= ($firstElement == 0) ? 'true' : 'false'; ?>" aria-controls="<?= $faq['id']; ?>">
                <i class="plluus"></i> <?= $faq['question']; ?>
              </a>
              <div id="<?= $faq['id']; ?>" class="collapse <?= ($firstElement == 0) ? 'show' : ''; ?>" data-parent="#accordion">
                <div class="card-body">
                  <?= $faq['answer']; ?>
                </div>
              </div>
            </div>
          <?php
            $firstElement = $faq['id'];
          }
          ?>
        </div>
      </div>
    </div>
  </div>
</section>