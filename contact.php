<?php include('header.php'); ?>

<!-- start body -->
<body onunload="" >

	<!-- start dotted pattern -->
	<div class="bg-overlay"></div>
	<!-- end dotted pattern -->
	
	<!-- start navigation -->
	<?php include('menu.php'); ?>
	<!-- end navigation -->
	
	<!-- start content wrapper -->
	
	<div class="content page-content">
	
		<div class="page-title">
			<h1>Feedback</h1>
		</div>
		
		<div class="divider clear"></div>
		
		<div class="inner-content">	
			<?php
			$name = "";
			$email = "";
			$msg = "";
			if(isset($_POST['submit']))
			{
			$name = $_POST['name'];
			$msg = $_POST['message'];
			$email = $_POST['email'];
				$url = "https://www.google.com/recaptcha/api/siteverify?secret=6LcXYP8SAAAAAH7WUPMtiHoEiTnev6ofbzsuRY4U&response=".$_POST['g-recaptcha-response']."&remoteip=".$_SERVER['REMOTE_ADDR'];
			$text = file_get_contents($url);
		if(strpos($text,'true') && $name != "" && $email != "" && $msg != "")
		{
			echo 'Email has been sent. We will contact you back shortly';
			mail("capankajjain@smilyo.com","Jain Muni - Email From ".$email,$msg." - ".$name."(".$email.")");
		}
		else
		{
			echo 'Please check and fill the form again';
		}
			}
			?>
			<!-- start feedback form -->
			<form method="post" class="contactForm" id="contactForm" action="">
				<fieldset>
					<div>
						<label>Name*</label>
						<input type="text" value="<?php echo $name ?>" id="name" name="name" class="name validate[required,custom[onlyLetterNumber],maxSize[20]]">
					</div>
					
					<div>
						<label>Email*</label>
						<input type="text" value="<?php echo $email ?>" id="email" name="email" class="email  validate[required,custom[email]]">
					</div>
					
					<div>					
						<label>Message*</label><textarea id="mess" name="message" class="message validate[requied,length[6,3000]]"><?php echo $msg ?></textarea>
					</div>
					<div>
					<div class="g-recaptcha" data-sitekey="6LcXYP8SAAAAAM8199rOJV8yoCWS4mI5FHb5Q70Q"></div>
					</div><br />
					<p class="sent-result" style="display:none;">Your message sent successfully!</p>
					
					<div class="send-wrap">
						<input type="submit" name="submit" value="Send Email">
					</div>
				</fieldset>
				
				
			</form>					
			<!-- end feedback form -->	
	
		</div>
		
		<!-- start widgets -->		 
		<div class="sidebar">
			<div id="text-2" class="widget widget_text">
				<h3>Contact Us</h3>			
				<div class="textwidget">Contact us to give us suggestions, report any wrong information or any other thing. Please use the contact form and we will contact you back shortly.
					<br><br>
					<strong>
						Any address we would like to give<br />
						9818609955 <br />
						capankajjain@smilyo.com
					</strong>
				</div>
			</div>
			
		
		</div>
		<!-- end widgets -->
	</div>
	
	<!--  end content wrapper  -->
 	
<?php include('footer.php'); ?>
