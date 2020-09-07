var list = $(".filter-tabs-main nav div a");
$.each(list, function(){
    $(this).removeClass('waves-effect waves-light');
});
// code for submit contact us form
$('#contact_submit').submit(function(e){
    e.preventDefault();
    var username = $('#username').val();
    var useremail = $('#useremail').val();
    var usermobile = $('#usermobile').val();
    var userMessage = $('#userMessage').val();
    $.ajax({
        type: 'post',
        url: '/api/contact-mail',
        data: {
        'name':  username,
        'email': useremail,
        'usermobile': usermobile,
        'userMessage': userMessage
        },
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success: function(result){
            if(result[0] =='success')
            { 
                toastr.success('Success! Email Sent.')
                $('#get-in-touch-modal').modal('hide');
                $('#username').val('');
                $('#useremail').val('');
                $('#usermobile').val('');
                $('#userMessage').val('');
            }
        },
        error: function(err){
            toastr.error('Kindly fill the form carefully.');
        }
    });
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
// Mortgage Calculator
function calculatePayment() 
{
    var principal = document.getElementById("amount").value;
    principal = principal.replace(/[|&;$%@"<>()+,]/g, "");

    var termOfLoan = document.getElementById("term").value;
    var annualInterestRate = document.getElementById("rate").value;
    var total_downpay = document.getElementById("downpay_amt").value;
    total_downpay = total_downpay.replace(/[|&;$%@"<>()+,]/g, "");

    if ( termOfLoan.match("y") ) 
    {
        termOfLoan = parseInt( termOfLoan.replace(/[^\d.]/ig, ''), 10 )*12;
    } 
    else 
    {
        termOfLoan = parseInt( termOfLoan.replace(/[^\d.]/ig, ''), 10 );
    }
    var total_pay = principal - total_downpay;
    var monthly_interest = annualInterestRate / 100 / 12;
    var x = Math.pow( 1 + monthly_interest, termOfLoan), 
    monthlyPayment = ( total_pay * x * monthly_interest ) / ( x - 1 );
    var a = Math.round(monthlyPayment);
    var b = "$";
    var position = 1;
    //var output = b + a.substr(0, position) + a.substr(position);
    var output = b + a;
    document.getElementById("payment").innerHTML = output;
    document.getElementById("payments").innerHTML = output;
    var downpay_amt = document.getElementById("downpay_amt").value;
    downpay_amt = downpay_amt.replace(/[|&;$%@"<>()+,]/g, "");
    var total_income = monthlyPayment * termOfLoan + parseInt(downpay_amt);
    var income = Math.round(total_income);
    var tot_inc = b + income;
    document.getElementById("paymentss").innerHTML = tot_inc;
}

function downrate()
{
    var principal = document.getElementById("amount").value;
    principal = principal.replace(/[|&;$%@"<>()+,]/g, "");
    var down_rate = document.getElementById("downpay_rate").value;
    var total_downpay = (principal * down_rate) / 100;
    var c = total_downpay;
    var down_output = c;
    document.getElementById("downpay_amt").value = down_output;
    calculatePayment();
}

function downpayment()
{
    var principal = document.getElementById("amount").value;
    principal = principal.replace(/[|&;$%@"<>()+,]/g, "");
    var down = document.getElementById("downpay_amt").value;
    down = down.replace(/[|&;$%@"<>()+,]/g, "");
    var per = (down * 100) / principal;
    var percent = per.toFixed(0);
    document.getElementById("downpay_rate").value = percent;
    calculatePayment();
}
if(!sessionStorage.getItem('hide-welcome-message')){
    $('#feature-tour-message').fadeIn();
}
$("#feature-tour-button").mouseenter(function(){
    $("#feature-tour-message").fadeOut();
    sessionStorage.setItem('hide-welcome-message', true);
})
// Light Gallery Brochure
$('.brochure-image-wrapper').lightGallery({
    thumbnail:true,
    animateThumb: true,
    showThumbByDefault: false,
    mode: 'lg-slide-circular'
});  
var brochure = $('.brochure-image-wrapper');
brochure.lightGallery();
brochure.on('onBeforeSlide.lg', function(event, prevIndex, index){
    $(".inner-sliding-modal").modal("hide");
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
    $('.lg-outer').css('background-color', 'rgba(255,255,255,0.9)')
});
// Slick Slider & Light Gallery
var tabsCarousel = $('.carousel-gallery');
tabsCarousel.lightGallery({
    thumbnail: true,
    animateThumb: false,
    showThumbByDefault: false,
    mode: 'lg-slide-circular'
});
// Card's slider
tabsCarousel.slick({
    infinite: true,
    speed: 500,
    fade: true,
    cssEase: 'linear',
    dots: false,
    arrows: true,
    autoplay: true,
    adaptiveHeight: true
});
var propertyModalCarousel = $('.property-image');
// Sliding Modal
$(".inner-sliding-modal").on('show.bs.modal', function(){
    $('.inner-sliding-modal').not(this).modal('hide');
});
$("#property-modal").on('show.bs.modal', function(){
    propertyModalCarousel.slick('unslick').slick('reinit').slick();
});  
$(".inner-sliding-modal").on('hidden.bs.modal', function(){
    $('body').addClass('modal-open');
});
//Brochure hover effect
$(".inner-sliding-modal .modal-dialog.modal-notify .modal-body .brochure-image-wrapper img, .inner-sliding-modal .modal-dialog.modal-notify .modal-body .brochure-image-wrapper a .middle").mouseover(function(){
    $('.inner-sliding-modal .modal-dialog.modal-notify .modal-body .brochure-image-wrapper a .middle').addClass('middle-show');
    $('.inner-sliding-modal .modal-dialog.modal-notify .modal-body .brochure-image-wrapper img').addClass('img-fade');
});
$(".inner-sliding-modal .modal-dialog.modal-notify .modal-body .brochure-image-wrapper img").mouseout(function(){
    $('.inner-sliding-modal .modal-dialog.modal-notify .modal-body .brochure-image-wrapper a .middle').removeClass('middle-show');
    $('.inner-sliding-modal .modal-dialog.modal-notify .modal-body .brochure-image-wrapper img').removeClass('img-fade');
});
// Floor Hover effect
$("#property-modal .floor-map-img-main img, .inner-sliding-modal .modal-dialog.modal-notify .modal-body .middle").mouseenter(function(){
    $('.inner-sliding-modal .modal-dialog.modal-notify .modal-body .middle').addClass('middle-show');
    $('#property-modal .floor-map-img-main img').addClass('img-fade');
});
    $("#property-modal .floor-map-img-main img").mouseout(function(){
    $('.inner-sliding-modal .modal-dialog.modal-notify .modal-body .middle').removeClass('middle-show');
    $('#property-modal .floor-map-img-main img').removeClass('img-fade');
});
$("#tray-menu .right-arrow").click(function(){
    $(".tray-menu-buttons").toggleClass('tray-menu-buttons-show');
    $('#tray-menu').toggleClass('w-95');
    $(this).toggleClass('rotate-arrow');
});
$(".footer .close-arrow").click(function(){
    $('.footer .footer-btns').toggleClass('hide-footer-btns');
    $(".footer").toggleClass('close-footer');
    $('.footer .close-arrow span').toggleClass('rotate-arrow');
});
// Slick Slider & Light Gallery
propertyModalCarousel.lightGallery({
        thumbnail: true,
        animateThumb: false,
        showThumbByDefault: false,
        mode: 'lg-slide-circular'
});
// Card's slider
propertyModalCarousel.slick({
    infinite: true,
    speed: 500,
    fade: true,
    cssEase: 'linear',
});
propertyModalCarousel.on('onBeforeSlide.lg', function(event, prevIndex, index){
    $(".inner-sliding-modal").modal("hide");
});

// X-Plat
if(currentRoute == "xplat" || currentRoute == "plat")
{
    // Decalring Variables
    var filter_lot_id;
    var counter = 0;
    var scale = 1;

    // Progress Bar
    $("#pb-elevation-type, #pb-elevation, #pb-community").addClass('active complete');
    $(".progressbar li.complete span").html("done");
    $("#pb-lot").addClass('active');

    // Ui Changes
    window.onload = function(){
        var list = $(".filter-tabs-main nav div a");
        $.each(list, function(){
            $(this).removeClass('waves-effect waves-light');
        });
    }

    //Mortgage Calculator
    function setPayment () {
        var val = parseInt(document.getElementById("slot_id").value) + parseInt(document.getElementById("shome_id").value);
        document.getElementById("amount").value = val;
        document.getElementById("amount_display").innerHTML = formatter.format(val);
        downrate();
    }
    
    // Lot Tooltip
    function showPopup() {
        var lotInfoOnHover = document.getElementById("lotInfoOnHover");
        $("g").mouseover(function () {
            var las = $(this).attr("legend-alias");
            if (typeof las !== typeof undefined && las !== false) {
                var legendAlias = $(this).attr("legend-alias");
                var legendStatus = $(this).attr("legend-name");
                var legendPrice = $(this).attr("data-price");
                var iconPos = this.getBoundingClientRect();
                lotInfoOnHover.style.left = (iconPos.right ) + "px";
                lotInfoOnHover.style.top = (window.scrollY + iconPos.top - 140) + "px";
                lotInfoOnHover.style.display = "block";
                lotInfoOnHover.style.width = "140px";
                lotInfoOnHover.style.height = "90px";
                $(".alias").text("Lot No " + legendAlias);
                if((legendStatus.toLowerCase() != 'sold') && (legendStatus.toLowerCase() != 'model') && (legendPrice >= 1)) {
                    $(".price").text("Price : "+formatter.format(legendPrice));
                } else {
                    $(".price").text('');
                }
                $(".status").text("Status: " + legendStatus);
            }
        });
        $("g").mouseout(function () {
            lotInfoOnHover.style.display = "none";
        });
    }
    showPopup();

    function resetColors(lid) {
        $("svg").find("g").find(".blue").removeClass('blue');
    }

    function loadSvg(){
        $(".svg-draggable svg").find("g path").css({
            "fill" : "rgb(119, 120, 123)",
            "stroke" : "#fff"
        });
        $(".svg-draggable svg").find("g polygon").css({
            "fill" : "rgb(119, 120, 123)",
            "stroke" : "#fff"
        });
        $.ajax({
            url: "/api/get-lots",
            type: 'post',
            dataType : "json",
            data: { pid: plotId },
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function(response){ 
                var response;
                $.each(response.lots, function(i, item) {
                    $("svg").find("g#"+item.groupID).attr('data-pid', item.plot_id).attr('data-lid', item.id).attr('data-legend', item.legend_id).attr('data-price', item.price).attr('font-size',"8").attr('legend-name',item.name).attr('legend-alias',item.alias).attr('lot_connected', false);
                    $("svg").find("g#"+item.groupID+' text.st1.st2').text(item.alias);
                    $("svg").find("g#"+item.groupID+' text.st4.st20').text(item.alias);
                });
                $.each(response.connected_lots, function(i, item) {
                    $("svg").find("g#"+item.groupID).attr('lot_connected', true);
                    $("svg").find("g#"+item.groupID+' path').css("fill", item.colorcode);
                    $("svg").find("g#"+item.groupID+' polygon').css("fill", item.colorcode);
                });
                $('.svgloader').fadeOut(250);
            }
        });
        $.ajax({
            url: "/api/setlotcount",
            type: 'post',
            dataType : "json",
            data: { cid: communityId},
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function(response){ 
                //console.log(responseText);
                $('.legend-list').html(response.html);
            }
        });
        $(document).on('click', '.sb-listings-more', function(){
            var lotid = $(this).data('lotid');
            resetColors(lotid);
            $('#nav-tab1, #nav-tab2, #nav-tab3').removeClass('active');
            $('#nav1, #nav2, #nav3').removeClass('active show');
            $('#nav-tab4').addClass('active');
            $('#nav4').addClass('active show');
            
            $('#search-results').html('fetching home details....');
            if(lotid) {
                $('#'+lotid+' path').addClass('blue');
                $('#'+lotid+' polygon').addClass('blue');
            }
            var lotpid = $(this).data('pid');
            $('#continue_to_home').attr('data-lid', lotpid);
            $('#generate_estimate').attr('data-lid', lotpid);
            $('#slotp').html(formatter.format($(this).data('price')));
            $('#slot_id').val($(this).data('price'));
            setPayment();
            $.ajax({
                url: "/xplat/search",
                type: 'get',
                dataType : "json",
                data: { lid: lotpid },
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: function(response){ 
                    $('#search-results').html(response.html); 
                    $('.lot-no').html($(this).attr("legend-alias"));
                    $(".home-img").mouseenter(function(){
                        $(this).find('span').addClass('show-buttons');
                        $(this).find('img').addClass('fade-img');
                    });
                    $(".home-img").not(".home-img span").mouseleave(function(){
                        $(this).find('span').removeClass('show-buttons');
                        $(this).find('img').removeClass('fade-img');
                    });
                },
            });
        });
        // Show search records on svg click
        $(".svg-draggable svg").find("g").click(function(){
            openNav();
            var legend_name = $(this).attr('legend-name');
            var lot_connected = $(this).attr('lot_connected')
            var lotid = $(this).attr('id');
            filter_lot_id = $(this).attr('data-lid');
            resetColors(lotid);
        
            $('#nav-tab1, #nav-tab2, #nav-tab3').removeClass('active');
            $('#nav1, #nav2, #nav3').removeClass('active show');
            $('#nav-tab4').addClass('active');
            $('#nav4').addClass('active show');
            if( legend_name.toLowerCase() == "available" && lot_connected == "true"){
                if(lotid) {
                    $('#'+lotid+' path').addClass('blue');
                    $('#'+lotid+' polygon').addClass('blue');
                }
            }
            $('#search-results').html('fetching home details....');
            var lotpid = $(this).data('lid');
            if( legend_name.toLowerCase() == "available" && lot_connected == "true"){
                $('#continue_to_home').attr('data-lid', lotpid);
                $('#generate_estimate').attr('data-lid', lotpid);
                $("#pb-lot").addClass('complete');
                $("#pb-lot span").html("done");
            }
            else{
                $('#continue_to_home').attr('data-lid', '');
                $('#generate_estimate').attr('data-lid', '');
                $("#pb-lot").removeClass('complete');
                $("#pb-lot span").html("place");
            }
            
            $('#lotInfoOnHover').hide();
            $("#searchImage-tab").trigger('click');
            $('#search-results').html('<p class="text-center text-white m-3"><img src="/images/white-loader.gif"></p>');
            if( legend_name.toLowerCase() == "available"){
                $('#slotp').html(formatter.format($(this).data('price')));
                $('#slot_id').val($(this).data('price'));
                setPayment();
            }
            $.ajax({
            url: "/xplat/search",
            type: 'get',
            dataType : "json",
            data: { lid: lotpid},
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function(response){ 
                $('#search-results').html(response.html); 
                $('#continue_to_home').attr('data-hid', ' ');
                $('#continue_to_home').attr('data-link', '');
                $(".home-img").mouseenter(function(){
                    $(this).find('span').addClass('show-buttons');
                    $(this).find('img').addClass('fade-img');
                });
                $(".home-img").not(".home-img span").mouseleave(function(){
                    $(this).find('span').removeClass('show-buttons');
                    $(this).find('img').removeClass('fade-img');
                });
            },
            });
            if(!sessionStorage.getItem('hide-estimate-message')){
                $('.estimate-message').fadeIn();
            }
            $("#generate_estimate").mouseenter(function(){
                $(".estimate-message").fadeOut();
                sessionStorage.setItem('hide-estimate-message', true);
            })
        });
    }
    loadSvg();

    // Reset SVG
    $(".refrest-btn").click(function(){
        counter += 180;
        $('.refrest-btn div').css('transform', 'rotate(' + counter + 'deg)')
        resetColors();
        showPopup();
        dragElement(document.getElementById("stage"));
        $("#stage").animate({'top':'0px','left': '0','bottom':'auto'});
        $(".svg-draggable").css({'transform':'scale(1)'});
        scale = 1;
        $.ajax({
            type:"get",
            url:"/api/refresh-lots",
            success: function(){
                $("#pb-lot").removeClass('complete');
                $("#pb-lot span").html("place");
                $("#continue_to_home").attr('data-lid', '');
                $("#generate_estimate").attr('data-lid', '');
                $('#slotp').html("");
                $('#slot_id').val("");
                $('.lot-no').html("$0");
            }
        })
    });

    $(document).on('click','.check-home',function(){
        $('.check-home').removeClass('active');
        $(this).addClass('active');
    });

    function homePopup(lid, hid) 
    {
        $('.inner-sliding-modal').modal('hide');
        $('.svgloader').show();
        $('#property-modal .modal-body').hide();
        $('#property-modal').modal('show');
        openNav();
        $.ajax({
            url: "/api/sethomeform",
            type: 'post',
            dataType : "json",
            data: { lid:lid,hid:hid},
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function(response){ 
                $('#property-modal .modal-dialog.modal-notify.modal-info .modal-body h4').html(
                    `${response.title}
                    <span class="lot-no" style="position: absolute;top: 4px;right: 0;font-size: 14px;font-weight: 500;">
                    ${response.linfo}
                    </span>`
                );
                $('.property-image').html('');
                var $carousel = $('.property-image');
                $.each(response.gallery, function(){
                    $carousel.append(`<a href="/uploads/homes/${this}">
                                            <img src="/uploads/homes/${this}"/>
                                        </a>`
                                    );
                    $carousel.lightGallery();
                    $carousel.data('lightGallery').destroy(true);
                    $carousel.lightGallery({
                        thumbnail: true,
                        animateThumb: false,
                        showThumbByDefault: false,
                        mode: 'lg-slide-circular'
                    });
                });
                $carousel.slick('slickRemove', null, null, true);
                $carousel.slick("unslick");
                $carousel.slick({
                    infinite: true,
                    speed: 500,
                    fade: true,
                    cssEase: 'linear',
                });
                if(response.floor_data.length > 0){
                    $('#property-modal .modal-body .row div .tab-content').html('');
                }
                else{
                    $('#property-modal .modal-body .row div .tab-content').html(`<div class="alert alert-info" role="alert">
                                                                                Floor Plans Coming Soon!.
                                                                                </div>`);
                }
                var li = "";
                $.each(response.floor_data, function(key){
                    if(key == 0){
                        li += `<li class="nav-item waves-effect waves-light">
                                    <a class="nav-link active" data-toggle="tab" href="#floor_plan${this.id}">${this.title}</a>
                                </li>`;
                        $('#property-modal .modal-body .row div .tab-content')
                        .append(
                                `<div class="tab-pane active h-100" id="floor_plan${this.id}">
                                    <div class="floor-map-img-main">
                                    <a href="/uploads/floors/${this.image}">
                                        <img src="/uploads/floors/${this.image}" alt="">
                                        <div class="middle">
                                            <div class="text">View</div>
                                        </div>
                                        </a>
                                    </div>
                                </div>`
                        );
                        var floor_light_gallery = $(".floor-map-img-main");
                        floor_light_gallery.lightGallery();
                        floor_light_gallery.data('lightGallery').destroy(true);
                        floor_light_gallery.lightGallery({
                            thumbnail: false,
                        });
                    }
                    else{
                        li += `<li class="nav-item waves-effect waves-light">
                                    <a class="nav-link" data-toggle="tab" href="#floor_plan${this.id}">${this.title}</a>
                                </li>`;
                        $('#property-modal .modal-body .row div .tab-content')
                        .append(
                                `<div class="tab-pane h-100" id="floor_plan${this.id}">
                                    <div class="floor-map-img-main">
                                    <a href="/uploads/floors/${this.image}">
                                        <img src="/uploads/floors/${this.image}" alt="">
                                        <div class="middle">
                                            <div class="text">View</div>
                                        </div>
                                        </a>
                                    </div>
                                </div>`
                        );
                        var floor_light_gallery = $(".floor-map-img-main");
                        floor_light_gallery.lightGallery();
                        floor_light_gallery.data('lightGallery').destroy(true);
                        floor_light_gallery.lightGallery({
                            thumbnail: false,
                        });
                        floor_light_gallery.on('onBeforeSlide.lg', function(event, prevIndex, index){
                            $('.lg-outer').css('background-color', 'rgba(255,255,255,0.9)')
                        });
                    }
                });
                $("#property-modal .modal-body .row div ul").html(li);
                $('#hname').html('Selected Home<br><b>'+response.title+'</b>');
                $('#property-modal .property-info p.home-price').html(formatter.format(response.price));
                $('#property-modal .property-info p.bed').html(response.bed);
                $('#property-modal .property-info p.bath').html(response.bath);
                $('#property-modal .property-info p.garage').html(response.garg);
                $('#property-modal .property-info p.floor').html(response.floor);
                $('#property-modal .property-info p.area').html(`${areaFormatter.format(response.area)} sqft`);
                $('#property-modal .modal-dialog.modal-notify.modal-info .modal-body h4 span.lot-no').html(response.linfo);
                $('.svgloader').hide();
                $('#property-modal .modal-body').show();
            },
        });
    }
    
    function disableLots(lid, hid){
        openNav();
        $(".svg-draggable svg").find("g path").css({
            "fill" : "rgb(119, 120, 123)",
            "stroke" : "#fff"
        });
        $(".svg-draggable svg").find("g polygon").css({
            "fill" : "rgb(119, 120, 123)",
            "stroke" : "#fff"
        });
        $.ajax({
            url: "/api/disable-lots",
            type: 'post',
            dataType : "json",
            data: { pid: plotId, home_id: hid },
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function(response){
            var elevationTypes = "";
            $.each(response.home_types, function(){
               elevationTypes += `<div class="search-single available-img-box shuffle-item shuffle-item--hidden d-block 
                                align-items-center pt-3 pl-3 pr-3 pb-2 m-0 border-bottom "> 
                                <div class="home-img">
                                    <img src="/uploads/homes/${this.img}" alt="${this.title}" class="w-100">
                                    <span class="text-dark">
                                        <svg class="check-home-type" data-id="${this.id}" data-title="${this.title}" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                                    </span>
                                </div>
                                <p class="m-0 mt-2 home-data-wrap text-left">
                                    <span style="color:#3a3b3d;">${this.title}</span>
                                    <span class="d-block" style="color:#3a3b3d;">${formatter.format(this.price)}</span>
                                    <span class="d-flex justify-content-between home-icons mt-2">
                                        <span style="color:#3a3b3d;">
                                            <span style="color:#3a3b3d;" class="material-icons mr-1">
                                            king_bed
                                            </span>
                                            ${this.bedroom} Beds
                                        </span>
                                        <span style="color:#3a3b3d;">
                                            <span style="color:#3a3b3d;" class="material-icons mr-1">
                                            bathtub
                                            </span>
                                            ${this.bathroom} Baths
                                        </span>
                                        <span style="color:#3a3b3d;">
                                            <span style="color:#3a3b3d;" class="material-icons mr-1">
                                            drive_eta
                                            </span>
                                            ${this.garage} Garages
                                        </span>
                                    </span>
                                </p>                            
                            </div>` ;
            });
            $("#elevation-type-modal .modal-body").html(elevationTypes);
            $(".home-img").mouseenter(function(){
                $(this).find('span').addClass('show-buttons');
                $(this).find('img').addClass('fade-img');
            });
            $(".home-img").not(".home-img span").mouseleave(function(){
                $(this).find('span').removeClass('show-buttons');
                $(this).find('img').removeClass('fade-img');
            });
            $('#continue_to_home').attr('href',response.home_link);
            $("#elevation-type-modal").modal('show');
            $(".check-home-type").click(function(){
                var home_type_id = $(this).attr('data-id');
                var home_type_name = $(this).attr('data-title');
                $.ajax({
                    url: "/api/select-elevation-type",
                    type: 'post',
                    data: { home_type_id : home_type_id},
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    success: function(result){
                        $(document).find(".home-type-title").html(`- ${home_type_name}`);
                        $(document).find(".home-type-title-mortgage").html(`- ${home_type_name}`);
                        $("#elevation-type-modal").modal('hide');
                        $('#shmprice').html(formatter.format(result.home_price));
                        $('#shome_id').val(result.home_price);
                        $('#amount_display').html(formatter.format(result.total_price));
                        $('#amount').val(result.total_price); 
                        $('#continue_to_home').attr('href',result.home_link);
                        setPayment();
                    }
                });
            });
               
            var response;
            $.each(response.lots, function(i, item) {
                $("svg").find("g#"+item.groupID).attr('data-pid', item.plot_id).attr('data-lid', item.id).attr('data-legend', item.legend_id).attr('data-price', item.price).attr('font-size',"8").attr('legend-name',item.name).attr('legend-alias',item.alias).attr('lot_connected', false);
                $("svg").find("g#"+item.groupID+' text.st1.st2').text(item.alias);
                $("svg").find("g#"+item.groupID+' text.st4.st20').text(item.alias);
            });
            $.each(response.connected_lots, function(i, item) {
                $("svg").find("g#"+item.groupID).attr('lot_connected', true);
                $("svg").find("g#"+item.groupID+' path').css("fill", item.colorcode);
                $("svg").find("g#"+item.groupID+' polygon').css("fill", item.colorcode);
            });
            $(".footer .footer-title h6").html(`<span class="material-icons">home</span> ${response.title} <span class="m-0 home-type-title" style="position:unset; color:#1f223e;"></span>`);
            $('#shmprice').html(formatter.format(response.price));
            $('#shome_id').val(response.price);
            $("#shome").html(`${response.title} <span class="m-0 home-type-title-mortgage"></span>`);
            setPayment();
            }
        });
        $.ajax({
            url: "/api/sethomeform",
            type: 'post',
            dataType : "json",
            data: { lid:lid,hid:hid},
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function(response){ 
                $('#property-modal .modal-dialog.modal-notify.modal-info .modal-body h4').html(
                    `${response.title} <span class="m-0 home-type-title"></span>
                    <span class="lot-no" style="position: absolute;top: 4px;right: 0;font-size: 14px;font-weight: 500;">
                    ${response.linfo}
                    </span>`
                );
                 $('.property-image').html('');
                 var $carousel = $('.property-image');
                $.each(response.gallery, function(){
                     $carousel.append(`<a href="/uploads/homes/${this}">
                                            <img src="/uploads/homes/${this}"/>
                                        </a>`
                                    );
                    $carousel.lightGallery();
                    $carousel.data('lightGallery').destroy(true);
                    $carousel.lightGallery({
                        thumbnail: true,
                        animateThumb: false,
                        showThumbByDefault: false,
                        mode: 'lg-slide-circular'
                    });
                });
                $carousel.slick('slickRemove', null, null, true);
                $carousel.slick("unslick");
                $carousel.slick({
                    infinite: true,
                    speed: 500,
                    fade: true,
                    cssEase: 'linear',
                });
                if(response.floor_data.length > 0){
                    $('#property-modal .modal-body .row div .tab-content').html('');
                }
                else{
                    $('#property-modal .modal-body .row div .tab-content').html(`<div class="alert alert-info" role="alert">
                                                                                Floor Plans Coming Soon!.
                                                                                </div>`);
                }
                var li = "";
                $.each(response.floor_data, function(key){
                    if(key == 0){
                        li += `<li class="nav-item waves-effect waves-light">
                                    <a class="nav-link active" data-toggle="tab" href="#floor_plan${this.id}">${this.title}</a>
                                </li>`;
                        $('#property-modal .modal-body .row div .tab-content')
                        .append(
                                `<div class="tab-pane active h-100" id="floor_plan${this.id}">
                                    <div class="floor-map-img-main">
                                    <a href="/uploads/floors/${this.image}">
                                        <img src="/uploads/floors/${this.image}" alt="">
                                        <div class="middle">
                                            <div class="text">View</div>
                                        </div>
                                        </a>
                                    </div>
                                </div>`
                        );
                        var floor_light_gallery = $(".floor-map-img-main");
                        floor_light_gallery.lightGallery();
                        floor_light_gallery.data('lightGallery').destroy(true);
                        floor_light_gallery.lightGallery({
                            thumbnail: false,
                        });
                    }
                    else{
                        li += `<li class="nav-item waves-effect waves-light">
                                    <a class="nav-link" data-toggle="tab" href="#floor_plan${this.id}">${this.title}</a>
                                </li>`;
                        $('#property-modal .modal-body .row div .tab-content')
                        .append(
                                `<div class="tab-pane h-100" id="floor_plan${this.id}">
                                    <div class="floor-map-img-main">
                                    <a href="/uploads/floors/${this.image}">
                                        <img src="/uploads/floors/${this.image}" alt="">
                                        <div class="middle">
                                            <div class="text">View</div>
                                        </div>
                                        </a>
                                    </div>
                                </div>`
                        );
                        var floor_light_gallery = $(".floor-map-img-main");
                        floor_light_gallery.lightGallery();
                        floor_light_gallery.data('lightGallery').destroy(true);
                        floor_light_gallery.lightGallery({
                            thumbnail: false,
                        });
                    }
                });
                $("#property-modal .modal-body .row div ul").html(li);
                $('#hname').html('Selected Home<br><b>'+response.title+'</b>');
                $('#property-modal .property-info p.home-price').html(formatter.format(response.price));
                $('#property-modal .property-info p.bed').html(response.bed);
                $('#property-modal .property-info p.bath').html(response.bath);
                $('#property-modal .property-info p.garage').html(response.garg);
                $('#property-modal .property-info p.floor').html(response.floor);
                $('#property-modal .property-info p.area').html(areaFormatter.format(response.area));
                $('#property-modal .modal-dialog.modal-notify.modal-info .modal-body h4 span.lot-no').html(response.linfo);
            },
        });
    }

    // Zoom Buttons
    function step(zoom)
    {
        if(zoom == "zoom-in"){
            scale = scale + 0.25;
            $('.svg-draggable').css({
                "transform": `scale(${scale})`
            })
        }
        else{
            if(scale > 1){
                scale = scale - 0.25;
                $('.svg-draggable').css({
                    "transform": `scale(${scale})`
                }) 
            }
        }
    }

    //SVG Draggable
    dragElement(document.getElementById("stage"));
    function dragElement(elmnt) {
        var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
        if (document.getElementById(elmnt.id + "header")) {
            /* if present, the header is where you move the DIV from:*/
            document.getElementById(elmnt.id + "header").onmousedown = dragMouseDown;
        } else {
            /* otherwise, move the DIV from anywhere inside the DIV:*/
            elmnt.onmousedown = dragMouseDown;
        }

        function dragMouseDown(e) {
            e = e || window.event;
            e.preventDefault();
            // get the mouse cursor position at startup:
            pos3 = e.clientX;
            pos4 = e.clientY;
            document.onmouseup = closeDragElement;
            // call a function whenever the cursor moves:
            document.onmousemove = elementDrag;
        }

        function elementDrag(e) {
            e = e || window.event;
            e.preventDefault();
            // calculate the new cursor position:
            pos1 = pos3 - e.clientX;
            pos2 = pos4 - e.clientY;
            pos3 = e.clientX;
            pos4 = e.clientY;
            // set the element's new position:
            elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
            elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
        }

        function closeDragElement() {
            /* stop moving when mouse button is released:*/
            document.onmouseup = null;
            document.onmousemove = null;
        }
    }

    //Filters
    //Price Slider
    $("#filter-price").ionRangeSlider({
        type        : "double",
        min         : minPrice,
        max         : maxPrice,
        grid        : false,
        skin        : "round",
        hide_min_max: true,    
        hide_from_to: true,
        from        : minPrice,
        to          : maxPrice,
        onStart: function(data){
            $(".price_range_data").html(`${formatter.format(data.from)} - ${formatter.format(data.to)}`);
        },
        onChange: function (data) {
            $(".price_range_data").html(`${formatter.format(data.from)} - ${formatter.format(data.to)}`);
        },
        onFinish: function(data){       
            getHomes("price", data.from, data.to);
        }
    });
    //Area Slider
    $("#filter-living-area").ionRangeSlider({
        type        : "double",
        min         : minArea,
        max         : maxArea,
        grid        : false,
        skin        : "round",
        hide_min_max: true,    
        hide_from_to: true,
        from        : minArea,
        to          : maxArea,
        onStart: function(data){
            $(".living_area_range_data").html(`${areaFormatter.format(data.from)} sqft - ${areaFormatter.format(data.to)} sqft`);
        },
        onChange: function (data) {
            $(".living_area_range_data").html(`${areaFormatter.format(data.from)} sqft - ${areaFormatter.format(data.to)} sqft`);
        },
        onFinish: function(data){
            getHomes("area", data.from, data.to);
        }
    });
    //Beds Slider
    $("#filter-beds").ionRangeSlider({
        type        : "double",
        min         : minBed,
        max         : maxBed,
        grid        : false,
        skin        : "round",
        hide_min_max: true,    
        hide_from_to: true,
        from        : minBed,
        to          : maxBed,
        onStart: function(data){
            $(".beds_range_data").html(`${data.from} - ${data.to}`);
        },
        onChange: function (data) {
            $(".beds_range_data").html(`${data.from} - ${data.to}`);
        },
        onFinish: function(data){
            getHomes("bedroom", data.from, data.to);
        }
    });
    //Baths slider
    $("#filter-baths").ionRangeSlider({
        type        : "double",
        min         : minBath,
        max         : maxBath,
        grid        : false,
        skin        : "round",
        hide_min_max: true,    
        hide_from_to: true,
        from        : minBath,
        to          : maxBath,
        onStart: function(data){
            $(".baths_range_data").html(`${data.from} - ${data.to}`);
        },
        onChange: function (data) {
            $(".baths_range_data").html(`${data.from} - ${data.to}`);
        },
        onFinish: function(data){
            getHomes("bathroom", data.from, data.to);
        }
    });
    //Garage Slider
    $("#filter-garage").ionRangeSlider({
        type        : "double",
        min         : minGarage,
        max         : maxGarage,
        grid        : false,
        skin        : "round",
        hide_min_max: true,    
        hide_from_to: true,
        from        : minGarage,
        to          : maxGarage,
        onStart: function(data){
            $(".garage_range_data").html(`${data.from} - ${data.to}`);
        },
        onChange: function (data) {
            $(".garage_range_data").html(`${data.from} - ${data.to}`);
        },
        onFinish: function(data){
            getHomes("garage", data.from, data.to);
        }
    });
    //Floors Slider
    $("#filter-floors").ionRangeSlider({
        type        : "double",
        min         : minFloor,
        max         : maxFloor,
        grid        : false,
        skin        : "round",
        hide_min_max: true,    
        hide_from_to: true,
        from        : minFloor,
        to          : maxFloor,
        onStart: function(data){
            $(".floors_range_data").html(`${data.from} - ${data.to}`);
        },
        onChange: function (data) {
            $(".floors_range_data").html(`${data.from} - ${data.to}`);
        },
        onFinish: function(data){
            getHomes("floor", data.from, data.to);
        }
    });

    // Tabs Switch
    $('#nav-tab2').on('shown.bs.tab', function (e) {
        tabsCarousel.slick('unslick').slick({
            infinite: true,
            speed: 500,
            fade: true,
            cssEase: 'linear',
            dots: false,
            arrows: true,
            autoplay: true,
            adaptiveHeight: true
        });
        e.target // newly activated tab
        e.relatedTarget // previous active tab
    })

    // Filter Homes
    function getHomes(typ, minv, maxv) {
        $('#search-results').html('<p class="text-center text-white m-3"><img src="/images/white-loader.gif"></p>');
        var lotpid = $('#continue_to_home').data('lid');
        if(lotpid == '') {
            $('#search-results').html('<p class="text-center text-white m-3">Please select the lot first</p>');
            return false;
        } 
        $.ajax({
            url: "/api/filterhome",
            type: 'post',
            dataType : "json",
            data: {lid:filter_lot_id,type:typ, minv:minv, maxv:maxv },
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function(response){ 
                //consoleconsole.log(response);
                $('#search-results').html(response.html); 
                $(".home-img").mouseenter(function(){
                $(this).find('span').addClass('show-buttons');
                $(this).find('img').addClass('fade-img');
                });
                $(".home-img").not(".home-img span").mouseleave(function(){
                    $(this).find('span').removeClass('show-buttons');
                    $(this).find('img').removeClass('fade-img');
                });
            },
        });
    }

    // Generate Estimate
    $("#generate_estimate").click(function(){
        var lid = $(this).attr('data-lid');
        var login = $(this).attr('data-login');
        if(lid == '') {
            toastr.info('Please select Lot to continue'); 
            return false;
        } 
        else {
            if(auth == true){
                window.location.href = estimate;
            }
            else{
                $('#exampleModal').modal('show');
            }
        }
    });

    // Xhome Link
    $("#continue_to_home").click(function(){
        var lid = $(this).attr('data-lid');
        if(lid == '') {
            toastr.info('Please select Lot to continue'); 
            return false;
        } 
        else {
            window.location.href = xhome;
        }
    });
}

//X-Home
if(currentRoute == "xhome"){
    $("#pb-elevation-type, #pb-elevation, #pb-community, #pb-lot").addClass('active complete');
    $(".progressbar li.complete span").html("done");
    $("#pb-color").addClass('active');

    // Declaring Variables
    var $carousel = $('.property-image');

    //Elevation Types
    $(".home-img").mouseenter(function(){
        $(this).find('span').addClass('show-buttons');
        $(this).find('img').addClass('fade-img');
    });
    $(".home-img").not(".home-img span").mouseleave(function(){
        $(this).find('span').removeClass('show-buttons');
        $(this).find('img').removeClass('fade-img');
    });
    //Color Schemes
    $(".color-schemes").mouseenter(function(){
        $(this).find('span').addClass('show-buttons');
        $(this).find('img').addClass('fade-img');
    });
    $(".color-schemes").not(".color-schemes span").mouseleave(function(){
        $(this).find('span').removeClass('show-buttons');
        $(this).find('img').removeClass('fade-img');
    });
    //Features list
    $(".feature-wrap").mouseenter(function(){
        $(this).find('span').addClass('show-buttons');
        $(this).find('img').addClass('fade-img');
    });
    $(".feature-wrap").not(".feature-wrap span").mouseleave(function(){
        $(this).find('span').removeClass('show-buttons');
        $(this).find('img').removeClass('fade-img');
    });

    // Elevation Info Modal
    function elevationPopup(hid) {
        $("#property-loader").addClass('show-loader');
        $('#property-modal .modal-body').removeClass('show-modal-body');
        $('#property-modal').modal('show');
        $.ajax({
            url: "/api/get-elevation",
            type: 'post',
            dataType : "json",
            data: {hid:hid},
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function(response){ 
                // console.log(response.home.title);
                $('#property-modal .modal-dialog.modal-notify.modal-info .modal-body h4').html(
                    `${response.home.title}`
                );
                $('#hname').html('Selected Home<br><b>'+response.home.title+'</b>');
                $('#property-modal .property-info p.home-price span').html(formatter.format(response.home.price));
                $('#property-modal .property-info p.bed span').html(response.home.bedroom);
                $('#property-modal .property-info p.bath span').html(response.home.bathroom);
                $('#property-modal .property-info p.garage span').html(response.home.garage);
                $('#property-modal .property-info p.floor span').html(response.home.floor);
                $('#property-modal .property-info p.area span').html(areaFormatter.format(response.home.area));
                $('.property-image').html('');
                $.each(response.gallery, function(){
                    $carousel.append(`<a href="/uploads/homes/${this}">
                                            <img src="/uploads/homes/${this}"/>
                                        </a>`
                                    );
                    $carousel.lightGallery();
                    $carousel.data('lightGallery').destroy(true);
                    $carousel.lightGallery({
                        thumbnail: true,
                        animateThumb: false,
                        showThumbByDefault: false,
                        mode: 'lg-slide-circular'
                    });
                });
                $carousel.slick('slickRemove', null, null, true);
                $carousel.slick('unslick').slick({
                    infinite: true,
                    speed: 500,
                    fade: true,
                    cssEase: 'linear',
                    dots: false,
                    arrows: true,
                    autoplay: true,
                });
                if(response.floor_data.length > 0){
                    $('#property-modal .modal-body .floor-tabs-wrapper').html(`<ul class="nav nav-tabs border-bottom-0 
                                                                                    justify-content-center">
                                                                                    </ul>
                                                                                    <div class="tab-content">
                                                                                    </div>
                                                                                `);
                }
                else{
                    $('#property-modal .modal-body .floor-tabs-wrapper').html(`<div class="alert alert-info" role="alert">
                                                                                Floor Plans Coming Soon!
                                                                                </div>`);
                }
                var li = "";
                $.each(response.floor_data, function(key){
                    if(key == 0){
                        li += `<li class="nav-item waves-effect waves-light">
                                    <a class="nav-link active" data-toggle="tab" href="#floor_plan${this.id}">${this.title}</a>
                                </li>`;
                        $('#property-modal .modal-body .row div .tab-content')
                        .append(
                                `<div class="tab-pane active h-100" id="floor_plan${this.id}">
                                    <div class="floor-map-img-main">
                                    <a href="/uploads/floors/${this.image}">
                                        <img src="/uploads/floors/${this.image}" alt="">
                                        <div class="middle">
                                            <div class="text">View</div>
                                        </div>
                                        </a>
                                    </div>
                                </div>`
                        );
                        var floor_light_gallery = $(".floor-map-img-main");
                        floor_light_gallery.lightGallery();
                        floor_light_gallery.data('lightGallery').destroy(true);
                        floor_light_gallery.lightGallery({
                            thumbnail: false,
                        });
                    }
                    else{
                        li += `<li class="nav-item waves-effect waves-light">
                                    <a class="nav-link" data-toggle="tab" href="#floor_plan${this.id}">${this.title}</a>
                                </li>`;
                        $('#property-modal .modal-body .row div .tab-content')
                        .append(
                                `<div class="tab-pane h-100" id="floor_plan${this.id}">
                                    <div class="floor-map-img-main">
                                    <a href="/uploads/floors/${this.image}">
                                        <img src="/uploads/floors/${this.image}" alt="">
                                        <div class="middle">
                                            <div class="text">View</div>
                                        </div>
                                        </a>
                                    </div>
                                </div>`
                        );
                        var floor_light_gallery = $(".floor-map-img-main");
                        floor_light_gallery.lightGallery();
                        floor_light_gallery.data('lightGallery').destroy(true);
                        floor_light_gallery.lightGallery({
                            thumbnail: false,
                        });
                    }
                });
                $("#property-modal .modal-body .row div ul").html(li);
                $('.floor-map-img-main').on('onBeforeSlide.lg', function(event, prevIndex, index){
                    $('.lg-outer').css('background-color', 'rgba(255,255,255,0.9)')
                });
            },
            complete: function(){
                $("#property-loader").removeClass('show-loader');
                $('#property-modal .modal-body').addClass('show-modal-body');
            }
        });
    }
    $('.clear-btn').click(function(){
        $("#msg").val("");
        $.ajax({
            url: "/home/save-msg/",
            method: 'post',
            dataType : "json",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: {
                'msg': '',
            },
            success: function(result)
            {
                toastr.success("Your Message has been cleared.");
            }
        });
    })

    //Display Color Scheme On click of Home
    $('.elevation').click(function(){
        $('#home-loading').show();
        $('#nav3 #options').html('');
        $('.elevation').removeClass('active');
        $(this).addClass('active');
        var img = $(this).parent().prev().attr('src');
        $('#main_img').attr('src',img);
        $(".nav-link").removeClass('active');
        $(".tab-pane").removeClass('active show');
        $('#nav-tab3').addClass('active');
        $('#nav3').addClass('active show');
        var home_id=$(this).attr('elevation_id');
        var home_url="/uploads/homes/";
        $.ajax({
            url: "/home/colorschemes",
            method: 'post',
            dataType : "json",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: {
                'home_id': home_id,
                },
            success: function(result){
                if(result.title != ''){
                    $('.home-title').text(`- ${result.title}`);
                }
                else{
                    $('.home-title').text('');
                }
                $('#continue_to_floor').attr('href',result.floor_link);
                $("#shome").html(result.title);
                var content='<div class="row pt-3 pb-0 m-0 w-100" style="padding-right:15px;">';
                $.each( result.data, function( key, value ) {
                    if(key%2 == 0){
                        content += `<div class="col-6 pr-1 pl-0">
                                        <a href="javascript:void(0)" class="" >
                                        <div id="colorBox0" class="color-schemes">
                                            <img class="img-fluid" width="100%" height="100%" src="${home_url}${this.img}" base_image="${home_url}${this.img}" alt="${this.title}" tabindex="0">
                                            <span class="text-white">
                                                <svg class="home-thumbnail" active="0" title="${this.title}" price="${this.price}" color_scheme_id="${this.id}" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                                            </span>
                                        </div>
                                        </a>
                                        <div style="color:white;font-size:12px; margin-top:2px;margin-bottom:1px;">${this.title}</div>
                                    </div>`;
                    }
                    else{
                        content += `<div class="col-6 pr-0 pl-1">
                                        <a href="javascript:void(0)" class="" >
                                        <div id="colorBox0" class="color-schemes">
                                            <img class="img-fluid" width="100%" height="100%" src="${home_url}${this.img}" base_image="${home_url}${this.img}" alt="${this.title}" tabindex="0">
                                            <span class="text-white">
                                                <svg class="home-thumbnail" active="0" title="${this.title}" price="${this.price}" color_scheme_id="${this.id}" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                                            </span>
                                        </div>
                                        </a>
                                        <div style="color:white;font-size:12px; margin-top:2px;margin-bottom:1px;">${this.title}</div>
                                    </div>`;
                    }
                });
                content +='</div>';
                $('#base_images').html(content);
                $(".color-schemes").mouseenter(function(){
                    $(this).find('span').addClass('show-buttons');
                    $(this).find('img').addClass('fade-img');
                });
                $(".color-schemes").not(".color-schemes span").mouseleave(function(){
                    $(this).find('span').removeClass('show-buttons');
                    $(this).find('img').removeClass('fade-img');
                });
                $('#home-loading').hide();
                $('#shmprice').text(`${formatter.format(result.price)}`);
                $('#amount').val(result.total_price);
                $('#amount_display').text(formatter.format(result.total_price));
                $('#total_cost').text(result.total_price);
                $("#mort_color_scheme_price").html("");
                $("#mort_upgrade_options").html("");
                downrate();
                calculatePayment();     
            }
        });
        // Property Info Model Information Update
        $.ajax({
            url: "/api/get-elevation",
            type: 'post',
            dataType : "json",
            data: {hid:home_id},
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function(response){ 
                $('#property-modal .modal-dialog.modal-notify.modal-info .modal-body h4').html(
                    `${response.home.title}`
                );
                $('#hname').html('Selected Home<br><b>'+response.home.title+'</b>');
                $('#property-modal .property-info p.home-price span').html(formatter.format(response.home.price));
                $('#property-modal .property-info p.bed span').html(response.home.bedroom);
                $('#property-modal .property-info p.bath span').html(response.home.bathroom);
                $('#property-modal .property-info p.garage span').html(response.home.garage);
                $('#property-modal .property-info p.floor span').html(response.home.floor);
                $('#property-modal .property-info p.area span').html(areaFormatter.format(response.home.area));
                $('.property-image').html('');
                $.each(response.gallery, function(){
                    $carousel.append(`<a href="/uploads/homes/${this}">
                                            <img src="/uploads/homes/${this}"/>
                                        </a>`
                                    );
                    $carousel.lightGallery();
                    $carousel.data('lightGallery').destroy(true);
                    $carousel.lightGallery({
                        thumbnail: true,
                        animateThumb: false,
                        showThumbByDefault: false,
                        mode: 'lg-slide-circular'
                    });
                });
                $carousel.slick('slickRemove', null, null, true);
                $carousel.slick('unslick').slick({
                    infinite: true,
                    speed: 500,
                    fade: true,
                    cssEase: 'linear',
                    dots: false,
                    arrows: true,
                    autoplay: true,
                });
                if(response.floor_data.length > 0){
                    $('#property-modal .modal-body .floor-tabs-wrapper').html(`<ul class="nav nav-tabs border-bottom-0 
                                                                                justify-content-center">
                                                                                </ul>
                                                                                <div class="tab-content">
                                                                                </div>
                                                                                `);
                }
                else{
                    $('#property-modal .modal-body .floor-tabs-wrapper').html(`<div class="alert alert-info" role="alert">
                                                                                Floor Plans Coming Soon!
                                                                                </div>`);
                }
                var li = "";
                $.each(response.floor_data, function(key){
                    if(key == 0){
                        li += `<li class="nav-item waves-effect waves-light">
                                    <a class="nav-link active" data-toggle="tab" href="#floor_plan${this.id}">${this.title}</a>
                                </li>`;
                        $('#property-modal .modal-body .row div .tab-content')
                        .append(
                                `<div class="tab-pane active h-100" id="floor_plan${this.id}">
                                    <div class="floor-map-img-main">
                                    <a href="/uploads/floors/${this.image}">
                                        <img src="/uploads/floors/${this.image}" alt="">
                                        <div class="middle">
                                            <div class="text">View</div>
                                        </div>
                                        </a>
                                    </div>
                                </div>`
                        );
                        var floor_light_gallery = $(".floor-map-img-main");
                        floor_light_gallery.lightGallery();
                        floor_light_gallery.data('lightGallery').destroy(true);
                        floor_light_gallery.lightGallery({
                            thumbnail: false,
                        });
                    }
                    else{
                        li += `<li class="nav-item waves-effect waves-light">
                                    <a class="nav-link" data-toggle="tab" href="#floor_plan${this.id}">${this.title}</a>
                                </li>`;
                        $('#property-modal .modal-body .row div .tab-content')
                        .append(
                                `<div class="tab-pane h-100" id="floor_plan${this.id}">
                                    <div class="floor-map-img-main">
                                    <a href="/uploads/floors/${this.image}">
                                        <img src="/uploads/floors/${this.image}" alt="">
                                        <div class="middle">
                                            <div class="text">View</div>
                                        </div>
                                        </a>
                                    </div>
                                </div>`
                        );
                        var floor_light_gallery = $(".floor-map-img-main");
                        floor_light_gallery.lightGallery();
                        floor_light_gallery.data('lightGallery').destroy(true);
                        floor_light_gallery.lightGallery({
                            thumbnail: false,
                        });
                    }
                });
                $("#property-modal .modal-body .row div ul").html(li);
                $('.floor-map-img-main').on('onBeforeSlide.lg', function(event, prevIndex, index){
                    $('.lg-outer').css('background-color', 'rgba(255,255,255,0.9)')
                });
            },
        });
    });
    //End- Display Color Scheme On click of Home - End

    //Display Patches and Manufacturer details of a Color Scheme
    $('#nav3').on('click','.home-thumbnail',function(){
        if($(this).attr('active')==1){
            return false;
        }
        $('#new_data #mort_upgrade_options').html('');
        var color_scheme_price=$(this).attr('price');
        var color_scheme_title=$(this).attr('title');
        /* Calculator*/
        $('#mort_color_scheme_price').html('<div class="base-price">'+color_scheme_title+' <span>$'+color_scheme_price+'</span></div>');

        $('#nav3 .home-thumbnail').attr('active',0)
        $(this).attr('active',1);
        $('#home-loading').show();
        $('#nav3 .home-thumbnail').removeClass('active');
        $(this).addClass('active');
        $('#nav3 #options').html('');
        $('#nav3 #manufacturer').html('');
        var img = $(this).parent().prev().attr('base_image');
        $('#main_img').attr('src',img);

        var color_scheme_id=$(this).attr('color_scheme_id');
        var home_customization=$('#new_data').html();
        var home_url="/uploads/homes/";
        $.ajax({
            url: "/home/homefeatures",
            method: 'post',
            dataType : "html",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: {
                'color_scheme_id': color_scheme_id,
                'color_scheme_price': color_scheme_price,
                'home_customization':home_customization,
            },
            success: function(result){
                $('#home-loading').hide();
                var obj = JSON.parse(result);
                $('#amount').val(obj.total_cost);
                $('#amount_display').text(formatter.format(obj.total_cost));
                $('#total_cost').text(obj.total_cost);
                downrate();
                calculatePayment();
                var feature_content='';
                $.each( obj.data, function( key, value ) {
                    var get_upgrade_type=this.upgrade_type;
                    var upgrade_type='';
                    if(get_upgrade_type==1){
                        upgrade_type='concrete';
                    }
                    if(get_upgrade_type==2){
                        upgrade_type='window';
                    }
                    if(get_upgrade_type==3){
                        upgrade_type='siding';
                    }
                    var feature_id=this.id;
                    feature_content += `<ul class="col-4 pr-1 pl-0 mb-1">
                            <a id="${upgrade_type}" upgraded="${this.upgraded}">
                                <div class="feature-wrap">
                                <img class="w-100" id="img_${feature_id}" upgrade_patch_id="" price="0" alt="${this.title}" src="${home_url}${this.img}">
                                <span class="text-white d-flex">
                                    <svg class="feature" href="javascript:void(0)" upgrade_type="${upgrade_type}" feature_id="${feature_id}" stared="${this.stared}" upgraded="${this.upgraded}" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
                                    ${this.stared!=0 ? '<svg upgrade="'+this.upgraded+'" feature_id="'+feature_id+'" upgrade_type="'+upgrade_type+'" class="upgrade_options ml-1" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-up-circle"><circle cx="12" cy="12" r="10"></circle><polyline points="16 12 12 8 8 12"></polyline><line x1="12" y1="16" x2="12" y2="8"></line></svg>' : ''}
                                </span>
                                ${this.stared!=0 ? '<p style="left: 0;right: 0;width: 100%;text-align: center;position: absolute;top: 2px;margin: 0; opacity:0; transition: 0.3s ease opacity;font-size: 11px;background: #FFE300;padding: 4px 5px;line-height: 1;"> Upgraded</p>' : ''}
                                </div>
                            </a>
                            </ul>`; 
                });
                $('#nav3 #options').html(feature_content);
                //Features list
                $(".feature-wrap").mouseenter(function(){
                    $(this).find('span').addClass('show-buttons');
                    $(this).find('img').addClass('fade-img');
                });
                $(".feature-wrap").not(".feature-wrap span").mouseleave(function(){
                    $(this).find('span').removeClass('show-buttons');
                    $(this).find('img').removeClass('fade-img');
                });
                $(".upgrade_options").mouseenter(function(){
                    var upgrade = $(this).attr('upgrade');
                    if(upgrade == 1){
                        $(this).tooltip('dispose');
                        $(this).tooltip({ title: "Downgrade", container:'body'});
                        $(this).tooltip('show');
                    }
                    else{
                        $(this).tooltip('dispose');
                        $(this).tooltip({ title: "Upgrade", container:'body'});
                        $(this).tooltip('show');
                    }
                });
            }
        });
    });
    //End- Display Patches and Manufacturer details of a Color Scheme - End

    // Feature Info Click
    //Display Manufacturer Details of Patch and show upgrade options for upgradable features
    $('#nav3').on('click','.feature',function(){
        $(".feature-wrapper").removeClass('show-feature');  
        $("#loader").addClass('show-loader');
        $("#elevation-type-modal").modal('show');
        var upgraded=$(this).attr('upgraded');
        var feature_id = $(this).attr('feature_id');
        var upgrade_type = $(this).attr('upgrade_type');
        var stared = $(this).attr('stared');
        var upgrade_patch_id=$(this).parent().prev().attr('upgrade_patch_id');
        if(upgrade_patch_id !=''){ // upgrade patch id used to dispaly upgraded details
            var feature_id = upgrade_patch_id;
        }
        $.ajax({
            url: "/home/homemanufacturer",
            method: 'post',
            dataType : "json",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: {
            'feature_id': feature_id,
            },
            success: function(result){
                $("#elevation-type-modal .modal-body .feature-image-wrapper img").attr('src', `/uploads/homes/${result.data.img}`);
                $("#elevation-type-modal .modal-body .f-material").html(result.data.material);
                $("#elevation-type-modal .modal-body .f-manufacturer").html(result.data.manufacturer);
                $("#elevation-type-modal .modal-body .f-name").html(result.data.name);
                $("#elevation-type-modal .modal-body .f-id").html(result.data.id); 
            },
            complete: function(){
                $(".feature-wrapper").addClass('show-feature');  
                $("#loader").removeClass('show-loader');
            }
        });
    });
    //End- Display Manufacturer Details of Patch and show upgrade options for upgradable features - End
    
    //Upgrades
    $('#nav3').on('click','.upgrade_options',function(){
        var upgrade= $(this).attr('upgrade');
        if(upgrade == 0 ){
            upgrade = 1;
            $(this).attr('title', 'Downgrade');
            $(this).tooltip('dispose');
            $(this).tooltip({ title: "Downgrade", container:'body'});
            $(this).tooltip('show');
            $(this).parent().next().addClass('show-bookmark');
        }
        else{
            upgrade = 0;
            $(this).attr('title', 'Upgrade');
            $(this).tooltip('dispose');
            $(this).tooltip({ title: "Upgrade", container:'body'});
            $(this).tooltip('show');
            $(this).parent().next().removeClass('show-bookmark');
        }
        var upgrade_type=$(this).attr('upgrade_type');
        var getUpgradeOption= $('#nav3 #'+upgrade_type).attr('upgraded');
        if(upgrade==getUpgradeOption){ // if already upgraded the stop upgrading
          return false;
        }
        $('#home-loading').show();
        $(this).toggleClass("rotate-upgrade");
        var feature_id=$(this).attr('feature_id');
        $('#nav3 #'+upgrade_type).attr('upgraded',upgrade);
        var upgrade_window = 0;
        var upgrade_concrete = 0;
        var upgrade_siding = 0;
        upgrade_window=$('#window').attr('upgraded');
        upgrade_concrete=$('#concrete').attr('upgraded');
        upgrade_siding=$('#siding').attr('upgraded');
        var mort_patch_prices='';
        $(this).attr('upgrade', upgrade);
        
        var home_url="/uploads/homes/";
        $.ajax({
            url: "/home/upgradefeatures",
            method: 'post',
            dataType : "html",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: {
                'feature_id': feature_id,
                'upgrade':upgrade,
                'upgrade_window':upgrade_window,
                'upgrade_concrete':upgrade_concrete,
                'upgrade_siding':upgrade_siding,
                'total_cost':parseInt($('#total_cost').text()),
            },
            success: function(result){
                var obj = JSON.parse(result);
                $('#main_img').attr('src',home_url+obj.data2.img);
                $('#nav3 #img_'+feature_id).attr('src',home_url+obj.data.img);
                var price_with_colorsch=parseInt($('#total_cost').text());
                if(upgrade ==1){ // upgrade option
                var patch_price=parseInt(obj.data.price);
                $('#nav3 #img_'+feature_id).attr('price',patch_price);
                $('#nav3 #img_'+feature_id).attr('upgrade_patch_id',obj.data.id);
                $(this).attr('price',patch_price)
                var total=price_with_colorsch+patch_price;
                }else{ // Base option (response current price will be zero for base so get it from attr already set)
                var patch_price=$('#nav3 #img_'+feature_id).attr('price');
                var total=price_with_colorsch-patch_price;
                $('#nav3 #img_'+feature_id).attr('upgrade_patch_id',obj.data.id);
                }
                var total_cost=Math.round(total);
                $('#total_cost').text(total_cost);
                $('#amount').val(total_cost);
                $('#amount_display').text(formatter.format(total_cost));
                downrate();
                calculatePayment();
    
                $('#home-loading').hide();
                var home_upgrade_patches=new Array();
                $('#nav3 .feature').each(function(){
                    if($(this).parent().parent().parent().attr('upgraded')==1){
                        home_upgrade_patches.push($(this).parent().prev().attr('upgrade_patch_id'));
                        var patch_price=Math.round(parseInt($(this).parent().prev().attr('price')));
                        if($(this).attr('upgrade_type')=='concrete'){
                        mort_patch_prices +='<div class="base-price">Concrete Upgrade<span>$'+patch_price+'</span></div>';
                        }
                        if($(this).attr('upgrade_type')=='window'){
                        mort_patch_prices +='<div class="base-price">Window Upgrade<span>$'+patch_price+'</span></div>';
                        }
                        if($(this).attr('upgrade_type')=='siding'){
                        mort_patch_prices +='<div class="base-price">Side Upgrade<span>$'+patch_price+'</span></div>';
                        }
                    }
                });
                $('#mort_upgrade_options').html(mort_patch_prices);
                var home_customization=$('#new_data').html();
                set_price_session(total_cost,home_customization,home_upgrade_patches);
            }
        });
    });

    function set_price_session(total_cost,home_customization,home_upgrade_patches){
        $.ajax({          
            url: "/home/pricesession",
            method: 'post',
            dataType : "html",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: {
                'home_price': total_cost,
                'home_customization': home_customization,
                'home_upgrade_patches': home_upgrade_patches,
            },
            success: function(result){
                var obj = JSON.parse(result);
            }
        });
    }

    // Generate Estimate
    $("#generate_estimate").click(function(){
        if(auth == true){
            window.location.href = estimate;
        }
        else{
            $('#exampleModal').modal('show');
        }
    });

    //Note
    $('#msg_save').click(function(e){
        var msg=$('#msg').val();
        if(msg ==''){
            //e.preventDefault();
            return false;
        }
        $.ajax({
            url: "/home/save_msg",
            method: 'post',
            dataType : "json",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: {
            'msg': msg,
            },
            success: function(result){
                toastr.success(result.data);
            }
        });
    });

    // Tabs Switch
    $('#nav-tab1').on('shown.bs.tab', function (e) {
        tabsCarousel.slick('unslick').slick({
          infinite: true,
          speed: 500,
          fade: true,
          cssEase: 'linear',
          dots: false,
          arrows: true,
          autoplay: true,
          adaptiveHeight: true
        });
        e.target // newly activated tab
        e.relatedTarget // previous active tab
    })
}

// X-Floor
if(currentRoute == "xfloor"){
    $("#pb-elevation-type, #pb-elevation, #pb-community, #pb-lot, #pb-color").addClass('active complete');
    $("#pb-floor").addClass('active')
    $(".progressbar li.complete span").html("done");

    let scale = 1;
    var counter = 0;

    function step(zoom){
        if(zoom == "zoom-in"){
            scale = scale + 0.25;
            $(".floor_img").css({
            "transform" : `scale(${scale})`
            });
        }
        else{
            if(scale > 1){
                scale = scale - 0.25;
                $(".floor_img").css({
                "transform" : `scale(${scale})`
                });
            }
        }
    }
    function elevationPopup(){
        $("#property-modal").modal('show');
    }

    // Floor List Mouseover Functionality
    $('.xfloor-list span.fttl').on('mouseover', function (e) {
        $(document).find('.overedimage').fadeOut(300).remove();
        var fid = $(this).attr('data-self');
        var fimg = $(this).attr('data-image');
        var dcon = $(this).attr('data-conflicts');
        var floor_no = $('.floorList.active').attr('floor_no');
        var featureImage = '<img src="/uploads/features/'+fimg+'" id="'+fid+'" class="overedimage">';
        $(featureImage).hide().appendTo('.floor_image_view'+floor_no).fadeIn(300);

        let conflicts = (dcon) ? JSON.parse(dcon) : [];
        for (var i = 0; i < conflicts.length; i++) {
            let value = conflicts[i];
            $('img#'+value).addClass('d-none');
        }
    });
    $('.xfloor-list span.fttl').on('mouseout', function (e) {
        var floor_no = $('.floorList.active').attr('floor_no');
        $(document).find('.overedimage').fadeOut(300).remove();
        $('.ftImage img').removeClass('d-none');
    });
    $('.floorList').click(function(){
        $('.floor_img').fadeOut();
        $('.floor_no'+$(this).attr('floor_no')).fadeIn();
    });

      //get checked features and go to final page
    function final_finish(){
        $(document).find('.manageToggle').each(function(){
            let checked = $(this).find('input').is(':checked');
            if(checked){
                let featureid = $(this).attr('data-self');
                let featureInput = '<input name="feature_id[]" type="hidden" value="'+featureid+'">';
                $(document).find("input[name='home_id']").after(featureInput);
            }
        });
        $(document).find('#finishPage_form').submit();
    }

    $(".checkbox").click(function() {   
        var total1 = 0;
        var total2 = 0;
        var d_total1 = 0;
        var d_total2 = 0; 
        var customization='';
        var scheck = 0;
        var prehome = totalPrice;
        var flist = new Array();
        var floor_no=$('.floorList.active').attr('floor_no');
        var floor_count= floorCount;
        $(".checkbox").each(function() {
            if($(this).prop('checked')){
                var feature_price = $(this).val();
                var title = $(this).attr('title');
                feature_price = feature_price.replace(/[|&;$%@"<>()+,]/g, "");
                total1 += parseInt(feature_price);
                var home_cost = prehome ;
                total2 = parseInt(home_cost);
                d_total1 = total2 + total1;
                d_total2 = d_total1;

                //Monthly Payment
                var termOfLoan = $('#term').val();
                var annualInterestRate = $('#rate').val();
                var total_downpay = $('#downpay_amt').val();
                total_downpay = total_downpay.replace(/[|&;$%@"<>()+,]/g, "");
                if ( termOfLoan.match("y") ) {
                    termOfLoan = parseInt( termOfLoan.replace(/[^\d.]/ig, ''), 10 )*12;
                } 
                else {
                    termOfLoan = parseInt( termOfLoan.replace(/[^\d.]/ig, ''), 10 );
                }
                var total_pay = d_total1 - total_downpay;
                var monthly_interest = annualInterestRate / 100 / 12;
                var x = Math.pow( 1 + monthly_interest, termOfLoan), 
                monthlyPayment = ( total_pay * x * monthly_interest ) / ( x - 1 );
                var a = Math.round(monthlyPayment);
                var output = a;
                $('#payment').html('$'+output);
                $('#payments').html(output);

                //Down Rate
                var down = $('#downpay_amt').val();
                down = down.replace(/[|&;$%@"<>()+,]/g, "");
                var total_income = monthlyPayment * termOfLoan + parseInt(down);
                var income = Math.round(total_income);
                $('#paymentss').html(income);
                scheck = 1;
            }
        });
        for (var i = 1; i <= floor_count; i++) {
            var flistids = new Array();
            $("#floor-tabs-"+i+" .checkbox").each(function() {
                if($(this).prop('checked')){
                    var fid = $(this).attr('id');
                    flistids.push(fid);
                }
            });
            flist.push(flistids);
        }
        var floor_no=$('.floorList.active').attr('floor_no');
        $(".floor_options.active .checkbox").each(function() {
            if($(this).prop('checked')){
                var feature_price = $(this).val();
                var title = $(this).attr('title');
                feature_price = feature_price.replace(/[|&;$%@"<>()+,]/g, "");
                customization +='<div class="base-price">'+title+' <span>$'+feature_price+'</span></div>';
            }
        });
        $('#floor_customization'+floor_no).html(customization);
        $('#floor_heading').show();
        if(scheck == 0) {
          var home_cost = prehome;
          d_total2 = parseInt(home_cost);
        }
        $('#total_costs').html(d_total2);
        $('#amount').val(d_total2);
        $('#amount_display').text(formatter.format(d_total2));
        downrate1();
        flist = JSON.stringify(flist);
        var floor_customization= $('#floor_customization').html();
        set_price_session(d_total2,floor_customization,flist);
    });

    function updateemi(){
        var principal = document.getElementById("amount").value;
        principal = principal.replace(/[|&;$%@"<>()+,]/g, "");
        var termOfLoan = document.getElementById("term").value;
        var annualInterestRate = document.getElementById("rate").value;
        if ( termOfLoan.match("y") ) {
            termOfLoan = parseInt( termOfLoan.replace(/[^\d.]/ig, ''), 10 )*12;
        } 
        else {
            termOfLoan = parseInt( termOfLoan.replace(/[^\d.]/ig, ''), 10 );
        }
        var total_downpay = document.getElementById("downpay_amt").value;
        total_downpay = total_downpay.replace(/[|&;$%@"<>()+,]/g, "");
        var total_pay = principal - total_downpay;
        var monthly_interest = annualInterestRate / 100 / 12;
        var x = Math.pow( 1 + monthly_interest, termOfLoan);
        var monthlyPayment = ( total_pay * x * monthly_interest ) / ( x - 1 );
        var a = Math.round(monthlyPayment);
        var output = a;
        document.getElementById("payment").innerHTML = '$'+output;
        document.getElementById("payments").innerHTML = output;
        // document.getElementById("payments1").innerHTML = output;
        var downpay_amt = document.getElementById("downpay_amt").value;
        downpay_amt = downpay_amt.replace(/[|&;$%@"<>()+,]/g, "");
        var total_income = monthlyPayment * termOfLoan + parseInt(downpay_amt);
        var income = total_income.toFixed(0);
        document.getElementById("paymentss").innerHTML = income;
    }

    function downrate1(){
        var principal = document.getElementById("amount").value;
        principal = principal.replace(/[|&;$%@"<>()+,]/g, "");
        var down_rate = document.getElementById("downpay_rate").value;
        var total_downpay = (principal * down_rate) / 100;
        var total_downpay = Math.round(total_downpay);
        document.getElementById("downpay_amt").value = total_downpay;
    }

    function downpayment1(){
        var principal = document.getElementById("amount").value;
        principal = principal.replace(/[|&;$%@"<>()+,]/g, "");
        var down = document.getElementById("downpay_amt").value;
        down = down.replace(/[|&;$%@"<>()+,]/g, "");
        var percent = (down * 100) / principal;
        document.getElementById("downpay_rate").value = percent;
    } 

    //Note 
    $('#msg_save').click(function(){
        var msg = $("#msg").val();
        if(msg ==''){
            toastr.info("Please enter some note in your message");
            return false;
        }
        $.ajax({
            url : "/floor/save-msg/",
            method: 'post',
            dataType : "json",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: {
                'msg': msg,
            },
            success: function(result)
            {
                toastr.success(result.data);
            }
        });
    });

    $('.clear-btn').click(function(){
        $("#msg").val('');
        $.ajax({
            url: "/floor/save-msg/",
            method: 'post',
            dataType : "json",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: {
                'msg': '',
            },
            success: function(result)
            {
                toastr.success("Your Message has been cleared.");
            }
        });
    });

    $(".refrest-btn").click(function(){
        counter += 180;
        $('.refrest-btn div').css('transform', 'rotate(' + counter + 'deg)')
        $(".floor_img").css("transform","scale(1)");
        $(".floor_img").css({'left':'0', 'top':'0'});
        scale = 1;
    });

    function checkPreChecked() {
        var features = JSON.parse(featuresData);
        for (var i = 1; i <= features.length; i++) {
            (function(floor_no) {
                $.ajax({
                    url         : '/get-feature-data',
                    type        : "post",
                    data        : {'featureid':features[i-1]},
                    headers     : {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success     : function (response) {
                        if(response.length > 0){
                            $.each(response, function( index, value ){
                                let featureImage = '<img src="'+value.image+'" class="ftImage" id="'+value.id+'">';
                                $(document).find('.floor_image_view'+floor_no).append(featureImage);
                            });
                        }    
                    }
                });
            })(i);
            for(let index = 0; index < features[i-1].length; index++) {
                var element = features[i-1][index];
                $('input[type="checkbox"]#'+element).trigger('click');
            }
        }
    }

    function set_price_session(total_cost,floor_customization,featureid){
        $.ajax({
            url         : "/floor/pricesession",
            method      : 'post',
            dataType    : "html",
            headers     : {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data        : {
                            'total_price': total_cost,
                            'feature_id': featureid,
                            'floor_customization': floor_customization,
                        },
        });
    }

    // Tabs Switch Data Display
    $('#nav-tab3').on('shown.bs.tab', function (e) {
        $('.elevation-home-img').fadeOut(function(){
        $('.floor-plan-img').fadeIn();
        });
        e.target // newly activated tab
        e.relatedTarget // previous active tab
    })
    $('#nav-tab2').on('shown.bs.tab', function (e) {
        $('.floor-plan-img').fadeOut(function(){
        $('.elevation-home-img').fadeIn();
        });
        e.target // newly activated tab
        e.relatedTarget // previous active tab
    });

    // Image Hover Buttons
    $(".home-img").mouseenter(function(){
        $(this).find('span').addClass('show-buttons');
        $(this).find('img').addClass('fade-img');
    });
    $(".home-img").not(".home-img span").mouseleave(function(){
        $(this).find('span').removeClass('show-buttons');
        $(this).find('img').removeClass('fade-img');
    });
    $('#nav-tab1').on('shown.bs.tab', function (e) {
        tabsCarousel.slick('unslick').slick({
        infinite: true,
        speed: 500,
        fade: true,
        cssEase: 'linear',
        dots: false,
        arrows: true,
        autoplay: true,
        adaptiveHeight: true
        });
        e.target // newly activated tab
        e.relatedTarget // previous active tab
    })
    // Slick Slider & Light Gallery for Property Info Modal
    $("#property-modal").on('show.bs.modal', function(){
        propertyModalCarousel.slick('unslick').slick({
        infinite: true,
        speed: 500,
        fade: true,
        cssEase: 'linear',
        dots: false,
        arrows: true,
        autoplay: true,
        });
    });

    //set local storage default values
    localStorage.setItem('home_id',1);
    localStorage.setItem('floor_id',1);
    localStorage.setItem('feature_id',1);
    loadCheckFinalAclSettings();

    $(document).on('click','.home_list', function(e){
        let homeid = $(this).attr('id');
        $("input[name='home_id']").val(homeid);
        localStorage.setItem('home_id',homeid);
        let homeEnId = $(this).attr('data-home-id');
        $(document).find('.floor_image_view').addClass('disp_none');
        // Show Full Home Image
        $(document).find('.home_image_full').each(function(i,obj){
            if($(obj).attr('id')===homeid){
                $(obj).removeClass('disp_none');
            }else{
                $(obj).addClass('disp_none');
            }
        });
        $(document).find('.home_image_title').each(function(i,obj){
            if($(obj).attr('id')===homeid){
                $(obj).removeClass('disp_none');
            }else{
                $(obj).addClass('disp_none');
            }
        });
        $(document).find('.home_image_footer').each(function(i,obj){
            if($(obj).attr('id')===homeid){
                $(obj).removeClass('disp_none');
            }else{
                $(obj).addClass('disp_none');
            }
        });
        //Set Floors of current home
        $(document).find('.home_floors').each(function(i,obj){
            if($(obj).attr('data-floor-home-id')===homeid){
                $(obj).removeClass('disp_none');
            }else{
                $(obj).addClass('disp_none');
            }
        });
    });

    $(document).on('click','.tabDiv', function(e){
        let tab = $(this).attr('id');
        // To show div content of current tab
        $(document).find('.tabDivSection').each(function(i,obj){
            if($(obj).attr('id')===tab){
                $(obj).removeClass('disp_none');
            }else{
                $(obj).addClass('disp_none');
            }
        });
        if(tab=='floor'){
            $('.floorList:first').click();
        }else{
            $(document).find('.floor_image_view').addClass('disp_none');
            let homeid = localStorage.getItem('home_id');
            $(document).find('.home_image_full').each(function(i,obj){
                if($(obj).attr('id')===homeid){
                    $(obj).removeClass('disp_none');
                }else{
                    $(obj).addClass('disp_none');
                }
            });
        }
    });

    // function to set depandent and together toggle off on load
    function checkDependencyToggle(){
        $(document).find('.floor_options.active .manageToggle').each(function(){
            let iid = $(this).attr('data-title');
            let dependency = ($(this).attr('data-dependency')) ? JSON.parse($(this).attr('data-dependency')) : [];
            for (var i = 0; i < dependency.length; i++) {
                let value = dependency[i];
                $('.dependency_'+value).prop('disabled',true).next('i').addClass('disabled');
                $('.dependency_'+value).parents('li').addClass('confilmsg').attr('data-tooltip', iid+' must be selected');
            }
            let togetherness = ($(this).attr('data-togetherness')) ? JSON.parse($(this).attr('data-togetherness')) : [];
            for (var i = 0; i < togetherness.length; i++) {
                let value = togetherness[i];
                $('.togetherness_'+value).parents('li').addClass('confilmsg').attr('data-tooltip', 'Comes with '+iid);
            }
        });
    }
    
    $(document).on('click','.downloadPDFBtn', function(e){
        $(document).find('#pdf_form').submit();
    });

    function hideConflicts(toggleId){
        let currentElement = $('label#ftlabel'+toggleId);
        let conficts = (currentElement.attr('data-conflicts')) ? JSON.parse(currentElement.attr('data-conflicts')) : [];
        let selectfet = currentElement.attr('data-title');
        for (var i = 0; i < conficts.length; i++) {
            let values = conficts[i];
            $('.conflicts_'+values).prop('checked',false);
            hideTogetherness(values);
        }
    }

    function showTogetherness(toggleId){
        let currentElement = $('label#ftlabel'+toggleId);
        let togetherness = (currentElement.attr('data-togetherness') ) ? JSON.parse(currentElement.attr('data-togetherness')) : [];
        for (var i = 0; i < togetherness.length; i++) {
            let values = togetherness[i];
            $('.togetherness_'+values).parents('li').removeClass('confilmsg').removeAttr('data-tooltip');
            $('.togetherness_'+values).prop('checked',true);
            //Manage Conflicts
            hideConflicts(values);
            //Manage Dependency
            showDependency(values);
        }   
    }
    function hideTogetherness(toggleId){
        let currentElement = $('label#ftlabel'+toggleId);
        let togetherness = (currentElement.attr('data-togetherness') ) ? JSON.parse(currentElement.attr('data-togetherness')) : [];
        let selectfet = currentElement.attr('data-title');
        for (var i = 0; i < togetherness.length; i++) {
            let values = togetherness[i];
            $('.togetherness_'+values).prop('checked',false);
            $('.togetherness_'+values).parents('li').addClass('confilmsg').attr('data-tooltip', 'Comes under '+selectfet);
            //Manage Conflicts
            //Manage Dependency
            hideDependency(values);
        }   
    }
    function showDependency(toggleId){
        let currentElement = $('label#ftlabel'+toggleId);
        let dependency = (currentElement.attr('data-dependency')) ? JSON.parse(currentElement.attr('data-dependency')) : [];
        if(dependency.length > 0){
            for (var i = 0; i < dependency.length; i++) {
                let value = dependency[i];
                $('.dependency_'+value).parents('li').removeClass('confilmsg').removeAttr('data-tooltip');
                $('.dependency_'+value).prop('disabled',false).next('i').removeClass('disabled');
            }
        }
    }

    function hideDependency(toggleId){
        let currentElement = $('label#ftlabel'+toggleId);
        let dependency = (currentElement.attr('data-dependency')) ? JSON.parse(currentElement.attr('data-dependency')) : [];
        let selectfet = currentElement.attr('data-title');
        if(dependency.length > 0){
            for (var i = 0; i < dependency.length; i++) {
                let value = dependency[i];
                $('.dependency_'+value).prop('checked',false).prop('disabled',true).next('i').addClass('disabled');
                $('.dependency_'+value).parents('li').addClass('confilmsg').attr('data-tooltip', 'Depends on '+selectfet);
            }
        }
    }

    function checkFinalAclSettings(){
        checkDependencyToggle();
        var onOptions = [];
        $(document).find('.floor_options.active .manageToggle').each(function(){
            //alert('code2');
            let checked = $(this).find('input').is(':checked');
            if(checked){
                let toggleId = $(this).attr('data-self');
                onOptions.push(toggleId);
            }
        });
        if(onOptions.length > 0){
            for(var i = 0; i < onOptions.length; i++){
                let toggleId = onOptions[i];
                showDependency(toggleId);
            }
        }
        if(onOptions.length > 0){
            for(var i = 0; i < onOptions.length; i++){
                let toggleId = onOptions[i];
                showTogetherness(toggleId);
            }
        }
        if(onOptions.length > 0){
            for(var i = 0; i < onOptions.length; i++){
                let toggleId = onOptions[i];
                hideConflicts(toggleId);
            }
        }
    }

    function loadCheckFinalAclSettings(){
        checkDependencyToggle();
        var onOptions = [];
        $(document).find('.floor_options .manageToggle').each(function(){
            //alert('code2');
            let checked = $(this).find('input').is(':checked');
            if(checked){
                let toggleId = $(this).attr('data-self');
                onOptions.push(toggleId);
            }
        });
        if(onOptions.length > 0){
            for(var i = 0; i < onOptions.length; i++){
                let toggleId = onOptions[i];
                showDependency(toggleId);
            }
        }
        if(onOptions.length > 0){
            for(var i = 0; i < onOptions.length; i++){
                let toggleId = onOptions[i];
                showTogetherness(toggleId);
            }
        }
        if(onOptions.length > 0){
            for(var i = 0; i < onOptions.length; i++){
                let toggleId = onOptions[i];
                hideConflicts(toggleId);
            }
        }
    }

    function preset_price_session(total_cost,floor_customization,featureid)
    {
        $.ajax({
            url: SITE_URL+'/floor/pricesession',
            method: 'post',
            dataType : "html",
            data: {
                 'total_price': total_cost,
                 'feature_id': featureid,
                 'floor_customization': floor_customization,
            },
            headers: {
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     },
            success: function(result){}
                 
        });
    }

    $(document).on('click','.reset-btn',function(event) {
        $('input[type="checkbox"]:checked').prop("checked", false);
        $(document).find('.ftImage').remove();
        var home_cost = $('#prehomecost').val();
        $('#total_costs').html(home_cost);
        $('#amount').val(home_cost);
        $('#amount_display').text(home_cost);
        $('#floor_customization').html('');
        $('li.xfloor-list').removeClass('confilmsg').removeAttr('data-tooltip');
        //downrate1();
        // updateemi();
        loadCheckFinalAclSettings();
        preset_price_session(home_cost);
    });

    // set acl toggles when a toggle is clicked
    $(document).on('change','.floor_options.active .manageToggle',function(event) {
        //Ranjan's Code
        let toggleId = $(this).attr('data-self');
        let checked = $('input#'+toggleId).is(':checked');
        // When toggle gets on
        if(checked ){
            hideConflicts(toggleId);
            showTogetherness(toggleId);
            showDependency(toggleId);
            checkFinalAclSettings();
        }else{
            // Manage Conflicts
            hideTogetherness(toggleId);
            hideDependency(toggleId);
            checkFinalAclSettings();
        }

        // Get all on toggles
        var checkedOptions = [];
        $(document).find('.floor_options.active .manageToggle').each(function(){
            //alert('code3');
            let checkTrue = $(this).find('input').is(':checked');
            if(checkTrue){
                let toggleId = $(this).find('input').attr('id');
                checkedOptions.push(toggleId);
            }
        });
        // Load featues image
        $.ajax({
            url         : app_base_url+'/get-feature-data',
            type        : "post",
            data        : {'featureid':checkedOptions},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend  : function () {
                $("#preloader").show();
            },
            complete: function () {
                $("#preloader").hide();
            },
            success: function (response) {
                var floor_no=$('.floorList.active').attr('floor_no');
                $(document).find('.floor_image_view'+floor_no+' .ftImage').remove();
                if(response.length > 0){
                    $.each(response, function( index, value ){
                       let featureImage = '<img src="'+value.image+'" id="'+value.id+'" class="ftImage">'
                        $(document).find('.floor_image_view'+floor_no).append(featureImage);
                    });
                }
            }
        });
    })

    function setupForTogetherness(togetherness,flag) {
        var postData = [];
        if(togetherness.length) {
               togetherness.map(function(item){
                let togethernessValue= item;
                $('.dependency_'+togethernessValue).prop('disabled',false);
                $('.dependency_'+togethernessValue).prop('checked',flag);
                $('.dependency_'+togethernessValue).prop('disabled',true).next('i').addClass("disabled");
                postData.push(togethernessValue);
            })
        }
        return postData;
    }
    function setupForDependency(dependencyProp,flag) {
        var postData = [];
        if(dependencyProp.length) {
               dependencyProp.map(function(item){
                let dependencyPropValue= item;
                $('.dependency_'+dependencyPropValue).prop('disabled',false);
                $('.dependency_'+dependencyPropValue).prop('checked',flag);
                $('.dependency_'+dependencyPropValue).prop('disabled',true).next('i').addClass("disabled");
                postData.push(dependencyPropValue);
            })
        }
        return postData;
    }
    function unique(list) {
        var result = [];
        $.each(list, function(i, e) {
            if ($.inArray(e, result) == -1) result.push(e);
        });
        return result;
    }

    function dragElement(elmnt) {
        var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
        if (document.getElementById(elmnt.id)) {
            /* if present, the header is where you move the DIV from:*/
            document.getElementById(elmnt.id).onmousedown = dragMouseDown;
        } else {
            /* otherwise, move the DIV from anywhere inside the DIV:*/
            elmnt.onmousedown = dragMouseDown;
        }

        function dragMouseDown(e) {
            e = e || window.event;
            e.preventDefault();
            // get the mouse cursor position at startup:
            pos3 = e.clientX;
            pos4 = e.clientY;
            document.onmouseup = closeDragElement;
            // call a function whenever the cursor moves:
            document.onmousemove = elementDrag;
        }

        function elementDrag(e) {
            e = e || window.event;
            e.preventDefault();
            // calculate the new cursor position:
            pos1 = pos3 - e.clientX;
            pos2 = pos4 - e.clientY;
            pos3 = e.clientX;
            pos4 = e.clientY;
            // set the element's new position:
            elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
            elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
        }

        function closeDragElement() {
            /* stop moving when mouse button is released:*/
            document.onmouseup = null;
            document.onmousemove = null;
        }
    }
    $(".floor_img").mouseenter(function(){
        var draggableElement = $(this).attr('id');
        dragElement(document.getElementById(draggableElement));
    });
}