<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
	
	
	<style>
	h1,h2,h3,h4,h5,h6{
	margin-bottom:0px;
	}
	body{
	background: #14499A;
	}
	.form_page_section .container{
	background:#fff;
	padding:20px 0;
	border-radius:10px;
	}
	   h3, .h3 {
         font-size: 1.5rem;
             }
			 
			 .form_page_section{
			 padding:20px 0;
			 }
			.card_form img{
			width:50%
			}
			.card_form_div{
			text-align:center}
			.form_div{
			padding:50px;
			}
			
			.blue_back{
			    background-color: #F3F6F9;
    border-color: #F3F6F9;
			}
			.form-group label
			{
			    font-size: 1rem;
    font-weight: 400;
    color: #3F4254;
}
			.input_background{
			    background: #e8f0fe;
				    border-color: #F3F6F9;
			}
			
			span{
			font-size:13px;}
			
			
			@media screen and (max-width:768px)
			{
			.form_page_section {
                  padding:0px;
}
	</style>

    <title>Pick My Order</title>
  </head>
  <body>
  
       <section class="form_page_section">
	          <div class="container">
			     
			        <div class="row">
					     
					     <div class="col-md-6 col-sm-12">
						        <div class="card_form">
									<div data-wizard-type="step-info" data-wizard-state="current" class="card_form_div">
															<h3 class=" mb-3">Setup Your Account</h3>
															<p class="font-size-lg text-dark-50">To start off, please enter your username, 
															<br>email address and password.</p>
															<img src="	https://app.pickmyorder.co.uk/images/applogo/orignalhand.png" alt="image" class="mt-10 h-300px">
														</div>
								</div>
						 </div>
					     <div class="col-md-6 col-sm-12">
						 <div class="form_div">
						      <form  method="post" action="<?php echo base_url('CreateUserForTrial');?>">
							  <h5 class="mb-4  text-dark">Create your Account </h5>
 
  <div class="form-group">
    <label for="inputAddress">First Name</label>
    <input type="text" class="form-control blue_back" name="fname" id="inputAddress" placeholder="First Name" required >
	<span class="form-text text-muted">Please enter your first name.</span>
  </div>
  
  
  <div class="form-group">
    <label for="last_name">Last Name</label>
    <input type="text" class="form-control blue_back" name="lname" id="last_name" placeholder="Last Name" required>
	<span class="form-text text-muted">Please enter your last name.</span>
  </div>
  

<div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Email</label>
      <input type="email" class="form-control input_background" name="email" id="inputEmail4" required>
	  <span class="form-text text-muted">Please enter your Email.</span>
    </div>
	<div style="color:red;font-weight: 600;"><?php echo $this->session->flashdata('error'); ?> </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Password</label>
      <input type="password" class="form-control input_background" name="password" id="inputPassword4" required>
	  <span class="form-text text-muted">Please enter your Password.</span>
    </div>
  </div>
  
  <button type="submit" name="AddGernelDetails" class="btn btn-primary" style="background-color:#14499A">Submit</button>
</form>
						 </div>
						 </div>
						 
					</div>
			  </div>
	   </section>
	   
    

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

  </body>
</html>