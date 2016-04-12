jQuery(document).ready(function($){
    $('#ticker').ticker({displayType:'fade',controls:false,'titleText':'Latest News'});
    
    $('.documents .updates li').click(function(){
        $(this).find('a').trigger('click');
    });
    
    $('#committee-filter').change(function(){
       if($(this).val() == '-1'){
            $('.blog_wrapper').show();
       }else{
            $('.blog_wrapper').hide();
            $('.' + $(this).val()).show();
       }
    });
    
    $('.searchme').click(function(){
        console.log('Submiting form');
        $('#searchform').submit();
    });
    
    $('#budget-selector select').change(function(){
        if($(this).val() != ''){
            window.location = $(this).val();
        }
    });
    
    $('.committee-list tr').click(function(){
       window.location = $(this).attr('attr-link'); 
    });
    
    $('ul.docs a').click(function(){
        $('.loader-container').show();
        $('#content').html('');
       $('.documents li').removeClass('active');
       $(this).parent('li').addClass('active');
       $.ajax({
            type: 'post',
            url: pwuajax.ajaxurl,
            data: {action : 'pwu_ajax_get_pdf_view', file : $(this).attr('href'), title: $(this).text()},
            success: function(response){
                $('.loader-container').hide();
                if(response != '-1'){
                    $('#content').html(response);
                }
            }
       });
       return false; 
    });
    
    $('ul.updates a').click(function(){
        $('.loader-container').show();
        $('#content').html('');
       $('.documents li').removeClass('active');
       $(this).parent('li').addClass('active');
       $.ajax({
            type: 'post',
            url: pwuajax.ajaxurl,
            data: {action : 'pwu_ajax_get_update_content', id : $(this).attr('post-id')},
            success: function(response){
                $('.loader-container').hide();
                if(response != '-1'){
                    $('#content').html(response);
                }
            }
       });
       return false; 
    });
    
    $('ul.meetings a').click(function(){
        $('.loader-container').show();
        $('#content').html('');
       $('.documents li').removeClass('active');
       $(this).parent('li').addClass('active');
       $.ajax({
            type: 'post',
            url: pwuajax.ajaxurl,
            data: {action : 'pwu_ajax_get_meeting_content', id : $(this).attr('post-id')},
            success: function(response){
                $('.loader-container').hide();
                if(response != '-1'){
                    $('#content').html(response);
                }
            }
       });
       return false; 
    });
});