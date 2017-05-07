<?php
if ($this->session->userdata('status') == '0'){
$this->load->view('vwHeader');
} else {
    $this->load->view('vwHeaderC');
}
?>


<div class="row">
                    <div class="col-lg-12">
                        <h1>Offices</h1>
                        <p>Office List.</p>
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
                    <th class="header">Office Name <i class="fa fa-sort"></i></th>
                      <th class="header">Office City <i class="fa fa-sort"></i></th>
                    <th class="header">Action</th>
                  </tr>
                </thead>
                <tbody>
                    <?php foreach($list as $key => $ass){
						$c_id = $ass['centid'];
						$this->db->where('parentid',$c_id);
						$query = $this->db->get("center");
						$result = $query->result();
						
                      if($ass["deleted"] == 'N'){
                        echo '<tr>';
                        echo '<td>'.$ass["center_name"].'</td>';
                        echo '<td>'.$ass["center_address_city"].'</td>';
						echo '<td><a href="'. base_url().'home/view_address/'.$ass["centid"].'" class="btn btn-xs btn-success">View Detail</a>'; 
						//if($ass["further"]>0){  echo ' | <a href="'. base_url().'home/subcenter/'.$ass["centid"].'" class="btn btn-xs btn-success">Select Center</a>'; } echo '</td>';
						if($result) { echo ' | <a href="'. base_url().'home/subcenter/'.$ass["centid"].'" class="btn btn-xs btn-success">Select Center</a>';}
						echo '</td>';
                        echo '</tr>';
                      }
                      }   
                     ?>
                </tbody>
              </table>
            </div>

<?php
$this->load->view('vwFooter');
?>