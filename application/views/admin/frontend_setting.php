<?php include 'include/header.php'; ?>

<div class="conten_web">
  <h4 class="heading">Profile <span>
      <!-- <a href="javascript:void(0);" class="btn btn_theme2" data-toggle="modal" data-target="#Add_polls">modal</a></span> -->
  </h4>
  <div class="ddd">
    <div class="row">
      <div class="col-sm-12">
        <?= $this->session->flashdata('responseMessage'); ?>
        <div class="row">
          <div class="col-sm-12 p-5">
            <div class="white_box">
              <div class="card_bodym">
                <div class="box box-info">
                  <div class="box-header with-border">
                    <h3 class="box-title">Frontend Slider</h3>
                  </div>
                  <form class="form-horizontal" id="techform" action="<?= site_url('setting/submit_video_links'); ?>" method="post" style="padding: 15px;">
                    <div class="box-body">
                        <!-- ... [other form elements] ... -->
                        <div class="form-group">
                            <label for="sliderName">Slider Name:</label>
                            <input type="text" class="form-control" id="sliderName" name="sliderName" value="<?= $settingData['slider_name'] ?>"  required>
                        </div>
                        <div class="form-group">
                            <label for="videoLink1">Video Link 1:</label>
                            <input type="url" class="form-control" id="videoLink1" name="videoLink1"  value="<?= $settingData['video_link1'] ?>"  >
                        </div>
                        <div class="form-group">
                            <label for="videoLink2">Video Link 2:</label>
                            <input type="url" class="form-control" id="videoLink2" name="videoLink2"  value="<?= $settingData['video_link2'] ?>"  >
                        </div>
                        <div class="form-group">
                            <label for="videoLink3">Video Link 3:</label>
                            <input type="url" class="form-control" id="videoLink3" name="videoLink3"  value="<?= $settingData['video_link3'] ?>"  >
                        </div>
                        <div class="form-group">
                            <label for="videoLink3">Video Link 4:</label>
                            <input type="url" class="form-control" id="videoLink3" name="videoLink4"  value="<?= $settingData['video_link4'] ?>"  >
                        </div>
                        <div class="form-group">
                            <label for="videoLink3">Video Link 5:</label>
                            <input type="url" class="form-control" id="videoLink3" name="videoLink5"  value="<?= $settingData['video_link5'] ?>"  >
                        </div>
                        <!-- Add a -->
                        <!-- Slider Controls -->
                        <div class="form-group form-check">
                            <!-- <input type="checkbox" class="form-check-input" id="audioControl" name="audioControl" <?= $settingData['audio_control']? 'checked' :''?> > -->
                            <!-- <label class="form-check-label" for="audioControl">Audio Enable</label> -->
                        </div>
                        <div class="form-group form-check">
                            <!-- <input type="checkbox" class="form-check-input" id="videoControl" name="videoControl" <?= $settingData['video_control']? 'checked' :''?>> -->
                            <label class="form-check-label" for="videoControl">Link Type : https://www.youtube.com/embed/qwertyuiop?si=WPAu6mYszjLmwSG6?rel=0&controls=0&loop=1&mute=0</label>
                        </div>
                      </div>
                    </div>
                    <div class="box-footer text-right">
                      <input type="hidden" name="id" id="id" value="<?= $settingData['id'] ?>">
                      <button type="submit" class="btn btn-info " data-loading-text="Loading..." id="changeUsernameBtn">Update</button>
                    </div>
                    <!-- /.box-footer -->
                  </form>

                  
    <table class="table table-response">
        <thead>
            <tr>
                <th>Parameter</th>
                <th>Values</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>autoplay</td>
                <td>0 or 1</td>
                <td>Automatically start playing the video when the player loads.</td>
            </tr>
            <tr>
                <td>cc_load_policy</td>
                <td>1</td>
                <td>Turn on closed captions by default.</td>
            </tr>
            <tr>
                <td>color</td>
                <td>red or white</td>
                <td>Specify the color of the video progress bar.</td>
            </tr>
            <tr>
                <td>controls</td>
                <td>0, 1, or 2</td>
                <td>Determine whether the video player should display controls.</td>
            </tr>
            <tr>
                <td>disablekb</td>
                <td>0 or 1</td>
                <td>Disable the keyboard controls.</td>
            </tr>
            <tr>
                <td>enablejsapi</td>
                <td>0 or 1</td>
                <td>Enable the player to be controlled by JavaScript.</td>
            </tr>
            <tr>
                <td>end</td>
                <td>Time in seconds</td>
                <td>Specify a time, measured in seconds from the start of the video, when the video should stop playing.</td>
            </tr>
            <tr>
                <td>fs</td>
                <td>0 or 1</td>
                <td>Display the fullscreen button.</td>
            </tr>
            <tr>
                <td>iv_load_policy</td>
                <td>1 or 3</td>
                <td>Show or hide video annotations.</td>
            </tr>
            <tr>
                <td>loop</td>
                <td>0 or 1</td>
                <td>Play the video in a loop. Requires setting a playlist.</td>
            </tr>
            <tr>
                <td>modestbranding</td>
                <td>1</td>
                <td>Prevent the YouTube logo from displaying in the control bar.</td>
            </tr>
            <tr>
                <td>mute</td>
                <td>0 or 1</td>
                <td>Mute the video.</td>
            </tr>
            <tr>
                <td>playlist</td>
                <td>Video IDs</td>
                <td>List of video IDs to play as a playlist.</td>
            </tr>
            <tr>
                <td>playsinline</td>
                <td>0 or 1</td>
                <td>Play the video inline on iOS, rather than fullscreen.</td>
            </tr>
            <tr>
                <td>rel</td>
                <td>0 or 1</td>
                <td>Show related videos when playback ends.</td>
            </tr>
            <tr>
                <td>start</td>
                <td>Time in seconds</td>
                <td>Specify the time, measured in seconds from the start of the video, to start playing.</td>
            </tr>
            <!-- Add additional parameters as needed -->
        </tbody>
    </table>
</div>

                </div>
              </div>
            </div>
          </div>
          
    </div>
  </div>
</div>

<!-- modal us -->


<!-- modal us -->
<?php include 'include/footer.php'; ?>