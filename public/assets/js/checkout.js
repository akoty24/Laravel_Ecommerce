$(document).ready(function (){
     $('.razorpay_btn').click(function (e){
         e.preventDefault();

         var fname=$('.fname').val();
         var lname=$('.lname').val();
         var email=$('.email').val();
         var phone=$('.phone').val();
         var address=$('.address').val();
         var address2=$('.address2').val();
         var city=$('.city').val();
         var country=$('.country').val();
         var pincode=$('.pincode').val();
         if (!fname){
             fname_error="First Name is Required";
             $('#fname_error').html('');
             $('#fname_error').html(fname_error);
         }
         else {
             fname_error="";
             $('#fname_error').html('');
         }
         if (!lname){
             fname_error="last Name is Required";
             $('#lname_error').html('');
             $('#lname_error').html(lname);
         }
         else {
             lname_error="";
             $('#lname_error').html('');
         }
         if (!phone){
             phone_error="phone number is Required";
             $('#phone_error').html('');
             $('#phone_error').html(phone_error);
         }
         else {
             phone_error="";
             $('#phone_error').html('');
         }
         if (!email){
             email_error="email is Required";
             $('#email_error').html('');
             $('#email_error').html(email_error);
         }
         else {
             email_error="";
             $('#email_error').html('');
         }
         if (!address){
             address_error=" address is Required";
             $('#address_error').html('');
             $('#address_error').html(address_error);
         }
         else {
             address_error="";
             $('#address_error').html('');
         }
         if (!address2){
             address2_error="address2 is Required";
             $('#address2_error').html('');
             $('#address2_error').html(address2_error);
         }
         else {
             address2_error="";
             $('#address2_error').html('');
         }
         if (!city){
             city_error="city is Required";
             $('#city_error').html('');
             $('#city_error').html(city_error);
         }
         else {
             city_error="";
             $('#city_error').html('');
         }
         if (!country){
             country_error="country is Required";
             $('#country_error').html('');
             $('#country_error').html(country_error);
         }
         else {
             country_error="";
             $('#country_error').html('');
         }
         if (!pincode){
             pincode_error="pincode is Required";
             $('#pincode_error').html('');
             $('#pincode_error').html(pincode_error);
         }
         else {
             pincode_error="";
             $('#pincode_error').html('');
         }

         if (fname_error !='' || lname_error !='' || phone_error !='' || email_error !=''||address_error !=''||address2_error !=''||city_error !=''||country_error !=''||pincode_error !=''){
             return false ;
         }
         else {
             var data= {
                 'fname':fname,
                 'lname':lname,
                 'phone':phone,
                 'email':email,
                 'address':address,
                 'address2':address2,
                 'city':city,
                 'country':country,
                 'pincode':pincode,

             }
             $.ajaxSetup({
                 headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
             });
             $.ajax({
                 method:"POST",
                 url:"/razorpay",
                 data:data,
                 success:function (response){
//alert(response.total_price)
                 }
             });
         }




     });
     });