/**
 * Created by arthur on 4/1/15.
 */
$( document ).ready(function() {
    // References the comment in the textarea on click on the link "ref" for each comment
    $('a.comment-ref').click(function(e){
        var $commentId = $(this).parent().attr('id').replace('comment-', ''); // get the comment id
        $('#clemenger_commentbundle_comment_comment').append('#'+$commentId); // append it to the text area
        e.preventDefault();
    });
});