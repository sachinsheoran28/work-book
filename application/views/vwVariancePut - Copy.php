<?php
$this->load->view('vwHeader');
?>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
<style>
    .bootstrap-select:not([class*=col-]):not([class*=form-control]):not(.input-group-btn) {
    width: 120px;
}
</style>

<div class="row">
	<div class="col-lg-12">
		<h1>Update Variance</h1>
		<p></p>
		<div id="feed-container" class="alert alert-success" style="display:none;"></div>
	</div>
</div>
<div class="row">
    <form id ="feedInput">
		<div class="col-md-6">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Top 10 Food Variance Loss</h3>
                </div>
				<div class="searchbox form-group" id="importbox">
					<?php //echo form_open('home/import/',array('enctype'=>'multipart/form-data'),'id="form-1"'); ?>
						<p>Upload Excel file ( .xls only )</p>
						<input type="hidden" name="size" value="3500000">
						<input type="file" name="xlsfile" id="fvl1">
						<div style="clear:both;"></div>
						<div class="show_loader_fvl1" style="display:none;">
							<img src="<?php echo str_replace('index.php/','',base_url());?>uploads/images/loading.gif"/>
						</div>
						<button type="button" name="Import" value="FVL" id="FVL_import1">Import</button>
						<a href="<?php echo str_replace('index.php/','',base_url());?>xls/sample/FLV_Variance_sample.xls" target="new">Click here </a>to download sample file to know file format.
					<?php //echo form_close();?>
					<br> 
				</div>
                <div class="panel-body">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th class="col-md-3">Raw Matl</th>
                            <th class="col-md-3">Qty</th>
                            <th class="col-md-3">Value</th>
                            <th class="col-md-3">% Usg Val</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php 
             
for($i =0; $i< 10; $i++){
    ?>
                        <tr>
                            <td>
                                <div class="form-group">
                        <select class="selectpicker" name="variants[<?php echo $i ;?>][raw_malt]" data-live-search="true">
                             <option value="">Select </option>
                            <?php 

            foreach($dropdown as $row)
            { 
              echo '<option value="'.$row->qid.'">'.$row->question.'</option>';
            }
            ?>
      </select>
                </div>
                            </td>
                            <td>
                            <div class="form-group">
                                <input type="text" class="form-control" name="variants[<?php echo $i ;?>][quantity]" >
                            </div>
                            </td>
                            <td>
                            <div class="form-group">
                                <input type="text" class="form-control" name="variants[<?php echo $i ;?>][value]" >
                            </div>
                            </td>
                            <td>
                            <div class="form-group input-group">
                                <input type="text" name="variants[<?php echo $i ;?>][per_usg_val]" class="form-control">
                                <span class="input-group-addon">%</span>
                            </div>
                                
                            <input type="hidden" value="FVL" name="variants[<?php echo $i ;?>][type]" >
                            <input type="hidden" value="<?php echo $insid; ?>" name="variants[<?php echo $i ;?>][ins_id]" >
                            <input type="hidden" value="<?php echo $list->inscid; ?>" name="variants[<?php echo $i ;?>][cen_id]" >
                            <input type="hidden" value="<?php echo $list->insuid; ?>" name="variants[<?php echo $i ;?>][u_id]" >
                            </td>
                        </tr>
                            <?php } ?>
      
                        </tbody>
                    </table>
                </div>
            </div>
			<hr/>
                            
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Top 5 Food Variance Gain</h3>
                </div>
				<div class="searchbox form-group" id="importbox">
					<?php echo form_open('home/import/',array('enctype'=>'multipart/form-data'),'id="form-1"'); ?>
						<p>Upload Excel file ( .xls only )</p>
						<input type="hidden" name="size" value="3500000">
						<input type="file" name="xlsfile" id="fvl2">
						<div style="clear:both;"></div>
						<div class="show_loader_fvl2" style="display:none;">
							<img src="<?php echo str_replace('index.php/','',base_url());?>uploads/images/loading.gif"/>
						</div>
						<button type="button" name="Import" value="FVG" id="FVL_import2">Import</button>
						<a href="<?php echo str_replace('index.php/','',base_url());?>xls/sample/FLV_Variance_sample.xls" target="new">Click here </a>to download sample file to know file format.
					<?php echo form_close();?>
					<br> 
				</div>
                <div class="panel-body">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th class="col-md-3">Raw Matl</th>
                            <th class="col-md-3">Qty</th>
                            <th class="col-md-3">Value</th>
                            <th class="col-md-3">% Usg Val</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php 
             
