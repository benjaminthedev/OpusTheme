jQuery(document).ready(function($){
    $('.quantity').on('click', '.plus', function(e) {
        $input = $(this).prev('input.qty');
        var val = parseInt($input.val());
        $input.val( val+1 ).change();
    });

    $('.quantity').on('click', '.minus', 
        function(e) {
        $input = $(this).next('input.qty');
        var val = parseInt($input.val());
        if (val > 0) {
            $input.val( val-1 ).change();
        } 
    });


    //Custom Function for scrolling on the home page:

$(function() {
    $('a[href*=#]:not([href=#])').click(function() {
        var target = $(this.hash);
        target = target.length ? target : $('[name=' + this.hash.substr(1) +']');
        if (target.length) {
            $('html,body').animate({
              scrollTop: target.offset().top
            }, 1000);
            return false;
        }
    });
});



//Wrapping sections:

$( ".homeSectionOne" ).wrapAll( "<div id='section1' />");
// $( ".homeSectionTwo" ).wrapAll( "<div id='section2' />");
$( ".homeSectionThree" ).wrapAll( "<div id='section3' />");

//New Section 
$( ".newSectionFourTwo" ).wrapAll( "<div id='section2' />");



//Removing of (MHM) etc in the products


//(MHM)
$('label:contains("(MHM)")').each(function(){
    $(this).html($(this).html().split("(MHM)").join(""));
});
//(DIABETES)
$('label:contains("(Diabetes)")').each(function(){
    $(this).html($(this).html().split("(Diabetes)").join(""));
});
//(SE I)
$('label:contains("(SE I)")').each(function(){
    $(this).html($(this).html().split("(SE I)").join(""));
});
//(CD HRM)
$('label:contains("(CD HRM)")').each(function(){
    $(this).html($(this).html().split("(CD HRM)").join(""));
});
//(MC Part 1)
$('label:contains("(MC Part 1)")').each(function(){
    $(this).html($(this).html().split("(MC Part 1)").join(""));
});
//(MC Part 2)
$('label:contains("(MC Part 2)")').each(function(){
    $(this).html($(this).html().split("(MC Part 2)").join(""));
});
//(Dementia)
$('label:contains("(Dementia)")').each(function(){
    $(this).html($(this).html().split("(Dementia)").join(""));
});
//(Buccal)
$('label:contains("(Buccal)")').each(function(){
    $(this).html($(this).html().split("(Buccal)").join(""));
});
//(SP Diabetes)
$('label:contains("(SP Diabetes)")').each(function(){
    $(this).html($(this).html().split("(SP Diabetes)").join(""));
});
//(SP Asthma)
$('label:contains("(SP Asthma)")').each(function(){
    $(this).html($(this).html().split("(SP Asthma)").join(""));
});
//(School Ref)
$('label:contains("(School Ref)")').each(function(){
    $(this).html($(this).html().split("(School Ref)").join(""));
});
//(Nurse Ref)
$('label:contains("(Nurse Ref)")').each(function(){
    $(this).html($(this).html().split("(Nurse Ref)").join(""));
});
//(Day Ref)
$('label:contains("(Day Ref)")').each(function(){
    $(this).html($(this).html().split("(Day Ref)").join(""));
});
//(DOM Ref)
$('label:contains("(DOM Ref)")').each(function(){
    $(this).html($(this).html().split("(DOM Ref)").join(""));
});
//(COM Ref)
$('label:contains("(COM Ref)")').each(function(){
    $(this).html($(this).html().split("(COM Ref)").join(""));
});
//(Children Ref)
$('label:contains("(Children Ref)")').each(function(){
    $(this).html($(this).html().split("(Children Ref)").join(""));
});
//(ECSL Ref)
$('label:contains("(ECSL Ref)")').each(function(){
    $(this).html($(this).html().split("(ECSL Ref)").join(""));
});
//(MM FC)
$('label:contains("(MM FC)")').each(function(){
    $(this).html($(this).html().split("(MM FC)").join(""));
});
//(Children F)
$('label:contains("(Children F)")').each(function(){
    $(this).html($(this).html().split("(Children F)").join(""));
});
//(PA F)
$('label:contains("(PA F)")').each(function(){
    $(this).html($(this).html().split("(PA F)").join(""));
});
//(Nurse F)
$('label:contains("(Nurse F)")').each(function(){
    $(this).html($(this).html().split("(Nurse F)").join(""));
});
//(DOM F)
$('label:contains("(DOM F)")').each(function(){
    $(this).html($(this).html().split("(DOM F)").join(""));
});
//(ECSL F)
$('label:contains("(ECSL F)")').each(function(){
    $(this).html($(this).html().split("(ECSL F)").join(""));
});
//(Day F)
$('label:contains("(Day F)")').each(function(){
    $(this).html($(this).html().split("(Day F)").join(""));
});
//(MA SL)
$('label:contains("(MA SL)")').each(function(){
    $(this).html($(this).html().split("(MA SL)").join(""));
});
//(MA Foster)
$('label:contains("(MA Foster)")').each(function(){
    $(this).html($(this).html().split("(MA Foster)").join(""));
});
//(School F)
$('label:contains("(School F)")').each(function(){
    $(this).html($(this).html().split("(School F)").join(""));
});
//(COM F)
$('label:contains("(COM F)")').each(function(){
    $(this).html($(this).html().split("(COM F)").join(""));
});

//General Face to Face
$('label:contains("Face to Face –")').each(function(){
    $(this).html($(this).html().split("Face to Face –").join(""));
});



//About this course

//$('.single-product .woocommerce-product-details__short-description').insertBefore('.grouped-product-shizzle');







//Button on the shop page for buy now:

//$('a.button.product_type_simple.add_to_cart_button.ajax_add_to_cart').html('Buy Now');
$('a.button.product_type_simple.add_to_cart_button.ajax_add_to_cart').html('Add To Cart');


// $('a.button.product_type_grouped').html('Find Out More');
$('a.button.product_type_grouped').html('Select Delivery Option');









// FAQ boxes product pages

$('h4.faqTab01').click(function() {
  $( '.faqTab01box' ).toggleClass( "showFAQBox" );
});

$('h4.faqTab02').click(function() {
  $( '.faqTab02box' ).toggleClass( "showFAQBox" );
});

$('h4.faqTab03').click(function() {
  $( '.faqTab03box' ).toggleClass( "showFAQBox" );
});

$('h4.faqTab04').click(function() {
  $( '.faqTab04box' ).toggleClass( "showFAQBox" );
});

$('h4.faqTab05').click(function() {
  $( '.faqTab05box' ).toggleClass( "showFAQBox" );
});

$('h4.faqTab06').click(function() {
  $( '.faqTab06box' ).toggleClass( "showFAQBox" );
});

$('h4.faqTab07').click(function() {
  $( '.faqTab07box' ).toggleClass( "showFAQBox" );
});

$('h4.faqTab08').click(function() {
  $( '.faqTab08box' ).toggleClass( "showFAQBox" );
});




//New Section 
$( ".pricing" ).wrapAll( "<div class='section-three-information' />");
 



// Single product page info


$('li.courseInfo').click(function() {
  $( '.section-one-information' ).toggleClass( "showINFOBox" );
  $( '.section-two-information' ).removeClass( "showINFOBox" );
  console.log("course info");
});


$('li.accreditation').click(function() {
  $( '.section-one-information' ).removeClass( "showINFOBox" );
  $( '.section-two-information' ).toggleClass( "showINFOBox" );
  console.log("Accre box");
});

$('li.pricings').click(function() {
  $( '.section-three-information' ).toggleClass( "showINFOBox" );
  $( '.section-one-information, .section-two-information' ).removeClass( "showINFOBox" );
  console.log("Pricing Box");
});



// $("a.enquiresBtn").each(function(i) {
//      this.addClass("item"+(i+1));
// });

$("a.enquiresBtn").each(function(i) {
     $("a.enquiresBtn").addClass("item"+(i+1));
});


// $('li').each(function(i) {
//     $(this).addClass("group-" + Math.floor(i/4 + 1));
// });



//Single products layout

$('.postid-7981 form.cart').insertAfter('.niceTitle');

// Addtional Edits

//$(".postid-7981 .woocommerce div.product form.cart").before(".niceTitle");


//enquiries button to click to enquiries page


//This is from individual product pages

$(".postid-7936 .add-to-cart-container, .postid-7929 .add-to-cart-container, .postid-7931 .add-to-cart-container, .postid-7940 .add-to-cart-container, .postid-7938 .add-to-cart-container, .postid-7933 .add-to-cart-container, .postid-7911 .add-to-cart-container, .postid-7927 .add-to-cart-container, .postid-7944 .add-to-cart-container, .postid-7948 .add-to-cart-container, .postid-7942 .add-to-cart-container").after('<br /> <a href="https://opuspharmserve.com/enquiries/" class="newButtonClicked">Enquire Now</a>');

//This is from the archive product page
$("a.button[data-product_id='7936'], a.button[data-product_id='7929'], a.button[data-product_id='7931'], a.button[data-product_id='7940'], a.button[data-product_id='7938'], a.button[data-product_id='7933'], a.button[data-product_id='7911'], a.button[data-product_id='7927'], a.button[data-product_id='7944'], a.button[data-product_id='7948'], a.button[data-product_id='7942'], a.button[data-product_id='7971', a.button[data-product_id='7973'], a.button[data-product_id='7975'").hover(function() {
  // alert( "Handler for .click() called." );
  window.location.href='https://opuspharmserve.com/enquiries/';
});


$("a.button.product_type_simple.add_to_cart_button.ajax_add_to_cart[data-product_id='7936'], a.button.product_type_simple.add_to_cart_button.ajax_add_to_cart[data-product_id='7929'], a.button.product_type_simple.add_to_cart_button.ajax_add_to_cart[data-product_id='7931'], a.button.product_type_simple.add_to_cart_button.ajax_add_to_cart[data-product_id='7940'], a.button.product_type_simple.add_to_cart_button.ajax_add_to_cart[data-product_id='7938'], a.button.product_type_simple.add_to_cart_button.ajax_add_to_cart[data-product_id='7933'], a.button.product_type_simple.add_to_cart_button.ajax_add_to_cart[data-product_id='7911'], a.button.product_type_simple.add_to_cart_button.ajax_add_to_cart[data-product_id='7927'], a.button.product_type_simple.add_to_cart_button.ajax_add_to_cart[data-product_id='7944'], a.button.product_type_simple.add_to_cart_button.ajax_add_to_cart[data-product_id='7948'], a.button.product_type_simple.add_to_cart_button.ajax_add_to_cart[data-product_id='7942']").html('Enquire Now');


});
