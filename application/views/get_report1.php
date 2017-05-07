<div class="row" style="font-size:12px;font-family:arial; width: 600px;">
          <div class="col-lg-12">
              <strong>Name of Auditor:</strong> <?php echo $list->first_name .' '. $list->last_name; ?>
              <hr/>
                <strong>Name &amp; Address of Client:</strong> <?php echo '<br/>'.$list->firstname.'<br/>'.$list->vchaddress.'<br/>'.$list->city ;  ?>
              <hr/>
                <strong>Name &amp; Address of Client's office:</strong> <?php echo $list->center_name; ?><?php echo '<br/>'.$list->center_address_one.'<br/>'.$list->center_address_city.'<br/>'.$list->center_address_state;  ?>
              <hr/>
                <strong>Date of the Inspection:</strong> <?php echo $list->date; ?>
              <hr/>
            </div>
           
        
      </div>
<table class="table table-hover tablesorter" style="font-size:10px;font-family:arial;">
                <thead>
                  <tr>
                    <th class="header" th width="180px;">Question</th>
                    <th class="header" width="180px;">Remark</th>
                    <th class="header" width="180px;">Suggession</th>
                    
                  </tr>
                </thead>
                <tbody>
                    
                    <?php foreach($ques as $k => $val) { ?>
                    <tr>
                        <td>
                           <?php echo $ques[$k]['question']; ?> 
                            
                        </td>
                        
                        <td>
                            <?php echo explode("~",$list-> remark)[$k]; ?>
                        </td>
                        <td>
                         <?php echo explode("~",$list-> suggestion)[$k]; ?>
                        </td>
                        
                    </tr>
                    <?php } ?>
                </tbody>
</table>

