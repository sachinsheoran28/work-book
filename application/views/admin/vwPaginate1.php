<ul class="pagination pagination-sm" id="pagination">
            <li <?php if($limit == 0){ ?>class="disabled"<?php }?>><a href="<?php echo site_url('admin/'.$link.'/page/0'); ?>"><<</a></li>
            <?php  $j='';
              for($i=0; $i < ceil($count/$this->config->item('number_of_rows')); $i++){
                  $j = $i+1;
                  if($limit == $this->config->item('number_of_rows')*$i){
                  echo '<li class="active" id="'.$this->config->item('number_of_rows')*$i.'"><a href="'.site_url('admin/'.$link.'/page/'.$this->config->item('number_of_rows')*$i).'">'.$j.'</a></li>';
                  } else {
                      echo '<li id="'.$this->config->item('number_of_rows')*$i.'"><a href="'.site_url('admin/'.$link.'/page/'.$this->config->item('number_of_rows')*$i).'">'.$j.'</a></li>';
                  }
            ?>
            
            <?php 
              }
             if($limit == $this->config->item('number_of_rows')*($j-1)){
            ?>
            <li  class="disabled" ><a href="<?php echo site_url('admin/'.$link.'/page/'.$this->config->item('number_of_rows')*($j-1)); ?>">>></a></li>
          <?php 
             } else {
             ?>
          <li><a href="<?php echo site_url('admin/'.$link.'/page/'.$this->config->item('number_of_rows')*($j-1)); ?>">>></a></li>
          <?php } ?>
              </ul>
