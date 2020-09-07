var APP_URL = 'https://xseries360.com/';
var token = $('meta[name="csrf-token"]').attr('content');
get_url();
// update url count of current page url
function get_url(){
    var current_url = window.location.href;
    console.log(current_url);
    $.ajax({
        type: 'POST',
        url: APP_URL+'api/update-url-impression',
        data: {'_token':token,'url':current_url},

        success: function(result){
            ///console.log(result);
        }

    })  
}
// xseries.rendering360.com page analytics module
$(document).on('click','a',function(){
    var currentPage = (window.location.href).split('/').pop();
    if(currentPage ==''){
        var community_name =($(this).attr('href')).split('/').pop();
        
        $.ajax({
            type: 'POST',
            url: APP_URL+'api/update-communities-click',
            data: {'_token':token,'c_name':community_name,'type':'plats'},
    
            success: function(data){
               // console.log(data);
            }
        })
    }
    if(currentPage == 'plat'){
        $.each(this.attributes, function(b,c) {
            if(c.name=='data-pid'){
              //  alert("Vlicked on view more"+c.name+" "+c.value);
               // console.log(b,c.name,c.value,'');
               $.ajax({
                type: 'POST',
                url: APP_URL+'api/update-plats-lots-click',
                data: {'_token':token,'lot_id':c.value},
        
                success: function(result){
                    //console.log(result);
                }
    
               }) 
            } 
           
        });
    }

    if(currentPage == 'home'){
         var home_id = $('a[caption_id]').attr('caption_id');
       // var home_id =  
        $.each(this.attributes,function(b,c){
            if(c.name=='title'){
                $.ajax({
                    type: 'POST',
                    url: APP_URL+'api/color-scheme-click-analytics',
                    data: {'_token':token,'home_id':home_id,'color_scheme':c.value},
                    success: function(result){
                        //console.log(result);
                    }
        
                   }) 
            }

            if(c.name == 'caption_id'){
                $.ajax({
                    type: 'POST',
                    url: APP_URL+'api/color-scheme-analytics',
                    data: {'_token':token,'home_id':c.value},
            
                    success: function(result){
                     //   console.log(result);
                    }
        
                   }) 
            }
            if(c.name == 'id' && c.value == 'imageGallery-tab'){
                
                $.ajax({
                    type: 'POST',
                    url: APP_URL+'api/color-scheme-analytics',
                    data: {'_token':token,'home_id':home_id},
            
                    success: function(result){
                      //  console.log(result);
                    }
        
                   }) 
            }
        });
       
    }
   
});
$(document).on('click','button',function(){
    var currentPage = (window.location.href).split('/').pop();
    if(currentPage ==''){
        $.each(this.attributes, function(b,c) {
            if(c.name=='community'){
               // console.log(b,c.name,c.value,'');
               $.ajax({
                type: 'POST',
                url: APP_URL+'api/update-communities-click',
                data: {'_token':token,'c_id':c.value,'type':'elevations'},
        
                success: function(result){
                   // console.log(result);
                }
    
               }) 
            } 
           
        });
    }
    if(currentPage == 'plat'){
    }
    if(currentPage == 'home'){
        if($(this).attr('id')=='upgrade_btn')
       {
        var f_id = ($(this).attr('feature_id'));
        $.ajax({
            type: 'POST',
            url: APP_URL+'api/color-scheme-upgrade',
            data: {'_token':token,'feature_id':f_id},
    
            success: function(result){
             //   console.log(result);
            }
        })
           

       }
    }
});
$(document).on('change','select',function(){
    var currentPage = (window.location.href).split('/').pop();
    if(currentPage ==''){
    var cityId = $(this).find(':selected').val();
    $.ajax({
        type: 'POST',
        url: APP_URL+'api/update-communities-impression',
        data: {'_token':token,'city_id':cityId},

        success: function(result){
          //  console.log(result);
        }
    })
    }
});
// xseries.rendering360.com/plat analytics module here
$(document).on('click','div',function(){
    var currentPage = (window.location.href).split('/').pop();
    if(currentPage == 'plat'){
        $.each(this.attributes, function(b,c) {
            if(c.name=='data-pid'){
               // console.log(b,c.name,c.value,'');
               
               $.ajax({
                type: 'POST',
                url: APP_URL+'api/update-plats-home-click',
                data: {'_token':token,'home_id':c.value},
        
                success: function(result){
                 //   console.log(result);
                }
    
               }) 
            }
           
        });
    }
   
});
// handle when clicked on G tag
$(document).on('click','g',function(){
    var currentPage = (window.location.href).split('/').pop();
    if(currentPage == 'plat'){
        $.each(this.attributes, function(b,c) {
    if(c.name =='data-lid'){       
        $.ajax({
         type: 'POST',
         url: APP_URL+'api/update-plats-lots-click',
         data: {'_token':token,'lot_id':c.value},
 
         success: function(result){
             //console.log(result);
         }
        }) 
    }
});
     } 
})
// handle range slider 
$(document).on('click','span.irs-handle',function(){
    var selectedfilter = $('#nav-tab').find('a.active').text(); 
    var valFrm = $('.tab-pane').find('.active').find('.irs-from').html();
    var valTo = $('.tab-pane').find('.active').find('.irs-to').html();
   // alert(selectedfilter+" " +valFrm+" "+ valTo);
    
        $.ajax({
            type: 'POST',
            url: APP_URL+'api/lots-filter',
            data: {'_token':token,'type':selectedfilter,'range_from':valFrm,'range_to':valTo,},
    
            success: function(result){
               // console.log(result);
            }   
        })   
})
// Handle list clicked on designed page
$(document).on('click','ul li',function(){
    var currentPage = (window.location.href).split('/').pop();
    if(currentPage == 'design'){
        $.each(this.attributes,function(b,c){
            if(c.name == 'data-slug'){
                $.ajax({
                    type: 'POST',
                    url: APP_URL+'api/design-type-analytics',
                    data: {'_token':token,'type':c.value},
                    success: function(result){
                      //  console.log(result);
                    }   
                })
            }
            if(c.name == 'data-designslug'){
                $.ajax({
                    type: 'POST',
                    url: APP_URL+'api/design-select-analytics',
                    data: {'_token':token,'home_design_id':'7'},
            
                    success: function(result){
                       // console.log(result);
                    }   
                })
            }
        });  
    }
    // if(currentPage == 'floor'){
    
    //     if ($(this).find('label').find('input[data-check-floor-id]').attr('data-check-floor-id') != null){
    //         alert($(this).find('input[data-check-floor-id]').attr('id'));
    //       } else {
    //         alert("You didn't check it! Let me check it for you.")
    //       }
    // }
})
// handle the click on floor filter section
$(document).on('click','label input',function(){
   
    var currentPage = (window.location.href).split('/').pop();
    if(currentPage == 'floor'){
        var f_id = $(this).attr('id');
        $.ajax({
            type: 'POST',
            url: APP_URL+'api/floor-filter-analytics',
            data: {'_token':token,'feature_id':f_id},
    
            success: function(result){
               // console.log(result);
            }   
        })
    }
})