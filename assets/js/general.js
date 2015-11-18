/////DISCIPLINES////////
$('document').ready(function () {
    $('.area:checked').siblings('label').addClass('active');
});
function pullDiscipline(id){
    $.post('../controllers/discipline.php',{ institute: id, action: 'selectByInstitute'}, function(result) {
        $('.discipline').remove();
        $('.disciplines').append(result);
    });
}
function followDiscipline(id){
    $.post('../controllers/user_has_disciplines.php',{ discipline: id, action: 'followDiscipline'}, function(result) {
        return false;
    });
}
function unfollowDiscipline(id){
    $.post('../controllers/user_has_disciplines.php',{ discipline: id, action: 'unfollowDiscipline'}, function(result) {
        return false;
    });
}
function removeComment(id){
    $.get('../controllers/comment.php',{ comment: id, action: 'delete'}, function(result) {
        $("#comment-"+id).remove();
    });
}
$('.btn-area').click(function(){
    $('.btn-area').removeClass('active');
    $(this).addClass('active');
});
$('.btn-full').click(function(){
    $('.btn-full').removeClass('active');
    $(this).addClass('active');
});
$('#search').keyup(function(){
    $.post('../controllers/discipline.php',{ term: $(this).val(), action: 'find'}, function(result) {
        $('.discipline').remove();
        $('.disciplines').append(result);
    });
});

////////HEADER////////
$('#me-menu-bt').click(function(){
    $('#me-menu').slideToggle();
});

////////HOME/////////
 $(document).ready(function(){
    $('.owl-carousel').owlCarousel({
        loop:true,
        autoplay:true,
        autoplayTimeout:2000,
        autoplayHoverPause:true,
        margin:10,
        items:1
    })
});
var tops = document.getElementById('footer').offsetTop;
window.onscroll = function(){
    if($(document).scrollTop() >= tops){
        var e = document.getElementById('aboutus');
        e.style.position="fixed";
        e.style.top="0";
        e.style.right="0";
    }
    else{
        document.getElementById('aboutus').style.position="";
    }
}

function config(id){
    el = document.getElementById(id);
    if(el.style.maxHeight == "150px"){
        el.style.maxHeight = '0';
    }
    else{
        el.style.maxHeight = '150px';
    }
}
document.getElementById('upfile').onclick = function(){
    $('.modal-fa').fadeIn();
    $("html, body").animate({ scrollTop: $('.modal-fa').offset().top }, 0);
    $('body').css('overflow', 'hidden');
}

document.getElementById('modal-container').onclick = function(e) {
    target = e.target;
    if (target.id == 'modal'||($(target).parents().is('#modal')  && (target.id != "dismiss-modal" && target.id != "ok"))){
        return true;
    }
    else {
        $('.modal-fa').fadeOut();
        $('body').removeAttr('style');
    }
}

$(document).keyup(function(e){
 if(e.which==27 && $('.modal-fa').is(':visible')){
        $('.modal-fa').fadeOut();
        $('body').removeAttr('style');
    }
});
//////INDEX////////////
function login(){
    $(".container").hide();
    $(".login-form").show();
    $("#login").hide();
    $("#signup").show();
}
function signup(){
    $(".container").show();
    $(".login-form").hide();
    $("#login").show();
    $("#signup").hide();
}