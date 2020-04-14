// Display Current Date
// var dt = new Date();
// document.getElementById("date").innerHTML = (("0"+dt.getDate()).slice(-2)) +"/"+  (("0"+(dt.getMonth()+1)).slice(-2)) +"/"+ (dt.getFullYear());

// Display Current Time
function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('txt').innerHTML =
    h + ":" + m + ":" + s;
    var t = setTimeout(startTime, 500);
  }
  function checkTime(i) {
    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
}

// Generate Assets Pass Serial Number
$('#mixAssetsSerialNumber').keyup(function () {
    $('#mixAssetsDisplay').text($(this).val());
});

// Generate Employee Pass Serial Number
$('#mixEmployeeSerialNumber').keyup(function () {
    $('#mixEmployeeDisplay').text($(this).val());
});

// Auto display input data in real time
$('#mixSerialNumber').keyup(function () {
    $('#mixDisplay').text($(this).val());
});

// Assets Employee
$('#assetsEmployee').on('change', function() {
    $('#assetsEmployeeDisplay').text($(this).val());
    // do whatever you want with 'values'
});

// Assets Company
$('#assetsCompany').on('change', function() {
    $('#assetsCompanyDisplay').text($(this).val());
    // do whatever you want with 'values'
});

// Assets Company
$('#assetsFrom').on('change', function() {
    $('#assetsFromDisplay').text($(this).val());
    // do whatever you want with 'values'
});

// Assets Company
$('#assetsTo').on('change', function() {
    $('#assetsToDisplay').text($(this).val());
// do whatever you want with 'values'
});

// Vehicle Request Passanger Number
$('#vrPass').keyup(function () {
    $('#vrPasngCont').text($(this).val());
});

// Vehicle Request When Time
$('#vrTime').keyup(function () {
    $('#vrWhenTime').text($(this).val());
});

// Vehicle Request When Date
$('#vrDate').keyup(function () {
    $('#vrWhenDate').text($(this).val());
});

// Request Form
$('#purpose').on('change', function() {
    $('.purposeDisplay').text($(this).val());
    // do whatever you want with 'values'
}); 

// Employee Perform
$('#employeePerform').keyup('change', function() {
    $('#employeePerformDisplay').text($(this).val());
    // do whatever you want with 'values'
});

// Add New Assets Field
$(document).ready(function(){  
    var i=1;  
    $('#add').click(function(){  
         i++;  
         $('#dynamic_field').append('<tr id="row'+i+'"><td><input type="text" name="name[]" placeholder="Old CPU - 5 Nos. [ TAG - 153, 154, 160, 161, 162 ]" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-outline-danger btn-sm mt-2 btn_remove"><i class="fa fa-times" aria-hidden="true"></i></button></td></tr>');  
    });  
    $(document).on('click', '.btn_remove', function(){  
         var button_id = $(this).attr("id");   
         $('#row'+button_id+'').remove();  
    });  
    $('#submit').click(function(){            
         $.ajax({  
              url:"name.php",  
              method:"POST",  
              data:$('#add_name').serialize(),  
              success:function(data)  
              {  
                   alert(data);  
                   $('#add_name')[0].reset();  
              }  
         });  
    });  
}); 

// Add New Employee Field
$(document).ready(function(){
      
        var count = 0;

        // Add New Fields
        $(document).on('click', '.add', function(){
            count++;
            var html = '';
            html += '<tr>';
            html += '<td><input type="text" name="name[]" class="form-control name" placeholder="Enter Name" /></td>';
            html += '<td><input type="text" name="gender[]" class="form-control gender" placeholder="Enter Gender" /></td>';
            html += '<td><input type="text" name="age[]" class="form-control age" placeholder="Enter Age" /></td>';

            html += '<td><button type="button" name="remove" class="btn btn-danger btn-xs remove"><span class="glyphicon glyphicon-minus"></span></button></td>';
            $('tbody').append(html);
        });

        // Remove Fields
        $(document).on('click', '.remove', function(){
            $(this).closest('tr').remove();
        });


        $(document).on('change', '.item_category', function(){
            var category_id = $(this).val();
            var sub_category_id = $(this).data('sub_category_id');

            $.ajax({
                url:"fill_sub_category.php",
                method:"POST",
                data:{category_id:category_id},
                success:function(data)
                {
                    var html = '<option value="">Select Sub Category</option>';
                    html += data;
                    $('#item_sub_category'+sub_category_id).html(html);
                }
            })
        });

        // Submit Form Data
        $('#insert_form').on('submit', function(event){
            event.preventDefault();
            var error = '';

            $('.item_name').each(function(){
                var count = 1;
                if($(this).val() == '')
                {
                error += '<p>Enter Item name at '+count+' Row</p>';
                return false;
                }
                count = count + 1;
            });

            $('.item_category').each(function(){
                var count = 1;

                if($(this).val() == '')
                {
                error += '<p>Select Item Category at '+count+' row</p>';
                return false;
                }

                count = count + 1;

            });

            $('.item_sub_category').each(function(){

                var count = 1;

                if($(this).val() == '')
                {
                error += '<p>Select Item Sub category '+count+' Row</p> ';
                return false;
                }

                count = count + 1;

            });

            var form_data = $(this).serialize();

            if(error == '')
            {
                $.ajax({
                url:"insert.php",
                method:"POST",
                data:form_data,
                success:function(data)
                {
                    if(data == 'ok')
                    {
                    $('#item_table').find('tr:gt(0)').remove();
                    $('#error').html('<div class="alert alert-success">Item Details Saved</div>');
                    }
                }
                });
            }
            else
            {
                $('#error').html('<div class="alert alert-danger">'+error+'</div>');
            }

        });
    
  });

// ADD Selecte Field Real time
// $(document).ready(function(){
 
//     $(document).on('click', '.add', function(){
//         var html = '';

//         html += '<tr>';
//         html += `<td><select class="form-control form-control-sm select2 employee" name="employee[]" data-placeholder="Choose Browser" required><option value="">Select</option><?php $results = mysqli_query($conn, "SELECT * FROM mix_master_employee ORDER BY e_id DESC"); ?><?php while ($row = mysqli_fetch_array($results)) { ?><option value="<?php echo $row['e_name']; ?>"><?php echo $row['e_name']; ?></option><?php } ?></select></td>`;

//         html += '<td><button type="button" name="remove" class="btn btn-danger btn-sm remove"><span class="glyphicon glyphicon-minus"></span></button></td></tr>';

//         $('#item_table').append(html);
//     });
    
//     $(document).on('click', '.remove', function(){
//         $(this).closest('tr').remove();
//     });
    
// });


$(document).ready(function(){
    $('#viewRequest').on('show.bs.modal', function (e) {
        var rowid = $(e.relatedTarget).data('id');
        $.ajax({
            type : 'post',
            url : 'fetch_record.php', //Here you will fetch records 
            data :  'rowid='+ rowid, //Pass $id
            success : function(data){
            $('.fetched-data').html(data);//Show fetched data from database
            }
        });
     });
});