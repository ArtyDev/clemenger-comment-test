/**
 * Created by arthur on 4/1/15.
 */
$(document).ready(function () {

    // References the comment in the textarea on click on the link "ref" for each comment
    $(document).on('click', 'a.comment-ref', function(e){
        $('#clemenger_commentbundle_comment_comment').val($('#clemenger_commentbundle_comment_comment').val() + $(this).attr('href')); // append the href to the text area
        $('#clemenger_commentbundle_comment_comment').focus(); // focus again
        e.preventDefault();
    });

    // Ajax
    $("form[name='clemenger_commentbundle_comment']").submit(function (e) {
        // Retrieve data
        var $name = $("input[name='clemenger_commentbundle_comment[name]']");
        var $email = $("input[name='clemenger_commentbundle_comment[email]']");
        var $comment = $("textarea[name='clemenger_commentbundle_comment[comment]']");
        console.log($comment.val());
        // Get the form
        var $form = $(this).closest('form');
        // Simulate form data
        var data = {};
        data[$name.attr('name')] = $name.val();
        data[$email.attr('name')] = $email.val();
        data[$comment.attr('name')] = $comment.val();
        // Submit data via AJAX to the form's action path.
        $.ajax({
            url: $form.attr('action'),
            type: $form.attr('method'),
            data: data,
            // Append html on success
            success: function (html) {
                $('#comment-list').prepend(html);
            }
        });
        e.preventDefault();
    });
});