/**
 * datepick 1.0.0
 * 
 * A jQuery-based datepick that provides an easy way of creating both single
 * and multi-viewed calendars capable of accepting single date, date range, two
 * date ranges and multiple selected dates. Easily styled with two example
 * styles provided: an attractive 'dark' style, and a Google Analytics-like
 * 'clean' style.
 * 
 * View project page for Examples and Documentation:
 * http://foxrunsoftware.github.com/datepick/
 * 
 * This project is distinct from and not affiliated with the jquery.ui.datepick.
 * 
 * Copyright 2012, Justin Stern (www.foxrunsoftware.net)
 * Dual licensed under the MIT and GPL Version 2 licenses.
 * 
 * Based on Work by Original Author: Stefan Petre www.eyecon.ro
 * 
 * Depends:
 *   jquery.js
 */
(function ($) {
  var datepick = function () {
    var ids = {},
      views = {
        days:  'datepickViewDays'
      },
      tpl = {
        wrapper: '<div class="datepick"><div class="datepickBorderBR" /><div class="datepickContainer"><table cellspacing="0" cellpadding="0"><tbody><tr></tr></tbody></table></div></div>',
        head: [
          '<td class="datepickBlock">',
          '<table cellspacing="0" cellpadding="0">',
            '<thead>',
              '<tr>',
                '<th colspan="7"><a class="datepickGoPrev" href="#"><span><%=prev%></span></a>',
                '<a class="datepickMonth" href="#"><span></span></a>',
                '<a class="datepickGoNext" href="#"><span><%=next%></span></a></th>',
              '</tr>',
              '<tr class="datepickDoW">',
                '<th><span><%=day1%></span></th>',
                '<th><span><%=day2%></span></th>',
                '<th><span><%=day3%></span></th>',
                '<th><span><%=day4%></span></th>',
                '<th><span><%=day5%></span></th>',
                '<th><span><%=day6%></span></th>',
                '<th><span><%=day7%></span></th>',
              '</tr>',
            '</thead>',
          '</table></td>'
        ],
        space : '<td class="datepickSpace"><div></div></td>',
        days: [
          '<tbody class="datepickDays">',
            '<tr>',
              '<td class="<%=weeks[0].days[0].classname%>"><a href="#"><span><%=weeks[0].days[0].text%></span></a></td>',
              '<td class="<%=weeks[0].days[1].classname%>"><a href="#"><span><%=weeks[0].days[1].text%></span></a></td>',
              '<td class="<%=weeks[0].days[2].classname%>"><a href="#"><span><%=weeks[0].days[2].text%></span></a></td>',
              '<td class="<%=weeks[0].days[3].classname%>"><a href="#"><span><%=weeks[0].days[3].text%></span></a></td>',
              '<td class="<%=weeks[0].days[4].classname%>"><a href="#"><span><%=weeks[0].days[4].text%></span></a></td>',
              '<td class="<%=weeks[0].days[5].classname%>"><a href="#"><span><%=weeks[0].days[5].text%></span></a></td>',
              '<td class="<%=weeks[0].days[6].classname%>"><a href="#"><span><%=weeks[0].days[6].text%></span></a></td>',
            '</tr>',
            '<tr>',
              '<td class="<%=weeks[1].days[0].classname%>"><a href="#"><span><%=weeks[1].days[0].text%></span></a></td>',
              '<td class="<%=weeks[1].days[1].classname%>"><a href="#"><span><%=weeks[1].days[1].text%></span></a></td>',
              '<td class="<%=weeks[1].days[2].classname%>"><a href="#"><span><%=weeks[1].days[2].text%></span></a></td>',
              '<td class="<%=weeks[1].days[3].classname%>"><a href="#"><span><%=weeks[1].days[3].text%></span></a></td>',
              '<td class="<%=weeks[1].days[4].classname%>"><a href="#"><span><%=weeks[1].days[4].text%></span></a></td>',
              '<td class="<%=weeks[1].days[5].classname%>"><a href="#"><span><%=weeks[1].days[5].text%></span></a></td>',
              '<td class="<%=weeks[1].days[6].classname%>"><a href="#"><span><%=weeks[1].days[6].text%></span></a></td>',
            '</tr>',
            '<tr>',
              '<td class="<%=weeks[2].days[0].classname%>"><a href="#"><span><%=weeks[2].days[0].text%></span></a></td>',
              '<td class="<%=weeks[2].days[1].classname%>"><a href="#"><span><%=weeks[2].days[1].text%></span></a></td>',
              '<td class="<%=weeks[2].days[2].classname%>"><a href="#"><span><%=weeks[2].days[2].text%></span></a></td>',
              '<td class="<%=weeks[2].days[3].classname%>"><a href="#"><span><%=weeks[2].days[3].text%></span></a></td>',
              '<td class="<%=weeks[2].days[4].classname%>"><a href="#"><span><%=weeks[2].days[4].text%></span></a></td>',
              '<td class="<%=weeks[2].days[5].classname%>"><a href="#"><span><%=weeks[2].days[5].text%></span></a></td>',
              '<td class="<%=weeks[2].days[6].classname%>"><a href="#"><span><%=weeks[2].days[6].text%></span></a></td>',
            '</tr>',
            '<tr>',
              '<td class="<%=weeks[3].days[0].classname%>"><a href="#"><span><%=weeks[3].days[0].text%></span></a></td>',
              '<td class="<%=weeks[3].days[1].classname%>"><a href="#"><span><%=weeks[3].days[1].text%></span></a></td>',
              '<td class="<%=weeks[3].days[2].classname%>"><a href="#"><span><%=weeks[3].days[2].text%></span></a></td>',
              '<td class="<%=weeks[3].days[3].classname%>"><a href="#"><span><%=weeks[3].days[3].text%></span></a></td>',
              '<td class="<%=weeks[3].days[4].classname%>"><a href="#"><span><%=weeks[3].days[4].text%></span></a></td>',
              '<td class="<%=weeks[3].days[5].classname%>"><a href="#"><span><%=weeks[3].days[5].text%></span></a></td>',
              '<td class="<%=weeks[3].days[6].classname%>"><a href="#"><span><%=weeks[3].days[6].text%></span></a></td>',
            '</tr>',
            '<tr>',
              '<td class="<%=weeks[4].days[0].classname%>"><a href="#"><span><%=weeks[4].days[0].text%></span></a></td>',
              '<td class="<%=weeks[4].days[1].classname%>"><a href="#"><span><%=weeks[4].days[1].text%></span></a></td>',
              '<td class="<%=weeks[4].days[2].classname%>"><a href="#"><span><%=weeks[4].days[2].text%></span></a></td>',
              '<td class="<%=weeks[4].days[3].classname%>"><a href="#"><span><%=weeks[4].days[3].text%></span></a></td>',
              '<td class="<%=weeks[4].days[4].classname%>"><a href="#"><span><%=weeks[4].days[4].text%></span></a></td>',
              '<td class="<%=weeks[4].days[5].classname%>"><a href="#"><span><%=weeks[4].days[5].text%></span></a></td>',
              '<td class="<%=weeks[4].days[6].classname%>"><a href="#"><span><%=weeks[4].days[6].text%></span></a></td>',
            '</tr>',
            '<tr>',
              '<td class="<%=weeks[5].days[0].classname%>"><a href="#"><span><%=weeks[5].days[0].text%></span></a></td>',
              '<td class="<%=weeks[5].days[1].classname%>"><a href="#"><span><%=weeks[5].days[1].text%></span></a></td>',
              '<td class="<%=weeks[5].days[2].classname%>"><a href="#"><span><%=weeks[5].days[2].text%></span></a></td>',
              '<td class="<%=weeks[5].days[3].classname%>"><a href="#"><span><%=weeks[5].days[3].text%></span></a></td>',
              '<td class="<%=weeks[5].days[4].classname%>"><a href="#"><span><%=weeks[5].days[4].text%></span></a></td>',
              '<td class="<%=weeks[5].days[5].classname%>"><a href="#"><span><%=weeks[5].days[5].text%></span></a></td>',
              '<td class="<%=weeks[5].days[6].classname%>"><a href="#"><span><%=weeks[5].days[6].text%></span></a></td>',
            '</tr>',
          '</tbody>'
        ],
        months: [
          '<tbody class="<%=className%>">',
            '<tr>',
              '<td colspan="2"><a href="#"><span><%=data[0]%></span></a></td>',
              '<td colspan="2"><a href="#"><span><%=data[1]%></span></a></td>',
              '<td colspan="2"><a href="#"><span><%=data[2]%></span></a></td>',
              '<td colspan="1"><a href="#"><span><%=data[3]%></span></a></td>',
            '</tr>',
            '<tr>',
              '<td colspan="2"><a href="#"><span><%=data[4]%></span></a></td>',
              '<td colspan="2"><a href="#"><span><%=data[5]%></span></a></td>',
              '<td colspan="2"><a href="#"><span><%=data[6]%></span></a></td>',
              '<td colspan="1"><a href="#"><span><%=data[7]%></span></a></td>',
            '</tr>',
            '<tr>',
              '<td colspan="2"><a href="#"><span><%=data[8]%></span></a></td>',
              '<td colspan="2"><a href="#"><span><%=data[9]%></span></a></td>',
              '<td colspan="2"><a href="#"><span><%=data[10]%></span></a></td>',
              '<td colspan="1"><a href="#"><span><%=data[11]%></span></a></td>',
            '</tr>',
          '</tbody>'
        ]
      },
      defaults = {
        /**
         * The currently selected date(s).  This can be: a single date, an array 
         * of two dates (sets a range when 'mode' is 'range'), or an array of
         * any number of dates (selects all dates when 'mode' is 'multiple'.  
         * The supplied dates can be any one of: Date object, milliseconds 
         * (as from date.getTime(), date.valueOf()), or a date string 
         * parseable by Date.parse().
         */
        date: null,
        /**
         * Optional date which determines the current calendar month/year.  This
         * can be one of: Date object, milliseconds (as from date.getTime(), date.valueOf()), or a date string 
         * parseable by Date.parse().  Defaults to todays date.
         */
        current: null,
        /**
         * Optional date range which limits the selectable dates. The range of acceptable dates,
         * in an array of [min, max], disables any date outside of the range. Arguments should be
         * Date objects.
         */
        selectableDates: null,
        /**
         * true causes the datepick calendar to be appended to the datepick 
         * element and rendered, false binds the datepick to an event on the trigger element
         */
        inline: false,
        /**
         * Date selection mode, one of 'single', 'range' or 'multiple'.  Default 
         * 'single'.  'Single' allows the selection of a single date, 'range'
         * allows the selection of range of dates, and 'multiple' allows the 
         * selection of any number of individual dates.
         */
        mode: 'single',
        /**
         * Number of side-by-side calendars, defaults to 1.
         */
        calendars: 1,
        /**
         * The day that starts the week, where 0: Sunday, 1: Monday, 2: Tuesday, 3: Wednesday, 4: Thursday, 5: Friday, 6: Saturday.  Defaults to Sunday
         */  
        starts: 0,
        /**
         * Previous link text.  Default '&#9664;' (Unicode left arrow)
         */
        prev: '&#9664;',
        /**
         * Next link text.  Default '&#9664;' (Unicode left arrow)
         */
        next: '&#9654;',
        /**
         * Initial calendar view, one of 'days', 'months' or 'years'.  Defaults to 'days'.
         */
        view: 'days',
        /**
         * Date picker's position relative to the trigger element (non inline 
         * mode only), one of 'top', 'left', 'right' or 'bottom'. Defaults to 'bottom'
         */
        position: 'bottom',
        /**
         * The trigger event used to show a non-inline calendar.  Defaults to
         * 'focus' which is useful when the trigger element is a text input, 
         * can also be 'click' for instance if the trigger element is a button
         * or some text element. 
         */
        showOn: 'focus',
        /**
         * Callback, invoked prior to the rendering of each date cell, which 
         * allows control of the styling of the cell via the returned hash.
         * 
         * @param HTMLDivElement el the datepick containing element, ie the 
         *        div with class 'datepick'
         * @param Date date the date that will be rendered
         * @return hash with the following optional attributes:
         *         selected: if true, date will be selected
         *         disabled: if true, date cell will be disabled
         *         className: css class name to add to the cell
         */
        onRenderCell: function() { return {} },
        /* 
         * Callback, invoked when a date is selected, with 'this' referring to
         * the HTMLElement that datepick was invoked upon.
         * 
         * @param dates: Selected date(s) depending on calendar mode.  When calendar mode  is 'single' this
         *        is a single Date object.  When calendar mode is 'range', this is an array containing 
         *        a 'from' and 'to' Date objects.  When calendar mode is 'multiple' this is an array
         *        of Date objects.
         * @param HTMLElement el the datepick element, ie the element that datepick was invoked upon
         */
        onChange: function() { },
        /* 
         * Callback, invoked when a date range is selected, with 'this' referring to
         * the HTMLElement that datepick was invoked upon.
         * 
         * @param dates: Selected date(s), ie an array containing a 'from' and 'to' Date objects. 
         * @param HTMLElement el the datepick element, ie the element that datepick was invoked upon
         */
        onRangeChange: function() { },
        /**
         * Invoked before a non-inline datepick is shown, with 'this'
         * referring to the HTMLElement that datepick was invoked upon, ie
         * the trigger element
         * 
         * @param HTMLDivElement el The datepick container element, ie the div with class 'datepick'.
         * @return true to allow the datepick to be shown, false to keep it hidden
         */

        onBeforeShow: function() { return true },
        /**
         * Invoked after a non-inline datepick is shown, with 'this'
         * referring to the HTMLElement that datepick was invoked upon, ie
         * the trigger element
         * 
         * @param HTMLDivElement el The datepick container element, ie the div with class 'datepick'
         */
        onAfterShow: function() { },
        /**
         * Invoked before a non-inline datepick is hidden, with 'this'
         * referring to the HTMLElement that datepick was invoked upon, ie
         * the trigger element
         * 
         * @param HTMLDivElement el The datepick container element, ie the div with class 'datepick'
         * @return true to allow the datepick to be hidden, false to keep it visible
         */
        onBeforeHide: function() { return true },
        /**
         * Invoked after a non-inline datepick is hidden, with 'this'
         * referring to the HTMLElement that datepick was invoked upon, ie
         * the trigger element
         * 
         * @param HTMLDivElement el The datepick container element, ie the div with class 'datepick'
         */
        onAfterHide: function() { },
        /**
         * Locale text for day/month names: provide a hash with keys 'daysMin', 'months' and 'monthsShort'. Default english 
         */
        locale: {
          daysMin: ["S", "M", "T", "W", "T", "F", "S"],
          months: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
          monthsShort: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"]
        },
        /**
         * The combined height from the top/bottom borders.  'false' is the default
         * and generally the correct value.
         */
        extraHeight: false,
        /**
         * The combined width from the left/right borders.  'false' is the default
         * and generally the correct value.
         */
        extraWidth: false,
        /**
         * Private option, used to determine when a range is selected
         */
        lastSel: false
      },
      
      /**
       * Internal method which renders the calendar cells
       * 
       * @param HTMLDivElement el datepick container element
       */
      fill = function(el) {
        var options = $(el).data('datepick');
        var cal = $(el);
        var currentCal = Math.floor(options.calendars/2), date, data, dow, month, cnt = 0, days, indic, indic2, html, tblCal;
        
        cal.find('td>table tbody').remove();
        for(var i = 0; i < options.calendars; i++) {
          date = new Date(options.current);
          date.addMonths(-currentCal + i);
          tblCal = cal.find('table').eq(i+1);
          
          if(i == 0) tblCal.addClass('datepickFirstView');
          if(i == options.calendars - 1) tblCal.addClass('datepickLastView');
          
          if(tblCal.hasClass('datepickViewDays')) {
            dow = date.getMonthName(true)+", "+date.getFullYear();
          } else if(tblCal.hasClass('datepickViewMonths')) {
            dow = date.getFullYear();
          } else if(tblCal.hasClass('datepickViewYears')) {
            dow = (date.getFullYear()-6) + ' - ' + (date.getFullYear()+5);
          } 
          tblCal.find('thead tr:first th a:eq(1) span').text(dow);
          dow = date.getFullYear()-6;
          data = {
            data: [],
            className: 'datepickYears'
          }
          for( var j = 0; j < 12; j++) {
            data.data.push(dow + j);
          }
          // datepickYears template
          html = tmpl(tpl.months.join(''), data);
          date.setDate(1);
          data = {weeks:[], test: 10};
          month = date.getMonth();
          var dow = (date.getDay() - options.starts) % 7;
          date.addDays(-(dow + (dow < 0 ? 7 : 0)));
          cnt = 0;
          while(cnt < 42) {
            indic = parseInt(cnt/7,10);
            indic2 = cnt%7;
            if (!data.weeks[indic]) {
              data.weeks[indic] = {
                days: []
              };
            }
            data.weeks[indic].days[indic2] = {
              text: date.getDate(),
              classname: []
            };
            var today = new Date();
            if (today.getDate() == date.getDate() && today.getMonth() == date.getMonth() && today.getYear() == date.getYear()) {
              data.weeks[indic].days[indic2].classname.push('datepickToday');
            }
            if($.isArray(options.selectableDates) && options.selectableDates.length == 2) {
              if(date < options.selectableDates[0] || date > options.selectableDates[1]) {
                //data.weeks[indic].days[indic2].classname.push('datepickFuture');
                //data.weeks[indic].days[indic2].classname.push('datepickDisabled');
              }
            } else if (date > today) {
              // current month, date in future
              //data.weeks[indic].days[indic2].classname.push('datepickFuture');
            }
            
            if (month != date.getMonth()) {
              data.weeks[indic].days[indic2].classname.push('datepickNotInMonth');
              // disable clicking of the 'not in month' cells
              //data.weeks[indic].days[indic2].classname.push('datepickDisabled');
            }
            if (date.getDay() == 0) {
              data.weeks[indic].days[indic2].classname.push('datepickSunday');
            }
            if (date.getDay() == 6) {
              data.weeks[indic].days[indic2].classname.push('datepickSaturday');
            }
            var fromUser = options.onRenderCell(el, date);
            var val = date.valueOf();
            if(options.date && (!$.isArray(options.date) || options.date.length > 0)) {
              if (options.mode != 'tworanges') {
                if (fromUser.selected || options.date == val || ($.isArray(options.date) && $.inArray(val, options.date.slice(0,2)) > -1) || (options.mode == 'range' && val >= options.date[0] && val <= options.date[1])) {
                  data.weeks[indic].days[indic2].classname.push('datepickSelected');
                }
              } else {
                if ((val >= options.date[0] && val <= options.date[1]) || (val == options.date[0])) {
                        data.weeks[indic].days[indic2].classname.push('datepickSelected');
                      }
                if ((val >= options.date[2] && val <= options.date[3]) || (val == options.date[2])) {
                          data.weeks[indic].days[indic2].classname.push('datepickSelected2');
                        }
              }
            }
            if (fromUser.disabled) {
              //data.weeks[indic].days[indic2].classname.push('datepickDisabled');
            }
            if (fromUser.className) {
              data.weeks[indic].days[indic2].classname.push(fromUser.className);
            }
            data.weeks[indic].days[indic2].classname = data.weeks[indic].days[indic2].classname.join(' ');
            cnt++;
            date.addDays(1);
          }
          // Fill the datepickDays template with data
          html = tmpl(tpl.days.join(''), data) + html;
          
          data = {
            data: options.locale.monthsShort,
            className: 'datepickMonths'
          };
          tblCal.append(html);
        }
      },
      
      /**
       * Extends the Date object with some useful helper methods
       */
      extendDate = function(locale) {
        if (Date.prototype.tempDate) {
          return;
        }
        Date.prototype.tempDate = null;
        Date.prototype.months = locale.months;
        Date.prototype.monthsShort = locale.monthsShort;
        Date.prototype.getMonthName = function(fullName) {
          return this[fullName ? 'months' : 'monthsShort'][this.getMonth()];
        };
        Date.prototype.addDays = function (n) {
          this.setDate(this.getDate() + n);
          this.tempDate = this.getDate();
        };
        Date.prototype.addMonths = function (n) {
          if (this.tempDate == null) {
            this.tempDate = this.getDate();
          }
          this.setDate(1);
          this.setMonth(this.getMonth() + n);
          this.setDate(Math.min(this.tempDate, this.getMaxDays()));
        };
        Date.prototype.addYears = function (n) {
          if (this.tempDate == null) {
            this.tempDate = this.getDate();
          }
          this.setDate(1);
          this.setFullYear(this.getFullYear() + n);
          this.setDate(Math.min(this.tempDate, this.getMaxDays()));
        };
        Date.prototype.getMaxDays = function() {
          var tmpDate = new Date(Date.parse(this)),
            d = 28, m;
          m = tmpDate.getMonth();
          d = 28;
          while (tmpDate.getMonth() == m) {
            d ++;
            tmpDate.setDate(d);
          }
          return d - 1;
        };
      },
      
      /**
       * Internal method which lays out the calendar widget
       */
      layout = function(el) {
        var options = $(el).data('datepick');
        var cal = $('#' + options.id);
        if (options.extraHeight === false) {
          var divs = $(el).find('div');
          options.extraHeight = divs.get(0).offsetHeight + divs.get(1).offsetHeight;  // heights from top/bottom borders
          options.extraWidth = divs.get(2).offsetWidth + divs.get(3).offsetWidth;     // widths from left/right borders
        }
        var tbl = cal.find('table:first').get(0);
        var width = tbl.offsetWidth;
        var height = tbl.offsetHeight;
      },
      
      /**
       * Internal method, bound to the HTML datepick Element, onClick.
       * This is the function that controls the behavior of the calendar when
       * the title, next/previous, or a date cell is clicked on.
       */
      click = function(ev) {
    		ev.preventDefault();
        if ($(ev.target).is('span')) {
          ev.target = ev.target.parentNode;
        }
        var el = $(ev.target);
        if (el.is('a')) {
          ev.target.blur();
          //if (el.hasClass('datepickDisabled') || el.hasClass('datepickFuture')) {
            //return false;
         // }
          var options = $(this).data('datepick');
          var parentEl = el.parent();
          var tblEl = parentEl.parent().parent().parent();
          var tblIndex = $('table', this).index(tblEl.get(0)) - 1;
          var tmp = new Date(options.current);
          var tmpStart = new Date(options.current);
          var tmpEnd = new Date(options.current);
          var changed = false;
          var changedRange = false;
          var fillIt = false;
          var currentCal = Math.floor(options.calendars/2);
          
          if (parentEl.is('th')) {
            // clicking the calendar title
            
            if (el.hasClass('datepickMonth')) {
              // clicking on the title of a Month datepick
              tmp.addMonths(tblIndex - currentCal);
              tmpStart.addMonths(tblIndex - currentCal);
              tmpEnd.addMonths(tblIndex - currentCal);

              if (options.mode == 'tworanges') {
                var offset = (options.lastSel > 1) ? 2 : 0;
                var nextSel = (options.lastSel > 1) ? 0 : 2;
                // range, select the whole month
                options.date[offset] = (tmp.setHours(0,0,0,0)).valueOf();
                tmp.addDays(tmp.getMaxDays()-1);
                tmp.setHours(23,59,59,0);
                options.date[offset+1] = tmp.valueOf();
                fillIt = true;
                changed = true;
                options.lastSel = nextSel;
              }
            } else if (parentEl.parent().parent().is('thead')) {
              // clicked either next/previous arrows
              if(tblEl.eq(0).hasClass('datepickViewDays')) {
                options.current.addMonths(el.hasClass('datepickGoPrev') ? -1 : 1);
              }
              fillIt = true;
            }

          } else if (parentEl.is('td') && !parentEl.hasClass('datepickDisabled')) {
            // clicking the calendar grid
            if(tblEl.eq(0).hasClass('datepickViewMonths')) {
              // clicked a month cell
              options.current.setMonth(tblEl.find('tbody.datepickMonths td').index(parentEl));
              options.current.setFullYear(parseInt(tblEl.find('thead th a.datepickMonth span').text(), 10));
              options.current.addMonths(currentCal - tblIndex);
              tblEl.eq(0).toggleClass('datepickViewMonths datepickViewDays');
            }  else {
              // clicked a day cell
              //if (parentEl.hasClass('datepickFuture')) { // Prevent click on future cell
                //return false;
              //}
              var val = parseInt(el.text(), 10);
              tmp.addMonths(tblIndex - currentCal);
              if (parentEl.hasClass('datepickNotInMonth')) {
                tmp.addMonths(val > 15 ? -1 : 1);
              }
              tmp.setDate(val);
              var mapping_other = [1, 0, 3, 2];
              var mapping_first = [0, 0, 2, 2];
              var current = options.lastSel;
              var other = mapping_other[options.lastSel];
              var first = mapping_first[options.lastSel];
              var second = first + 1;
              if (current == first) {
                // first click: set to the start of the day
                options.date[first] = (tmp.setHours(0,0,0,0)).valueOf();
              }
              // get the very end of the day clicked
              val = (tmp.setHours(23,59,59,0)).valueOf();
              if (val < options.date[other]) {
                // second range click < first
                options.date[second] = options.date[first] + 86399000;  // starting date + 1 day
                options.date[first] = val - 86399000;  // minus 1 day
              } else {
                // initial range click, or final range click >= first
                options.date[second] = val;
              }
              var modulo = options.mode == 'range' ? 2 : 4;
              options.lastSel = (current + 1) % modulo;
              changed = true;
            }
            fillIt = true;
          }
          if(fillIt) {
            fill(this);
          }
          if(changed) {
            options.onChange.apply(this, prepareDate(options));
          }
        }
        return false;
      },

      /**
       * Internal method, called from the public getDate() method, and when
       * invoking the onChange callback function
       * 
       * @param object options with the following attributes: 'mode' which can
       *        be one of 'single', 'range', or 'multiple'.  Attribute 'date'
       *        which will be a single timestamp when 'mode' is 'single', or
       *        an array of timestamps otherwise.  Attribute 'el' which is the
       *        HTML element that datepick was invoked upon.
       * @return array where the first item is either a Date object, or an 
       *         array of Date objects, depending on the datepick mode, and
       *         the second item is the HTMLElement that datepick was invoked
       *         upon.
       */
      prepareDate = function (options) {
        var dates = null;
        dates = new Array();
        $(options.date).each(function(i, val){
          dates.push(new Date(val));
        });
        return [dates, options.el, options];
      },
      
      /**
       * Internal method, returns an object containing the viewport dimensions
       */
      getViewport = function () {
        var m = document.compatMode == 'CSS1Compat';
        return {
          l : window.pageXOffset || (m ? document.documentElement.scrollLeft : document.body.scrollLeft),
          t : window.pageYOffset || (m ? document.documentElement.scrollTop : document.body.scrollTop),
          w : window.innerWidth || (m ? document.documentElement.clientWidth : document.body.clientWidth),
          h : window.innerHeight || (m ? document.documentElement.clientHeight : document.body.clientHeight)
        };
      },
      
      /**
       * Internal method, returns true if el is a child of parentEl
       */
      isChildOf = function(parentEl, el, container) {
        if(parentEl == el) {
          return true;
        }
        if(parentEl.contains) {
          return parentEl.contains(el);
        }
        if( parentEl.compareDocumentPosition ) {
          return !!(parentEl.compareDocumentPosition(el) & 16);
        }
        var prEl = el.parentNode;
        while(prEl && prEl != container) {
          if(prEl == parentEl)
            return true;
          prEl = prEl.parentNode;
        }
        return false;
      },
      
      /**
       * Hide a non-inline datepick calendar.
       * 
       * Not applicable for inline datepicks.
       * 
       * @param ev Event object
       */
      hide = function (ev) {
        if (ev.target != ev.data.trigger && !isChildOf(ev.data.cal.get(0), ev.target, ev.data.cal.get(0))) {
          if (ev.data.cal.data('datepick').onBeforeHide.apply(this, [ev.data.cal.get(0)]) != false) {
            ev.data.cal.hide();
            ev.data.cal.data('datepick').onAfterHide.apply(this, [ev.data.cal.get(0)]);
            $(document).unbind('mousedown', hide);  // remove the global listener
          }
        }
      },
      
      /**
       * Internal method to normalize the selected date based on the current 
       * calendar mode.
       */
      normalizeDate = function (mode, date) {
        // if range/multi mode, make sure that the current date value is at least an empty array
        if(mode != 'single' && !date) date = [];
        // if we have a selected date and not a null or empty array
        if(date && (!$.isArray(date) || date.length > 0)) {
            // Create a standardized date depending on the calendar mode
            if (mode != 'single') {
              if (!$.isArray(date)) {
                date = [((new Date(date)).setHours(0,0,0,0)).valueOf()];
                if (mode == 'range') {
                  // create a range of one day
                  date.push(((new Date(date[0])).setHours(23,59,59,0)).valueOf());
                }
              } else {
                for (var i = 0; i < date.length; i++) {
                  date[i] = ((new Date(date[i])).setHours(0,0,0,0)).valueOf();
                }
                if (mode == 'range') {
                  // for range mode, create the other end of the range
                  if(date.length == 1) date.push(new Date(date[0]));
                  date[1] = ((new Date(date[1])).setHours(23,59,59,0)).valueOf();
                }
              }
            } else {
              // mode is single, convert date object into a timestamp
              date = ((new Date(date)).setHours(0,0,0,0)).valueOf();
            }
            // at this point date is either a timestamp at hour zero 
            //  for 'single' mode, an array of timestamps at hour zero for 
            //  'multiple' mode, or a two-item array with timestamps at hour
            //  zero and hour 23:59 for 'range' mode
        }
        return date;
      };


// <<- end var definition

    return {
      /**
       * 'Public' functions
       */
      
      /**
       * Called when element.datepick() is invoked
       * 
       * Note that 'this' is the HTML element that datepick was invoked upon
       * @see datepick()
       */
      init: function(options){
        options = $.extend({}, defaults, options||{});
        extendDate(options.locale);
        options.calendars = Math.max(1, parseInt(options.calendars,10)||1);
        options.mode = /single|multiple|range/.test(options.mode) ? options.mode : 'single';
        
        return this.each(function(){
          if (!$(this).data('datepick')) {
            options.el = this;
            
            options.date = normalizeDate(options.mode, options.date);
            
            if (!options.current) {
              options.current = new Date();
            } else {
              options.current = new Date(options.current);
            } 
            options.current.setDate(1);
            options.current.setHours(0,0,0,0);
            
            var id = 'datepick_' + parseInt(Math.random() * 1000), cnt;
            options.id = id;
            $(this).data('datepickId', options.id);
            var cal = $(tpl.wrapper).attr('id', id).bind('click', click).data('datepick', options);
            if (options.className) {
              cal.addClass(options.className);
            }
            var html = '';
            for (var i = 0; i < options.calendars; i++) {
              cnt = options.starts;
              if (i > 0) {
                html += tpl.space;
              }
              // calendar header template
              html += tmpl(tpl.head.join(''), {
                prev: options.prev,
                next: options.next,
                day1: options.locale.daysMin[(cnt++)%7],
                day2: options.locale.daysMin[(cnt++)%7],
                day3: options.locale.daysMin[(cnt++)%7],
                day4: options.locale.daysMin[(cnt++)%7],
                day5: options.locale.daysMin[(cnt++)%7],
                day6: options.locale.daysMin[(cnt++)%7],
                day7: options.locale.daysMin[(cnt++)%7]
              });
            }
            cal
              .find('tr:first').append(html)
                .find('table').addClass(views[options.view]);
            fill(cal.get(0));
            if (options.inline) {
              cal.appendTo(this).show().css('position', 'relative');
              layout(cal.get(0));
            } else {
              cal.appendTo(document.body);
              $(this).bind(options.showOn, show);
            }
          }
          if (/range/.test(options.mode)) {
            cal.addClass('selectableRange');
          }
        });
      },
      
      /**
       * Shows the datepick, applicable only when the picker is not inline
       * 
       * @return the datepick HTML element
       * @see datepickShow()
       */
      showPicker: function() {
        return this.each( function() {
          if ($(this).data('datepickId')) {
            var cal = $('#' + $(this).data('datepickId'));
            var options = cal.data('datepick');
            if(!options.inline) {
              show.apply(this);
            }
          }
        });
      },
      
      /**
       * Hides the datepick, applicable only when the picker is not inline
       * 
       * @return the datepick HTML element
       * @see datepickHide()
       */
      hidePicker: function() {
        return this.each( function() {
          if ($(this).data('datepickId')) {
            var cal = $('#' + $(this).data('datepickId'));
            var options = cal.data('datepick');
            if(!options.inline) {
              $('#' + $(this).data('datepickId')).hide();
            }
          }
        });
      },
      
    /**
     * Sets the datepick current date, and optionally shifts the current
     * calendar to that date.
     * 
     * @param Date|String|int|Array date The currently selected date(s).  
     *        This can be: a single date, an array 
     *        of two dates (sets a range when 'mode' is 'range'), or an array of
     *        any number of dates (selects all dates when 'mode' is 'multiple'.  
     *        The supplied dates can be any one of: Date object, milliseconds 
     *        (as from date.getTime(), date.valueOf()), or a date string 
     *        parseable by Date.parse().
     * @param boolean shiftTo if true, shifts the visible calendar to the
     *        newly set date(s)
     * 
     * @see datepickSetDate()
     */
    setDate: function(date, shiftTo){
      return this.each(function(){
        if ($(this).data('datepickId')) {
          var cal = $('#' + $(this).data('datepickId'));
          var options = cal.data('datepick');
          options.date = normalizeDate(options.mode, date);
          
          if (shiftTo) {
            options.current = new Date(options.mode != 'single' ? options.date[0] : options.date);
          }
          fill(cal.get(0));
        }
      });
    },

    /**
     * Returns the currently selected date(s) and the datepick element.
     * 
     * @return array where the first element is the selected date(s)  When calendar mode  is 'single' this
     *        is a single date object, or null if no date is selected.  When calendar mode is 'range', this is an array containing 
     *        a 'from' and 'to' date objects, or the empty array if no date range is selected.  When calendar mode is 'multiple' this
     *       	is an array of Date objects, or the empty array if no date is selected.
     *        The second element is the HTMLElement that datepick was invoked upon
     * 
     * @see datepickGetDate()
     */
    getDate: function() {
      if (this.size() > 0) {
        return prepareDate($('#' + $(this).data('datepickId')).data('datepick'));
      }
    },

    /**
     * Clears the currently selected date(s)
     * 
     * @see datepickClear()
     */
    clear: function(){
      return this.each(function(){
        if ($(this).data('datepickId')) {
          var cal = $('#' + $(this).data('datepickId'));
          var options = cal.data('datepick');
          if (options.mode == 'single') {
            options.date = null;
          } else {
            options.date = [];
          }
          fill(cal.get(0));
        }
      });
    },

    /**
     * Only applicable when the datepick is inline
     * 
     * @see datepickLayout()
     */
    fixLayout: function(){
      return this.each(function(){
        if ($(this).data('datepickId')) {
          var cal = $('#' + $(this).data('datepickId'));
          var options = cal.data('datepick');
          if(options.inline) {
            layout(cal.get(0));
          }
        }
      });
    },

	  /**
	   * Returns options.lastSel
	   */
	  getLastSel: function() {
		var cal = $('#' + $(this).data('datepickId'));
		var options = cal.data('datepick');
		return options.lastSel;
	  },
	  
	  /**
	   * Sets options.lastSel
	   */
	  setLastSel: function(lastSel) {
		var cal = $('#' + $(this).data('datepickId'));
		var options = cal.data('datepick');
		options.lastSel = parseInt(lastSel);
	  },
	  
	  /**
	   * Returns options.mode
	   */
	  getMode: function() {
		var cal = $('#' + $(this).data('datepickId'));
		var options = cal.data('datepick');
		return options.mode;
	  },
	  
	  /**
	   * Sets options.mode
	   */
	  setMode: function(mode) {
		var cal = $('#' + $(this).data('datepickId'));
		var options = cal.data('datepick');
		options.mode = mode;
		fill(cal);
	  }
    };
  }();  // datepick

  // Extend jQuery with the following functions so that they can be called on HTML elements, ie: $('#widgetCalendar').datepick();
  $.fn.extend({
    datepick: datepick.init,
    datepickHide: datepick.hidePicker,
    datepickShow: datepick.showPicker,
    datepickSetDate: datepick.setDate,
    datepickGetDate: datepick.getDate,
    datepickClear: datepick.clear,
    datepickGetLastSel: datepick.getLastSel,
    datepickSetLastSel: datepick.setLastSel,
    datepickGetMode: datepick.getMode,
    datepickSetMode: datepick.setMode,
    datepickLayout: datepick.fixLayout
  });

})(jQuery);

(function(){
  // within here, 'this' refers to the window object
  var cache = {};

  this.tmpl = function tmpl(str, data){
    // Figure out if we're getting a template, or if we need to
    // load the template - and be sure to cache the result.
    var fn = !/\W/.test(str) ?
      cache[str] = cache[str] ||
        tmpl(document.getElementById(str).innerHTML) :

      // Generate a reusable function that will serve as a template
      // generator (and which will be cached).
      new Function("obj",
        "var p=[],print=function(){p.push.apply(p,arguments);};" +
        // Introduce the data as local variables using with(){}
        "with(obj){p.push('" +
        // Convert the template into pure JavaScript
        str
          .replace(/[\r\t\n]/g, " ")
          .split("<%").join("\t")
          .replace(/((^|%>)[^\t]*)'/g, "$1\r")
          .replace(/\t=(.*?)%>/g, "',$1,'")
          .split("\t").join("');")
          .split("%>").join("p.push('")
          .split("\r").join("\\'")
      + "');}return p.join('');");
    // Provide some basic currying to the user
    return data ? fn( data ) : fn;
  };

})(jQuery);
