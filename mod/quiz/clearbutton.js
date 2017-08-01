//jQuery(function($) {
//
//    var radioButtonName = document.querySelector(".answer .r0 input").getAttribute("name");
//
//    if ($("input[type]").is(":radio")) {
//        $(".answer").append("<button type='button' name='clear' >Clear</button>");
//       
//    }
//
//    $('button[name=clear]').on('click', function() {
//        $(this).closest('.answer').find(':radio').prop('checked', false)
//       
//       
//    });
//
//    if ($('.content').parent().hasClass("deferredfeedback")) {
//        if ($('.answer .r0 input').prop('disabled')) {
//            $("button[name=clear]").remove();
//        }
//    } else {
//        if (!($('div.im-controls').length)) {
//            $("button[name=clear]").remove();
//        }
//    }
//
//});

jQuery(function($) {

    var radioButtonName = document.querySelector(".answer .r0 input").getAttribute("name");

    if ($("input[type]").is(":radio")) {
        $(".answer").append("<input type='radio' name=" + radioButtonName + " value='' id=" + radioButtonName +3+ "><button type='button' name='clear' >Clear</button>");
       document.getElementById(radioButtonName+3).style.display = 'none';
    }

    $('button[name=clear]').on('click', function() {
        $(this).closest('.answer').find(':radio').prop('checked', false)
        document.getElementById(radioButtonName+3).checked = true;
       
    });

    if ($('.content').parent().hasClass("deferredfeedback")) {
        if ($('.answer .r0 input').prop('disabled')) {
            $("button[name=clear]").remove();
        }
    } else {
        if (!($('div.im-controls').length)) {
            $("button[name=clear]").remove();
        }
    }

});