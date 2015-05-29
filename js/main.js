$(document).ready(function(){
   $('#btn-modification').click(function(){
      $('#modification').css('display', 'block'); $('#profil').css('display', 'none');
   });
    if($('#modification .error_message')[0]){
        $('#modification').css('display', 'block'); $('#profil').css('display', 'none');
      }else{
          $('#modification').css('display', 'none'); $('#profil').css('display', 'block');
      }
    $('#delete').click(function(){
        $('#confirm').css('display', 'block'); $('#background').css({'opacity': '0.8','z-index': '0'});
    });
    $('#no').click(function(){
      $('#confirm').css('display', 'none'); $('#background').css({'opacity': '0','z-index': '-1'});
    });

    // $('#connexion_ref').click(function(){
    //   location.reload(true);
    // });
  
//   setTimeout(function(){
//      $('#connexion_ref').click(function(){
//          window.location.reload();
//          /* or window.location = window.location.href; */
//      });
// }, 5000);
    
    
});

// setTimeout(function(){
//          window.location.reload();
//          /* or window.location = window.location.href; */
//     }, 1000);