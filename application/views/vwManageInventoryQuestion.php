<?php $this->load->view('vwHeader');?>
<!--  
Author : Abhishek R. Kaushik 
Downloaded from http://devzone.co.in
-->

      <div id="page-wrapper">

        <div class="row">
          <div class="col-lg-12">
            <h1>Questions <small>Manage Inventory</small></h1>
            <ol class="breadcrumb">
				<li><a href="javascript:void(0);"><i class="icon-dashboard"></i> Questions</a></li>
				<li class="active"><i class="icon-file-alt"></i> Inventory Questions List</li>
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
            <div class="table-responsive">
              <table class="table table-hover tablesorter">
                <thead>
					<tr>
						<th  class="header">SL<i class="fa fa-sort"></i></th>
						<th class="header">Item Code<i class="fa fa-sort"></i></th>
						<th class="header">Fixed Assets List<i class="fa fa-sort"></i></th>
						<th class="header">Actual Score<i class="fa fa-sort"></i></th>
						<th class="header">Score<i class="fa fa-sort"></i></th>
					</tr>
                </thead>
                <tbody>
                    <?php 
                    
                    if (is_array($list)) {
                      foreach($list as $key => $ass){
						$score = explode(',',$ass["scores"])[$key] !=' ' ? explode(',',$ass["scores"])[$key] : '0';  
						$score2 = explode(',',$ass["scores2"])[$key] !=' ' ? explode(',',$ass["scores2"])[$key] : '0';  
                      if($ass["deleted"] == 'N'){
					  $sl=$key+1;
                        echo '<tr>';
						echo '<td>'.$sl.'</td>';
						echo '<td>'.$ass["code"].'</td>';
                        echo '<td>'.$ass["question"].'</td>';
						echo '<td>'.$score.'</td>';
						echo '<td>'.$score2.'</td>';
                        echo '</tr>';
                      }
                      } 
                    } else {
                       echo '<tr><td colspan="6">'.$list.'</td></tr>'; 
                    }
                     ?>
                </tbody>
              </table>
            </div>
        
        <ul class="pagination pagination-sm">
                <li class="disabled"><a href="#"><<</a></li>
                <li class="active"><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li><a href="#">>></a></li>
              </ul>
        
        
      </div><!-- /#page-wrapper -->

<?php
$this->load->view('admin/vwFooter');
?>