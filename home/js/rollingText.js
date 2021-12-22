$(
  function(){
    var whoAmI_list = $('.rollingText li');
    var ul_height = $('.rollingText').outerHeight();
    $('.rollingText').append(whoAmI_list.clone());
  
    var i = 0;
    (function displayMe(i){
      setTimeout(function(){
        if( $('.rollingText').css('top') == (-1 * ul_height) + 'px'){
          $('.rollingText').css('top', '0');
        }
        var li_height = $(whoAmI_list[i]).outerHeight();
        $('.rollingText').animate({
          top: '-=' + li_height + 'px'}, 500);
        if( i == whoAmI_list.length - 1){
          i = 0;
        }else{
          i++;
        }
        displayMe(i);
        
      }, 1500);
    })(i);  
  }
);


