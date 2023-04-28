<!DOCTYPE html>
<!--[if IE 8]>    <html class="no-js ie8 ie" lang="en"> <![endif]-->
<!--[if IE 9]>    <html class="no-js ie9 ie" lang="en"> <![endif]-->
<!--[if gt IE 9]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>
	<?php require_once('head.php'); ?>
</head>

<body class="fixed-layout">
	<div class="container">
		<div class="sidebar">
			<?php include_once('sidebar.php');?>
		</div>
		<div class="content-block" role="main">
			<ul class="breadcrumb">
				<li><a href="index.php"><span class="awe-home"></span></a><span class="divider"></span>
				</li>
				<li><a href="index.php">Admin Panel</a><span class="divider"></span>
				</li>
				<li class="active">Setting</li>
			</ul>
			<div class="row-fluid">
				<?php ?>
				<?php if(isset($_SESSION['type']) && $_SESSION['type'] == 'master-admin'){ /*?>
				
				<article class="span6 data-block nested">
					<div class="data-container">
						<?php
						$masteradmin = $obj_fun->getUser( 'master-admin' );
						$folder = '../uploads/logo/';
						if ( !file_exists( $folder ) ) {
							@mkdir( $folder, 0777, true );
						}

						?>
						<header>
							<h2>Edit Master Admin </h2>
							<br>
							<br>
							<hr>
						</header>
						<section class="tab-content">
							<div class="tab-pane active" id="newUser">
								<?php
								if ( isset( $_POST[ 'master_submit' ] ) ) {
									$homelogo_path = $_POST[ 'file_homelogo' ];
									$icon_path = $_POST[ 'file_icon' ];
									$favicon_path = $_POST[ 'file_favicon' ];

									$removeimg = $masteradmin[ 'homelogo' ];
									if ( $_FILES[ 'homelogo' ][ 'name' ] != '' ) {

										$removeimg = str_replace( $folder, "", $removeimg );
										$removeimg = $folder . $removeimg;
										unlink( $removeimg );
										$homelogo = $_FILES[ 'homelogo' ][ 'name' ];
										$homelogo = $folder . rand( 1111, 9999 ) . "_" . $homelogo;
										move_uploaded_file( $_FILES[ 'homelogo' ][ 'tmp_name' ], $homelogo );
										$hpath = $homelogo;
									} else {
										$hpath = $homelogo_path;
									}

									$iremoveimg = $masteradmin[ 'icon' ];

									if ( $_FILES[ 'icon' ][ 'name' ] != '' ) {
										$iremoveimg = str_replace( $folder, "", $iremoveimg );
										$iremoveimg = $folder . $iremoveimg;
										unlink( $iremoveimg );
										$icon = $_FILES[ 'icon' ][ 'name' ];
										$icon = $folder . rand( 1111, 9999 ) . "_" . $icon;
										move_uploaded_file( $_FILES[ 'homelogo' ][ 'tmp_name' ], $icon );
										$ipath = $icon;
									} else {
										$ipath = $icon_path;
									}

									$fremoveimg = $masteradmin[ 'favicon' ];

									if ( $_FILES[ 'favicon' ][ 'name' ] != '' ) {
										$fremoveimg = str_replace( $folder, "", $fremoveimg );
										$fremoveimg = $folder . $fremoveimg;
										unlink( $fremoveimg );
										$favicon = $_FILES[ 'favicon' ][ 'name' ];
										$favicon = $folder . rand( 1111, 9999 ) . "_" . $favicon;
										move_uploaded_file( $_FILES[ 'favicon' ][ 'tmp_name' ], $favicon );
										$fpath = $favicon;
									} else {
										$fpath = $favicon_path;
									}

									$r = $obj_fun->updateAdmin( $_POST[ "m_name" ], $_POST[ "m_email" ], $_POST[ "m_pass" ], $_POST[ "m_id" ], $hpath, $ipath, $fpath );
									if ( $r > 0 ) {

										move_uploaded_file( $_FILES[ 'icon' ][ 'tmp_name' ], $icon );
										move_uploaded_file( $_FILES[ 'favicon' ][ 'tmp_name' ], $favicon );
										echo "<script>window.location.href = 'setting.php'</script>";
									}
								}
								?>
								<form class="form-horizontal" method="post" onSubmit="return masterchkForm();" enctype="multipart/form-data">
									<div class="control-group">
										<label class="control-label" for="input">User name</label>
										<div class="controls">
											<input id="m_id" name="m_id" class="input-xxlarge" type="hidden" value="<?php echo $masteradmin['id']; ?>"/>
											<input id="m_name" name="m_name" class="input-xlarge" type="text" value="<?php echo $masteradmin['username']; ?>"/>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label" for="input">E-mail</label>
										<div class="controls">
											<input id="m_email" name="m_email" class="input-xlarge" type="email" value="<?php echo $masteradmin['email']; ?>"/>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label" for="input">Change Password</label>
										<div class="controls">
											<input id="m_pass" name="m_pass" class="input-xlarge" type="password" value="" placeholder="######"/>

										</div>
									</div>
									<div class="control-group">
										<label class="control-label" for="input">Change Logo </label>
										<div class="controls">
											<div data-provides="fileupload" class="fileupload fileupload-new">
												<div class="input-append">
													<div class="uneditable-input"><i class="icon-file fileupload-exists"></i> <span class="fileupload-preview"></span>
													</div>
													<span class="btn btn-alt btn-file"><span class="fileupload-new">Select Image</span><span class="fileupload-exists">Change</span>
													<input type="file" name="homelogo" id="homelogo">
													</span>
												</div>
											</div>
										</div>
										<img src="<?php echo $masteradmin['homelogo']; ?>" style="width:50px;height:50px;float:right">
										<br/><br/>
										<div style="margin-left:185px;">Upload Logo Image in 1000 x 750 px size</div>
										<input type="hidden" name="file_homelogo" value="<?php echo $masteradmin['homelogo']; ?>">
									</div>
									<div class="control-group">
										<label class="control-label" for="input">Change Icon</label>
										<div class="controls">
											<div data-provides="fileupload" class="fileupload fileupload-new">
												<div class="input-append">
													<div class="uneditable-input"><i class="icon-file fileupload-exists"></i> <span class="fileupload-preview"></span>
													</div>
													<span class="btn btn-alt btn-file"><span class="fileupload-new">Select Image</span><span class="fileupload-exists">Change</span>
													<input type="file" name="icon" id="icon">
													</span>
												</div>
											</div>
										</div>
										<img src="<?php echo $masteradmin['icon']; ?>" style="width:50px;height:50px;float:right">
										<br/><br/>
										<div style="margin-left:185px;">Upload Icon Image in 200 x 200 px size</div>
										<input type="hidden" name="file_icon" value="<?php echo $masteradmin['icon']; ?>">
									</div>
									<div class="control-group">
										<label class="control-label" for="input">Change Favicon</label>
										<div class="controls">
											<div data-provides="fileupload" class="fileupload fileupload-new">
												<div class="input-append">
													<div class="uneditable-input"><i class="icon-file fileupload-exists"></i> <span class="fileupload-preview"></span>
													</div>
													<span class="btn btn-alt btn-file"><span class="fileupload-new">Select Image</span><span class="fileupload-exists">Change</span>
													<input type="file" name="favicon" id="favicon"><br/>
													</span>
												</div>
											</div>
										</div>
										<img src="<?php echo $masteradmin['favicon']; ?>" style="width:50px;height:50px;float:right">
										<br/><br/>
										<div style="margin-left:185px;">Upload Favicon Image in 48 x 48 px size</div>
										<input type="hidden" name="file_favicon" value="<?php echo $masteradmin['favicon']; ?>"><br/><br/>

									</div>

									<div class="form-actions">
										<input name="master_submit" class="btn btn-alt btn-large btn-primary" type="submit" value="Update"/>
									</div>
								</form>
							</div>
						</section>
					</div>
				</article>
				<article class="span6 data-block nested">
					<div class="data-container">
						<?php
							$useradmin = $obj_fun->getUser( 'admin' );
						?>
						<header>
							<h2>Edit User Admin </h2><br><br><hr>
						</header>
						<section class="tab-content">
							<div class="tab-pane active" id="newUser">
								<?php
								if ( isset( $_POST[ 'user_submit' ] ) ) {
									$r = $obj_fun->updateAdmin( $_POST[ "u_name" ], $_POST[ "u_email" ], $_POST[ "u_pass" ], $_POST[ "u_id" ] );
									if ( $r > 0 )
										echo "<script>window.location.href = 'setting.php'</script>";
							
								}
								?>
								<form class="form-horizontal" method="post" onSubmit="return userchkForm();">
									<div class="control-group">
										<label class="control-label" for="input">User name</label>
										<div class="controls">
											<input id="u_id" name="u_id" class="input-xxlarge" type="hidden" value="<?php echo $useradmin['id']; ?>"/>
											<input id="name" name="name" class="input-xlarge" type="text" value="<?php echo $useradmin['username']; ?>"/>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label" for="input">E-mail</label>
										<div class="controls">
											<input id="email" name="email" class="input-xlarge" type="email" value="<?php echo $useradmin['email']; ?>"/>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label" for="input">Change Password</span></label>
										<div class="controls">
											<input id="pass" name="pass" class="input-xlarge" type="password" value="<?php echo base64_decode($useradmin['password']); ?>" placeholder="######"/>
											<button type="button" class="btn awe-eye-open" id="hide_show_id" onClick="hide_show()"></button>
										</div>
									</div>
									<div class="form-actions">
										<input name="user_submit" class="btn btn-alt btn-large btn-primary" type="submit" value="Update"/>
									</div>
								</form> 
							</div>
						</section>
					</div> 
				</article>
				<script>
					function hide_show() {
						if ( $( '#hide_show_id' ).attr( 'class' ) == 'btn awe-eye-open' ) {
							$( '#u_pass' ).prop( 'type', 'text' );
							$( '#hide_show_id' ).removeClass( 'awe-eye-open' ).addClass( 'awe-eye-close' );
						} else {
							$( '#u_pass' ).prop( 'type', 'password' );
							$( '#hide_show_id' ).removeClass( 'awe-eye-close' ).addClass( 'awe-eye-open' );
						}
					}

					function masterchkForm() {
						var valid = true;
						if ( document.getElementById( 'm_name' ).value.replace( /^\s+/, '' ) == '' ) {
							document.getElementById( 'm_name' ).style.border = "solid 1px #DD0000";
							document.getElementById( 'm_name' ).style.borderRadius = "4px";
							document.getElementById( 'm_name' ).style.boxShadow = "0px 0px 10px #BB0000";
							//danger('Please fill the name field.');
							valid = false;
						}

						if ( document.getElementById( 'm_pass' ).value.replace( /^\s+/, '' ) == '' ) {
							document.getElementById( 'm_pass' ).style.border = "solid 1px #DD0000";
							document.getElementById( 'm_pass' ).style.borderRadius = "4px";
							document.getElementById( 'm_pass' ).style.boxShadow = "0px 0px 10px #BB0000";
							//danger('Please fill the password field.');
							valid = false;
						}
						if ( document.getElementById( 'm_email' ).value.replace( /^\s+/, '' ) == '' ) {
							document.getElementById( 'm_email' ).style.border = "solid 1px #DD0000";
							document.getElementById( 'm_email' ).style.borderRadius = "4px";
							document.getElementById( 'm_email' ).style.boxShadow = "0px 0px 10px #BB0000";
							//	danger('Please fill the Email field.');
							valid = false;
						}

						return valid;
					}

					function userchkForm() {

						var valid = true;
						if ( document.getElementById( 'u_name' ).value.replace( /^\s+/, '' ) == '' ) {
							document.getElementById( 'u_name' ).style.border = "solid 1px #DD0000";
							document.getElementById( 'u_name' ).style.borderRadius = "4px";
							document.getElementById( 'u_name' ).style.boxShadow = "0px 0px 10px #BB0000";
							//danger('Please fill the name field.');
							valid = false;
						}

						if ( document.getElementById( 'u_pass' ).value.replace( /^\s+/, '' ) == '' ) {
							document.getElementById( 'u_pass' ).style.border = "solid 1px #DD0000";
							document.getElementById( 'u_pass' ).style.borderRadius = "4px";
							document.getElementById( 'u_pass' ).style.boxShadow = "0px 0px 10px #BB0000";
							//danger('Please fill the password field.');
							valid = false;
						}
						if ( document.getElementById( 'u_email' ).value.replace( /^\s+/, '' ) == '' ) {
							document.getElementById( 'u_email' ).style.border = "solid 1px #DD0000";
							document.getElementById( 'u_email' ).style.borderRadius = "4px";
							document.getElementById( 'u_email' ).style.boxShadow = "0px 0px 10px #BB0000";
							//danger('Please fill the Email field.');
							valid = false;
						}

						return valid;
					}
				</script> 
				*/ ?>		
				<?php } else { ?>
			
				<article class="span12 data-block nested">
					<div class="data-container">
						<header>
							<h2>Edit Username & Password</h2><br><br><hr>
						</header>
						<section class="tab-content">
							<div class="tab-pane active" id="newUser">
								<?php
								if ( isset( $_POST[ 'submit' ] ) ) {
									include "update_api.php"; 
									/*$mobile = $_POST[ 'data' ];
									$r = $obj_fun->updateAdmin( $_POST[ "name" ], $_POST[ "email" ], $_POST[ "pass" ], $_POST[ "id" ] );
									if ( $r > 0 ) {
										global $con;
										$sql = "UPDATE `settings` SET `data` = '" . $mobile . "' WHERE `settings`.`id` = 15";
										$res = mysqli_query( $con, $sql );
										echo "<script>window.location.href = 'setting.php'</script>";
									}*/
									echo "<script>window.location.href = 'setting.php'</script>";
								}
								?>
								<form class="form-horizontal" method="post" onSubmit="return chkForm();">
									<div class="control-group">
										<label class="control-label" for="input">User name</label>
										<div class="controls">
											<input id="id" name="id" class="input-xxlarge" type="hidden" value="<?php echo $admin['id']; ?>"/>
											<input id="name" name="name" class="input-xlarge" type="text" value="<?php echo $admin['username']; ?>"/>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label" for="input">E-mail</label>
										<div class="controls">
											<input id="email" name="email" class="input-xlarge" type="email" value="<?php echo $admin['email']; ?>"/>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label" for="input">Change Password</label>
										<div class="controls">
											<input id="pass" name="pass" class="input-xlarge" type="password" value="" placeholder="######"/>
										</div>
									</div>

									<div class="control-group">
										<label class="control-label" for="input">Change Mobile No</label>
										<div class="controls">
											<input id="pass" name="data" class="input-xlarge" type="text" value="<?php echo sms_mobileno; ?>"/>
										</div>
									</div>

									<div class="form-actions">
										<input name="submit" class="btn btn-alt btn-large btn-primary" type="submit" value="Update"/>
									</div>
								</form>
							</div>
						</section>
					</div>
				</article>
				<?php }?>
			</div>
			<?php if(isset($_SESSION['type']) && $_SESSION['type'] =='master-admin'){?>
			<!--For User Change Socail Link Only For Master Admin-->
			<div class="row-fluid">
				<article class="span6 data-block nested">
					<div class="data-container">
						<header>
							<h2>Social Links</h2>
							<br>
							<br>
							<hr>
						</header>
						<section class="tab-content">
							<div class="tab-pane active" id="newUser">
								<?php
								if ( isset( $_POST[ 'submit_social' ] ) ) {
									unset( $_POST[ 'submit_social' ] );
									$ress = $obj_fun->add_MetaData( 'social', $_POST );
									if ( $ress > 0 )
										echo "<script>window.location.href = 'setting.php'</script>";
								}
								?>
								<form class="form-horizontal" method="post" action="#" onSubmit="">
									<?php 
											$socail = str_replace(" ", "_", "facebook,twitter,instagram,linkedin,pinterest,whatsapp,email");
											$social_arr = explode(",", $socail);
											foreach($social_arr as $name){?>
									<div class="control-group">
										<label class="control-label" for="input">
											<?php echo ucwords(str_replace("_", " ", $name)); ?>
										</label>
										<div class="controls">
											<input id="<?php echo $name;?>" name="<?php echo $name;?>" class="input-xlarge" type="text" value="<?php echo $obj_fun->getMetaData($name); ?>"/>
										</div>
									</div>
									<?php }?>
									<div class="form-actions">
										<input name="submit_social" class="btn btn-alt btn-large btn-primary" type="submit" value="Update"/>
									</div>
								</form>
							</div>
						</section>
					</div>
				</article>
				<article class="span6 data-block nested">
					<div class="data-container">
						<header>
							<h2>SMS Gateway</h2>
							<br>
							<br>
							<hr>
						</header>
						<section class="tab-content">
							<div class="tab-pane active" id="newUser">
								<?php
								if ( isset( $_POST[ 'submit_sms' ] ) ) {
									unset( $_POST[ 'submit_sms' ] );

									$resss = $obj_fun->add_MetaData( 'sms', $_POST );
									if ( $resss > 0 )
										echo "<script>window.location.href = 'setting.php'</script>";
								}
								?>
								<form class="form-horizontal" method="post" action="#" onSubmit="">
									<div class="control-group">
										<label class="control-label" for="input">SMS Status</label>
										<div class="controls" style="margin-top: 8px;">
											<label class="radio" style="float: left; padding: 0px 40px 0px 20px;">
                          <input type="radio" value="1" id="yes" name="sms_statue" <?php echo ($obj_fun->getMetaData('sms_statue') == 1 ? 'checked="checked"' : ''); ?> >
                          Enable </label>
										
											<label class="radio">
                          <input type="radio" value="0" id="no" name="sms_statue" <?php echo ($obj_fun->getMetaData('sms_statue') == 0 ? 'checked="checked"' : ''); ?>  />
                          Disabled </label>
										
										</div>
									</div>
							
										<div class="control-group">
										<label class="control-label" for="input">SMS Replay</label>
										<div class="controls" style="margin-top: 8px;">
											<label class="radio" style="float: left; padding: 0px 40px 0px 20px;">
                     <input type="radio" value="1" id="yes" name="sms_replay" <?php echo ($obj_fun->getMetaData('sms_replay') == 1 ? 'checked="checked"' : ''); ?> >
                          Enable </label>
										
											<label class="radio">
                          <input type="radio" value="0" id="no" name="sms_replay" <?php echo ($obj_fun->getMetaData('sms_replay') == 0 ? 'checked="checked"' : ''); ?>  />
                          Disabled </label>
										
										</div>
									</div>
									
									<div class="control-group">
										<label class="control-label" for="input">SMS Mobile</label>
										<div class="controls">
											<input id="sms_mobileno" name="sms_mobileno" class="input-xlarge" type="text" value="<?php echo $obj_fun->getMetaData('sms_mobileno'); ?>"/>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label" for="input">SMS Replay Msg.</label>
										<div class="controls">
											<textarea name="smsmsg" cols="4" rows="6" class="input-xlarge" id="smsmsg" spellcheck="true"><?php echo $obj_fun->getMetaData('smsmsg'); ?></textarea>
											
										</div>
									</div>
									
									<div class="form-actions" style="clear: both">
										<input name="submit_sms" class="btn btn-alt btn-large btn-primary" type="submit" value="Update">
									</div>
								</form>
							</div>
						</section>


					</div>
				</article>
			</div>

			<!--For User Change Settings Only For Master Admin-->
			<div class="row-fluid">
				<article class="span12 data-block nested">
					<div class="data-container">
						<header>
							<h2>Admin Panel Setting</h2>
							<br>
							<br>
							<hr>
						</header>
						<section class="tab-content">
							<div class="tab-pane active" id="newUser">
								<?php
								if ( isset( $_POST[ 'submit_setting' ] ) ) {
									unset( $_POST[ 'submit_setting' ] );

									$resss = $obj_fun->add_MetaData( 'settings', $_POST );
									if ( $resss > 0 )
										echo "<script>window.location.href = 'setting.php'</script>";
								}
								?>
								<form class="form-horizontal" method="post" action="#" onSubmit="">
									<div class="control-group span6">
										<label class="control-label" for="input">Company Name</label>
										<div class="controls">
											<input id="sms_mobileno" name="company" class="input-xlarge" type="text" value="<?php echo $obj_fun->getMetaData('company'); ?>"/>
										</div>
									</div>
									<div class="control-group span6">
										<label class="control-label" for="input">Web Site Title</label>
										<div class="controls">
											<input id="sms_mobileno" name="title" class="input-xlarge" type="text" value="<?php echo $obj_fun->getMetaData('title'); ?>"/>
										</div>
									</div>
									<div class="control-group span6">
										<label class="control-label" for="input">Web Site URL</label>
										<div class="controls">
											<input id="sms_mobileno" name="web_link" class="input-xlarge" type="text" value="<?php echo $obj_fun->getMetaData('web_link'); ?>"/>
										</div>
									</div>
									
									<div class="control-group span6">
										<label class="control-label" for="input">File Limit For Upload</label>
										<div class="controls">
											<input id="filelimitupload" name="filelimitupload" class="input-xlarge" type="text" value="<?php echo $obj_fun->getMetaData('filelimitupload'); ?>"/>
										</div>
									</div>
									<div class="control-group span6">
										<label class="control-label" for="input">Meta Keyword</label>
										<div class="controls">
											<textarea name="meta_key"  rows="6" class="input-xlarge" id="meta_key" spellcheck="true"><?php echo $obj_fun->getMetaData('meta_key'); ?></textarea>
										</div>
									</div>
									<div class="control-group span6">
										<label class="control-label" for="input">Meta Description</label>
										<div class="controls">
											<textarea name="meta_description"  rows="6" class="input-xlarge" id="meta_description" spellcheck="true"><?php echo $obj_fun->getMetaData('meta_description'); ?></textarea>
										</div>
									</div>
									<div class="control-group span6">
										<label class="control-label" for="input">Web Visitor Session Time Out</label>
										<div class="controls">
											<input id="stimeout" name="stimeout" class="input-xlarge" type="text" value="<?php echo $obj_fun->getMetaData('stimeout'); ?>"/>
										</div>
									</div>
									<div style="clear: both"></div>
									<div class="form-actions">
										<input name="submit_setting" class="btn btn-alt btn-large btn-primary" type="submit" value="Update">
									</div>
								</form>
							</div>
						</section>
					</div>
				</article>
			</div>

			<!--For User Change Pagination Limit Only For Master Admin-->
			<div class="row-fluid">
				<article class="span12 data-block nested">
					<div class="data-container">
						<header>
							<h2>Pagination Limit </h2>
							<br>
							<br>
							<hr>
						</header>
						<section class="tab-content page_limits">
							<div class="tab-pane active" id="newUser">
								<?php
								if ( isset( $_POST[ 'submit_paging' ] ) ) {
									unset( $_POST[ 'submit_paging' ] );
									$ress = $obj_fun->add_MetaData( 'paging', $_POST );
									if ( $ress > 0 )
										echo "<script>window.location.href = 'setting.php'</script>";
								}
								?>
								<form class="form-horizontal" method="post" action="#" onSubmit="">
									<?php 
										$socail = str_replace(" ", "_", "page_limit_for_search,page_limit_for_gallery,page_limit_for_product_direct_design,page_limit_for_product_series_with_no,page_limit_for_concept,page_limit_for_blog,page_limit_for_advertisement,page_limit_for_showroom,page_limit_for_product_design_series_or_series_with_description");
										$social_arr = explode(",", $socail);
										foreach($social_arr as $name){?>
									<div class="control-group span6">
										<label class="control-label" for="input">
											<?php echo ucwords(str_replace("_", " ", $name)); ?>
										</label>
										<div class="controls">
											<input id="<?php echo $name;?>" name="<?php echo $name;?>" class="input-xlarge" type="text" value="<?php echo $obj_fun->getMetaData($name); ?>"/>
										</div>
									</div>
									<?php }?>
									<div class="form-actions" style="clear: both;">
										<input name="submit_paging" class="btn btn-alt btn-large btn-primary" type="submit" value="Update"/>
									</div>
								</form>
							</div>
						</section>
					</div>
				</article>
			</div>

			

			<?php 
   			include "fun_all.php"; 	
		?>
			<?php }?>
		</div>
	</div>
	<div id="demoModal" class="modal fade hide modal-info" style="display: none;" aria-hidden="true">
		<div class="modal-header">
			<button data-dismiss="modal" class="close" type="button">×</button>
			<h3>LightBox Image Select Box</h3>
		</div>
		<form id="lightt" method="post" action="#">
			<div class="modal-body">
				<div class="">
					<div class="">
						<div id="uploader"></div>
					</div>
				</div>
			</div>
			<div class="modal-footer"> <a data-dismiss="modal" class="btn btn-alt" href="#">Close</a> <a class="btn btn-alt" href="#" id="setlight">Set Lightbox</a> </div>
		</form>
	</div>
	
	<?php include_once('script.php');?>
