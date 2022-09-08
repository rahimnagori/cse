
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
              <a class="" data-toggle="collapse" data-target="#<?= $faq['id']; ?>"
               aria-expanded="<?=($firstElement == 0) ? 'true' : 'false';?>" aria-controls="<?= $faq['id']; ?>">
                <i class="plluus"></i> <?= $faq['question']; ?>
              </a>


              <div id="<?= $faq['id']; ?>" class="collapse <?=($firstElement == 0) ? 'show' : '';?>" data-parent="#accordion">
                <div class="card-body">
                  <?= $faq['answer']; ?>
                </div>
              </div>
            </div>
          <?php
          $firstElement = $faq['id'];
          }
          ?>
          <!-- <div class="card panel-title">
        <a class="" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          <i class="plluus"></i> Collapsible Group Item #2
        </a>
    
    <div id="collapseTwo" class="collapse" data-parent="#accordion">
      <div class="card-body">
        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
      </div>
    </div>
  </div>
  <div class="card panel-title">
        <a class="" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          <i class="plluus"></i> Collapsible Group Item #3
        </a>
    
    <div id="collapseThree" class="collapse" data-parent="#accordion">
      <div class="card-body">
        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
      </div>
    </div>
  </div> -->
        </div>
        <!-- <div class="conten_set ">
          
        </div> -->
      </div>
    </div>
  </div>
</section>