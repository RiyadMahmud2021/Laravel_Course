// Owl Carousel Start..................



$(document).ready(function() {
    var one = $("#one");
    var two = $("#two");

    $('#customNextBtn').click(function() {
        one.trigger('next.owl.carousel');
    })
    $('#customPrevBtn').click(function() {
        one.trigger('prev.owl.carousel');
    })
    one.owlCarousel({
        autoplay:true,
        loop:true,
        dot:true,
        autoplayHoverPause:true,
        autoplaySpeed:300,
        margin:10,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:2
            },
            1000:{
                items:4
            }
        }
    });

    two.owlCarousel({
        autoplay:true,
        loop:true,
        dot:true,
        autoplayHoverPause:true,
        autoplaySpeed:300,
        margin:10,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:1
            },
            1000:{
                items:1
            }
        }
    });

});








// Owl Carousel End..................


// Contact Send

$('#contactSendBtnId').click(function () {
    var contactName= $('#contactNameId').val();
    var contactMobile= $('#contactMobileId').val();
    var contactEmail= $('#contactEmailId').val();
    var contactMsg= $('#contactMsgId').val();
    sendContact(contactName,contactMobile,contactEmail,contactMsg);
});

function sendContact(contact_name,contact_mobile,contact_email,contact_msg) {

    if(contact_name.length==0){
        $('#contactSendBtnId').html('আপনার নাম লিখুন !');
        setTimeout(function () {
            $('#contactSendBtnId').html('পাঠিয়ে দিন');
        },2000)
    }
    else if(contact_mobile.length==0){
        $('#contactSendBtnId').html('আপনার মোবাইল নং লিখুন !')
        setTimeout(function () {
            $('#contactSendBtnId').html('পাঠিয়ে দিন');
        },2000)
    }
    else if(contact_email.length==0){
        $('#contactSendBtnId').html('আপনার ইমেইল  লিখুন !')
        setTimeout(function () {
            $('#contactSendBtnId').html('পাঠিয়ে দিন');
        },2000)
    }
    else if(contact_msg.length==0){

        $('#contactSendBtnId').html('আপনার মেসেজ লিখুন !')
        setTimeout(function () {
            $('#contactSendBtnId').html('পাঠিয়ে দিন');
        },2000)

    }
    else {
        // form reset code start
            $(':input', '#course_form_id').not(':button, :submit, :reset, :hidden')
            .val('').prop('checked', false)
            .prop('selected', false);
        // form reset code end
        $('#contactSendBtnId').html('পাঠানো হচ্ছে...')
        axios.post('/sendContact',{
            contact_name:contact_name,
            contact_mobile:contact_mobile,
            contact_email:contact_email,
            contact_msg: contact_msg,
        })
            .then(function (response) {
                if(response.status==200){
                    if(response.data==1){
                        $('#contactSendBtnId').html('অনুরোধ সফল হয়েছে')
                        setTimeout(function () {
                            $('#contactSendBtnId').html('পাঠিয়ে দিন');
                        },3000)
                    }
                    else{
                        $('#contactSendBtnId').html('অনুরোধ ব্যার্থ হয়েছে ! আবার চেষ্টা করুন ')
                        setTimeout(function () {
                            $('#contactSendBtnId').html('পাঠিয়ে দিন');
                        },3000)
                    }
                }
                else {
                    $('#contactSendBtnId').html('অনুরোধ ব্যার্থ হয়েছে ! আবার চেষ্টা করুন ')
                    setTimeout(function () {
                        $('#contactSendBtnId').html('পাঠিয়ে দিন');
                    },3000)
                }

            }).catch(function (error) {
            $('#contactSendBtnId').html('আবার চেষ্টা করুন')
            setTimeout(function () {
                $('#contactSendBtnId').html('পাঠিয়ে দিন');
            },3000)
        })
    }

}
