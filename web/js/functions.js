$(document).ready(function(){
    
    $('#announceLink').click(function(){
        $('#homeLink').removeClass('active');
        $('#registerLink').removeClass('active');
        $('#contactLink').removeClass('active'); 
        $('#announceLink').addClass('active'); 
    });

    $('#homeLink').click(function(){
        $('#homeLink').addClass('active');
        $('#registerLink').removeClass('active');
        $('#contactLink').removeClass('active'); 
        $('#announceLink').removeClass('active'); 
    });
    
    $('#registerLink').click(function(){
        $('#homeLink').removeClass('active');
        $('#registerLink').addClass('active');
        $('#contactLink').removeClass('active'); 
        $('#announceLink').removeClass('active');  
    });
    
    $('#contactLink').click(function(){
        $('#homeLink').removeClass('active');
        $('#registerLink').removeClass('active');
        $('#contactLink').addClass('active'); 
        $('#announceLink').removeClass('active'); 
    });
    
});