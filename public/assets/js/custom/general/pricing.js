"use strict";

// Class definition
var KTPricingPlan = function () {
    // Private variables
    var pricing;
	var planPeriodMonthButton;
	var planPeriodAnnualButton;

	var changePlanPrices = function(type) {
		var items = [].slice.call(pricing.querySelectorAll('[data-kt-plan-price-month]'));

		items.map(function (item) {
			var monthPrice = item.getAttribute('data-kt-plan-price-month');
			var annualPrice = item.getAttribute('data-kt-plan-price-annual');

			if ( type === 'month' ) {
				item.innerHTML = monthPrice;
			} else if ( type === 'annual' ) {
				item.innerHTML = annualPrice;
			}
		});
	}

    var handlePlanPeriodSelection = function() {
        // Handle period change
        planPeriodMonthButton.addEventListener('click', function (e) {
            changePlanPrices('month');
        });

		planPeriodAnnualButton.addEventListener('click', function (e) {
            changePlanPrices('annual');
        });
    }

    var handleTabs = function() {
        KTUtil.on(pricing, '[data-bs-toggle="tab"]', 'click', function(e) {
            this.querySelector('[type="radio"]').checked = true;
        });
    }

    // Public methods
    return {
        init: function () {
            // Elements
            pricing = document.querySelector('#kt_pricing_plan');

            if (!pricing) {
				return;
			}

			planPeriodMonthButton = pricing.querySelector('[data-kt-plan="month"]');
			planPeriodAnnualButton = pricing.querySelector('[data-kt-plan="annual"]');

            // Handlers
            handlePlanPeriodSelection();
            handleTabs();
        }
    }
}();

// On document ready
KTUtil.onDOMContentLoaded(function() {
    KTPricingPlan.init();
});
