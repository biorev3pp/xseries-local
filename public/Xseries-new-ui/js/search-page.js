$(document).on('click', '.dropdown-menu', function (e) {
    e.stopPropagation();
});
function openNav() {
    document.getElementById("myNav").style.width = "250px";
    $(".sliding-modal").modal("hide");
}
/* Close */
function closeNav() {
    document.getElementById("myNav").style.width = "0%";
}
$(function () {
    $('[data-toggle="tooltip"]').tooltip()
})
//Light Gallery
$('#animated-thumbnails').lightGallery({
    thumbnail:true
});
$(".property-list-tabs-main .nav-item .nav-link").click(function(){
    $(this).addClass('button-active');
});
$(".sliding-modal").on('hide.bs.modal', function(){
    $(".property-list-tabs-main .nav-item .nav-link").removeClass('button-active');
});
// Search Select Select2
$('.js-example-basic-single').select2({
    placeholder: 'Select City',
});
//Bootstrap dropdown
$('.dropdown').on('show.bs.dropdown', function () {
    $(this).find('.select-filter-input').addClass('filter-button-active');
});
$('.dropdown').on('hide.bs.dropdown', function () {
    $(this).find('.select-filter-input').removeClass('filter-button-active');
});
// Map Icon
$(".map-mobile-icon").click(function(){
    $("#x-content-col-right").addClass("map-show");
    $("#x-content-col-left").addClass("content-hide-mobile");
    $(".back-map").addClass("show-back-map");
    $(this).addClass("map-icon-hide");
})
$(".back-map").click(function(){
    $("#x-content-col-right").removeClass("map-show");
    $("#x-content-col-left").removeClass("content-hide-mobile");
    $(this).removeClass("show-back-map");
    $('.map-mobile-icon').removeClass("map-icon-hide");
})
$(".brochure-image-wrapper").lightGallery({
    thumbnails:false
});
// brochure Hover effect
$(".sliding-modal .brochure-image-wrapper img, .sliding-modal .modal-body .middle").mouseenter(function(){
    $('.sliding-modal .modal-body .middle').addClass('middle-show');
    $('.sliding-modal .brochure-image-wrapper img').addClass('img-fade');
});
    $(".sliding-modal .brochure-image-wrapper img").mouseout(function(){
    $('.sliding-modal .modal-body .middle').removeClass('middle-show');
    $('.sliding-modal .brochure-image-wrapper img').removeClass('img-fade');
});
//Price Formatter
var formatter = new Intl.NumberFormat('en-US', {
style: 'currency',
currency: 'USD',
minimumFractionDigits: 0,
maximumFractionDigits: 0
});
//Area Formatter
var areaFormatter = new Intl.NumberFormat('en-US', {
style: 'decimal',
minimumFractionDigits: 0,
maximumFractionDigits: 0
});
//Download Brochure
$('#brochure-download').click(function(){
    var a = document.createElement('a');
    a.href = $(this).next().find('img').attr('src');
    a.download = $(this).next().find('img').attr('src');
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
})
$("#apply-button").click(function(){
    $("#mobile-filter").submit(); 
})

