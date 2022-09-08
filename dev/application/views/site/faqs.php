<style>
  
.faq_us .panel.panel-default {
    border: none;
    box-shadow: 0 2px 10px rgba(0, 0, 0, .1);
    border-left: 4px solid var(--blue)
}

.faq_us .panel-title {
    font-size: 17px;
    margin-bottom: 0
}

.faq_us .panel-title>a {
    position: relative;
    color: var(--BL);
    padding: 15px;
    display: inline-block;
    padding-right: 45px;
    width: 100%;
    background: #fff;
    font-family: 'Nunito Sans', sans-serif;
    font-weight: 700;
}

.faq_us .panel-title>a i {
    position: absolute;
    right: 9px;
    top: 7px;
    background: var(--blue);
    width: 30px;
    height: 30px;
    text-align: center;
    color: #fff;
    line-height: 30px;
    border-radius: 100%;
    box-shadow: 0 1px 7px rgba(0, 0, 0, .2) !important
}

.faq_us .panel-default>.panel-heading+.panel-collapse>.panel-body {
    border: none;
    padding: 15px;
    padding-top: 0;
    color: #777;
    font-family: 'Nunito Sans', sans-serif;
    font-weight: 400;
    background: #fff;
}

.faq_us .panel-group .panel+.panel {
    margin-top: 15px
}

.faq_us .panel-default>.panel-heading+.panel-collapse>.panel-body br {
    margin-bottom: 10px
}

.faq_us .panel-title>a i::after {
    position: absolute;
    width: 16px;
    height: 3px;
    background: #fff;
    content: "";
    top: 14px;
    left: 0;
    right: 0;
    margin: 0 auto
}

.faq_us .panel-title>a i::before {
    position: absolute;
    width: 3px;
    height: 16px;
    background: #fff;
    content: "";
    top: 7px;
    left: 0;
    right: 0;
    margin: 0 auto
}

.faq_us .panel-title>a[aria-expanded=true] i::before {
    transform: rotate(-90deg);
    opacity: 0
}
</style>
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
  <div class="card panel-title">
        <a class="" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          <i class="plluus"></i> Collapsible Group Item #1
        </a>
    

    <div id="collapseOne" class="collapse show" data-parent="#accordion">
      <div class="card-body">
        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
      </div>
    </div>
  </div>
  <div class="card panel-title">
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
  </div>
</div>
        <!-- <div class="conten_set ">
          <?php
            foreach($faqs as $faq){
            ?>
            <h1><?$faq['question'];?></h1>
            <p><?$faq['answer'];?></p>
            <?php
            }
          ?>
        </div> -->
      </div>
    </div>
  </div>
</section>