"use strict";

// Class definition
var KTWidgets = function() {
	// Lists widgets
	var initListsWidget3 = function() {
		var element = document.getElementById("kt_lists_widget_3_chart");

		var labelColor = KTUtil.getCssVariableValue('--bs-gray-500');
		var borderColor = KTUtil.getCssVariableValue('--bs-gray-200');

		var baseColor = KTUtil.getCssVariableValue('--bs-primary');
		var secondaryColor = KTUtil.getCssVariableValue('--bs-info');

		if (!element) {
			return;
		}

		var height = parseInt(KTUtil.css(element, 'height'));

		var options = {
			series: [{
				name: 'Net Profit',
				data: [40, 50, 65, 70, 50, 30]
			}, {
				name: 'Revenue',
				data: [-30, -40, -55, -60, -40, -20]
			}],
			chart: {
				fontFamily: 'inherit',
				type: 'bar',
				stacked: true,
				height: 350,
				toolbar: {
					show: false
				}
			},
			plotOptions: {
				bar: {
					borderRadius: 8,
					horizontal: false,
					columnWidth: ['12%'],
					borderRadius: 4
				},
			},
			legend: {
				show: false
			},
			dataLabels: {
				enabled: false
			},
			stroke: {
				show: true,
				width: 2,
				colors: ['transparent']
			},
			xaxis: {
				categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
				axisBorder: {
					show: false,
				},
				axisTicks: {
					show: false
				},
				labels: {
					style: {
						colors: labelColor,
						fontSize: '12px'
					}
				}
			},
			yaxis: {
				min: -80,
				max: 80,
				labels: {
					style: {
						colors: labelColor,
						fontSize: '12px'
					}
				}
			},
			fill: {
				opacity: 1
			},
			states: {
				normal: {
					filter: {
						type: 'none',
						value: 0
					}
				},
				hover: {
					filter: {
						type: 'none',
						value: 0
					}
				},
				active: {
					allowMultipleDataPointsSelection: false,
					filter: {
						type: 'none',
						value: 0
					}
				}
			},
			tooltip: {
				style: {
					fontSize: '12px'
				},
				y: {
					formatter: function(val) {
						return "$" + val + " thousands"
					}
				}
			},
			colors: [baseColor, secondaryColor],
			grid: {
				borderColor: borderColor,
				strokeDashArray: 4,
				yaxis: {
					lines: {
						show: true
					}
				}
			}
		};
		
		var chart = new ApexCharts(element, options);
		chart.render();
	}

	// Chart widgets    
	var initChartWidget2 = function(tabSelector, chartSelector, data, initByDefault) {
		var element = document.querySelector(chartSelector);

		if (!element) {
			return;
		}

		var height = parseInt(KTUtil.css(element, 'height'));

		var options = {
			series: [{
				name: 'Profit',
				data: data
			}],
			chart: {
				fontFamily: 'inherit',
				type: 'bar',
				height: height,
				toolbar: {
					show: false
				}
			},
			plotOptions: {
				bar: {
					horizontal: false,
					columnWidth: ['30%'],
					borderRadius: 4
				}
			},
			legend: {
				show: false
			},
			dataLabels: {
				enabled: false
			},
			stroke: {
				show: true,
				width: 2,
				colors: ['transparent']
			},
			xaxis: {
				crosshairs: {
					show: false
				},
				categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
				axisBorder: {
					show: false,
				},
				axisTicks: {
					show: false
				},
				labels: {
					style: {
						colors: KTUtil.getCssVariableValue('--bs-gray-400'),
						fontSize: '12px'
					}
				}
			},
			yaxis: {
				crosshairs: {
					show: false
				},
				labels: {
					style: {
						colors: KTUtil.getCssVariableValue('--bs-gray-400'),
						fontSize: '12px'
					}
				}
			},
			states: {
				normal: {
					filter: {
						type: 'none',
						value: 0
					}
				},
				hover: {
					filter: {
						type: 'none',
					}
				},
				active: {
					allowMultipleDataPointsSelection: false,
					filter: {
						type: 'none',
						value: 0
					}
				}
			},
			fill: {
				opacity: 1
			},
			tooltip: {
				style: {
					fontSize: '12px'
				},
				y: {
					formatter: function(val) {
						return "$" + val + "k"
					}
				}
			},
			colors: [KTUtil.getCssVariableValue('--bs-primary')],
			grid: {
				borderColor: KTUtil.getCssVariableValue('--bs-gray-300'),
				strokeDashArray: 4,
				yaxis: {
					lines: {
						show: true
					}
				}
			}
		};
		
		var chart = new ApexCharts(element, options);

		var init = false;
		var tab = document.querySelector(tabSelector);

		if (initByDefault === true) {
			chart.render();
			init = true;
		}

		tab.addEventListener('shown.bs.tab', function(event) {
			if (init == false) {
				chart.render();
				init = true;
			}
		})
	}

	// Mixed widgets
	var initMixedWidget1 = function() {
		var element = document.getElementById("kt_mixed_widget_1_chart");

		if (!element) {
			return;
		}

		var height = parseInt(element.getAttribute('data-kt-height'));

		var options = {
			series: [68],
			chart: {
				fontFamily: 'inherit',
				height: height,
				type: 'radialBar',
                toolbar: {
					show: false
				}
			},
			grid: {
				padding: {
            		//top: 0
          		}
			},
			plotOptions: {
				radialBar: {
					borderRadius: 4,
					startAngle: -90,
					endAngle: 90,	
					hollow: {
						margin: 0,
						size: "70%"
					},
					dataLabels: {
						showOn: "always",
						name: {
							show: true,
							fontFamily: 'inherit',
							fontSize: "13px",
							fontWeight: 500,
							offsetY: -4,
							color: KTUtil.getCssVariableValue('--bs-gray-400')
						},
						value: {
							color: KTUtil.getCssVariableValue('--bs-info'),
							fontFamily: 'inherit',
							fontSize: "30px",
							fontWeight: 700,
							offsetY: -40,
							show: true																			
						}
					},
					track: {
						background: KTUtil.getCssVariableValue('--bs-light-info'),
						strokeWidth: '100%'
					}
				}
			},
			colors: [KTUtil.getCssVariableValue('--bs-info')],
			stroke: {
				lineCap: "round"				
			},			 
			labels: ["Weekly Followers"],
			grid: {
				padding: {
					bottom: 0						  
				}
			}
		};

		var chart = new ApexCharts(element, options);
		chart.render();
	}

	var initMixedWidget2 = function() {		
        var element = document.getElementById("kt_mixed_widget_2_chart");

		if (!element) {
			return;
		}

		var height = parseInt(KTUtil.css(element, 'height'));

		var options = {
			series: [{
				name: 'Inflation',
				data: [2.3, 3.1, 4.0, 10.1, 4.0, 3.6, 3.2]
			}],
			chart: {
                fontFamily: 'inherit',
				height: height,
				type: 'bar',
                toolbar: {
					show: false
				}
			},
            grid: {
                show: false,
				padding: {
					top: 0,
					bottom: -5
				}
            },
			plotOptions: {
				bar: {
					borderRadius: 10,
					dataLabels: {
						position: 'top', // top, center, bottom
					},
				}
			},
			dataLabels: {
				enabled: false,
				formatter: function(val) {
					return val + "%";
				},
				offsetY: -20,
				style: {
					fontSize: '12px',
					colors: ["#304758"]
				}
			},

			xaxis: {
                labels: {
					show: false,
                },
				categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul"],
				position: 'top',
				axisBorder: {
					show: false
				},
				axisTicks: {
					show: false
				},
				crosshairs: {
                    show: false
				},
				tooltip: {
					enabled: false,
				}
			},
			yaxis: {
                show: false,
				 
				axisTicks: {
					show: false,
				},
				labels: {
					show: false,
					formatter: function(val) {
						return val + "%";
					}
				}

			},
			title: {
				text: 'Monthly Inflation in Argentina, 2002',
				floating: true,
				offsetY: 330,
				align: 'center',
				style: {
					color: '#444'
				}
			}
		};
		
		var chart = new ApexCharts(element, options);
		chart.render();
	}

	// Statistics widgets
	var initStatisticsWidget1 = function() {
		var charts = document.querySelectorAll('.statistics-widget-1-chart');

		[].slice.call(charts).map(function(element) {
			var height = parseInt(KTUtil.css(element, 'height'));

			if (!element) {
				return;
			}

			var color = element.getAttribute('data-kt-chart-color');

			var labelColor = KTUtil.getCssVariableValue('--bs-' + 'gray-800');
			var baseColor = KTUtil.getCssVariableValue('--bs-' + color);
			var lightColor = KTUtil.getCssVariableValue('--bs-light-' + color);

			var options = {
				series: [{
					name: 'Net Profit',
					data: [30, 45, 32, 70, 40]
				}],
				chart: {
					fontFamily: 'inherit',
					type: 'area',
					height: height,
					toolbar: {
						show: false
					},
					zoom: {
						enabled: false
					},
					sparkline: {
						enabled: true
					}
				},
				plotOptions: {},
				legend: {
					show: false
				},
				dataLabels: {
					enabled: false
				},
				fill: {
					type: 'solid',
					opacity: 0.3
				},
				stroke: {
					curve: 'smooth',
					show: true,
					width: 3,
					colors: [baseColor]
				},
				xaxis: {
					categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
					axisBorder: {
						show: false,
					},
					axisTicks: {
						show: false
					},
					labels: {
						show: false,
						style: {
							colors: labelColor,
							fontSize: '12px'
						}
					},
					crosshairs: {
						show: false,
						position: 'front',
						stroke: {
							color: '#E4E6EF',
							width: 1,
							dashArray: 3
						}
					},
					tooltip: {
						enabled: true,
						formatter: undefined,
						offsetY: 0,
						style: {
							fontSize: '12px'
						}
					}
				},
				yaxis: {
					min: 0,
					max: 80,
					labels: {
						show: false,
						style: {
							colors: labelColor,
							fontSize: '12px'
						}
					}
				},
				states: {
					normal: {
						filter: {
							type: 'none',
							value: 0
						}
					},
					hover: {
						filter: {
							type: 'none',
							value: 0
						}
					},
					active: {
						allowMultipleDataPointsSelection: false,
						filter: {
							type: 'none',
							value: 0
						}
					}
				},
				tooltip: {
					style: {
						fontSize: '12px'
					},
					y: {
						formatter: function(val) {
							return "$" + val + " thousands"
						}
					}
				},
				colors: [baseColor],
				markers: {
					colors: [baseColor],
					strokeColor: [lightColor],
					strokeWidth: 3
				}
			};

			var chart = new ApexCharts(element, options);
			chart.render();
		});
	}

	// Dark mode toggler
	var initDarkModeToggle = function() {
        var toggle = document.querySelector('#kt_user_menu_dark_mode_toggle');
        
        if (toggle) {
            toggle.addEventListener('click', function() {
                window.location.href = this.getAttribute('data-kt-url');
            });
        }
    }

	// Calendar
    var initCalendarWidget1 = function() {
        if (typeof FullCalendar === 'undefined' || !document.querySelector('#kt_calendar_widget_1')) {
            return;
        }

        var todayDate = moment().startOf('day');
        var YM = todayDate.format('YYYY-MM');
        var YESTERDAY = todayDate.clone().subtract(1, 'day').format('YYYY-MM-DD');
        var TODAY = todayDate.format('YYYY-MM-DD');
        var TOMORROW = todayDate.clone().add(1, 'day').format('YYYY-MM-DD');

        var calendarEl = document.getElementById('kt_calendar_widget_1');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
            },

            height: 800,
            contentHeight: 780,
            aspectRatio: 3,  // see: https://fullcalendar.io/docs/aspectRatio

            nowIndicator: true,
            now: TODAY + 'T09:25:00', // just for demo

            views: {
                dayGridMonth: { buttonText: 'month' },
                timeGridWeek: { buttonText: 'week' },
                timeGridDay: { buttonText: 'day' }
            },

            initialView: 'dayGridMonth',
            initialDate: TODAY,

            editable: true,
            dayMaxEvents: true, // allow "more" link when too many events
            navLinks: true,
            events: [
                {
                    title: 'All Day Event',
                    start: YM + '-01',
                    description: 'Toto lorem ipsum dolor sit incid idunt ut',
                    className: "fc-event-danger fc-event-solid-warning"
                },
                {
                    title: 'Reporting',
                    start: YM + '-14T13:30:00',
                    description: 'Lorem ipsum dolor incid idunt ut labore',
                    end: YM + '-14',
                    className: "fc-event-success"
                },
                {
                    title: 'Company Trip',
                    start: YM + '-02',
                    description: 'Lorem ipsum dolor sit tempor incid',
                    end: YM + '-03',
                    className: "fc-event-primary"
                },
                {
                    title: 'ICT Expo 2017 - Product Release',
                    start: YM + '-03',
                    description: 'Lorem ipsum dolor sit tempor inci',
                    end: YM + '-05',
                    className: "fc-event-light fc-event-solid-primary"
                },
                {
                    title: 'Dinner',
                    start: YM + '-12',
                    description: 'Lorem ipsum dolor sit amet, conse ctetur',
                    end: YM + '-10'
                },
                {
                    id: 999,
                    title: 'Repeating Event',
                    start: YM + '-09T16:00:00',
                    description: 'Lorem ipsum dolor sit ncididunt ut labore',
                    className: "fc-event-danger"
                },
                {
                    id: 1000,
                    title: 'Repeating Event',
                    description: 'Lorem ipsum dolor sit amet, labore',
                    start: YM + '-16T16:00:00'
                },
                {
                    title: 'Conference',
                    start: YESTERDAY,
                    end: TOMORROW,
                    description: 'Lorem ipsum dolor eius mod tempor labore',
                    className: "fc-event-primary"
                },
                {
                    title: 'Meeting',
                    start: TODAY + 'T10:30:00',
                    end: TODAY + 'T12:30:00',
                    description: 'Lorem ipsum dolor eiu idunt ut labore'
                },
                {
                    title: 'Lunch',
                    start: TODAY + 'T12:00:00',
                    className: "fc-event-info",
                    description: 'Lorem ipsum dolor sit amet, ut labore'
                },
                {
                    title: 'Meeting',
                    start: TODAY + 'T14:30:00',
                    className: "fc-event-warning",
                    description: 'Lorem ipsum conse ctetur adipi scing'
                },
                {
                    title: 'Happy Hour',
                    start: TODAY + 'T17:30:00',
                    className: "fc-event-info",
                    description: 'Lorem ipsum dolor sit amet, conse ctetur'
                },
                {
                    title: 'Dinner',
                    start: TOMORROW + 'T05:00:00',
                    className: "fc-event-solid-danger fc-event-light",
                    description: 'Lorem ipsum dolor sit ctetur adipi scing'
                },
                {
                    title: 'Birthday Party',
                    start: TOMORROW + 'T07:00:00',
                    className: "fc-event-primary",
                    description: 'Lorem ipsum dolor sit amet, scing'
                },
                {
                    title: 'Click for Google',
                    url: 'http://google.com/',
                    start: YM + '-28',
                    className: "fc-event-solid-info fc-event-light",
                    description: 'Lorem ipsum dolor sit amet, labore'
                }
            ]
        });

        calendar.render();
    }

	// Public methods
	return {
		init: function() {
			// Dark Mode
			initDarkModeToggle();

			// Calendar
			initCalendarWidget1();
			
			// Lists Widgets
			initListsWidget3();

			// Mixed Widgets
			initMixedWidget1();
			initMixedWidget2();

			// Lists Widgets
			initStatisticsWidget1();

			// Chart Widgets           
			initChartWidget2('#kt_charts_widget_2_tab_1', '#kt_charts_widget_2_chart_1', [30, 40, 30, 25, 40, 45, 30, 20, 40, 25, 20, 30], true);

			initChartWidget2('#kt_charts_widget_2_tab_2', '#kt_charts_widget_2_chart_2', [25, 30, 25, 45, 30, 40, 30, 25, 40, 20, 25, 30], false);
		}
	}
}();

// On document ready
KTUtil.onDOMContentLoaded(function() {
	KTWidgets.init();
});