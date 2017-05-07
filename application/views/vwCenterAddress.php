<?php
if ($this->session->userdata('status') == '0'){
$this->load->view('vwHeader');
} else {
    $this->load->view('vwHeaderC');
}
?>


<div class="row">
                    <div class="col-lg-12">
                        <h1>Center</h1>
                        <p><?php echo $center->center_name; ?></p>
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
                <tbody>
                    <tr>
                        <th>Center Name</th>
                        <td><?php echo $center->center_name; ?></td>
                    </tr>
                    <tr>
                        <th>Center Address</th>
                        <td><?php echo $center->center_address_one; ?></td>
                    </tr>
                    <tr>
                        <th>City</th>
                        <td><?php echo $center->center_address_city; ?></td>
                    </tr>
                    <tr>
                        <th>State</th>
                        <td><?php echo $center->center_address_state; ?></td>
                    </tr>
                    <tr>
                        <th>Contry</th>
                        <td><?php echo $center->center_address_contry; ?></td>
                    </tr>
                    <tr>
                        <th>Pin Code</th>
                        <td><?php echo $center->center_address_zip; ?></td>
                    </tr>
                    <tr>
                        <th>Center Representative</th>
                        <td><?php echo $center->center_rep; ?></td>
                    </tr>
                    <tr>
                        <th>Phone Number</th>
                        <td><?php echo $center->center_phone; ?></td>
                    </tr>
                    <tr>
                        <th>Email Id</th>
                        <td><?php echo $center->email; ?></td>
                    </tr>
                </tbody>
                  <tfoot>
                    <tr>
                     <td><?php if ($this->session->userdata('status') == '0'){ echo '<a href="'. base_url().'home/start_quiz/'.$insid.'" class="btn btn-sm btn-success">Start quiz</a>'; } ?></td>
                      <td></td>
                      </tr>
                  </tfoot>
              </table>
            </div>

<?php
$this->load->view('vwFooter');
?>