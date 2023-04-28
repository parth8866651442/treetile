// Setting Validation
function chkForm()
{	
	var valid = true;
	if(document.getElementById('name').value.replace(/^\s+/,'')=='')
	{
		document.getElementById('name').style.border="solid 1px #DD0000";
		document.getElementById('name').style.borderRadius="4px";
		document.getElementById('name').style.boxShadow="0px 0px 10px #BB0000";
		danger('Please fill the name field.');
		valid = false;
	}

	if(document.getElementById('pass').value.replace(/^\s+/,'')=='')
	{
		document.getElementById('pass').style.border="solid 1px #DD0000";
		document.getElementById('pass').style.borderRadius="4px";
		document.getElementById('pass').style.boxShadow="0px 0px 10px #BB0000";
		danger('Please fill the password field.');
		valid = false;
	}
	if(document.getElementById('email').value.replace(/^\s+/,'')=='')
	{
		document.getElementById('email').style.border="solid 1px #DD0000";
		document.getElementById('email').style.borderRadius="4px";
		document.getElementById('email').style.boxShadow="0px 0px 10px #BB0000";
		danger('Please fill the Email field.');
		valid = false;
	}

	return valid;
}
function category_delete(id)
{
	var x= confirm('Want To Remove Category then all images will be remove !');
	if(x)
	{
		$.post("custom-ajax.php",{action:'category_delete',id:id},function(result){
			location.reload();
		});
	}
	return false;	
}
//Series Validation
function register_validate()
{
	var valid = true;
	if(document.getElementById('username').value.replace(/^\s+/,'')=='')
	{
		document.getElementById('username').style.border="solid 1px #DD0000";
		document.getElementById('username').style.borderRadius="4px";
		document.getElementById('username').style.boxShadow="0px 0px 10px #BB0000";
		$.jGrowl("", {
			header: 'Please fill the username field.',
			sticky: true,
			theme: 'danger'
		});
		valid = false;
	}
	if(document.getElementById('password').value.replace(/^\s+/,'')=='')
	{
		document.getElementById('password').style.border="solid 1px #DD0000";
		document.getElementById('password').style.borderRadius="4px";
		document.getElementById('password').style.boxShadow="0px 0px 10px #BB0000";
		$.jGrowl("", {
			header: 'Please fill the password field.',
			sticky: true,
			theme: 'danger'
		});
		valid = false;
	}
	
	return valid;
}
//Series
function series_validate()
{
	var valid = true;
	if(document.getElementById('name').value.replace(/^\s+/,'')=='')
	{
		document.getElementById('name').style.border="solid 1px #DD0000";
		document.getElementById('name').style.borderRadius="4px";
		document.getElementById('name').style.boxShadow="0px 0px 10px #BB0000";
		$.jGrowl("", {
			header: 'Please fill the name field.',
			sticky: true,
			theme: 'danger'
		});
		valid = false;
	}
	return valid;
}
function series_delete(id)
{  
	var x= confirm('Want To Remove Series then all images will be remove !');
	if(x)
	{
		
		$.post("custom-ajax.php",{action:'series_delete',id:id},function(result){
			
			location.reload();
		});
	}
	return false;	
}
function series_mul_delete()
{
	var x= confirm('Want To Remove Series then all images will be remove !');
	if(x){
		var id = [];
		$('.checkbox1:checked').each(function () {
			var e = $(this);
			id.push(e.val());
		});
		if(id !='')
		{
			$.post("custom-ajax.php",{action:'series_mul_delete',id:id},function(result){
				//console.log(result);
				location.reload();
			});
		}
	}
	return false;
}
// For Series No
function series_filter(p_size ,id)
{
	if(id != '')
		window.location = window.location.pathname + '?action=newseriesno&size=' + p_size + '&filter=' + id;
	else
		window.location = window.location.pathname + '?action=newseriesno&size=' + p_size ;
}

