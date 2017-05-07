<?php
$this->load->view('admin/vwHeader');
?>
      <div id="page-wrapper">

        <div class="row">
          <div class="col-lg-12">
            <h1>Client <small>Manage Client</small></h1>
            <ol class="breadcrumb">
              <li><a href="Vtp"><i class="icon-dashboard"></i> Clients</a></li>
              <li class="active"><i class="icon-file-alt"></i> Clients List</li>
              <a class="btn btn-primary" href="<?php echo base_url(); ?>admin/vtp/add_vtp" style="float:right;">Add New Client</a>
              <div style="clear: both;"></div>
            </ol>
          </div>
        </div><!-- /.row -->

        <?php
if(isset($succ) && $succ !='') {
        ?>
                    <div class="alert alert-success">
                        <?php echo $succ; ?>
                    </div>
        <?php
        }
        ?>
          <div>
              <form method="post" action="<?php echo base_url('admin/vtp') ?>">
                  <input type="text" value="<?php if(isset($_POST["search"])) { echo $_POST["search"]; } ?>" placeholder="Type Client Name..."name="search" class="form-control" style="width:150px;float:left;margin-left:10px;" value=""> 
<input type="submit" value="Search"  class="btn btn-default" style="float:left;margin-left:10px;">
              </form>
          </div>
            
            <div class="table-responsive">
              <table class="table table-hover tablesorter">
                <thead>
                  <tr>
                      <th class="header">S.No <i class="fa fa-sort"></i></th>
                    <th class="header">Client Name <i class="fa fa-sort"></i></th>
                    <th class="header">Contact Person <i class="fa fa-sort"></i></th>
                    <th class="header">Email <i class="fa fa-sort"></i></th>
                    <th class="header">City<i class="fa fa-sort"></i></th>
                    <th class="header">Action</th>
                  </tr>
                </thead>
                <tbody>
                    <?php
                     
                      if(is_string($list)){
                            echo '<tr>';
                            echo '<td colspan="5"> ';
                            echo "No Client";
                            echo '</td>';
                            echo '</tr>';
                             } else {
                                 $limit++;
                      foreach($list as $key => $ass){
                      if($ass["deleted"] == 'N'){
                        echo '<tr>';
                        echo '<td>'.$limit++.'</td>';
                        echo '<td>'.$ass["firstname"].'</td>';
                        echo '<td>'.$ass["vtp_rep"].'</td>';
                        echo '<td>'.$ass["email"].'</td>';
                        echo '<td>'.$ass["city"].'</td>';
                        echo '<td><a href="'. base_url().'admin/vtp/edit_vtp/'.$ass["aid"].'" class="btn btn-xs btn-success">edit</a>  <a href="'. base_url().'admin/vtp/delete_vtp/'.$ass["aid"].'" class="btn btn-xs btn-danger">delete</a></td>';
                        echo '</tr>';
                      }
                      } 
                      } 
                     ?>
                </tbody>
              </table>
            </div>
                
        <?php
          $this->load->view('admin/vwPaginate');
        ?>
        
      </div><!-- /#page-wrapper -->

<?php
$this->load->view('admin/vwFooter');
?>