for($i =10; $i< 15; $i++){
    ?>
                        <tr>
                            <td>
                                <div class="form-group">
                        <select class="selectpicker" name="variants[<?php echo $i ;?>][raw_malt]" data-live-search="true">
                             <option value="">Select </option>
                            <?php 

            foreach($dropdown as $row)
            { 
              echo '<option value="'.$row->qid.'">'.$row->question.'</option>';
            }
            ?>
      </select>
                </div>
                            </td>
                            <td>
                            <div class="form-group">
                                <input type="text" class="form-control" name="variants[<?php echo $i ;?>][quantity]" >
                            </div>
                            </td>
                            <td>
                            <div class="form-group">
                                <input type="text" class="form-control" name="variants[<?php echo $i ;?>][value]" >
                            </div>
                            </td>
                            <td>
                            <div class="form-group input-group">
                                <input type="text" name="variants[<?php echo $i ;?>][per_usg_val]" class="form-control">
                                <span class="input-group-addon">%</span>
                            </div>
                                
                            <input type="hidden" value="FVG" name="variants[<?php echo $i ;?>][type]" >
                            <input type="hidden" value="<?php echo $insid; ?>" name="variants[<?php echo $i ;?>][ins_id]" >
                            <input type="hidden" value="<?php echo $list->inscid; ?>" name="variants[<?php echo $i ;?>][cen_id]" >
                            <input type="hidden" value="<?php echo $list->insuid; ?>" name="variants[<?php echo $i ;?>][u_id]" >
                            </td>
                        </tr>
                            <?php } ?>
      
                        </tbody>
                    </table>
                </div>
            </div>
			<hr/>
                            
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Top 5 Food Yield Loss</h3>
                </div>
				<div class="searchbox form-group" id="importbox">
					<?php echo form_open('home/import/',array('enctype'=>'multipart/form-data'),'id="form-1"'); ?>
						<p>Upload Excel file ( .xls only )</p>
						<input type="hidden" name="size" value="3500000">
						<input type="file" name="xlsfile" id="fvl3">
						<div style="clear:both;"></div>
						<div class="show_loader_fvl3" style="display:none;">
							<img src="<?php echo str_replace('index.php/','',base_url());?>uploads/images/loading.gif"/>
						</div>
						<button type="button" name="Import" value="FYL" id="FVL_import3">Import</button>
						<a href="<?php echo str_replace('index.php/','',base_url());?>xls/sample/FLV_Variance_sample.xls" target="new">Click here </a>to download sample file to know file format.
					<?php echo form_close();?>
					<br> 
				</div>
                <div class="panel-body">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th class="col-md-3">Raw Matl</th>
                            <th class="col-md-3">Qty</th>
                            <th class="col-md-3">Value</th>
                            <th class="col-md-3">% Usg Val</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php 
             
for($i =15; $i< 20; $i++){
    ?>
                        <tr>
                            <td>
                                <div class="form-group">
                        <select class="selectpicker" name="variants[<?php echo $i ;?>][raw_malt]" data-live-search="true">
                             <option value="">Select </option>
                            <?php 

            foreach($dropdown as $row)
            { 
              echo '<option value="'.$row->qid.'">'.$row->question.'</option>';
            }
            ?>
      </select>
                </div>
                            </td>
                            <td>
                            <div class="form-group">
                                <input type="text" class="form-control" name="variants[<?php echo $i ;?>][quantity]" >
                            </div>
                            </td>
                            <td>
                            <div class="form-group">
                                <input type="text" class="form-control" name="variants[<?php echo $i ;?>][value]" >
                            </div>
                            </td>
                            <td>
                            <div class="form-group input-group">
                                <input type="text" name="variants[<?php echo $i ;?>][per_usg_val]" class="form-control">
                                <span class="input-group-addon">%</span>
                            </div>
                                
                            <input type="hidden" value="FYL" name="variants[<?php echo $i ;?>][type]" >
                            <input type="hidden" value="<?php echo $insid; ?>" name="variants[<?php echo $i ;?>][ins_id]" >
                            <input type="hidden" value="<?php echo $list->inscid; ?>" name="variants[<?php echo $i ;?>][cen_id]" >
                            <input type="hidden" value="<?php echo $list->insuid; ?>" name="variants[<?php echo $i ;?>][u_id]" >
                            </td>
                        </tr>
                            <?php } ?>
      
                        </tbody>
                    </table>
                </div>
            </div>
                            <hr/>
                            
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Top 5 Food Yield Gain</h3>
                </div>
				<div class="searchbox form-group" id="importbox">
					<?php echo form_open('home/import/',array('enctype'=>'multipart/form-data'),'id="form-1"'); ?>
						<p>Upload Excel file ( .xls only )</p>
						<input type="hidden" name="size" value="3500000">
						<input type="file" name="xlsfile" id="fvl4">
						<div style="clear:both;"></div>
						<div class="show_loader_fvl4" style="display:none;">
							<img src="<?php echo str_replace('index.php/','',base_url());?>uploads/images/loading.gif"/>
						</div>
						<button type="button" name="Import" value="FYG" id="FVL_import4">Import</button>
						<a href="<?php echo str_replace('index.php/','',base_url());?>xls/sample/FLV_Variance_sample.xls" target="new">Click here </a>to download sample file to know file format.
					<?php echo form_close();?>
					<br> 
				</div>
                <div class="panel-body">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th class="col-md-3">Raw Matl</th>
                            <th class="col-md-3">Qty</th>
                            <th class="col-md-3">Value</th>
                            <th class="col-md-3">% Usg Val</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php 
             
