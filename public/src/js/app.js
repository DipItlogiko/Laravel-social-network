// function notification(message) {
//     $('header').after(`
//         <div class="row">
//             <div class="col-md-4 col-md-offset-4">
//                 <div class="alert alert-success alert-dismissible" role="alert">
//                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
//                         <span aria-hidden="true">&times;</span>
//                     </button>
//                     ${message}
//                 </div>
//             </div>
//         </div>
//     `);
// }

// $('.post').find('.interaction').find('a').eq(6).on('click' ,function() {
//     // console.log('it works!!');

//     $('#edit-modal').modal();
// });


var postId=0;

var postBodyElement = null;

var postUpdate_At= null;


$('.post').find('.interaction').find('.edit').on('click' ,function(event) {
    // console.log('it works!!');
    event.preventDefault();

    postBodyElement=event.target.parentNode.parentNode.childNodes[1];
    var postBody = postBodyElement.textContent;

    postUpdate_At =event.target.parentNode.parentNode.childNodes[5];


    postId = event.target.parentNode.parentNode.dataset['postid']; ////postid is comes from dashboard.blade.php
    ////////Debug---(under console.log you can apply one by one element and debug)----------------------------------------
    // console.log(event.target.parentNode.parentNode.childNodes[1].textContent);

    $('#post-body').val(postBody)  /////it's from dashboard.blade.php

    $('#edit-modal').modal(); /////it's from dashboard.blade.php
});


$('#modal-save').on('click' , function() {  ///// modal-save it's from dashboard.blade.php and it's an id as well.....
    $.ajax({
        method: 'POST',
        url: urlEdit,
        data: { body: $('#post-body').val(), postId: postId , _token: token } //// the token is comes from dashboard.blade.php
    })

       .done(function(msg) {
           $(postBodyElement).text(msg['new_body']); /////new_body is comes from postcontroller

           const newDate = new Date(msg['new_date']); /////new_date is comes from postcontroller
           const formattedDate = `${newDate.getFullYear()}-${(newDate.getMonth() + 1).toString().padStart(2, '0')}-${newDate.getDate().toString().padStart(2, '0')} ${newDate.getHours().toString().padStart(2, '0')}:${newDate.getMinutes().toString().padStart(2, '0')}:${newDate.getSeconds().toString().padStart(2, '0')}`;

           $(postUpdate_At).text(`Updated on ${formattedDate}`);
           $('#edit-modal').modal('hide');  ////this code will help us when we will edit post and the pop up will be autometically desapear

        });
});

$('.like').on('click' , function(event){   ////like class from dashboard.blade.php
    event.preventDefault();

    postId = event.target.parentNode.parentNode.dataset['postid'];

    var isLike=event.target.previousElementSibling == null ? true : false;
    ////console.log(event.target.previousElementSibling);
    ////console.log(isLike);

    $.ajax({
        method:'POST',
        url: urlLike,
        data: {
            _token: token,
            islike: isLike,
            POST_ID: postId,
        },
    })

      .done(function() {
          event.target.innerText = isLike ? event.target.innerText == 'Like' ? 'You like this post' : 'Like' : event.target.innerText == 'Dislike' ? 'you don\'t like this post' : 'Dislike';
         ///// user will not be able to like and dislike a post at a same time
          if (isLike) {
            event.target.nextElementSibling.innerText = 'Dislike';
          } else {
            event.target.previousElementSibling.innerText = 'Like';
          }
      });
});

$('.delete-post-pop-up').click(function(event) {
    event.preventDefault();

    // const postId = event.target.dataset['postId'];
    const urlDelete = event.target.dataset['urlDelete'];
     

    $('#delete-modal').modal('show');

    $('#modal-confirm-delete').click(function() {
        // Perform AJAX request to delete the post

        // window.location = urlDelete.replace('#', postId);
        window.location = urlDelete;

        // $.ajax({
        //     method:'GET',
        //     // url: urlDelete.replace('#', postId),
        //     url: urlDelete,
        // }).done(function(data) {
        //     $('#delete-modal').modal('hide');
        //     // window.location.reload();
        //     // notification(data.message);
        // });
    });

});
