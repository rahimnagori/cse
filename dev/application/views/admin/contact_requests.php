<?php include 'include/header.php'; ?>

<div class="conten_web">
  <h4 class="heading">Enquiries <small>Management</small></h4>
  <div class="white_box">
    <?= $this->session->flashdata('responseMessage'); ?>
    <div class="card_bodym">
      <div class="table-responsive">
        <table id="extent_tbl1" class="table display">
          <thead>
            <tr>
              <th>S.No.</th>
              <th>Full Name</th>
              <th>Email</th>
              <th>Telephone</th>
              <th>Message</th>
              <th>Sent Date</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($contactRequests as $serialNumber => $contactRequest) {
            ?>
              <tr>
                <td><?= $serialNumber + 1; ?></td>
                <td><?= $contactRequest['full_name']; ?></td>
                <td><?= $contactRequest['email'] ?></td>
                <td><?= $contactRequest['phone']; ?></td>
                <td>
                  <button class="btn btn_theme2 btn-xs" data-toggle="modal" data-target="#viewMessageModal_<?= $contactRequest['id']; ?>">See Message</button>  

<!-- Modal -->
<div class="modal fade" id="viewMessageModal_<?= $contactRequest['id']; ?>" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="la la-times-circle"></i></span></button>
      </div>
      <div class="modal-body"><?= $contactRequest['message']; ?></td></div>
    </div>
  </div>
</div>
<!-- Modal close-->
                <td><?= date("d M, Y", strtotime($contactRequest['created'])); ?></td>
              </tr>
            <?php
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?php include 'include/footer.php'; ?>