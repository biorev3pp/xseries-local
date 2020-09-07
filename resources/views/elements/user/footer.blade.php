<style>
   footer {
    background-color: #313131;
    position: fixed;
    bottom: 0;
    width: 100%;
    height: 38px;
    z-index: 2000;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 15px;
    left: 0;
}
footer p {
    color: #fff;
    font-size: 12px;
    margin: 0;
    line-height: 1;
}
footer p a{
   color: #9fcc3a;
}
@media (max-width: 555px){
   footer {
      padding: 0 10px;
   }
   footer p {
    font-size: 10px;
   }
}
@media (max-width: 350px){
   footer p {
      font-size: 8px;
   }
}
</style>
<footer>
   <p> ©  2020 Biorev, All Rights Reserved. </p>
   <p>Designed &amp; Developed By <a href="https://biorev.com" target="_blank">Biorev</a></p>
</footer>
<script type="text/javascript">
   var app_base_url = "{{url('/')}}";
   // In your Javascript (external .js resource or <script> tag)
   $(document).ready(function() 
   {
   $(document).find('.js-example-basic-single').select2();
   });
</script>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

  <script src="{{ asset('user/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('user/datatables/datatables-demo.js') }}"></script> 
