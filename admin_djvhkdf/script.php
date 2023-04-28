<script src="js/navigation.js"></script>
<!-- Bootstrap scripts -->
<script src="js/bootstrap/bootstrap.js"></script>

<!-- jQuery DataTable -->
<script src="js/plugins/dataTables/jquery.datatables.min.js"></script>
<script>
	/* Default class modification */
	$.extend( $.fn.dataTableExt.oStdClasses, {
		"sWrapper": "dataTables_wrapper form-inline"
	} );
	
	/* API method to get paging information */
	$.fn.dataTableExt.oApi.fnPagingInfo = function ( oSettings )
	{
		return {
			"iStart":         oSettings._iDisplayStart,
			"iEnd":           oSettings.fnDisplayEnd(),
			"iLength":        oSettings._iDisplayLength,
			"iTotal":         oSettings.fnRecordsTotal(),
			"iFilteredTotal": oSettings.fnRecordsDisplay(),
			"iPage":          Math.ceil( oSettings._iDisplayStart / oSettings._iDisplayLength ),
			"iTotalPages":    Math.ceil( oSettings.fnRecordsDisplay() / oSettings._iDisplayLength )
		};
	}
	
	/* Bootstrap style pagination control */
	$.extend( $.fn.dataTableExt.oPagination, {
		"bootstrap": {
			"fnInit": function( oSettings, nPaging, fnDraw ) {
				var oLang = oSettings.oLanguage.oPaginate;
				var fnClickHandler = function ( e ) {
					e.preventDefault();
					if ( oSettings.oApi._fnPageChange(oSettings, e.data.action) ) {
						fnDraw( oSettings );
					}
				};
				
				$(nPaging).addClass('pagination').append(
					'<ul>'+
						'<li class="prev disabled"><a href="#">&larr; '+oLang.sPrevious+'</a></li>'+
						'<li class="next disabled"><a href="#">'+oLang.sNext+' &rarr; </a></li>'+
					'</ul>'
				);
				var els = $('a', nPaging);
				$(els[0]).bind( 'click.DT', { action: "previous" }, fnClickHandler );
				$(els[1]).bind( 'click.DT', { action: "next" }, fnClickHandler );
			},
			
			"fnUpdate": function ( oSettings, fnDraw ) {
				var iListLength = 5;
				var oPaging = oSettings.oInstance.fnPagingInfo();
				var an = oSettings.aanFeatures.p;
				var i, j, sClass, iStart, iEnd, iHalf=Math.floor(iListLength/2);
				
				if ( oPaging.iTotalPages < iListLength) {
					iStart = 1;
					iEnd = oPaging.iTotalPages;
				}
				else if ( oPaging.iPage <= iHalf ) {
					iStart = 1;
					iEnd = iListLength;
				} else if ( oPaging.iPage >= (oPaging.iTotalPages-iHalf) ) {
					iStart = oPaging.iTotalPages - iListLength + 1;
					iEnd = oPaging.iTotalPages;
				} else {
					iStart = oPaging.iPage - iHalf + 1;
					iEnd = iStart + iListLength - 1;
				}
				
				for ( i=0, iLen=an.length ; i<iLen ; i++ ) {
					// Remove the middle elements
					$('li:gt(0)', an[i]).filter(':not(:last)').remove();
					
					// Add the new list items and their event handlers
					for ( j=iStart ; j<=iEnd ; j++ ) {
						sClass = (j==oPaging.iPage+1) ? 'class="active"' : '';
						$('<li '+sClass+'><a href="#">'+j+'</a></li>')
							.insertBefore( $('li:last', an[i])[0] )
							.bind('click', function (e) {
								e.preventDefault();
								oSettings._iDisplayStart = (parseInt($('a', this).text(),10)-1) * oPaging.iLength;
								fnDraw( oSettings );
							} );
					}
					
					// Add / remove disabled classes from the static elements
					if ( oPaging.iPage === 0 ) {
						$('li:first', an[i]).addClass('disabled');
					} else {
						$('li:first', an[i]).removeClass('disabled');
					}
					
					if ( oPaging.iPage === oPaging.iTotalPages-1 || oPaging.iTotalPages === 0 ) {
						$('li:last', an[i]).addClass('disabled');
					} else {
						$('li:last', an[i]).removeClass('disabled');
					}
				}
			}
		}
	});
	
	/* Show/hide table column */
	function dtShowHideCol( iCol ) {
		var oTable = $('#example-2').dataTable();
		var bVis = oTable.fnSettings().aoColumns[iCol].bVisible;
		oTable.fnSetColumnVis( iCol, bVis ? false : true );
	};
	
	/* Table #example */
	$(document).ready(function() {
		$('.datatable').dataTable( {
			"sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span6'i><'span6'p>>",
			"sPaginationType": "bootstrap",
			"oLanguage": {
				"sLengthMenu": "_MENU_ records per page"
			}
		});
		$('.datatable-controls').on('click','li input',function(){
			dtShowHideCol( $(this).val() );
		});
		
		//alert(this.href);
		
		<!--- for access --->
		var path = window.location.pathname;
		var page = path.split("/").pop();
		
		/*var url_string = window.location.href;
		var url = new URL(url_string);
		var c = url.searchParams.get("c");
		alert(url.searchParams);*/
		
		var path_full = window.location;
		
		if(page != "login.php"){
				
			$.ajax({
				type: "POST",
				url: "ajax_accesslog.php",
				data: "ajax=true&url="+path_full,
				success: function(data){
					if(data == 'logout'){
						window.location.href = '<?php //echo base_url().ADMINFOLDER."/Login/Logout"; ?>';
					}
				}
		 	});
		}
	});
</script>

<link rel="stylesheet" href="plupload/jquery-ui.css" type="text/css" />
<link rel="stylesheet" href="plupload/js/jquery.ui.plupload/css/jquery.ui.plupload.css" type="text/css" />

<script type="text/javascript" src="plupload/jquery-ui.min.js"></script>

<!-- production -->
<script type="text/javascript" src="plupload/js/plupload.full.min.js"></script>
<script type="text/javascript" src="plupload/js/jquery.ui.plupload/jquery.ui.plupload.js"></script>

<!-- Fileupload and Inputmask plugin -->
<script src="js/bootstrap/bootstrap-fileupload.js"></script>
<script src="js/bootstrap/bootstrap-inputmask.js"></script>