// ------------------------------------------------
// Visitor Page Table
$(document).ready(function() {
     $('#VisitorDt').DataTable();
     $('.dataTables_length').addClass('bs-select');
 });
// ------------------------------------------------

// ------------------------------------------------
// For Services Table
 function getServicesD() {
 
     axios.get('/getServices')
         .then(function(response) {
 
             if (response.status == 200) {
 
                 $('#loaderDiv').addClass('d-none');
                 $('#mainDiv').removeClass('d-none');
 
                 $('#service_table').empty(); // helps to avoid cloning data at the time of deleting data
 
                 var alldata = response.data;
                 $.each(alldata, function(i, item) {
                     $('<tr>').html(
                         "<td class='th-sm'><img class='table-img' src=" + alldata[i].service_img + "></td>" +
                         "<td class='th-sm'>" + alldata[i].service_name + "</td>" +
                         "<td class='th-sm'>" + alldata[i].service_des + "</td>" +
                         "<td class='th-sm'><a class='serviceEditBtn' data-id =" + alldata[i].id + "    ><i class='fas fa-edit'></i></a></td>" +
                         "<td class='th-sm'><a class='serviceDeleteBtn' data-id =" + alldata[i].id + "   ><i class='fas fa-trash-alt'></i></a></td>"
                         //  data-toggle='modal' data-target='#deleteModal' 
                     ).appendTo('#service_table');
                 });
 
                  // For Services Table Delete Icon Click
                 $('.serviceDeleteBtn').click(function() {
                     var id = $(this).data('id');
 
                     $('#serviceDeleteId').html(id);
                     // $('#serviceDeleteConfirmBtn').attr('data-id', id);
                     $('#deleteModal').modal('show');
 
                 })

                // For Services Table Edit Icon Click
                $('.serviceEditBtn').click(function() {
                var id = $(this).data('id');

                    $('#serviceEditId').html(id);
                    servicesDetail(id);
                    // $('#serviceEditSaveBtn').attr('data-id', id);
                    $('#editModal').modal('show');
                    
                })


             } else {
                 $('#loaderDiv').addClass('d-none');
                 $('#wrongDiv').removeClass('d-none');
             }
 
         })
         .catch(function(error) {
             $('#loaderDiv').addClass('d-none');
             $('#wrongDiv').removeClass('d-none');
         });
 }
// ------------------------------------------------ 

// ------------------------------------------------
// For Services Delete Modal Yes Button Click
 $('#serviceDeleteConfirmBtn').click(function() {
     var id = $('#serviceDeleteId').html();
     //var id = $(this).data('id');
     servicesDelete(id);
 })
// ------------------------------------------------

 
// For Service Delete Function
 function servicesDelete(deleteID) {
    $('#serviceDeleteConfirmBtn').html("<div class='spinner-border spinner-border-sm text-light' role='status'></div>");
     axios.post('/deleteServices', {
             id: deleteID
         })
         .then(function(response) {
            $('#serviceDeleteConfirmBtn').html("Yes");
             if (response.data == 1) {
                 //alert('Success');
                 $('#deleteModal').modal('hide');
                 toastr.success('Successfully deleted');
                 getServicesD();
             } else {
                 //alert('Failed');
                 $('#deleteModal').modal('hide');
                 toastr.error('Failed !!! Some is wrong!!!');
                 getServicesD();
             }
         })
         .catch(function(error) {
            // alert('Some is wrong!!!');
            toastr.error('Failed !!! Some is wrong!!!');
         })
 }


 // For Service Detail and Edit Function
 function servicesDetail(detailID) {
    axios.post('/detailServices', {
            id: detailID,
        })
        .then(function(response) {
            if (response.status == 200) {
                
                $('#loaderDivE').addClass('d-none');
                $('#mainDivE').removeClass('d-none');

                var alldata = response.data;
                $('#service_name').val(alldata[0].service_name);
                $('#service_des').val(alldata[0].service_des);
                $('#service_img').val(alldata[0].service_img);

            } else {
                 $('#loaderDivE').addClass('d-none');
                 $('#wrongDivE').removeClass('d-none');
            }
        })
        .catch(function(error) {
            $('#loaderDivE').addClass('d-none');
            $('#wrongDivE').removeClass('d-none');
        })
         
}


// ------------------------------------------------
// For Services Edit Modal Save Button Click
$('#serviceEditSaveBtn').click(function() {
    var id = $('#serviceEditId').html();
    var name =  $('#service_name').val(); 
    var des =  $('#service_des').val();
    var img =  $('#service_img').val(); 
    servicesUpdate(id,name,des,img);
})
// ------------------------------------------------


function servicesUpdate(editID,editName,editDes,editImg) {
    
    if( editName.length == 0 ){
        // alert('Name Required');
        toastr.error('Name field is Required...');
        // $('#serviceEditSaveBtn').click(function() {
        //     $('#toast_message').toast('show');
        //     $('#textTaking').html("Name field is Required...");
        // })

    }

    else if( editDes.length == 0 ){
        // alert('Descrption Required');
        toastr.error('Description field is Required...');
        // $('#serviceEditSaveBtn').click(function() {
        //     $('#toast_message').toast('show');
        //     $('#textTaking').html("Description field is Required...");
        // })
    }
    
    else if( editImg.length == 0 ){
        // alert('Image Required');
        toastr.error('Image field is Required...');
        // $('#serviceEditSaveBtn').click(function() {
        //     $('#toast_message').toast('show');
        //     $('#textTaking').html("Image field is Required...");
        // })
    }

    else{
        $('#serviceEditSaveBtn').html("<div class='spinner-border spinner-border-sm text-light' role='status'></div>");
        axios.post('/updateServices', {
                id: editID,
                name: editName,
                des: editDes,
                img: editImg
        })
        .then(function(response) {  
           if(response.status == 200){
            $('#serviceEditSaveBtn').html("Save");

               if( response.data == 1 ){
                    $('#editModal').modal('hide');
                    //alert('Updated');
                    toastr.success('Updated');
                    // $('#serviceEditSaveBtn').click(function() {
                    //     $('#textTaking').html("Updated");
                    //     $('#toast_message').toast('show');
                    // })
                    getServicesD();
               }
               else{      
                    $('#editModal').modal('hide');
                    // alert('Not updated');
                    toastr.warnig('No Update History');
                    // $('#serviceEditSaveBtn').click(function() {
                    //     $('#textTaking').html("Not updated");
                    //     $('#toast_message').toast('show');
                    // })
                    getServicesD(); 
               }

           }else{
            $('#editModal').modal('hide');
            //alert('Some is wrong!!!');
            toastr.error('Some is wrong!!!');
           }

        })
        .catch(function(error) {
            $('#editModal').modal('hide');
            //alert('Some is wrong!!!');
            toastr.error('Some is wrong!!!');
        })
    }
}