function series_no_validate()
{
	var valid = true;
	if(document.getElementById('series_id').value.replace(/^\s+/,'')=='')
	{
		document.getElementById('series_id').style.border="solid 1px #DD0000";
		document.getElementById('series_id').style.borderRadius="4px";
		document.getElementById('series_id').style.boxShadow="0px 0px 10px #BB0000";
		$.jGrowl("", {
			header: 'Please select Series.',
			sticky: true,
			theme: 'danger'
		});
		valid = false;
	}
	if(document.getElementById('series_no').value.replace(/^\s+/,'')=='')
	{
		document.getElementById('series_no').style.border="solid 1px #DD0000";
		document.getElementById('series_no').style.borderRadius="4px";
		document.getElementById('series_no').style.boxShadow="0px 0px 10px #BB0000";
		$.jGrowl("", {
			header: 'Please fill the name field.',
			sticky: true,
			theme: 'danger'
		});
		valid = false;
	}
	return valid;
}
function series_no_delete(id,path)
{
	var x= confirm('Want To Remove !');
	if(x)
	{
		$.post("custom-ajax.php",{action:'series_no_delete',id:id,path:path},function(result){
			location.reload();
		});
	}
	
	return false;
}
function series_no_mul_delete()
{
	var x= confirm('Want To Remove !');
	if(x){
		var path = [];
		var id = [];
		$('.checkbox1:checked').each(function () {
			var e = $(this);
			id.push(e.val());
			path.push(document.getElementById("s_no_path_"+e.val()).value);
		});
		if(id !='')
		{
			$.post("custom-ajax.php",{action:'s_no_mul_delete',id:id,path:path},function(result){
				//alert(result);
				location.reload();
			});
		}
	}
	return false;
}

//------------------------For Product----------------------------- 
//All Product 
function product_mul_delete()
{
	var x= confirm('Want To Remove !');
	if(x){
		var image = [];
		var view = [];
		var id = [];
		$('.checkbox1:checked').each(function () {
			var e = $(this);
			id.push(e.val());
			image.push(document.getElementById("old_img_"+e.val()).value);
			view.push(document.getElementById("old_view_"+e.val()).value);
		});
		
		if(image !='')
		{
			var img_path = document.getElementById("img_path").value;
			$.post("custom-ajax.php",{action:'product_mul_delete',id:id,image:image,view:view,img_path:img_path},function(result){
				location.reload();
			});
		}
	}
	return false;
}

function Flag_mul_delete()
{
	var x= confirm('Want To Remove !');
	if(x){
		var image = [];
		
		var id = [];
		$('.checkbox1:checked').each(function () {
			var e = $(this);
			id.push(e.val());
			image.push(document.getElementById("old_img_"+e.val()).value);
		});
		
		if(image !='')
		{
			$.post("custom-ajax.php",{action:'Flag_mul_delete',id:id,image:image},function(result){
				location.reload();
			});
		}
	}
	return false;
}

function product_delete(id)
{
	"use strict";
	swal({
			title: "Want To Remove !",
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
						var image = document.getElementById("old_img_"+id).value;
						var img_path = document.getElementById("img_path").value;
							$.post("custom-ajax.php",{action:'product_delete',id:id,image:image,img_path:img_path},function(result){
								location.reload();
							});
					} else {
						swal("Cancelled", "", "error");
					}
			});
}
function Export_flag_delete(id)
{
	"use strict";
	swal({
			title: "Want To Remove !",
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
						var image = document.getElementById("old_img_"+id).value;
							
							$.post("custom-ajax.php",{action:'Export_flag_delete',id:id,image:image},function(result){
								location.reload();
							});
					} else {
						swal("Cancelled", "", "error");
					}
			});
}

function product_view_delete(id,path,view)
{
	var x= confirm('Want To Remove !');
	if(x){
		$.post("custom-ajax.php",{action:'product_view_delete',id:id,path:path,view:view},function(result){
			location.reload();
		});
	}
	return false;
}

function menu_view_delete(id,path,view)
{
	var x= confirm('Want To Remove !');
	if(x){
		$.post("custom-ajax.php",{action:'menu_view_delete',id:id,path:path,view:view},function(result){
			location.reload();
		});
	}
	return false;
}

function size_view_delete(id,path,view)
{
	var x= confirm('Want To Remove !');
	if(x){
		$.post("custom-ajax.php",{action:'size_view_delete',id:id,path:path,view:view},function(result){
			location.reload();
		});
	}
	return false;
}

function series_view_delete(id,path,view)
{
	var x= confirm('Want To Remove !');
	if(x){
		$.post("custom-ajax.php",{action:'series_view_delete',id:id,path:path,view:view},function(result){
			location.reload();
		});
	}
	return false;
}



function jpgImage(img)
{
	var ext = img.substring(img.lastIndexOf('.') + 1);
	if(ext == "JPEG" || ext == "jpeg" || ext == "jpg" || ext == "JPG")
		return true;
	else
	{
		danger("uploads only JPEG image");
		return false;
	}
}

