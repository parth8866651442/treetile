<!DOCTYPE html>
<!--[if gt IE 9]><!-->
<html class="no-js" lang="en">
<?php header("X-XSS-Protection: 0"); ?>
<!--<![endif]-->
<?php ob_start(); ?>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php 
	require_once('head.php');
	$type = 'International';
	if($obj_fun->getMetaData('catalogue') == 0 and $_SESSION['type'] == 'admin')
		header('location:index.php'); 
		
?>
</head>

<body class="fixed-layout">
<div class="container">
  <div class="sidebar">
    <?php include_once('sidebar.php');?>
  </div>
  <div class="content-block" role="main">
    <ul class="breadcrumb">
      <li><a href="index.php"><span class="awe-home"></span></a><span class="divider"></span></li>
      <li><a href="index.php">Admin Panel</a><span class="divider"></span></li>
      <li class="active">Export Contact</li>
    </ul>
    <div class="row-fluid">
      <article class="span12 data-block nested">
        <div class="data-container">
          <header>
            <h2>Export Contact </h2>
            <br>
            <br>
            <hr>
          </header>
          <section class="tab-content">
            <div class="tab-pane active" id="newUser">
              <?php 
			   if(isset($_POST['submit']) && $_POST['submit'] == 'create'){ 
									$obj_fun->insertfrontcontact($_POST);
									echo '<script>success("Contact Detail insert successfully")</script>';
									echo "<script>urlRefresh('internationalcontact.php');</script>";
								}
				if(isset($_POST['submit']) && $_POST['submit'] == 'update' && isset($_GET['id']) && $_GET['id'] != ''){ 
				   // echo "<pre>";
				    //print_r($_POST);
				    //die;
				$psdata = $obj_fun->getfrontcontact($_GET['id']);
				$obj_fun->updatefrontcontact($_POST,$_GET['id']);
				echo '<script>success("Contact Detail Update successfully.")</script>';
				echo "<script>urlRefresh('internationalcontact.php');</script>";
				}
			  ?>
              <?php
			    if(isset($_GET['action']) && $_GET['action'] == 'update' && isset($_GET['id']) && $_GET['id'] != '')
				{
						$psdata = $obj_fun->getfrontcontact($_GET['id']);
				}
			
				
			  ?>
              <form id="myForm" class="form-horizontal" method="post" action="#">
              	<input type="hidden" name="type" value="<?php echo $type; ?>">
                <?php 
					if(isset($_GET['action']) && $_GET['action'] == 'update' && isset($_GET['id']) && $_GET['id'] != ''){ ?>
                <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                
                <?php }	?>
                <div class="control-group" >
                  <label for="fileInput" class="control-label">Address</label>
                  <div class="controls">
                  	
                    <textarea id="address" name="address" class="input-xxlarge" type="text" rows="6" /><?php echo (isset($psdata['address'])) ? $psdata['address'] : '';  ?></textarea>
                  </div>
                </div>
                
               
                                    
                <div class="control-group" >
                  <label for="fileInput" class="control-label">Mobile </label>
                  <div class="controls">
                    <input type="text" class="input-xxlarge" id="mobile" name="mobile" value="<?php echo (isset($psdata['mobile'])) ? $psdata['mobile'] : '';  ?>" >
                  </div>
                </div>
                
                                      
                <div class="control-group" >
                  <label for="fileInput" class="control-label">Email </label>
                  <div class="controls">
                    <input type="email" class="input-xxlarge" id="email" name="email" value="<?php echo (isset($psdata['email'])) ? $psdata['email'] : '';  ?>" >
                  </div>
                </div>
                <div class="control-group" >
                  <label for="fileInput" class="control-label">Map </label>
                  <div class="controls">
                    <textarea id="map" name="map" class="input-xxlarge" type="text" rows="6" /><?php echo base64_decode($psdata['map']);  ?></textarea>
                    <br/><br/>
                    <p>  
                    - Write Embed Map Link After pb Variable...<br/>
                    </p>
                    
                    <textarea id="map2" name="map2" class="input-xxlarge" type="text" rows="8" readonly />Ex- 
