// $('.post').find('.interaction').find('a').eq(6).on('click' ,function() {
//     // console.log('it works!!'); 

//     $('#edit-modal').modal();
// });


$('.post').find('.interaction').find('.edit').on('click' ,function(event) {
    // console.log('it works!!'); 
    event.preventDefault();

    var postBody = event.target.parentNode.parentNode.childNodes[1].textContent;

    ////////Debug---(under console.log you can apply one by one element and debug)----------------------------------------
    // console.log(event.target.parentNode.parentNode.childNodes[1].textContent);

    $('#post-body').val(postBody)  /////it's from dashboard.blade.php

    $('#edit-modal').modal(); /////it's from dashboard.blade.php
});

 