// For Design with Title
function product_validate()
{
	var valid = true;
	if(document.getElementById('title').value.replace(/^\s+/,'')=='')
	{
		document.getElementById('title').style.border="solid 1px #DD0000";
		document.getElementById('title').style.borderRadius="4px";
		document.getElementById('title').style.boxShadow="0px 0px 10px #BB0000";
		$.jGrowl("", {
			header: 'Please Select Series Number.',
			sticky: true,
			theme: 'danger'
		});
		valid = false;
	}
	return valid;
}
// For Design with Series Number
function product_s_no_and_title_validate()
{
	var valid = true;
	if(document.getElementById('title').value.replace(/^\s+/,'')=='')
	{
		document.getElementById('title').style.border="solid 1px #DD0000";
		document.getElementById('title').style.borderRadius="4px";
		document.getElementById('title').style.boxShadow="0px 0px 10px #BB0000";
		$.jGrowl("", {
			header: 'Please Select Series Number.',
			sticky: true,
			theme: 'danger'
		});
		valid = false;
	}
	if(document.getElementById('series_no').value.replace(/^\s+/,'')=='')
	{
		document.getElementById('series_no').style.border="solid 1px #DD0000";
		document.getElementById('series_no').style.borderRadius="4px";
		document.getElementById('series_no').style.boxShadow="0px 0px 10px #BB0000";
		$.jGrowl("", {
			header: 'Please Select Series Number.',
			sticky: true,
			theme: 'danger'
		});
		valid = false;
	}
	return valid;
}
function product_s_no_validate()
{
	var valid = true;
	if(document.getElementById('series_no').value.replace(/^\s+/,'')=='')
	{
		document.getElementById('series_no').style.border="solid 1px #DD0000";
		document.getElementById('series_no').style.borderRadius="4px";
		document.getElementById('series_no').style.boxShadow="0px 0px 10px #BB0000";
		$.jGrowl("", {
			header: 'Please Select Series Number.',
			sticky: true,
			theme: 'danger'
		});
		valid = false;
	}
	return valid;
}
function product_filter(p_size,s_id ,id)
{
	if(id != '')
		window.location = window.location.pathname + '?size=' + p_size + '&series=' + s_id + '&filter=' + id;
	else
		window.location = window.location.pathname + '?size=' + p_size + '&series=' + s_id;
}

function selectProductSize(id)
{
	$.post("custom-ajax.php",{action:'selectProductSize',id:id},function(result){
		document.getElementById("product_size").innerHTML = result;
	});
	return false;
}
function urlRefreshFiveSec(url)
{
   window.setTimeout(function(){
        window.location.href = url;
    }, 5000);
}
function urlRefresh(url)
{
   window.setTimeout(function(){
        window.location.href = url;
    }, 2000);
}
function pageRelode()
{
   window.setTimeout(function(){
        location.reload();
    }, 2000);
}

/* for application */ 

function product_mul_application()
{
	var x= confirm('Want To Add in this Application !');
	if(x){
		var id = [];
		var application_id = $('#application_id').val();
		
		$('.checkbox1:checked').each(function () {
			var e = $(this);
			id.push(e.val());
			
		});
		if(id !='')
		{
			$.post("custom-ajax.php",{action:'product_mul_application',id:id,application_id:application_id},function(result){
				location.reload();
			});
		}
	}
	return false;
}

/* for inspiration */

function product_mul_inspiration()
{
	var x= confirm('Want To Add in this Inspiration !');
	if(x){
		var id = [];
		var inspiration_id = $('#inspiration_id').val();
		
		$('.checkbox1:checked').each(function () {
			var e = $(this);
			id.push(e.val());
			
		});
		if(id !='')
		{	
			$.post("custom-ajax.php",{action:'product_mul_inspiration',id:id,inspiration_id:inspiration_id},function(result){
				location.reload();
			});
		}
	}
	return false;
}

/* for color */

function product_mul_color()
{
	var x= confirm('Want To Add in this Color !');
	if(x){
		var id = [];
		var color_id = $('#color_id').val();
		
		$('.checkbox1:checked').each(function () {
			var e = $(this);
			id.push(e.val());
			
		});
		if(id !='')
		{	
			$.post("custom-ajax.php",{action:'product_mul_color',id:id,color_id:color_id},function(result){
				location.reload();
			});
		}
	}
	return false;
}

