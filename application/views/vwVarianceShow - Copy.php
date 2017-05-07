<?php
$this->load->view('vwHeaderC');
?>

<div class="row">
                    <div class="col-lg-12">
                        <h1>Variance Report</h1>
                        <p></p>
            
                        
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
foreach($list as $k => $row){
    if($row["type"] =="FVL"){
    ?>
                        <tr>
                            <td>
                           
              <?php echo $row["question"]; ?>
           
               
                            </td>
                            <td>
                           <?php echo $row["quantity"]; ?>
                            </td>
                            <td>
                            <?php echo $row["value"]; ?>
                            </td>
                            <td>
                                <?php echo $row["per_usg_val"]; ?>
                            </td>
                        </tr>
                            <?php 
    }
    } ?>
      
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
foreach($list as $k => $row){
    if($row["type"] =="FVG"){
    ?>
                        <tr>
                            <td>
                           
              <?php echo $row["question"]; ?>
           
               
                            </td>
                            <td>
                           <?php echo $row["quantity"]; ?>
                            </td>
                            <td>
                            <?php echo $row["value"]; ?>
                            </td>
                            <td>
                                <?php echo $row["per_usg_val"]; ?>
                            </td>
                        </tr>
                            <?php 
    }
    } ?>
      
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
foreach($list as $k => $row){
    if($row["type"] =="FYL"){
    ?>
                        <tr>
                            <td>
                           
              <?php echo $row["question"]; ?>
           
               
                            </td>
                            <td>
                           <?php echo $row["quantity"]; ?>
                            </td>
                            <td>
                            <?php echo $row["value"]; ?>
                            </td>
                            <td>
                                <?php echo $row["per_usg_val"]; ?>
                            </td>
                        </tr>
                            <?php 
    }
    } ?>
      
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
foreach($list as $k => $row){
    if($row["type"] =="FYG"){
    ?>
                        <tr>
                            <td>
                           
              <?php echo $row["question"]; ?>
           
               
                            </td>
                            <td>
                           <?php echo $row["quantity"]; ?>
                            </td>
                            <td>
                            <?php echo $row["value"]; ?>
                            </td>
                            <td>
                                <?php echo $row["per_usg_val"]; ?>
                            </td>
                        </tr>
                            <?php 
    }
    } ?>
      
                        </tbody>
                    </table>
                </div>
            </div>
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
foreach($list as $k => $row){
    if($row["type"] =="PVL"){
    ?>
                        <tr>
                            <td>
                           
              <?php echo $row["question"]; ?>
           
               
                            </td>
                            <td>
                           <?php echo $row["quantity"]; ?>
                            </td>
                            <td>
                            <?php echo $row["value"]; ?>
                            </td>
                            <td>
                                <?php echo $row["per_usg_val"]; ?>
                            </td>
                        </tr>
                            <?php 
    }
    } ?>
      
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
foreach($list as $k => $row){
    if($row["type"] =="PVG"){
    ?>
                        <tr>
                            <td>
                           
              <?php echo $row["question"]; ?>
           
               
                            </td>
                            <td>
                           <?php echo $row["quantity"]; ?>
                            </td>
                            <td>
                            <?php echo $row["value"]; ?>
                            </td>
                            <td>
                                <?php echo $row["per_usg_val"]; ?>
                            </td>
                        </tr>
                            <?php 
    }
    } ?>
      
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
foreach($list as $k => $row){
    if($row["type"] =="FOC"){
    ?>
                        <tr>
                            <td>
                           
              <?php echo $row["question"]; ?>
           
               
                            </td>
                            <td>
                           <?php echo $row["quantity"]; ?>
                            </td>
                            <td>
                            <?php echo $row["value"]; ?>
                            </td>
                            <td>
                                <?php echo $row["per_usg_val"]; ?>
                            </td>
                        </tr>
                            <?php 
    }
    } ?>
      
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
foreach($list as $k => $row){
    if($row["type"] =="FPC"){
    ?>
                        <tr>
                            <td>
                           
              <?php echo $row["question"]; ?>
           
               
                            </td>
                            <td>
                           <?php echo $row["quantity"]; ?>
                            </td>
                            <td>
                            <?php echo $row["value"]; ?>
                            </td>
                            <td>
                                <?php echo $row["per_usg_val"]; ?>
                            </td>
                        </tr>
                            <?php 
    }
    } ?>
      
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        </form>
</div>

<?php
$this->load->view('vwFooter');
?>