for($i =20; $i< 25; $i++){
    ?>
                            <tr>
                            <td>
                                <div class="form-group">
                        <select class="selectpicker" name="variants[<?php echo $i ;?>][raw_malt]" data-live-search="true">
                             <option value="">Select </option>
                            <?php 

            foreach($dropdown as $row)
            { 
              echo '<option value="'.$row->qid.'">'.$row->question.'</option>';
            }
            ?>
      </select>
                </div>
                            </td>
                            <td>
                            <div class="form-group">
                                <input type="text" class="form-control" name="variants[<?php echo $i ;?>][quantity]" >
                            </div>
                            </td>
                            <td>
                            <div class="form-group">
                                <input type="text" class="form-control" name="variants[<?php echo $i ;?>][value]" >
                            </div>
                            </td>
                            <td>
                            <div class="form-group input-group">
                                <input type="text" name="variants[<?php echo $i ;?>][per_usg_val]" class="form-control">
                                <span class="input-group-addon">%</span>
                            </div>
                                
                            <input type="hidden" value="FYG" name="variants[<?php echo $i ;?>][type]" >
                            <input type="hidden" value="<?php echo $insid; ?>" name="variants[<?php echo $i ;?>][ins_id]" >
                            <input type="hidden" value="<?php echo $list->inscid; ?>" name="variants[<?php echo $i ;?>][cen_id]" >
                            <input type="hidden" value="<?php echo $list->insuid; ?>" name="variants[<?php echo $i ;?>][u_id]" >
                            </td>
                        </tr>
                            <?php } ?>
      
                        </tbody>
                    </table>
                </div>
            </div>
                <button type="button" class="btn btn-warning" id="f_submit">Submit Update</button>
        </div>
    
                    
		<div class="col-md-6">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Top 5 Paper Variance Loss</h3>
                </div>
				<div class="searchbox form-group" id="importbox">
					<?php echo form_open('home/import/',array('enctype'=>'multipart/form-data'),'id="form-1"'); ?>
						<p>Upload Excel file ( .xls only )</p>
						<input type="hidden" name="size" value="3500000">
						<input type="file" name="xlsfile" id="fvl5">
						<div style="clear:both;"></div>
						<div class="show_loader_fvl5" style="display:none;">
							<img src="<?php echo str_replace('index.php/','',base_url());?>uploads/images/loading.gif"/>
						</div>
						<button type="button" name="Import" value="PVL" id="FVL_import5">Import</button>
						<a href="<?php echo str_replace('index.php/','',base_url());?>xls/sample/FLV_Variance_sample.xls" target="new">Click here </a>to download sample file to know file format.
					<?php echo form_close();?>
					<br> 
				</div>
                <div class="panel-body">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th class="col-md-3">Raw Matl</th>
                            <th class="col-md-3">Qty</th>
                            <th class="col-md-3">Value</th>
                            <th class="col-md-3">% Usg Val</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php 
             
