<?php $this->load->view('vwHeader');?>
<!--  
Author : Abhishek R. Kaushik 
Downloaded from http://devzone.co.in
-->

      <div id="page-wrapper">

        <div class="row">
			<div class="col-lg-12">
				<h1>Questions <small>Manage Assets</small></h1>
				<ol class="breadcrumb">
					<li><a href="javascript:void(0);"><i class="icon-dashboard"></i> Questions</a></li>
					<li class="active"><i class="icon-file-alt"></i> Checklist Questions List</li>
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
						<th  class="header">
						<th class="header">Fixed Assets List<i class="fa fa-sort"></i></th>
						<th class="header">Model<i class="fa fa-sort"></i></th>
						<th class="header">Tag<i class="fa fa-sort"></i></th>
					</tr>
                </thead>
                <tbody>
                    <?php 
                    if (is_array($list)) {
						foreach($list as $key => $ass){
							$model = explode('~',$ass["model"])[$key] !=' ' ? explode('~',$ass["model"])[$key] : 'N/A';
							$tag = explode('~',$ass["tag"])[$key] !=' ' ? explode('~',$ass["tag"])[$key] : 'N/A';	
							if($ass["deleted"] == 'N'){
								$sl=$key+1;
								echo '<tr>';
								echo '<td>'.$sl.'</td>';
								echo '<td>'.$ass["question"].'</td>';
								echo '<td>'.$model.'</td>';
								echo '<td>'.$tag.'</td>';
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