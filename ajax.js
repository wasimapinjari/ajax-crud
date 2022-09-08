/*

ajax-crud: ajax.js
Licensed under MIT (https://github.com/wasimapinjari/ajax-crud/blob/main/LICENSE)

*/

$(document).ready(function(){

    // Copyright Year Autoupdate, Default is 2022

    let dateNow = new Date();
    let intYear = dateNow.getFullYear();

    $('#copyright').each(function() {
        let text = $(this).text();
        $(this).text(text.replace('2022', intYear)); 
    });

    // Read

    function showdata(){
        output = "";
        $.ajax({
        url: "read.php",
        method: "GET",
        dataType: "json", 
        success: function(data){
            
            if(data){
                x = data;
                } else {
                x = "";
            }

            // console.log(data);

            for(let k in x) {
                output += "<div class='card my-3 w-75' id='card'><div class='card-body text-center'>" + x[k].name +
                " (" + x[k].email + ")</strong><div class='text-secondary mt-2'>" + x[k].address +
                "</div><div class='btn-group my-3 w-100 flex-wrap' role='group' aria-label='Basic example'><button type='button' id='update' class='btn btn-outline-dark btn-update' data-sid=" + x[k].id + ">Update</button><button type='button' id='delete' class='btn btn-outline-dark btn-delete' data-sid=" + x[k].id + ">Delete</button></div></div></div>";
            }

            if(output != 0){
                $("#user").html(output);
               } else {
                   $("#user").html("<div class='card my-3 w-75'><div class='card-body text-center'>No Users");
               }
            }

        });
    }

    showdata();

    // Reset
   
    $("#uid,#name,#email,#address,#reset,#search").click(function(){
        $("#msg").html("");
        $('#name,#email,#address').removeClass('is-valid is-invalid');
    });
    
    $("#reset").click(function(){
        $("#submit").val("Add");
        $("#search, #uid").val("");
        showdata();
    });
    
    // Search

    $("#search").keyup(function(){
        let input = $(this).val();
        // console.log(input);
        output = "";
        mydata = {search: input};
        if(input != ""){
            $.ajax({
                url:"search.php",
                method:"POST",
                data: JSON.stringify(mydata),
                success:function(data)
                {  
                    
                    if(data){
                        x = $.parseJSON(data);
                        } else {
                        x = "";
                    }

                    for(let k in x) {
                        output += "<div class='card my-3 w-75'><div class='card-body text-center'>" + x[k].name +
                        " (" + x[k].email + ")</strong><div class='text-secondary mt-2'>" + x[k].address +
                        "</div><div class='btn-group my-3 w-100 flex-wrap' role='group' aria-label='Basic example'><button type='button' id='update' class='btn btn-outline-dark btn-update' data-sid=" + x[k].id + ">Update</button><button type='button' id='delete' class='btn btn-outline-dark btn-delete' data-sid=" + x[k].id + ">Delete</button></div></div></div>";
                    }
                    
                    if(output != 0){
                     $("#user").html(output);
                    } else {
                        $("#user").html("<div class='card my-3 w-75'><div class='card-body text-center'>No Matching Results");
                    }
                
                } 
            }); 
        } else {
            showdata();
            $("#user").html("<div class='card my-3 w-75'><div class='card-body text-center'>No Users");
        }
    }); 
    
    // Create
    
    $("#submit").click(function(e){

        e.preventDefault(e);
        
        let id = $("#uid").val();
        let nameData = $("#name").val();
        let emailData = $("#email").val();
        let addressData = $("#address").val();

        $("#msg").html("");

        let validName, validEmail, validAddress;
        var isNameValid = isEmailValid = isAddressValid = false;
        var messageName = messageEmail = messageAddress =  "";

        // For Debugging

        // console.log("Button clicked!");

        // console.log(id);
        // console.log(nameData);
        // console.log(emailData);
        // console.log(addressData);

        // console.log(nameData.length);
        // console.log(emailData.length);
        // console.log(addressData.length);

        // console.log(isNameValid);
        // console.log(isEmailValid);
        // console.log(isAddressValid);

        // Javascript Validations

        if(nameData.length == 0 || emailData.length == 0 || addressData.length == 0){

            if(nameData.length > 0){
                $('#name').removeClass('is-invalid');
            } else {
                $('#name').addClass('is-invalid');
                messageName += "<div>Name is required!</div>";
            }

            if(emailData.length > 0){
                $('#email').removeClass('is-invalid');
            } else {
                $('#email').addClass('is-invalid');
                messageEmail += "<div>Email is required!</div>";
            }


            if(addressData.length > 0){
                $('#address').removeClass('is-invalid');
            } else {
                $('#address').addClass('is-invalid');
                messageAddress += "<div>Address is required!</div>";
            }

        } else {

            if(nameData.length < 3){
                messageName += "<div>Name too short!</div>";
                $('#name').addClass('is-invalid');
            } else {
                if(nameData.length > 255){
                    messageName += "<div>Maximum 255 characters allowed!</div>";
                    $('#name').addClass('is-invalid');
                } else {
                    let re1 = /^[a-zA-Z ]*$/;
                    if (re1.test(nameData)) {
                        validName = nameData;
                        isNameValid = true;
                        $('#name').addClass('is-valid').removeClass('is-invalid');
                    } else {
                        messageName += "<div>Name should only contain alphabet and whitespace!</div>";
                        $('#name').addClass('is-invalid');
                    }
                }
            }
    
            if(emailData.length > 255){
                messageEmail += "<div>Maximum 255 characters allowed!</div>";
                $('#email').addClass('is-invalid');
            } else {
                let re2 = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i;
                if (re2.test(emailData)) {
                    validEmail = emailData;
                    isEmailValid = true;
                    $('#email').addClass('is-valid').removeClass('is-invalid');
                } else {
                    messageEmail += "<div>Email Invalid!</div>";
                    $('#email').addClass('is-invalid');
                }
            }
        
            if(addressData.length < 5){
                messageAddress += "<div>Address too short!</div>";
                $('#address').addClass('is-invalid');
            } else {
                if(addressData.length > 255){
                    messageAddress += "<div>Maximum 255 characters allowed!</div>";
                    $('#address').addClass('is-invalid');
                } else {
                    let re3 = /^[a-z0-9A-Z,-.:; ]*$/;
                    if (re3.test(addressData)) {
                        validAddress = addressData;
                        isAddressValid = true;
                        $('#address').addClass('is-valid').removeClass('is-invalid');
                    } else {
                        messageAddress += "<div>Address should only contain alphabet, number, comma, dot, colon, semicolon, hyphen, and whitespace!</div>";
                        $('#address').addClass('is-invalid');
                    }
                }
            }
        }

        $("#messageName").html(messageName);
        $("#messageEmail").html(messageEmail);
        $("#messageAddress").html(messageAddress);

        // For Debugging

        // console.log(isNameValid);
        // console.log(isEmailValid);
        // console.log(isAddressValid);

        mydata = {sid: id, name: validName, email: validEmail, address: validAddress};
        
        if(isNameValid && isEmailValid && isAddressValid){
            $("#uid,#name,#email,#address,#search").val("");
            $.ajax({
                url: "insert.php",
                method: "POST",
                data: JSON.stringify(mydata),
                success: function (data) {
                    msg = "<div>" + data + "<div>";
                    $("#msg").html(msg);
                    $("#submit").html("Add");
                    $('#name,#email,#address').removeClass('is-valid is-invalid');
                    showdata();
                }    
            })
        }
    });
    
    // Delete

    $("#user").on("click", ".btn-delete", function(){
        // console.log("Delete Clicked");
        let id = $(this).attr("data-sid");
        // console.log(id);
        mydata = {sid: id};
        mythis = this;
        $.ajax({
            url: "delete.php",
            method: "POST",
            data: JSON.stringify(mydata),
            success: function(data){
                // console.log(data);
                msg = "<div>" + data + "<div>";
                $("#msg").html(msg);
                $("#uid,#name,#email,#address,#search").val("");
                $('#name,#email,#address').removeClass('is-valid is-invalid');
                showdata();
            }
        })
    });

    // Update

    $("#user").on("click", ".btn-update", function(){
        $("#msg").html("");
        // console.log("Update Clicked");
        let id = $(this).attr("data-sid");
        // console.log(id);
        mydata = {sid: id};
        $.ajax({
            url: "update.php",
            method: "POST",
            dataType: "json",
            data: JSON.stringify(mydata),
            success: function (data){
                // console.log(data);
                $("#uid").val(data.id);
                $("#name").val(data.name);
                $("#email").val(data.email);
                $("#address").val(data.address);
                $("#submit").html("Update");
                $("#search").val("");
                $('#name,#email,#address').addClass('is-valid').removeClass('is-invalid');
                $(window).scrollTop(0);
                showdata();
            }
        })
    });
});