for($i =25; $i< 30; $i++){
    ?>
                            <tr>
                            <td>
                                <div class="form-group">
                        <select class="selectpicker" name="variants[<?php echo $i ;?>][raw_malt]" data-live-search="true">
                             <option value="">Select </option>
                            <?php 

            foreach($dropdown as $row)
            { 
              echo '<option value="'.$row->qid.'">'.$row->question.'</option>';
            }
            ?>
      </select>
                </div>
                            </td>
                            <td>
                            <div class="form-group">
                                <input type="text" class="form-control" name="variants[<?php echo $i ;?>][quantity]" >
                            </div>
                            </td>
                            <td>
                            <div class="form-group">
                                <input type="text" class="form-control" name="variants[<?php echo $i ;?>][value]" >
                            </div>
                            </td>
                            <td>
                            <div class="form-group input-group">
                                <input type="text" name="variants[<?php echo $i ;?>][per_usg_val]" class="form-control">
                                <span class="input-group-addon">%</span>
                            </div>
                                
                            <input type="hidden" value="PVL" name="variants[<?php echo $i ;?>][type]" >
                            <input type="hidden" value="<?php echo $insid; ?>" name="variants[<?php echo $i ;?>][ins_id]" >
                            <input type="hidden" value="<?php echo $list->inscid; ?>" name="variants[<?php echo $i ;?>][cen_id]" >
                            <input type="hidden" value="<?php echo $list->insuid; ?>" name="variants[<?php echo $i ;?>][u_id]" >
                            </td>
                        </tr>
                            <?php } ?>
      
                        </tbody>
                    </table>
                </div>
            </div>
                            <hr/>
                            
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Top 5 Paper Variance Gain</h3>
                </div>
				<div class="searchbox form-group" id="importbox">
					<?php echo form_open('home/import/',array('enctype'=>'multipart/form-data'),'id="form-1"'); ?>
						<p>Upload Excel file ( .xls only )</p>
						<input type="hidden" name="size" value="3500000">
						<input type="file" name="xlsfile" id="fvl6">
						<div style="clear:both;"></div>
						<div class="show_loader_fvl6" style="display:none;">
							<img src="<?php echo str_replace('index.php/','',base_url());?>uploads/images/loading.gif"/>
						</div>
						<button type="button" name="Import" value="PVG" id="FVL_import6">Import</button>
						<a href="<?php echo str_replace('index.php/','',base_url());?>xls/sample/FLV_Variance_sample.xls" target="new">Click here </a>to download sample file to know file format.
					<?php echo form_close();?>
					<br> 
				</div>
                <div class="panel-body">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th class="col-md-3">Raw Matl</th>
                            <th class="col-md-3">Qty</th>
                            <th class="col-md-3">Value</th>
                            <th class="col-md-3">% Usg Val</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php 
             
for($i =30; $i< 35; $i++){
    ?>
                        <tr>
                            <td>
                                <div class="form-group">
                        <select class="selectpicker" name="variants[<?php echo $i ;?>][raw_malt]" data-live-search="true">
                             <option value="">Select </option>
                            <?php 

            foreach($dropdown as $row)
            { 
              echo '<option value="'.$row->qid.'">'.$row->question.'</option>';
            }
            ?>
      </select>
                </div>
                            </td>
                            <td>
                            <div class="form-group">
                                <input type="text" class="form-control" name="variants[<?php echo $i ;?>][quantity]" >
                            </div>
                            </td>
                            <td>
                            <div class="form-group">
                                <input type="text" class="form-control" name="variants[<?php echo $i ;?>][value]" >
                            </div>
                            </td>
                            <td>
                            <div class="form-group input-group">
                                <input type="text" name="variants[<?php echo $i ;?>][per_usg_val]" class="form-control">
                                <span class="input-group-addon">%</span>
                            </div>
                                
                            <input type="hidden" value="PVG" name="variants[<?php echo $i ;?>][type]" >
                            <input type="hidden" value="<?php echo $insid; ?>" name="variants[<?php echo $i ;?>][ins_id]" >
                            <input type="hidden" value="<?php echo $list->inscid; ?>" name="variants[<?php echo $i ;?>][cen_id]" >
                            <input type="hidden" value="<?php echo $list->insuid; ?>" name="variants[<?php echo $i ;?>][u_id]" >
                            </td>
                        </tr>
                            <?php } ?>
      
                        </tbody>
                    </table>
                </div>
            </div>
                            <hr/>
                            
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Food Condiments:</h3>
                </div>
				<div class="searchbox form-group" id="importbox">
					<?php echo form_open('home/import/',array('enctype'=>'multipart/form-data'),'id="form-1"'); ?>
						<p>Upload Excel file ( .xls only )</p>
						<input type="hidden" name="size" value="3500000">
						<input type="file" name="xlsfile" id="fvl7">
						<div style="clear:both;"></div>
						<div class="show_loader_fvl7" style="display:none;">
							<img src="<?php echo str_replace('index.php/','',base_url());?>uploads/images/loading.gif"/>
						</div>
						<button type="button" name="Import" value="FOC" id="FVL_import7">Import</button>
						<a href="<?php echo str_replace('index.php/','',base_url());?>xls/sample/FLV_Variance_sample.xls" target="new">Click here </a>to download sample file to know file format.
					<?php echo form_close();?>
					<br> 
				</div>
                <div class="panel-body">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th class="col-md-3">Raw Matl</th>
                            <th class="col-md-3">Qty</th>
                            <th class="col-md-3">Value</th>
                            <th class="col-md-3">% Usg Val</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php 
             
