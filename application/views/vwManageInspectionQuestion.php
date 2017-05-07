<?php $this->load->view('vwHeader');?>
<!--  
Author : Abhishek R. Kaushik 
Downloaded from http://devzone.co.in
-->

      <div id="page-wrapper">

        <div class="row">
			<div class="col-lg-12">
				<h1>Questions <small>Manage Inspection</small></h1>
				<ol class="breadcrumb">
					<li><a href="javascript:void(0);"><i class="icon-dashboard"></i> Questions</a></li>
					<li class="active"><i class="icon-file-alt"></i> Inspection Questions List</li>
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
					<tr>SL<i class="fa fa-sort"></i></th>
						<th class="header">Question Group <i class="fa fa-sort"></i></th>
						<th class="header">Question<i class="fa fa-sort"></i></th>
						<th class="header">Auditor Score<i class="fa fa-sort"></i></th>
						<th class="header">Max. Score<i class="fa fa-sort"></i></th>
					</tr>
                </thead>
                <tbody>
                    <?php 
					//echo '<pre/>';print_r($list);exit;
                    if (is_array($list)) {
						$i = 0;
						foreach($list as $key => $ass){
							if($ass["deleted"] == 'N'){
								echo '<tr>';
								echo '<td>'.$ass["question_group"].'</td>';
								echo '<td>'.$ass["question"].'</td>';
								echo '<td>'.explode(',',$ass["scores"])[$i].'</td>';
								echo '<td>'.$ass["max_score"].'</td>';
								$i++;	
							}
						} 
                    } else {
                       echo '<tr><td colspan="6">'.$list.'</td></tr>'; 
                    }
                     ?>
                </tbody>
              </table>
            </div>
        
			<!--<ul class="pagination pagination-sm">
                <li class="disabled"><a href="#"><<</a></li>
                <li class="active"><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li><a href="#">>></a></li>
            </ul>-->
      </div><!-- /#page-wrapper -->
<?php $this->load->view('vwFooter');?>