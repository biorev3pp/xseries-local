(function() {
    $(function() {
      if(currentRoute == 'xhome'){
        var $demo, duration, remaining, tour;
        $demo = $("#demo");
        duration = 5000;
        remaining = duration;

        tour = new Tour({
            /* onStart: function() {
                return $demo.addClass("disabled", true);
            },
            onEnd: function() {
                return $demo.removeClass("disabled", true);
            }, */
            debug: true,
            backdrop: true,
            backdropContainer: 'body',
            backdropPadding: 0,
            storage: false,
            smartPlacement: true,
            keyboard: true,
            steps: [{
                element: ".pb_container",
                placement: "bottom",
                title: "Progress Bar",
                content: "Track your progress via the detailed progress bar for each section."
            }, {
                element: "#header-account-button",
                placement: "bottom",
                title: "Login / Register",
                content: "Login to the website if already registered/ Signup or you can also register by clicking here."
            }, {
                element: ".nav-item1",
                placement: "bottom",
                title: "Community Details",
                content: "The community image along with the community gallery."
            }, {
                element: ".nav-item2",
                placement: "bottom",
                title: "Elevation And Elevation Types",
                content: "This section will have elevation and it's multiple elevation types."
            }, {
                element: ".nav-item3",
                placement: "bottom",
                title: "Color Schemes",
                content: "The list of available color schemes for the selected elevation is here."
            }, {
                element: ".nav-item4",
                placement: "bottom",
                title: "Notes",
                content: "Here you can make your notes and save it.",
            }, {
                element: ".dbrochure",
                placement: "right",
                title: "Download Brochure",
                content: "The brochure for the community is available in this section.",
            }, {
                element: ".gintouch",
                placement: "right",
                title: "Get In Touch",
                content: "Contact with our team for any queries.",
            }, {
                element: ".proinfo",
                placement: "right",
                title: "Property Info",
                content: "Detailed information about the selected elevation and the lot.",
            }, {
                element: ".mcalculate",
                placement: "right",
                title: "Mortgage Calculator",
                content: "Tells you about the detailed Mortgage calculations for the lot and the elevation selected.",
            }, {
                element: ".checklocation",
                placement: "right",
                title: "Check Location",
                content: "Gives you a detailed information about your community and surroundings.",
            },{
                element: ".pestimate",
                placement: "right",
                title: "Estimate",
                content: "You can generate estimate by clicking on this icon.",
            },{
                element: ".pbtns",
                placement: "top",
                title: "Previous",
                content: "Go back to the previous page.",
            }, {
                element: ".footer-title",
                placement: "top",
                title: "Selected Community",
                content: "The name of the selected community and the elevation.",
            }, {
                element: ".fns-btn",
                placement: "top",
                title: "Continue",
                content: "Go to the next page and customize the floor of your choice.",
            }],
            template: "<div class='popover tour'><div class='arrow'></div><h3 class='popover-title'></h3><div class='popover-content'></div><div class='row my-2 mx-0'><div class='col-4 p-0 pl-2'><button class='tour-left-btn' data-role='prev'>Prev</button></div><div class='col-4 p-0 text-center'><button class='tour-center-btn' data-role='end'>End tour</button></div><div class='col-4 p-0 text-right pr-2'><button class='tour-right-btn' data-role='next'>Next</button></div></div></div>",
            onShown: function(tour) {
                var tours = tour._options.steps;
                var tlength = tour._options.steps.length - 1;
                var cstep;
                if (tour._current == null || tour._current == 0) {
                    cstep = 0;
                    $('.tour-tour .tour-left-btn').attr('disabled', 'disabled');
                } else {
                    cstep = tour._current;
                    $('.tour-tour .tour-left-btn').removeAttr('disabled');
                }
                if (cstep == tlength) {
                    $('.tour-tour .tour-right-btn').attr('disabled', 'disabled');
                } else {
                    $('.tour-tour .tour-right-btn').removeAttr('disabled');
                }
                $('.tour-tour .popover-title').html(tours[cstep].title);
                $('.tour-tour .popover-content').html(tours[cstep].content);
                if (tours[cstep].element == '.login') {
                    $('.tour-step-background').addClass('lbtn-pos').removeClass('lbsn-pos2 lbs-btn3').html($(tours[cstep].element).html());
                } else if (tours[cstep].element == '.fns-btn') {
                    $('.tour-step-background').addClass('lbtn-pos3').removeClass('lbsn-pos lbs-btn2').html($(tours[cstep].element).html());
                } else if (tours[cstep].element == '.pbtns') {
                    $('.tour-step-background').addClass('lbtn-pos2').removeClass('lbsn-pos lbs-btn3').html($(tours[cstep].element).html());
                } else if (tours[cstep].element == '.dbrochure') {
                    $('.tour-step-background').removeClass('lbtn-pos lbsn-pos2 lbs-btn3').html('<span class="material-icons dbrochure">' + $(tours[cstep].element).html() + '</span>');
                } else if (tours[cstep].element == '.gintouch') {
                    $('.tour-step-background').removeClass('lbtn-pos lbsn-pos2 lbs-btn3').html('<span class="material-icons gintouch">' + $(tours[cstep].element).html() + '</span>');
                } else if (tours[cstep].element == '.proinfo') {
                    $('.tour-step-background').removeClass('lbtn-pos lbsn-pos2 lbs-btn3').html('<span class="material-icons proinfo">' + $(tours[cstep].element).html() + '</span>');
                } else if (tours[cstep].element == '.mcalculate') {
                    $('.tour-step-background').removeClass('lbtn-pos lbsn-pos2 lbs-btn3').html('<span class="material-icons mcalculate">' + $(tours[cstep].element).html() + '</span>');
                } else if (tours[cstep].element == '.checklocation') {
                    $('.tour-step-background').removeClass('lbtn-pos lbsn-pos2 lbs-btn3').html('<span class="material-icons checklocation">' + $(tours[cstep].element).html() + '</span>');
                } else if (tours[cstep].element == '.pestimate') {
                    $('.tour-step-background').removeClass('lbtn-pos lbsn-pos2 lbs-btn3').html('<span class="material-icons pestimate">' + $(tours[cstep].element).html() + '</span>');
                } else { $('.tour-step-background').removeClass('lbtn-pos lbsn-pos2 lbs-btn3').html($(tours[cstep].element).html()); }
            },
            onEnd: function(tour) {
                $('.tour.tour-tour').remove();
            },

        });
        $('#pstart-btn').on("click", function(e) {
            e.preventDefault();
            $("#FeatureTourModal").modal("hide");
            // Initialize the tour
            tour.init();
            // Start the tour
            tour.start();
            tour.restart();
            return $(".alert").alert("close");
        });
        $('#demo').on("click", function() {
            $("#FeatureTourModal").modal("show");
        });
        $("html").smoothScroll();
      }
      else if(currentRoute == 'xfloor'){
        var $demo, duration, remaining, tour;
        $demo = $("#demo");
        duration = 5000;
        remaining = duration;

        tour = new Tour({
            /* onStart: function() {
                return $demo.addClass("disabled", true);
            },
            onEnd: function() {
                return $demo.removeClass("disabled", true);
            }, */
            debug: true,
            backdrop: true,
            backdropContainer: 'body',
            backdropPadding: 0,
            storage: false,
            smartPlacement: true,
            keyboard: true,
            steps: [{
                element: ".pb_container",
                placement: "bottom",
                title: "Progress Bar",
                content: "Track your progress via the detailed progress bar for each section."
            }, {
                element: "#header-account-button",
                placement: "bottom",
                title: "Login / Register",
                content: "Login to the website if already registered/ Signup or you can also register by clicking here."
            }, {
                element: ".nav-item1",
                placement: "bottom",
                title: "Community Details",
                content: "The community image along with the community gallery."
            }, {
                element: ".nav-item2",
                placement: "bottom",
                title: "Elevation",
                content: "This section will have the selected elevation."
            }, {
                element: ".nav-item3",
                placement: "bottom",
                title: "Floor Plan",
                content: "The list of available options for floor customization."
            }, {
                element: ".nav-item4",
                placement: "bottom",
                title: "Notes",
                content: "Here you can make your notes and save it.",
            }, {
                element: ".dbrochure",
                placement: "right",
                title: "Download Brochure",
                content: "The brochure for the community is available in this section.",
            }, {
                element: ".gintouch",
                placement: "right",
                title: "Get In Touch",
                content: "Contact with our team for any queries.",
            }, {
                element: ".proinfo",
                placement: "right",
                title: "Property Info",
                content: "Detailed information about the selected elevation.",
            }, {
                element: ".mcalculate",
                placement: "right",
                title: "Mortgage Calculator",
                content: "Tells you about the detailed Mortgage calculations for the lot and the elevation selected.",
            }, {
                element: ".checklocation",
                placement: "right",
                title: "Check Location",
                content: "Gives you a detailed information about your community and surroundings.",
            },{
                element: ".refrest-btn",
                placement: "right",
                title: "Reset",
                content: "Reset the size of the image if zoomed in.",
            },{
                element: ".zoomin-btn",
                placement: "right",
                title: "Zoom In",
                content: "Zoom in to the floor image.",
            }, {
                element: ".zoomout-btn",
                placement: "right",
                title: "Zoom Out",
                content: "Zoom out of the floor image.",
            },{
                element: ".pbtns",
                placement: "top",
                title: "Previous",
                content: "Go back to the previous page.",
            }, {
                element: ".footer-title",
                placement: "top",
                title: "Selected Community",
                content: "The name of the selected community and the elevation.",
            }, {
                element: ".fns-btn",
                placement: "top",
                title: "Estimate",
                content: "Go to the final page and generate the estimate by finalizing your choices.    ",
            }],
            template: "<div class='popover tour'><div class='arrow'></div><h3 class='popover-title'></h3><div class='popover-content'></div><div class='row my-2 mx-0'><div class='col-4 p-0 pl-2'><button class='tour-left-btn' data-role='prev'>Prev</button></div><div class='col-4 p-0 text-center'><button class='tour-center-btn' data-role='end'>End tour</button></div><div class='col-4 p-0 text-right pr-2'><button class='tour-right-btn' data-role='next'>Next</button></div></div></div>",
            onShown: function(tour) {
                var tours = tour._options.steps;
                var tlength = tour._options.steps.length - 1;
                var cstep;
                if (tour._current == null || tour._current == 0) {
                    cstep = 0;
                    $('.tour-tour .tour-left-btn').attr('disabled', 'disabled');
                } else {
                    cstep = tour._current;
                    $('.tour-tour .tour-left-btn').removeAttr('disabled');
                }
                if (cstep == tlength) {
                    $('.tour-tour .tour-right-btn').attr('disabled', 'disabled');
                } else {
                    $('.tour-tour .tour-right-btn').removeAttr('disabled');
                }
                $('.tour-tour .popover-title').html(tours[cstep].title);
                $('.tour-tour .popover-content').html(tours[cstep].content);
                if (tours[cstep].element == '.login') {
                    $('.tour-step-background').addClass('lbtn-pos').removeClass('lbsn-pos2 lbs-btn3').html($(tours[cstep].element).html());
                } else if (tours[cstep].element == '.fns-btn') {
                    $('.tour-step-background').addClass('lbtn-pos3').removeClass('lbsn-pos lbs-btn2').html($(tours[cstep].element).html());
                } else if (tours[cstep].element == '.pbtns') {
                    $('.tour-step-background').addClass('lbtn-pos2').removeClass('lbsn-pos lbs-btn3').html($(tours[cstep].element).html());
                } else if (tours[cstep].element == '.dbrochure') {
                    $('.tour-step-background').removeClass('lbtn-pos lbsn-pos2 lbs-btn3').html('<span class="material-icons dbrochure">' + $(tours[cstep].element).html() + '</span>');
                } else if (tours[cstep].element == '.gintouch') {
                    $('.tour-step-background').removeClass('lbtn-pos lbsn-pos2 lbs-btn3').html('<span class="material-icons gintouch">' + $(tours[cstep].element).html() + '</span>');
                } else if (tours[cstep].element == '.proinfo') {
                    $('.tour-step-background').removeClass('lbtn-pos lbsn-pos2 lbs-btn3').html('<span class="material-icons proinfo">' + $(tours[cstep].element).html() + '</span>');
                } else if (tours[cstep].element == '.mcalculate') {
                    $('.tour-step-background').removeClass('lbtn-pos lbsn-pos2 lbs-btn3').html('<span class="material-icons mcalculate">' + $(tours[cstep].element).html() + '</span>');
                } else if (tours[cstep].element == '.checklocation') {
                    $('.tour-step-background').removeClass('lbtn-pos lbsn-pos2 lbs-btn3').html('<span class="material-icons checklocation">' + $(tours[cstep].element).html() + '</span>');
                } else if (tours[cstep].element == '.pestimate') {
                    $('.tour-step-background').removeClass('lbtn-pos lbsn-pos2 lbs-btn3').html('<span class="material-icons pestimate">' + $(tours[cstep].element).html() + '</span>');
                } else { $('.tour-step-background').removeClass('lbtn-pos lbsn-pos2 lbs-btn3').html($(tours[cstep].element).html()); }
            },
            onEnd: function(tour) {
                $('.tour.tour-tour').remove();
            },

        });
        $('#pstart-btn').on("click", function(e) {
            e.preventDefault();
            $("#FeatureTourModal").modal("hide");
            // Initialize the tour
            tour.init();
            // Start the tour
            tour.start();
            tour.restart();
            return $(".alert").alert("close");
        });
        $('#demo').on("click", function() {
            $("#FeatureTourModal").modal("show");
        });
        $("html").smoothScroll();
      }
      else{
        var $demo, duration, remaining, tour;
        $demo = $("#demo");
        duration = 5000;
        remaining = duration;

        tour = new Tour({
            /* onStart: function() {
                return $demo.addClass("disabled", true);
            },
            onEnd: function() {
                return $demo.removeClass("disabled", true);
            }, */
            debug: true,
            backdrop: true,
            backdropContainer: 'body',
            backdropPadding: 0,
            storage: false,
            smartPlacement: true,
            keyboard: true,
            steps: [{
                element: ".pb_container",
                placement: "bottom",
                title: "Progress Bar",
                content: "Track your progress via the detailed progress bar for each section."
            }, {
                element: "#header-account-button",
                placement: "bottom",
                title: "Login / Register",
                content: "Login to the website if already registered/ Signup or you can also register by clicking here."
            }, {
                element: ".nav-item1",
                placement: "bottom",
                title: "Community Details",
                content: "The community image along with the availability of plats denoted with different colour legends."
            }, {
                element: ".nav-item2",
                placement: "bottom",
                title: "Image Gallery",
                content: "This section will have multiple Images of the Community selected for your reference."
            }, {
                element: ".nav-item3",
                placement: "bottom",
                title: "Available Now",
                content: "The list of available lots in the selected community."
            }, {
                element: ".nav-item4",
                placement: "bottom",
                title: "Filter",
                content: "To select the filtered list of elevation as per your selected lot.",
            }, {
                element: ".dbrochure",
                placement: "right",
                title: "Download Brochure",
                content: "The brochure for the community is available in this section.",
            }, {
                element: ".gintouch",
                placement: "right",
                title: "Get In Touch",
                content: "Contact with our team for any queries.",
            }, {
                element: ".proinfo",
                placement: "right",
                title: "Property Info",
                content: "Detailed information about the selected elevation and the lot.",
            }, {
                element: ".mcalculate",
                placement: "right",
                title: "Mortgage Calculator",
                content: "Tells you about the detailed Mortgage calculations for the lot and the elevation selected.",
            }, {
                element: ".checklocation",
                placement: "right",
                title: "Check Location",
                content: "Gives you a detailed information about your community and surroundings.",
            },{
                element: ".pestimate",
                placement: "right",
                title: "Estimate",
                content: "You can generate estimate by clicking on this icon.",
            }, {
                element: ".refrest-btn",
                placement: "right",
                title: "Reset",
                content: "Reset the size of the image if zoomed in and also the lot selection.",
            }, {
                element: ".zoomin-btn",
                placement: "right",
                title: "Zoom In",
                content: "Zoom in to the lots image.",
            }, {
                element: ".zoomout-btn",
                placement: "right",
                title: "Zoom Out",
                content: "Zoom out of the lots image.",
            }, {
                element: ".pbtns",
                placement: "top",
                title: "Previous",
                content: "Go back to the previous page.",
            }, {
                element: ".footer-title",
                placement: "top",
                title: "Selected Community",
                content: "The name of the selected community and the elevation.",
            }, {
                element: ".fns-btn",
                placement: "top",
                title: "Continue",
                content: "Go to the next page and customize the home of your choice.",
            }],
            template: "<div class='popover tour'><div class='arrow'></div><h3 class='popover-title'></h3><div class='popover-content'></div><div class='row my-2 mx-0'><div class='col-4 p-0 pl-2'><button class='tour-left-btn' data-role='prev'>Prev</button></div><div class='col-4 p-0 text-center'><button class='tour-center-btn' data-role='end'>End tour</button></div><div class='col-4 p-0 text-right pr-2'><button class='tour-right-btn' data-role='next'>Next</button></div></div></div>",
            onShown: function(tour) {
                var tours = tour._options.steps;
                var tlength = tour._options.steps.length - 1;
                var cstep;
                if (tour._current == null || tour._current == 0) {
                    cstep = 0;
                    $('.tour-tour .tour-left-btn').attr('disabled', 'disabled');
                } else {
                    cstep = tour._current;
                    $('.tour-tour .tour-left-btn').removeAttr('disabled');
                }
                if (cstep == tlength) {
                    $('.tour-tour .tour-right-btn').attr('disabled', 'disabled');
                } else {
                    $('.tour-tour .tour-right-btn').removeAttr('disabled');
                }
                $('.tour-tour .popover-title').html(tours[cstep].title);
                $('.tour-tour .popover-content').html(tours[cstep].content);
                if (tours[cstep].element == '.login') {
                    $('.tour-step-background').addClass('lbtn-pos').removeClass('lbsn-pos2 lbs-btn3').html($(tours[cstep].element).html());
                } else if (tours[cstep].element == '.fns-btn') {
                    $('.tour-step-background').addClass('lbtn-pos3').removeClass('lbsn-pos lbs-btn2').html($(tours[cstep].element).html());
                } else if (tours[cstep].element == '.pbtns') {
                    $('.tour-step-background').addClass('lbtn-pos2').removeClass('lbsn-pos lbs-btn3').html($(tours[cstep].element).html());
                } else if (tours[cstep].element == '.dbrochure') {
                    $('.tour-step-background').removeClass('lbtn-pos lbsn-pos2 lbs-btn3').html('<span class="material-icons dbrochure">' + $(tours[cstep].element).html() + '</span>');
                } else if (tours[cstep].element == '.gintouch') {
                    $('.tour-step-background').removeClass('lbtn-pos lbsn-pos2 lbs-btn3').html('<span class="material-icons gintouch">' + $(tours[cstep].element).html() + '</span>');
                } else if (tours[cstep].element == '.proinfo') {
                    $('.tour-step-background').removeClass('lbtn-pos lbsn-pos2 lbs-btn3').html('<span class="material-icons proinfo">' + $(tours[cstep].element).html() + '</span>');
                } else if (tours[cstep].element == '.mcalculate') {
                    $('.tour-step-background').removeClass('lbtn-pos lbsn-pos2 lbs-btn3').html('<span class="material-icons mcalculate">' + $(tours[cstep].element).html() + '</span>');
                } else if (tours[cstep].element == '.checklocation') {
                    $('.tour-step-background').removeClass('lbtn-pos lbsn-pos2 lbs-btn3').html('<span class="material-icons checklocation">' + $(tours[cstep].element).html() + '</span>');
                } else if (tours[cstep].element == '.pestimate') {
                    $('.tour-step-background').removeClass('lbtn-pos lbsn-pos2 lbs-btn3').html('<span class="material-icons pestimate">' + $(tours[cstep].element).html() + '</span>');
                } else { $('.tour-step-background').removeClass('lbtn-pos lbsn-pos2 lbs-btn3').html($(tours[cstep].element).html()); }
            },
            onEnd: function(tour) {
                $('.tour.tour-tour').remove();
            },

        });
        $('#pstart-btn').on("click", function(e) {
            e.preventDefault();
            $("#FeatureTourModal").modal("hide");
            // Initialize the tour
            tour.init();
            // Start the tour
            tour.start();
            tour.restart();
            return $(".alert").alert("close");
        });
        $('#demo').on("click", function() {
            $("#FeatureTourModal").modal("show");
        });
        $("html").smoothScroll();
      }  

    });

}).call(this);