for($i =35; $i< 45; $i++){
    ?>
                        <tr>
                            <td>
                                <div class="form-group">
                        <select class="selectpicker" name="variants[<?php echo $i ;?>][raw_malt]" data-live-search="true">
                             <option value="">Select </option>
                            <?php 

            foreach($dropdown as $row)
            { 
              echo '<option value="'.$row->qid.'">'.$row->question.'</option>';
            }
            ?>
      </select>
                </div>
                            </td>
                            <td>
                            <div class="form-group">
                                <input type="text" class="form-control" name="variants[<?php echo $i ;?>][quantity]" >
                            </div>
                            </td>
                            <td>
                            <div class="form-group">
                                <input type="text" class="form-control" name="variants[<?php echo $i ;?>][value]" >
                            </div>
                            </td>
                            <td>
                            <div class="form-group input-group">
                                <input type="text" name="variants[<?php echo $i ;?>][per_usg_val]" class="form-control">
                                <span class="input-group-addon">%</span>
                            </div>
                                
                            <input type="hidden" value="FOC" name="variants[<?php echo $i ;?>][type]" >
                            <input type="hidden" value="<?php echo $insid; ?>" name="variants[<?php echo $i ;?>][ins_id]" >
                            <input type="hidden" value="<?php echo $list->inscid; ?>" name="variants[<?php echo $i ;?>][cen_id]" >
                            <input type="hidden" value="<?php echo $list->insuid; ?>" name="variants[<?php echo $i ;?>][u_id]" >
                            </td>
                        </tr>
                            <?php } ?>
      
                        </tbody>
                    </table>
                </div>
            </div>
                            <hr/>
                            
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Paper Condiments:</h3>
                </div>
				<div class="searchbox form-group" id="importbox">
					<?php echo form_open('home/import/',array('enctype'=>'multipart/form-data'),'id="form-1"'); ?>
						<p>Upload Excel file ( .xls only )</p>
						<input type="hidden" name="size" value="3500000">
						<input type="file" name="xlsfile" id="fvl8">
						<div style="clear:both;"></div>
						<div class="show_loader_fvl8" style="display:none;">
							<img src="<?php echo str_replace('index.php/','',base_url());?>uploads/images/loading.gif"/>
						</div>
						<button type="button" name="Import" value="FPC" id="FVL_import8">Import</button>
						<a href="<?php echo str_replace('index.php/','',base_url());?>xls/sample/FLV_Variance_sample.xls" target="new">Click here </a>to download sample file to know file format.
					<?php echo form_close();?>
					<br> 
				</div>
                <div class="panel-body">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th class="col-md-3">Raw Matl</th>
                            <th class="col-md-3">Qty</th>
                            <th class="col-md-3">Value</th>
                            <th class="col-md-3">% Usg Val</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php 
             
for($i =45; $i< 55; $i++){
    ?>
                        <tr>
                            <td>
                                <div class="form-group">
                        <select class="selectpicker" name="variants[<?php echo $i ;?>][raw_malt]" data-live-search="true">
                             <option value="">Select </option>
                            <?php 

            foreach($dropdown as $row)
            { 
              echo '<option value="'.$row->qid.'">'.$row->question.'</option>';
            }
            ?>
      </select>
                </div>
                            </td>
                            <td>
                            <div class="form-group">
                                <input type="text" class="form-control" name="variants[<?php echo $i ;?>][quantity]" >
                            </div>
                            </td>
                            <td>
                            <div class="form-group">
                                <input type="text" class="form-control" name="variants[<?php echo $i ;?>][value]" >
                            </div>
                            </td>
                            <td>
                            <div class="form-group input-group">
                                <input type="text" name="variants[<?php echo $i ;?>][per_usg_val]" class="form-control">
                                <span class="input-group-addon">%</span>
                            </div>
                                
                            <input type="hidden" value="FPC" name="variants[<?php echo $i ;?>][type]" >
                            <input type="hidden" value="<?php echo $insid; ?>" name="variants[<?php echo $i ;?>][ins_id]" >
                            <input type="hidden" value="<?php echo $list->inscid; ?>" name="variants[<?php echo $i ;?>][cen_id]" >
                            <input type="hidden" value="<?php echo $list->insuid; ?>" name="variants[<?php echo $i ;?>][u_id]" >
                            </td>
                        </tr>
                            <?php } ?>
      
                        </tbody>
                    </table>
					
                </div>
            </div>
        </div>
	</form>
