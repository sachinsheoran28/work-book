<?php
$this->load->view('vwHeader');
?>

<div class="row">
                    <div class="col-lg-12">
                        <h1>Update Variance</h1>
                        <p></p>
            
                    <?php print_r($list); ?>
                        
                    </div>
       
                    </div>
                </div>
<div class="row">
    <form id ="feedInput">
                    
                        <div class="col-md-6">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Top 10 Food Variance Loss</h3>
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
foreach($list["raw_malt"] as $k => $row){
    ?>
                        <tr>
                            <td>
                           
              <?php echo $row; ?>
           
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
                            <button type="submit" class="btn btn-warning">Submit Update</button>
        </div>
    
                    
                        <div class="col-md-6">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Top 5 Paper Variance Loss</h3>
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
    $(document).ready(function() {
$('form#feedInput').submit(function(e) {

    var form = $(this);

    e.preventDefault();

    $.ajax({
        type: "POST",
        url: "<?php echo site_url('home/submit_var'); ?>",
        data: form.serialize(), // <--- THIS IS THE CHANGE
        dataType: "html",
        success: function(data){
            form.hide();
            $('#feed-container').show();
            $('#feed-container').prepend("Form submited successfully");
            
        },
        error: function() { alert("Error posting feed."); }
   });

});
    });
    </script>

<?php
$this->load->view('vwFooter');
?>