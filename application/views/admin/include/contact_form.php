<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" style="margin:0 -10px ;">
  <tbody>
    <tr>
      <td align="center" valign="top">
        <table border="0" cellpadding="0" cellspacing="10" width="100%">
          <tbody>
            <tr>
              <td style="color: #444;">
                <h4 style="font-size: 24px; margin:0 ; margin-bottom: 10px; color: #000;">User Contact Details</h4>
                <p>
                  <?= $emailContent; ?>
                </p>
              </td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>
    <tr>
      <td align="center" valign="top">
        <table border="0" cellpadding="0" cellspacing="10" width="100%">
          <tbody>
            <tr>
              <td style="color: #444; width: 50%;"><label>Full Name</label></td>
              <td style="color: #444; width: 50%;"><b><?= $userdata['full_name']; ?></b></td>
            </tr>
            <tr>
              <td style="color: #444; width: 50%;"><label>Email Address </label></td>
              <td style="color: #444; width: 50%;"><b><?= $userdata['email']; ?></b></td>
            </tr>
            <tr>
              <td style="color: #444; width: 50%;"><label>Phone </label></td>
              <td style="color: #444; width: 50%;"><b><?= $userdata['phone']; ?></b></td>
            </tr>
            <tr>
              <td style="color: #444; width: 50%;"><label>Message </label></td>
              <td style="color: #444; width: 50%;"><b><?= $userdata['message']; ?></b></td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>
  </tbody>
</table>