// Common Filters
//Price Filter
$(".price-filter").ionRangeSlider({
    type: "double",
    min: minPrice,
    max: maxPrice,
    from: fromPrice,
    to: toPrice,
    grid: false,
    skin: "round",
    hide_min_max: true,    
    hide_from_to: true,
    onStart: function(data){
        $(".select-fil-d-main .dropdown-menu .price .start-value").html(formatter.format(data.from));
        $(".select-fil-d-main .dropdown-menu .price .end-value").html(formatter.format(data.to));
        $(".price-badge").html(`${formatter.format(data.from)} - ${formatter.format(data.to)}`);
    },
    onChange: function (data) {
        $(".select-fil-d-main .dropdown-menu .price .start-value").html(formatter.format(data.from));
        $(".select-fil-d-main .dropdown-menu .price .end-value").html(formatter.format(data.to));
        $(".price-badge").html(`${formatter.format(data.from)} - ${formatter.format(data.to)}`);
    },
    onFinish: function(data){  
        if(window.innerWidth > 1023){
            $("#form-filter").submit(); 
        }
    }
});
//Area Filter
$(".area-filter").ionRangeSlider({
    type: "double",
    min: minArea,
    max: maxArea,
    from: fromArea,
    to: toArea,
    grid: false,
    skin: "round",
    hide_min_max: true,    
    hide_from_to: true,
    onStart: function(data){
        $(".select-fil-d-main .dropdown-menu .area .start-value").html(`${areaFormatter.format(data.from)} sqft`);
        $(".select-fil-d-main .dropdown-menu .area .end-value").html(`${areaFormatter.format(data.to)} sqft`);
        $(".area-badge").html(`Sqft ${areaFormatter.format(data.from)} - ${areaFormatter.format(data.to)}`);
    },
    onChange: function (data) {
        $(".select-fil-d-main .dropdown-menu .area .start-value").html(`${areaFormatter.format(data.from)} sqft`);
        $(".select-fil-d-main .dropdown-menu .area .end-value").html(`${areaFormatter.format(data.to)} sqft`);
        $(".area-badge").html(`Sqft ${areaFormatter.format(data.from)} - ${areaFormatter.format(data.to)}`);
    },
    onFinish: function(data){
        if(window.innerWidth > 1023){
            $("#form-filter").submit();
        }
    }
});
//Bed Filter
$(".bed-filter").ionRangeSlider({
    type: "double",
    min: minBed,
    max: maxBed,
    from: fromBed,
    to: toBed,
    grid: false,
    skin: "round",
    hide_min_max: true,    
    hide_from_to: true,
    step:0.5,
    onStart: function(data){
        $(".select-fil-d-main .dropdown-menu .bed .start-value").html(`${data.from}`);
        $(".select-fil-d-main .dropdown-menu .bed .end-value").html(`${data.to}`);
        $(".bed-badge").html(`${data.from} - ${data.to}`);
    },
    onChange: function (data) {
        $(".select-fil-d-main .dropdown-menu .bed .start-value").html(`${data.from}`);
        $(".select-fil-d-main .dropdown-menu .bed .end-value").html(`${data.to}`);
        $(".bed-badge").html(`${data.from} - ${data.to}`);
    },
    onFinish: function(data){
        if(window.innerWidth > 1023){
            $("#form-filter").submit(); 
        }
    }
});
//Bath Filter
$(".bath-filter").ionRangeSlider({
    type: "double",
    min: minBath, 
    max: maxBath,
    from: fromBath,
    to: toBath,
    grid: false,
    skin: "round",
    hide_min_max: true,    
    hide_from_to: true,
    step:0.5,
    onStart: function(data){
        $(".select-fil-d-main .dropdown-menu .bath .start-value").html(`${data.from}`);
        $(".select-fil-d-main .dropdown-menu .bath .end-value").html(`${data.to}`);
        $(".bath-badge").html(`${data.from} - ${data.to}`);
    },
    onChange: function (data) {
        $(".select-fil-d-main .dropdown-menu .bath .start-value").html(`${data.from}`);
        $(".select-fil-d-main .dropdown-menu .bath .end-value").html(`${data.to}`);
        $(".bath-badge").html(`${data.from} - ${data.to}`);
    },
    onFinish: function(data){
        if(window.innerWidth > 1023){
            $("#form-filter").submit();
        }
    }
});

// CheckBox Click
$('input[type="checkbox"].ccheckbox').click(function(){
    $('input:checkbox').parent().parent().removeClass('show-compare');
    if($('input:checkbox:checked').length >= 2) {
        $('input:checkbox:not(":checked")').removeAttr('disabled');
        $('input:checkbox:checked').parent().parent().addClass('show-compare');
        $(".property-list-compare span.compare").click(function(){
            if($(this).prev().find('input').prop('checked') == true){
                compareNow();
            }
        })
    } else {
        $('input:checkbox').parent().parent().removeClass('show-compare');
    }
    if($('input:checkbox:checked').length >= 3) {
        $('input:checkbox:not(":checked")').attr('disabled', 'disabled');
        toastr.info("You have selected maximum number of comparisons");
    }
});

