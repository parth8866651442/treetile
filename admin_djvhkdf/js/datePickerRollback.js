/**
 * datepickRange 0.1.0
 *
 * Based on the work from https://github.com/petrkotek/datepick
 *
 * Updated by Emanuele Barban (https://github.com/McRipper)
 * for Fashionbi.com
 *
 */

(function($) {

	var $current_target;
	var $dropdown;
	var $datepick;
	var $parameters;
	var $daterangePreset;
  var $baseOptions;
  var $basedatepick

	var default_options = {
		values : {}
	};
	
	var db = {
		date_presets : {
			'custom' : {
				title: "Custom",
				dates: function() { return null; }
			},
			'lastweeks' : {
				title: "Last Week",
				dates: function() {
					var dates = [];
					var weeks = 1;
					
					var monday = internal.getMonday(new Date());
					monday.setDate(monday.getDate() - (7 * weeks));
					dates[0] = monday.valueOf();
					var sunday = new Date(monday);
					sunday.setDate(sunday.getDate()+6 + (7 * (weeks - 1)));
					sunday.setHours(23,59,59,0);
					dates[1] = sunday.valueOf();
					
					return dates;
				}
			},
 			'last7days' : {
				title: "Last 7 Days",
				dates: function() {
					var dates = [];
					var days = 7;
          var today = new Date();
					dates[0] = new Date().setDate(today.getDate() - days).valueOf();
					dates[1] = new Date();
					dates[1].setDate(today.getDate() - 1);
					dates[1].setHours(23,59,59,0).valueOf();
					
					return dates;					
				}
			},
			'lastmonths' : {
				title: "Last Month",
				dates: function() {
					var months = 1;
					var dates = [];
					
					var lastOfMonth = new Date().setDate(0);
					var firstOfMonth = new Date(lastOfMonth);
					firstOfMonth.setDate(1);
					firstOfMonth.setMonth(firstOfMonth.getMonth() - months + 1);
					dates[0] = firstOfMonth.valueOf();
					dates[1] = lastOfMonth.valueOf();
					
					return dates;
				}
			},
 			'last30days' : {
				title: "Last 30 Days",
				dates: function() {
					var dates = [];
					var days = 30;
					var today = new Date();
					dates[0] = new Date(today).setDate(today.getDate() - days).valueOf();
					dates[1] = new Date(today);
					dates[1].setDate(today.getDate() - 1);
					dates[1].setHours(23,59,59,0).valueOf();
					
					return dates;					
				}
			}
		}	
	};
	
	var methods = {
		
		init : function(options) {
      this.element = $(this);
			return this.each(function() {
				var $this = $(this);
				var data = $this.data('DateRangesWidget');
				if (!data) {
					var effective_options = $.extend({}, default_options, options);
					$this.data('DateRangesWidget', {
						options : effective_options
					});
				}
				internal.createElements($this);
				internal.updateDateField($this);
			});
		}
		
    //destroy : function() {
      //return this.each(function() {
        //var $this = $(this),
        //data = $this.data('DateRangesWidget');
        //$(window).unbind('.DateRangesWidget');
        //data.target.remove();
        //$this.removeData('DateRangesWidget');
      //})
    //}
	};
	
	var internal = {
		
		refreshForm : function() {
			
      var lastSel = $datepick.datepickGetLastSel();
      lastSel = lastSel % 2;
  		$datepick.datepickSetLastSel(lastSel);

			var dates = $datepick.datepickGetDate()[0];

			var newFrom = dates[0].getDate() + '/' + (dates[0].getMonth()+1) + '/' + dates[0].getFullYear();
			var newTo = dates[1].getDate() + '/' + (dates[1].getMonth()+1) + '/' + dates[1].getFullYear();
			
			var oldFrom = $('.dr1.from', $dropdown).val();
			var oldTo = $('.dr1.to', $dropdown).val();
			
			if (newFrom != oldFrom || newTo != oldTo) {
				$('.dr1.from', $dropdown).val(newFrom);
				$('.dr1.to', $dropdown).val(newTo);
			}
			
			if (dates[2]) {
				$('.dr2.from', $dropdown).val(dates[2].getDate() + '/' + (dates[2].getMonth()+1) + '/' + dates[2].getFullYear());
			}
			if (dates[3]) {
				$('.dr2.to', $dropdown).val(dates[3].getDate() + '/' + (dates[3].getMonth()+1) + '/' + dates[3].getFullYear());
			}
		},
		
    // Create the main div for the date picker
    //
		createElements : function($target) {
			// modify div to act like a dropdown
			$target.html(
				'<div class="date-range-field">'+
					'<span class="main"></span>'+
					//'<span class="comparison"></span>'+
					'<a href="#">&#9660;</a>'+
				'</div>'
			);
			
			// only one dropdown exists even though multiple widgets may be on the page
			if (!$dropdown) {
				$dropdown = $(
				'<div id="datepick-dropdown">'+
					'<div class="date-ranges-picker"></div>'+
					'<div class="date-ranges-form">'+
            '<span>Use the calendar to select the period</span>'+
            '<div class="date-range-wrap">'+
              '<label>Date Range:</label>'+
              '<select class="daterange-preset"></select>'+
            '</div>'+
						'<div class="main-daterange">'+
							'<input type="text"  class="dr dr1 from" lastSel="0" /> - <input type="text"  class="dr dr1 to" lastSel="1" />'+
						'</div>'+
            //'<div class="comparison-daterange">'+
              //'<input type="text" disabled class="dr dr2 from" lastSel="2" /> - <input type="text" disabled class="dr dr2 to" lastSel="3" />'+
            //'</div>'+
            '<div class="legend">'+
              '<div class="color-wrap" style="width: 100px">'+
                '<span class="color selected"></span>'+
                '<span class="explain">Selected period</span>'+
              '</div>'+
              '<div class="color-wrap">'+
                //'<span class="color compare"></span>'+
                //'<span class="explain">Compared period</span>'+
              '</div>'+
            '</div><br><br>'+
            '<div class="actions">'+
  						'<div class="btn primary ok">Ok</div>'+
	  					'<div class="btn cancel">Cancel</div>'+
            '</div>'+
					'</div>'+
				'</div>');

				$dropdown.appendTo($('body'));
				
				$datepick = $('.date-ranges-picker', $dropdown);
				
				$daterangePreset = $('.daterange-preset', $dropdown);
				
				// TODO: inherit options from DRW options

        var base_options = {
					mode: 'tworanges',
					starts: 1,
					calendars: 3,
					inline: true,
					onChange: function(dates, el, options) {
						internal.setDaterangePreset('custom'); // user clicked on datepick
					}
				}

        $baseOptions = $target.data('DateRangesWidget').options

        // Init base datepick
				$basedatepick = $datepick.datepick($.extend({}, base_options, $baseOptions));
				
				// Handle change of datePreset
				$daterangePreset.change(function() {
					var date_preset = internal.getDaterangePreset();
					internal.recalculateDaterange();
				});
	
        // Handle clicking on a date field
				$('.dr', $dropdown).click(function() {
					// set active date field for datepick
					//$datepick.datepickSetLastSel($(this).attr('lastSel'));
          //internal.saveValues($current_target);
          //internal.recalculateDaterange();
					//internal.refreshForm();
				});
	
				// Handle clicking on OK button.
				$('div.ok', $dropdown).click(function() {
					internal.retractDropdown($current_target);
					internal.saveValues($current_target);
					internal.updateDateField($current_target);
					window.location.href = 'analytics.php?toDate='+$('.dr1.from', $dropdown).val()+'&endDate='+$('.dr1.to', $dropdown).val()+'&ChartType='+$('#a').val(); //Will take you to Google.


          $baseOptions.afterSave.apply($datepick.datepickGetDate()[0]) // afterSave Callback

					return false;
				});
				
				// Handle clicking on Cancel button.
				$('div.cancel', $dropdown).click(function() {
					internal.retractDropdown($current_target);
					return false;
				});
			}
			
			// Handle expand/retract of dropdown.
			$target.bind('click', function() {
				var $this = $(this);
				if ($this.hasClass('DRWClosed')) {
					internal.expandDropdown($this);
				} else {
					internal.retractDropdown($this);
				}
				return false;
			});
			
			$target.addClass('DRWInitialized');
			$target.addClass('DRWClosed');
		},
		
		recalculateDaterange : function() {
			var date_preset = internal.getDaterangePreset();
			var dates = $datepick.datepickGetDate()[0];
			
			var d = date_preset.dates();
			if (d != null) {
				dates[0] = d[0];
				dates[1] = d[1];
			}
			$datepick.datepickSetDate(dates);
			internal.recalculateComparison();
		},
		
		recalculateComparison : function() {
			var dates = $datepick.datepickGetDate()[0];
			if (dates.length >= 2) {
        // Set the comparison date range
        var days = parseInt((dates[1]-dates[0])/(24*3600*1000));
        dates[2] = new Date(dates[0]).setDate(dates[0].getDate() - (days+1));
        dates[3] = new Date(dates[1]).setDate(dates[1].getDate() - (days+1));
				$datepick.datepickSetDate(dates);
				internal.refreshForm();
			}
		},
		
		// Loads values from target element's data to controls.
		loadValues : function($target) {
			var values = $target.data('DateRangesWidget').options.values;
			$('.dr1.from', $dropdown).val(values.dr1from);
			$('.dr1.from', $dropdown).change();
			$('.dr1.to', $dropdown).val(values.dr1to);
			$('.dr1.to', $dropdown).change();
			$('.dr2.from', $dropdown).val(values.dr2from)
			$('.dr2.from', $dropdown).change();
			$('.dr2.to', $dropdown).val(values.dr2to)
			$('.dr2.to', $dropdown).change();
			$daterangePreset.val(values.daterangePreset);
			$daterangePreset.change();
		},
		
		// Stores values from controls to target element's data.
		saveValues : function($target) {
			var data = $target.data('DateRangesWidget');
			var values = data.options.values;
			values.daterangePreset = internal.getDaterangePresetVal()
			values.dr1from = $('.dr1.from', $dropdown).val()
			values.dr1to = $('.dr1.to', $dropdown).val()
			values.dr2from = $('.dr2.from', $dropdown).val()
			values.dr2to = $('.dr2.to', $dropdown).val()
			$target.data('DateRangesWidget', data);
		},
		
		// Updates target div with data from target element's data
		updateDateField : function($target) {
			var values = $target.data("DateRangesWidget").options.values;
			if (values.dr1from && values.dr1to) {
				$('span.main', $target).text(values.dr1from + ' - ' + values.dr1to);
			} else {
				$('span.main', $target).text('N/A');
			}

      // Show comparison period string
      $('span.comparison', $target).text(values.dr2from + ' - ' + values.dr2to);
      $('span.comparison', $target).show();
      $('span.comparison-divider', $target).show();

			return true;
		},
		
		getDaterangePresetVal : function() {
			return $daterangePreset.val();
		},
		
		getDaterangePreset : function() {
			return db.date_presets[$daterangePreset.val()];
		},
		
		setDaterangePreset : function(value) {
			$daterangePreset.val(value);
			$daterangePreset.change();
		},
		
		populateDateRangePresets : function() {
			var main_presets_keys = [];
			var $other_presets = $('<optgroup/>')
			var valueBackup = $daterangePreset.val();
			
			$daterangePreset.html('');
			
			// add main presets
			$.each(main_presets_keys, function(i, main_preset_key) {
				var date_preset = db.date_presets[main_preset_key];
				if (date_preset == undefined) throw 'Invalid preset "' + main_preset_key + '".';
				$daterangePreset.append($("<option/>", {
					value : main_preset_key,
					text : date_preset.title
				}));
			});
			
			// add other presets
			$.each(db.date_presets, function(preset_key, date_preset) {
				if ($.inArray(preset_key, main_presets_keys) == -1) {
					$other_presets.append($("<option/>", {
						value : preset_key,
						text : date_preset.title
					}));
				}
			});

			$daterangePreset.append($other_presets);
			$daterangePreset.val(valueBackup);
		},
		
		expandDropdown : function($target) {
			var options = $target.data("DateRangesWidget").options;
			$current_target = $target;
			
      internal.populateDateRangePresets();
			
			internal.loadValues($target);
			
			// retract all other dropdowns
			$('.DRWOpened').each(function() {
				internal.retractDropdown($(this));
			});
			
			var leftDistance = $target.offset().left;
			var rightDistance = $(document).width() - $target.offset().left - $target.width();

			$dropdown.show();

			if (rightDistance > leftDistance) {
				// align left edges
				$dropdown.offset({
					left : $target.offset().left,
					top : $target.offset().top + $target.height() - 1
				}).css('border-radius',  '0 5px 5px 5px');
			} else {
				// align right edges
				var fix = parseInt($dropdown.css('padding-left').replace('px', '')) +
					parseInt($dropdown.css('padding-right').replace('px', '')) +
					parseInt($dropdown.css('border-left-width').replace('px', '')) +
					parseInt($dropdown.css('border-right-width').replace('px', ''))
				$dropdown.offset({
					left : $target.offset().left + $target.width() - $dropdown.width() - fix,
					top : $target.offset().top + $target.height() - 1
				}).css('border-radius',  '5px 0 5px 5px');
			}
			
			// switch to up-arrow
			$('.date-range-field a', $target).html('&#9650;');
			$target.addClass('DRWOpened');
			$target.removeClass('DRWClosed');
			
			internal.recalculateDaterange(); // refresh
		},
		
		retractDropdown : function($target) {
			$dropdown.hide();
			$('.date-range-field a', $target).html('&#9660;');
			$target.addClass('DRWClosed');
			$target.removeClass('DRWOpened');
		},

		getMonday : function(d) {
			d = new Date(d);
			var day = d.getDay();
			var diff = d.getDate() - day + (day == 0 ? -6 : 1); // adjust when day is sunday
			return new Date(d.setDate(diff));
		}
		
	};
	
	$.fn.DateRangesWidget = function(method) {
		if (methods[method]) {
			return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
		} else if (typeof method === 'object' || !method) {
			return methods.init.apply( this, arguments );
		} else {
			$.error('Method ' +  method + ' does not exist on jQuery.DateRangesWidget');
		}
	};

})( jQuery );
