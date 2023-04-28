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
          <li><a href="index.php"><span class="awe-home"></span></a><span class="divider"></span></li>
          <li><a href="index.php">Admin Panel</a><span class="divider"></span></li>
                    <li><a href="#">Information</a><span class="divider"></span></li>
            <?php foreach($totalsection as $section){
					  if($section['key'] == $_GET['type']){ 	  
						  foreach($section['variable'] as $val){ ?>
							  
          <li class="active"><?php echo $val['full_text'] ?></li> <?php }}} ?>
          
        </ul>
   
   
    <?php if(isset($_SESSION['type']) || $_SESSION['type'] =='master-admin'){?>

    
    <!--For User Change Settings Only For Master Admin-->
    <div class="row-fluid">
          <article class="span12 data-block nested">
        <div class="data-container">
              <header>
            <h2>Change In <?php echo $val['full_text'] ?> Text</h2>
            <br>
            <br>
            <hr>
          </header>
              <section class="tab-content">
            <div class="tab-pane active" id="newUser">
                  <?php
								if(isset($_POST['submit_setting']))
								{
									unset($_POST['submit_setting']);
									
									$resss = $obj_fun->add_MetaData($_GET['type'], $_POST);
									if($resss>0)
										echo "<script>window.location.href = 'string.php?type=".$_GET['type']."'</script>";
								}?>
                  <form class="form-horizontal" method="post" action="#" onSubmit="">
                  <input type="hidden" name="type" value="<?php echo $_REQUEST['type']; ?>">
                  
                  
                  <?php foreach($totalsection as $section){
					  if($section['key'] == $_GET['type']){ 	  
						  foreach($section['variable'] as $val){
							  if($val['type'] == 'text'){  
							   							?>
							  
                     <div class="control-group">
                      <label class="control-label" for="input"><?php echo $val['full_text'] ?></label>
                      <div class="controls">
                    <input id="<?php echo $val['name'] ?>" name="<?php echo $val['name'] ?>" class="input-xlarge" type="text" value="<?php echo $obj_fun->getMetaData($val['name']); ?>" />
                  </div>
                    </div>
                            <?php }
							if($val['type'] == 'longtext'){
							
							 ?>  
                              
                 <div class="control-group">
                      <label class="control-label" for="input"><?php echo $val['full_text'] ?></label>
                      <div class="controls">
                    <textarea id="<?php echo $val['name'] ?>" class="" rows="8" name="<?php echo $val['name'] ?>"><?php echo $obj_fun->getMetaData($val['name']); ?></textarea>
                  </div>
                    </div>  
                              
							
                            
                             <?php }
							if($val['type'] == 'editor'){
							
							$detailsdataid[] = $val['name'];
							
							 ?> 
                             
                            <div class="control-group">
                      <label class="control-label" for="input"><?php echo $val['full_text'] ?></label>
                      <div class="controls">
                    <textarea id="<?php echo $val['name'] ?>" class="" rows="8" name="<?php echo $val['name'] ?>"><?php echo $obj_fun->getMetaData($val['name']); ?></textarea>
                  </div>
                    </div> 
                               
						<?php } } } } ?>
                    
                    
                <div class="form-actions">
                      <input name="submit_setting" class="btn btn-alt btn-large btn-primary" type="submit" value="Update">
                    </div>
              </form>
                </div>
          </section>
            </div>
      </article>
        </div>
    
    
    <?php }?>
  </div>
    </div>

<?php include_once('script.php');?>

		<script src="ckeditor/ckeditor.js"></script>
		<script src="ckeditor/adapters/jquery.js"></script>
        
         <script type="text/javascript">
	 jQuery(document).ready(function($) {
		$('.dynamic-menu #string').addClass('active');
		$('.dynamic-menu #<?php echo $_GET['type'] ?>').addClass('active');
	});
</script>

        
        <?php if(isset($detailsdataid) && $detailsdataid != ''){
			
				foreach($detailsdataid as $id){			
			 ?>



<script>
CKEDITOR.disableAutoInline = true;
$( document ).ready( function() {
CKEDITOR.replace( '<?php echo $id; ?>',
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
        
       <?php } } ?> 
        
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
  
<script type="text/javascript">
		$(function() {
			$("#uploader").plupload({
				// General settings
				runtimes : 'html5,flash,silverlight,html4',
				/*url : 'plupload/upload.php?folder=../../uploads/product/10x15250mmx375mm/admin&tw=200&th=100',*/
				url : 'plupload/upload.php?folder=../../uploads/lightboximage&tw=80&th=80',
				// User can upload no more then 20 files in one go (sets multiple_queues to false)
				max_file_count: 1,
				chunk_size: '1mb',
				unique_names : true,
				// Resize images on clientside if we can
				resize : {
					quality : 95,
					crop: false // crop to exact dimensions
				},
				filters : {
					// Maximum file size
					max_file_size : '3mb',
					// Specify what files to browse for
					mime_types: [
						{title : "Image files", extensions : "jpg,jpeg"}//,
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
				flash_swf_url : 'plupload/js/Moxie.swf',
				// Silverlight settings
				silverlight_xap_url : 'plupload/js/Moxie.xap',
				init : {
					 UploadComplete: function(up, files) {
                // Called when all files are either uploaded or failed
                			$('#setlight').show();
            		}
				}
			});
			// Handle the case when form was submitted before uploading has finished
			$('#form').submit(function(e) {
				// Files in queue upload them first
				if ($('#uploader').plupload('getFiles').length > 0) {
		
					// When all files are uploaded submit form
					$('#uploader').on('complete', function() {
						$('#form')[0].submit();
					});
		
					$('#uploader').plupload('start');
				} else {
					alert("You must have at least one file in the queue.");
				}
				return false; // Keep the form from submitting
			});
		});
	</script>