//Community Pages
if(currentRoute == "community" || currentRoute == "elevation-communities")
{
    //Compare
    function compareNow() {
        var i;
        var comarray = [];
        $("input:checkbox:checked").each(function(){
        comarray.push($(this).val());
        });
        if($('input:checkbox:checked').length >= 2) {
            $('#comparelist').html('<p class="p-4 text-center"><img src="/images/spinner.gif"></p>');
            $('#compreModelCenter').modal('show');
            var i;
            var cbox = '<table class="table table-bordered table-striped"><thead><tr><th id="feature-list-wrapper" style="width:200px; position:relative;"><div class="w-100 feature-list-tag">Feature List</div><div style="position: absolute; left: 0;right: 0;top: 45%;margin: 0 auto;padding: 8px 12px;background: #eaeaea;width: 90%;text-align: left;border: 1px solid #ddd;">All Features</div></th>';
            for (i = 0; i < $('input:checkbox:checked').length; i++) {
                cbox += '<th style="width:auto; height:150px;"><img src="/uploads/'+$('#cominfo'+comarray[i]).attr('data-image')+'" style="width:auto; object-fit:cover; height:100%;">'+'</th>';
            }
            cbox += '</tr></thead><tbody style="text-align:left;text-transform:uppercase;"><tr><td style="font-weight:500; color:#000;">Name</td>';
            for (i = 0; i < $('input:checkbox:checked').length; i++) {
                cbox += '<td style="font-weight:500; color:#000;"> '+$('#cominfo'+comarray[i]).attr('data-title')+'</td>';
            }
            cbox += '</tr><tr><td style="font-weight:500; color:#000;">Price</td>';
            for (i = 0; i < $('input:checkbox:checked').length; i++) {
                cbox += '<td class="price" style="color"><span style="color:#666;">'+$('#cominfo'+comarray[i]).attr('data-price')+'</span></td>';
            }
            cbox += '</tr><tr><td style="font-weight:500; color:#000;">Area</td>';
            for (i = 0; i < $('input:checkbox:checked').length; i++) {
                cbox += '<td style="color:#666;">'+$('#cominfo'+comarray[i]).attr('data-area')+'</td>';
            }
            cbox += '</tr><tr><td style="font-weight:500; color:#000;">Community Type</td>';
            for (i = 0; i < $('input:checkbox:checked').length; i++) {
                cbox += '<td style="color:#666;">Value</td>';
            }
            cbox += '</tr><tr><td style="font-weight:500; color:#000;">School</td>';
            for (i = 0; i < $('input:checkbox:checked').length; i++) {
                cbox += '<td style="color:#666;">Value</td>';
            }
            cbox += '</tr></tbody></table>';
            $('#comparelist').html(cbox);
        } 
    }
}

