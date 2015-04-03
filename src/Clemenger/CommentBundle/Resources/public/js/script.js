/**
 * Created by arthur on 4/1/15.
 */
$(document).ready(function () {

    // Init focusing system
    $('#clemenger_commentbundle_comment_comment').attr('id', 'last-focused');
    // Add id 'last-focused' on textareas on focusin
    $(document).on('focusout', 'textarea', function(){
        $(this).attr('id', 'last-focused');
    });
    // remove id 'last-focused' on textareas on focusout
    $(document).on('focusin', 'textarea', function(){
        $('textarea').attr('id', '');
    });

    // References the comment in the textarea on click on the link "ref" for each comment
    $(document).on('click', 'a.comment-ref', function(e){
        $('#last-focused').val($('#last-focused').val() + $(this).attr('href')); // append the href to the last focused text area
        $('#last-focused').focus(); // focus again
        e.preventDefault();
    });


    // On click on "Reply"
    $(document).on('click', 'a.reply', function(e){
        $(this).parent().children('.comment-reply').toggleClass('hidden');
        e.preventDefault();
    });

    // Ajax form submission
    $(document).on('submit', 'form', function(e){
        // Get the form
        var $form = $(this);

        // Retrieve data
        var $name = $form.children().children().children("input[name='clemenger_commentbundle_comment[name]']");
        var $email = $form.children().children().children("input[name='clemenger_commentbundle_comment[email]']");
        var $comment = $form.children().children().children("textarea[name='clemenger_commentbundle_comment[comment]']");

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
                // If initial form
                if($form.attr('id') == 'initial-form') {
                    $('#comment-list').prepend(html); // prepend comment to the main list
                }else {
                    $form.parent().parent().children('.comment-reply').toggleClass('hidden');
                    $form.parent().parent().children('.comment-list').prepend(html);// Prepend comment to the closest list
                }
            }
        });
        e.preventDefault();
    });
});