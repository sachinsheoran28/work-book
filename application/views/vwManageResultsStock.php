<?php
$this->load->view('vwHeaderC');

?>
<!--  
-->

      <div id="page-wrapper">

        <div class="row">
          <div class="col-lg-12">
            <h1>Inventry Audit <small>Reports</small></h1>
            <ol class="breadcrumb">
              <li><a href="Results"><i class="icon-dashboard"></i> Reports</a></li>
              <li class="active"><i class="icon-file-alt"></i> Report List</li>
              
              <div style="clear: both;"></div>
            </ol>
          </div>
        </div><!-- /.row -->  
          <div class="row">
              <div class="col-lg-12">
                  <h3>Search Audit</h3>
                  <form method="post" class="clearfix" action="<?php echo site_url('reports');?>">
         <select name="search_type" class="form-control" style="width:150px;float:left;">
         <option value="results.rid">ID</option>
         <option value="users.first_name">Auditor name</option>
         <option value="center.center_name">Office Name</option>    
         </select> 
         <input type="text" name="search" class="form-control" style="width:150px;float:left;margin-left:10px;" value=""> 
         <input type="submit"   value="Search"  class="btn btn-default" style="float:left;margin-left:10px;"></form>
                  <hr/>
              </div>
          </div>
    <div id="capture"></div>
        
            
            <div class="table-responsive">
              <table class="table table-hover tablesorter">
                <thead>
                  <tr>
                    <th class="header">Audit ID <i class="fa fa-sort"></i></th>
                    <th class="header">Auditor name <i class="fa fa-sort"></i></th>
                    <th class="header">Office Name<i class="fa fa-sort"></i></th>
                      
                    <th class="header">Action</th>
                  </tr>
                </thead>
                <tbody>
                    
                    <?php 

foreach($list as $key => $ass){
  //  print_r($ass);
                        echo '<tr>';
                        echo '<td>'.$ass["rid"].'</td>';
                        echo '<td>'.$ass["first_name"].' '.$ass["last_name"].'</td>';
                        echo '<td>'.$ass["center_name"].'</td>';
                        echo '<td><a href="'. site_url().'stock/view_result/'.$ass["rid"].'" class="btn btn-xs btn-success">View</a> 
                         </td>';
                        echo '</tr>';
						//<a href="'. site_url().'stock/view_variance/'.$ass["rid"].'" class="btn btn-xs btn-success">Variance</a>
                      }   
                     ?>
                </tbody>
              </table>
            </div>
        <?php
         if (!empty($list)) {
          //$this->load->view('vwPaginate');
         }
        ?>
        
        
      </div><!-- /#page-wrapper -->

<?php
$this->load->view('vwFooter');
?>