"!1m18!1m12!1m3!1d58846.91597688007!2d70.82177582881087!3d22.804974226203097!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39598cd96ce15487%3A0x294863999340c94e!2sMorbi%2C+Gujarat!5e0!3m2!1sen!2sin!4v1557813207908!5m2!1sen!2sin"

                    </textarea>


               	  </div>
                </div>
             
                <div class="form-actions">
                  <input name="submit" class="btn btn-alt btn-large btn-primary" type="submit" value="<?php echo (isset($_GET['action']) && $_GET['action'] == 'update') ? 'update' : 'create'; ?>" style="float: left;" />
                </div>
              </form>
            </div>
          </section>
        </div>
      </article>
    </div>
    <?php $data = $obj_fun->getallfrontcontact($type);
				if(isset($data) && $data !=''){
			?>
    <div class="row-fluid">
      <article class="span12 data-block">
        <div class="data-container">
          <?php
							if(isset($_POST['delete']) && $_POST['delete'] !='')
							{
								if(isset($_POST['cat_delete']) && $_POST['cat_delete'] !='')
								{
									for($i=0; $i < count($_POST['cat_delete']); $i++)
									{
										$obj_fun->Frontcontactdelete($_POST['cat_delete'][$i]);
										echo '<script>success("Front Menu Delete successfully.")</script>';
										echo "<script>urlRefresh('internationalcontact.php');</script>";
									}
								}
								else
								{
									echo "<script>danger('Please Select at least one for delete');</script>";
								}
							}
							?>
                        
          <form class="form-gallery" action="#" method="post">
            <header>
              <h2>Export Contact</h2>
              <ul class="data-header-actions tabs">
                <li class="demoTabs active">
                  <input type="button" name="delete" id="delete" value="Delete" onClick="return deleteAlertmega();" class="btn btn-alt btn-primary" />
                </li>
              </ul>
            </header>
            <section class="data-block">
              <div class="tab-pane" id="dynamic">
             
                <table class="table table-striped table-bordered" id="catalogueview" align="center">
                  <thead>
                    <tr>
                      <th><input type="checkbox" value="Check All" id="selecctall" name="selecctall" style="left: -16px; top: 16px;" /></th>
                      <th>Address</th>
                      <th>Mobile</th>
                      <th>Email</th>
                      <th>Map</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
													$i=1;
													
													foreach($data as $v){
													?>
                    <tr class="odd gradeX" id="<?php echo $v['id']; ?>">
                      <td><input type="checkbox" value="<?php echo $v['id']; ?>" class="checkbox1" id="cat_delete" name="cat_delete"></td>
                      <td><?php echo htmlspecialchars_decode($v['address']); ?></td>
                      <td><?php echo $v['mobile']; ?></td>
                      <td><?php echo $v['email']; ?></td>
						
                      <td>
					  <?php if($v['map'] != '') { ?>
                      <iframe src="https://www.google.com/maps/embed?pb=<?php echo base64_decode($v['map']); ?>" width="100%" height="200" frameborder="0" style="border:0" allowfullscreen></iframe>
					  <?php } ?>
                      </td>
                      </th>
                      <td align="center"><a href="internationalcontact.php?action=update&id=<?php echo $v['id']; ?>" class="btn btn-alt btn-primary" >Edit</a> <a class="btn btn-alt btn-danger" onClick="deleteAlert(<?php echo $v['id']; ?>)">Delete</a></td>
                    </tr>
                    <?php }?>
                  </tbody>
                </table>
              </div>
            </section>
          </form>
        </div>
      </article>
    </div>
    <?php }?>
  </div>
</div>
<?php include_once('script.php');?>
<script>

	function deleteAlertmega(){
			swal({
					title: "Are you sure want to delete?",
					text: "All Selected data will be remove.",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#DD6B55",
					confirmButtonText: "Yes, Delete!",
					cancelButtonText: "No, Cancel !",
					closeOnConfirm: false,
					closeOnCancel: false
				},
				function(isConfirm){
					var chkLength = $('input[name="cat_delete"]:checked').length;
					if(chkLength >= 1)
					{
						if (isConfirm) {
							$('input[name="cat_delete"]:checked').each(function() {
							   $.post("custom-ajax.php",{action:'frontmenu_contact',id:this.value },function(result){
							   });
							});
							swal({title: "Deleted!", text: "Deleted", type: "success"},
							   function(){ 
							       location.reload();
							   }
							);
						} else {
							swal("Cancelled", "", "error");
							return false;
						}
					}
					else
					{
						swal("Cancelled", "Please Select at least one for delete", "error");
						return false;
					}
				});
		}

		$('.confirm').click(function() {
			if($(this).text()=="OK")
			{
				location.reload();
			}
		});
		
	function deleteAlert(id){	
				swal({
				title: "Are you sure want to delete?",
				text: "Selected data will be remove",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Yes, Delete!",
				cancelButtonText: "No, Cancel !",
				closeOnConfirm: false,
				closeOnCancel: false
				},
				function(isConfirm){
						if (isConfirm) {
							$.post("custom-ajax.php",{action:'frontmenu_contact',id:id },function(result){
												swal("Deleted!", "Deleted", "success");
												location.reload();
													});
						} else {
							swal("Cancelled", "", "error");
						}
				});
	}
	
	

</script>
<style>
.row-fluid .span2.gallery{
	margin:10px;
	
}
</style>
<script src="progress/jquery_002.js"></script> 
<script type="text/javascript">
		$(document).ready(function() {
			$('#selecctall').click(function(event) {  //on click
				if(this.checked) { // check select status
					$('.checkbox1').each(function() { //loop through each checkbox
						this.checked = true;  //select all checkboxes with class "checkbox1"              
					});
				}else{
					$('.checkbox1').each(function() { //loop through each checkbox
						this.checked = false; //deselect all checkboxes with class "checkbox1"                      
					});        
				}
			});
		   
		});
	</script>
<script type="text/javascript">
	 jQuery(document).ready(function($) {
		$('.dynamic-menu #ManagedContact').addClass('active');
		$('.dynamic-menu #Exportcontact').addClass('active');
	});
</script>
<script src="ckeditor/ckeditor.js"></script>
		<script src="ckeditor/adapters/jquery.js"></script>
		<script>
			CKEDITOR.disableAutoInline = true;
			$( document ).ready( function() {
				CKEDITOR.replace( 'address',
				{
					toolbar: [
								{ name: 'document', groups: [ 'mode', 'document', 'doctools' ], items: [ 'Source', '-', 'Save', 'NewPage', 'Preview', 'Print', '-', 'Templates' ] },
								{ name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
								{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ], items: [ 'Find', 'Replace', '-', 'SelectAll', '-', 'Scayt' ] },
								{ name: 'forms', items: [ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField' ] },
								'/',
								{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'CopyFormatting', 'RemoveFormat' ] },
								{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language' ] },
								{ name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
								{ name: 'insert', items: [ 'Image', 'Flash', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe' ] },
								'/',
								{ name: 'styles', items: [ 'Styles', 'Format', 'Font', 'Fontyturl' ] },
								{ name: 'colors', items: [ 'TextColor', 'BGColor' ] },
								{ name: 'tools', items: [ 'Maximize', 'ShowBlocks' ] },
								{ name: 'others', items: [ '-' ] },
								{ name: 'about', items: [ 'About' ] }
							]
				});
			});
		</script>
        
</body>
</html>
