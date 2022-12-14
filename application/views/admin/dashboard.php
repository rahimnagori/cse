<?php include 'include/header.php'; ?>

<div class="conten_web">
  <h4 class="heading">Dashboard</h4>
  <?= $this->session->flashdata('responseMessage'); ?>
  <div class="ddd">
    <div class="row">
      <div class="col-sm-3">
        <div class="dashboard-tile1 detail1 ">
          <div class="content1">
            <p>Jobs</p>
            <h1>0</h1>
          </div>
          <div class="ussicon">
            <i class="fa fa-briefcase"></i>
          </div>
        </div>
      </div>
      <div class="col-sm-3">
        <div class="dashboard-tile1 detail1 ">
          <div class="content1">
            <p>Users</p>
            <h1>0</h1>
          </div>
          <div class="ussicon">
            <i class="fa fa-users"></i>
          </div>
        </div>
      </div>
      <div class="col-sm-3">
        <div class="dashboard-tile1 detail1 ">
          <div class="content1">
            <p>Chats</p>
            <h1>0</h1>
          </div>
          <div class="ussicon">
            <i class="fa fa-comments"></i>
          </div>
        </div>
      </div>
      <div class="col-sm-3">
        <div class="dashboard-tile1 detail1 ">
          <div class="content1">
            <p>Messages</p>
            <h1>0</h1>
          </div>
          <div class="ussicon">
            <i class="fa fa-commenting"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include 'include/footer.php'; ?>