if(currentRoute == "elevation" || currentRoute == "search-elevation")
{
    // Slick Slider & Light Gallery
    var $carousel = $('.slider-for');
    $carousel.lightGallery({
        thumbnail: true,
        animateThumb: false,
        showThumbByDefault: false,
        mode: 'lg-slide-circular'
    });
    // Card's slider
    $carousel.slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: true,
        fade: true,
        adaptiveHeight: true,
        asNavFor: '.slider-nav',
        cssEase: 'linear',
        speed: 500,
    });
    $('.slider-nav').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        asNavFor: '.slider-for',
        dots: false,
        focusOnSelect: true,
        variableWidth: true,
        arrows:false,
    });
    $("#aniimated-thumbnials img").click(function(){
        $(".sliding-modal").modal('hide');
    });
    $(".gallery").on('show.bs.modal', function(){
        $carousel.slick('unslick').slick('reinit').slick();
    });
    //Types Modal Event
    $('.types').on('show.bs.modal', function () {
        $(".progressbar #pb-elevation").addClass("complete");
        $(".progressbar #pb-elevation span").html("done");
        $(".progressbar #pb-elevation-type").addClass("active");
    });
    $('.types').on('hide.bs.modal', function () {
        $(".progressbar #pb-elevation").removeClass("complete");
        $(".progressbar #pb-elevation span").html("home");
        $(".progressbar #pb-elevation-type").removeClass("active");
    });
    // Light Gallery Floor
    $('.floor-map-img-main').lightGallery({
        thumbnail:true,
        animateThumb: true,
        showThumbByDefault: false
    });  
    var floor = $('.floor-map-img-main');
    floor.lightGallery();
    floor.on('onBeforeSlide.lg', function(event, prevIndex, index){
        $(".inner-sliding-modal").modal("hide");
        $('.lg-outer').css('background-color', 'rgba(255,255,255,0.9)')
    });
    // Floor Hover effect
    $(".sliding-modal .floor-map-img-main img, .sliding-modal .modal-body .middle").mouseenter(function(){
        $('.sliding-modal .modal-body .middle').addClass('middle-show');
        $('.sliding-modal .floor-map-img-main img').addClass('img-fade');
    });
        $(".sliding-modal .floor-map-img-main img").mouseout(function(){
        $('.sliding-modal .modal-body .middle').removeClass('middle-show');
        $('.sliding-modal .floor-map-img-main img').removeClass('img-fade');
    });

    function compareNow() {
        var i;
        var homearray = [];
        $("input:checkbox:checked").each(function(){
            homearray.push($(this).val());
        });
        if($('input:checkbox:checked').length >= 2) {
            $('#comparelist').html('<p class="p-4 text-center"><img src="/images/spinner.gif"></p>');
            $('#compreModelCenter').modal('show');
            var i;
            var cbox = '<table class="table table-bordered table-striped"><thead><tr><th id="feature-list-wrapper" style="width:200px; position:relative;"><div class="w-100 feature-list-tag">Feature List</div><div style="position: absolute; left: 0;right: 0;top: 45%;margin: 0 auto;padding: 8px 12px;background: #eaeaea;width: 90%;text-align: left;border: 1px solid #ddd;">All Features</div></th>';
            for (i = 0; i < $('input:checkbox:checked').length; i++) {
            cbox += '<th style="width:auto; height:150px;"><img src="/uploads/homes/'+$('#homeinfo'+homearray[i]).attr('data-image')+'" style="width:100%; object-fit:cover; height:100%;">'+'</th>';
            }
            cbox += '</tr></thead><tbody style="text-align:left;text-transform:uppercase;"><tr><td style="font-weight:500; color:#000;">Name</td>';
            for (i = 0; i < $('input:checkbox:checked').length; i++) {
            cbox += '<td style="font-weight:500; color:#000;"> '+$('#homeinfo'+homearray[i]).attr('data-title')+'</td>';
            }
            cbox += '</tr><tr><td style="font-weight:500; color:#000;">Price</td>';
            for (i = 0; i < $('input:checkbox:checked').length; i++) {
            cbox += '<td class="price" style="color"><span style="color:#666;">$ '+$('#homeinfo'+homearray[i]).attr('data-price')+'</span></td>';
            }
            cbox += '</tr><tr><td style="font-weight:500; color:#000;">Area</td>';
            for (i = 0; i < $('input:checkbox:checked').length; i++) {
            cbox += '<td style="color:#666;">'+$('#homeinfo'+homearray[i]).attr('data-area')+' sqft</td>';
            }
            cbox += '</tr><tr><td style="font-weight:500; color:#000;">Bed</td>';
            for (i = 0; i < $('input:checkbox:checked').length; i++) {
            cbox += '<td style="color:#666;">'+$('#homeinfo'+homearray[i]).attr('data-bed')+'</td>';
            }
            cbox += '</tr><tr><td style="font-weight:500; color:#000;">Bath</td>';
            for (i = 0; i < $('input:checkbox:checked').length; i++) {
            cbox += '<td style="color:#666;">'+$('#homeinfo'+homearray[i]).attr('data-bath')+'</td>';
            }
            cbox += '</tr><tr><td style="font-weight:500; color:#000;">Garage</td>';
            for (i = 0; i < $('input:checkbox:checked').length; i++) {
            cbox += '<td style="color:#666;">'+$('#homeinfo'+homearray[i]).attr('data-garage')+'</td>';
            }
            cbox += '</tr><tr><td style="font-weight:500; color:#000;">Floor</td>';
            for (i = 0; i < $('input:checkbox:checked').length; i++) {
            cbox += '<td style="color:#666;">'+$('#homeinfo'+homearray[i]).attr('data-floor')+'</td>';
            }
            cbox += '</tr></tbody></table>';
            $('#comparelist').html(cbox);
            
        } else {
            // toastr.warning('Please select atleast two elevations to compare.');
        }
    }

    $("#apply-button").click(function(){
        $("#mobile-filter").submit(); 
    });
}