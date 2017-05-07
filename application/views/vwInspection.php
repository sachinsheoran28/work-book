<?php
$this->load->view('vwHeader');
?>


<div class="row">
                    <div class="col-lg-12">
                        <h1>Select Inspection</h1>
                        <p>Select Inspection name to start quiz.</p>
                         <?php
if(isset($succ) && $succ !='') {
        ?>
                    <div class="alert alert-success">
                        <?php echo $succ; ?>
                    </div>
        <?php
        }
        ?>
                    </div>
                </div>

            <div class="table-responsive">
              <table class="table table-hover tablesorter">
                <thead>
                  <tr>
                    <th class="header">Inspection <i class="fa fa-sort"></i></th>
                      <th class="header">Center Name <i class="fa fa-sort"></i></th>
                    <th class="header">Action</th>
                  </tr>
                </thead>
                <tbody>
                    <?php 
                     $count = 0;
                     foreach($list as $key => $ass){
                      if($ass["deleted"] == 'N' && $ass["date"] == strtotime(date('d-m-Y')) && $ass["insuid"] == $this->session->userdata['id'] ){
                          $count = $count+1;
                        echo '<tr>';
                        echo '<td>'.$ass["insname"].'</td>';
                        echo '<td>'.$ass["center_name"].'</td>';
                        echo '<td><a href="'. base_url().'home/start_quiz/'.$ass["insid"].'" class="btn btn-xs btn-success">Start quiz</a> <a href="'. base_url().'home/view_address/'.$ass["inscid"].'/'.$ass["insid"].'" class="btn btn-xs btn-warning">View Address</a> <a href="'. base_url().'videos/index/'.$ass["inscid"].'" class="btn btn-xs btn-primary">Stream Video</a></td>';
                        echo '</tr>';
                      }
                      }
                      if($count == 0){
                          echo '<tr>';
                          echo '<td colspan="4">No audit for today</td>';
                          echo '</tr>';
                      }
                     ?>
                </tbody>
              </table>
            </div>
<?php
$this->load->view('vwFooter');
?>