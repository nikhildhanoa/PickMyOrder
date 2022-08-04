<?php error_reporting(0); 

?>
<div class="container">
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">Stripe Connect</a></li> 		
  </ul>
 <div class="tab-content">
    <div id="home" class="tab-pane  active background">
	<div><h3><?php if(isset($error)){ echo $error; } ?></h3></div>
	<?php
	
     if($preconnect) 
	 {
		?>
		 <form method="post" action="StripeConnect">
		 <input type="submit" name="Disconnect" value="Disconnect" class="btn btn-success">
		 </form> <?php
	 }
	elseif(!$button){ ?><a  class="btn btn-info" href="https://connect.stripe.com/oauth/authorize?response_type=code&client_id=ca_CeN8YB7i7WnAOhR6dYK7dcqIUeadYh3I&scope=read_write">Connect</a> <?php }else{ echo "This is a dedicated account please chage it first to connect.";} ?>
	
         
	</div>
    </div>

  </div>

