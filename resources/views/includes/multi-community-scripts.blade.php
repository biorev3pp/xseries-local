<!-- Bootstrap Dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>    
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<!-- MDB Bootstrap -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.0/js/mdb.min.js"></script>
<!--    Light Gallery-->
<script src="https://cdn.jsdelivr.net/combine/npm/lightgallery,npm/lg-autoplay,npm/lg-fullscreen,npm/lg-hash,npm/lg-pager,npm/lg-share,npm/lg-thumbnail,npm/lg-video,npm/lg-zoom" crossorigin="anonymous"></script>
@if(Route::currentRouteName() == "elevation" || Route::currentRouteName() == "search-elevation")
<!-- Slick Carousel -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js" integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg==" crossorigin="anonymous"></script>
@endif
<!--Select2-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous"></script>    
<!--Range Slider-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/js/ion.rangeSlider.min.js"></script>
<!-- Toastr -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<!-- Google Api -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDW-MNsJkIli84no9ZFtyx5uJrEUFPCACE&libraries=places,drawing" async defer></script>
<!-- Tidio -->
<script src="//code.tidio.co/nd3ei3sfxvutpyoyimav0ivh6gboahhy.js" async></script>
<script>
	const currentRoute 	= '{{Route::currentRouteName()}}';
    const minPrice      = <?php echo $range['min_price'] ?>;
    const maxPrice      = <?php echo $range['max_price'] ?>;
    const fromPrice     = <?php if(isset($_GET['price_range'])) 
                            { $price = explode(';',$_GET['price_range']); echo $price[0];}
                            else { echo $range['min_price'];} ?>;
    const toPrice       = <?php if(isset($_GET['price_range'])) 
                            { $price = explode(';',$_GET['price_range']); echo $price[1];} 
                            else { echo $range['max_price'];} ?>;
    const minArea       = <?php echo $range['min_area'] ?>;
    const maxArea       = <?php echo $range['max_area'] ?>;
    const fromArea      = <?php if(isset($_GET['feet'])) 
                            { $area = explode(';',$_GET['feet']); echo $area[0];} 
                            else { echo $range['min_area'];} ?>;
    const toArea        = <?php if(isset($_GET['feet'])) 
                            { $area = explode(';',$_GET['feet']); echo $area[1];} 
                            else { echo $range['max_area'];} ?>;
    const minBed        = <?php echo $range['min_bedroom'] ?>;
    const maxBed        = <?php echo $range['max_bedroom'] ?>;
    const fromBed       = <?php if(isset($_GET['bedroom'])) 
                            { $bedroom = explode(';',$_GET['bedroom']); echo $bedroom[0];} 
                            else { echo $range['min_bedroom'];} 
                            ?>;
    const toBed         = <?php if(isset($_GET['bedroom'])) 
                            { $bedroom = explode(';',$_GET['bedroom']); echo $bedroom[1];} 
                            else { echo $range['max_bedroom'];} 
                            ?>;
    const minBath       = <?php echo $range['min_bathroom'] ?>;
    const maxBath       = <?php echo $range['max_bathroom'] ?>;
    const fromBath      = <?php if(isset($_GET['bathroom'])) 
                            { $bathroom = explode(';',$_GET['bathroom']); echo $bathroom[0];} 
                            else { echo $range['min_bathroom'];} 
                            ?>;
    const toBath        = <?php if(isset($_GET['bathroom'])) 
                            { $bathroom = explode(';',$_GET['bathroom']); echo $bathroom[1];} 
                            else { echo $range['max_bathroom'];} 
                            ?>;
    @if(Route::currentRouteName() == "community" || Route::currentRouteName() == "elevation-communities")
        const cLat  = <?php if($ccount >= 1): echo $communities[0]['lat']; else: echo 48.0633173; endif; ?>;
        const cLng  = <?php if($ccount >= 1): echo $communities[0]['lng']; else: echo -114.0809202; endif; ?>;
    @endif
</script>
<script src="{{asset('Xseries-new-ui/js/search-page-minified.js')}}"></script>