</div>
<script>
//$(document).on('click','#f_submit',function(){
	$('form#feedInput').submit(function(e) {
    var form = $(this);

    e.preventDefault();

		$.ajax({
			type: "POST",
			url: "<?php echo site_url('home/submit_var'); ?>",
			data: $('form#feedInput').serialize(), // <--- THIS IS THE CHANGE
			dataType: "html",
			success: function(data){
				alert(data);
				//form.hide();
				$('#feed-container').show();
				$('#feed-container').prepend("Form submited successfully");
			},
			error: function() { alert("Error posting feed."); }
	   });

	});
//});

function file_import(val,fname,id_name){
	$('.show_loader_'+id_name).show();
	var formData = new FormData();
	formData.append('xlsfile', $('input[type=file][id='+id_name+']')[0].files[0]);
	$.ajax({
		type: "POST",
		url: "<?php echo site_url('home/import/'.$insid.'/'.$list->inscid.'/'.$list->insuid);?>"+"/"+val,
		data : formData,
		processData: false,
		contentType: false,
		success: function(msg){
			$('.show_loader_'+id_name).hide();
			alert(msg);
		}
	});
}

$(document).on('click','#FVL_import1',function(){
	var value = $(this).val();
	var file_name = $("#fvl1").val();
	
	var id_name = $("#fvl1").attr('id');
		
	if(file_name == ""){
		alert("please select a excel sheet");
		return false;
	}else{
		file_import(value,file_name,id_name);
	}
});
$(document).on('click','#FVL_import2',function(){
	var value = $(this).val();
	var file_name = $("#fvl2").val();
	
	var id_name = $("#fvl2").attr('id');
		
	if(file_name == ""){
		alert("please select a excel sheet");
		return false;
	}else{
		file_import(value,file_name,id_name);
	}
});
$(document).on('click','#FVL_import3',function(){
	var value = $(this).val();
	var file_name = $("#fvl3").val();
	
	var id_name = $("#fvl3").attr('id');
		
	if(file_name == ""){
		alert("please select a excel sheet");
		return false;
	}else{
		file_import(value,file_name,id_name);
	}
});
$(document).on('click','#FVL_import4',function(){
	var value = $(this).val();
	var file_name = $("#fvl4").val();
	
	var id_name = $("#fvl4").attr('id');
		
	if(file_name == ""){
		alert("please select a excel sheet");
		return false;
	}else{
		file_import(value,file_name,id_name);
	}
});
$(document).on('click','#FVL_import5',function(){
	var value = $(this).val();
	var file_name = $("#fvl5").val();
	
	var id_name = $("#fvl5").attr('id');
		
	if(file_name == ""){
		alert("please select a excel sheet");
		return false;
	}else{
		file_import(value,file_name,id_name);
	}
});
$(document).on('click','#FVL_import6',function(){
	var value = $(this).val();
	var file_name = $("#fvl6").val();
	
	var id_name = $("#fvl6").attr('id');
		
	if(file_name == ""){
		alert("please select a excel sheet");
		return false;
	}else{
		file_import(value,file_name,id_name);
	}
});
$(document).on('click','#FVL_import7',function(){
	var value = $(this).val();
	var file_name = $("#fvl7").val();
	
	var id_name = $("#fvl7").attr('id');
		
	if(file_name == ""){
		alert("please select a excel sheet");
		return false;
	}else{
		file_import(value,file_name,id_name);
	}
});
$(document).on('click','#FVL_import8',function(){
	var value = $(this).val();
	var file_name = $("#fvl8").val();
	
	var id_name = $("#fvl8").attr('id');
		
	if(file_name == ""){
		alert("please select a excel sheet");
		return false;
	}else{
		file_import(value,file_name,id_name);
	}
});
</script>

<?php $this->load->view('vwFooter');?>