
		$(function() {
  			$('input[name="datetimes"]').daterangepicker({
    			timePicker: true,
          minDate: moment().startOf('hour'),
    			startDate: moment().startOf('hour'),
    			endDate: moment().startOf('hour').add(32, 'hour'),
    			locale: {
      				format: 'M/DD hh:mm A'
    			}
  			});
		});