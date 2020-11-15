

$(document).ready(function() {

//nav-bar

$(".nav-button").on("click",function(){

$("nav ul").toggleClass('show');



});

$(".nav-button").on("click",function(){

$("nav").toggleClass('bar');



});



$(window).on("scroll",function(){


if($(window).scrollTop()){

$('nav').addClass('blue');
}

else{

$('nav').removeClass('blue');

}




});


$('.owl-carousel').owlCarousel({
margin: 20,
autoplay: true,
autoplayTimeout: 4000,
autoplayHoverPause: true,
responsive: {
0: {
items: 1,
}
}
	
});

$('nav a').on("click", function() {
		$('nav ul').collapse('hide');
		
		
	});



});



//my form



let validateForm=function(){


let getFname=document.forms["myForm" ]["fname"].value;
let getUname=document.forms["myForm" ]["uname"].value;
let getEmail=document.forms["myForm"]["email"].value;
let getComment=document.forms["myForm"]["comment"].value;


if (getFname==="" || getFname.length < 13){

document.getElementById("validate-fname").innerHTML='<p class="val">Enter a valid name of least 15 characters</p>';

return false;
}



else if (getEmail==="" || getEmail!=email){

document.getElementById("validate-email").innerHTML='<p class="val">Enter a valid email </p>';

return false;
}


else if (getUname==="" || getUname.length < 6){

document.getElementById("validate-uname").innerHTML='<p class="val">Enter a valid username of least 6 characters</p>';

return false;
}

else if (getComment==="" || getComment.length < 60){

document.getElementById("validate-comment").innerHTML='<p class="val">Enter a valid comment not less than 60 characters</p>';

return false;
}


}

if ($('.text-slider').length == 1) {
    var typed_strings = $('.text-slider-items').text();
		var typed = new Typed('.text-slider', {
			strings: typed_strings.split(','),
			typeSpeed: 80,
			loop: true,
			backDelay: 1100,
			backSpeed: 30
		});
	}