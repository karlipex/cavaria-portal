<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if($this->session->flashdata('ErrorMessage')!='') { ?>
<div class="content insert">
   <h2>Error</h2>
   <div><?php echo $this->session->flashdata('ErrorMessage'); ?></div>
</div>
<?php } else { ?>
<div class="content insert">
   <h2>Todo Perfecto.</h2>
   <div>Sin errores para mostrar.</div>
</div>
<?php } ?>