</body>

</html>
<style>
	.mrg-tp-8 {
		margin-top: 8px !important;
	}
	
	.radio1 {
		float: left !important;
		padding: 0px 40px 0px 20px !important;
	}
</style>
<script>
	$( document ).ready( function ( e ) {
		$( '#setlight' ).hide();

		<?php if(!isset($gallary[0]['thumb']) || $gallary[0]['thumb'] == ''){ ?>
		$( '#lightboxok' ).click( function () {
			$( '#demoModal' ).modal( 'show' );
		} );
		<?php	} ?>



		$( '#setlight' ).click( function () {
			var data = $( '#lightt' ).serializeArray();

			$.post( "custom-ajax.php", {
				action: 'setlightboximage',
				data: data
			}, function ( result ) {
				//console.log(result);
				if ( result )
					$( '#demoModal' ).modal( 'hide' );
				location.reload();
			} );
		} );
		
		$('#delete_lightbox').click(function(){
        	$.post("custom-ajax.php",{action:'delete_lightbox'},function(result){
            if(result)
            location.reload();
        });
    });
		
	} );
</script>
<script type="text/javascript">
	$( function () {
		$( "#uploader" ).plupload( {
			// General settings
			runtimes: 'html5,flash,silverlight,html4',
			url: 'plupload/upload.php?folder=../../uploads/lightboximage&tw=80&th=80',
			// User can upload no more then 20 files in one go (sets multiple_queues to false)
			max_file_count: 20,
			chunk_size: '1mb',
			unique_names: true,
			// Resize images on clientside if we can
			resize: {
				quality: 95,
				crop: false // crop to exact dimensions
			},
			filters: {
				// Maximum file size
				max_file_size: '3mb',
				// Specify what files to browse for
				mime_types: [ {
						title: "Image files",
						extensions: "jpg,jpeg"
					} //,
					/*{title : "Zip files", extensions : "zip"}*/
				]
			},
			// Rename files by clicking on their titles
			rename: false,
			// Sort files
			sortable: true,
			// Enable ability to drag'n'drop files onto the widget (currently only HTML5 supports that)
			dragdrop: true,
			// Views to activate
			views: {
				list: true,
				thumbs: true, // Show thumbs
				active: 'thumbs'
			},
			// Flash settings
			flash_swf_url: 'plupload/js/Moxie.swf',
			// Silverlight settings
			silverlight_xap_url: 'plupload/js/Moxie.xap',
			init: {
				UploadComplete: function ( up, files ) {
					// Called when all files are either uploaded or failed
					$( '#setlight' ).show();
				}
			}
		} );
		// Handle the case when form was submitted before uploading has finished
		$( '#form' ).submit( function ( e ) {
			// Files in queue upload them first
			if ( $( '#uploader' ).plupload( 'getFiles' ).length > 0 ) {

				// When all files are uploaded submit form
				$( '#uploader' ).on( 'complete', function () {
					$( '#form' )[ 0 ].submit();
				} );

				$( '#uploader' ).plupload( 'start' );
			} else {
				alert( "You must have at least one file in the queue." );
			}
			return false; // Keep the form from submitting
		} );
	} );
</script>