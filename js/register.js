
$( document ).ready(function() {
    $("#competition_type").show();

    $( "#repeatpassword" ).keyup(function() {
        var passwordcheck = $( "#password" ).val();
        var repeatpassword = $( "#repeatpassword" ).val();
        if(repeatpassword != passwordcheck){
            $( "#passworddoesnotmatch" ).show();
        }else{
            $( "#passworddoesnotmatch" ).hide();
        }
    });
    
    
    $.ajax({
        type : 'POST',
        url : 'server/user.php',
        data : {
            type : "loadStates",
            data : ""
        },
        success : function(data) {
            var html ="";
            var result  = JSON.parse(data);
            for(var i in result){
                html += "<option value="+result[i].state_abv+"> "+result[i].state_abv+" </option>";
            }

            $("#dd-state").html(html);
            loadCounties();
        },
        error : function(data) {
            alert("Server Error please contact admin")
        }
    });

    $.ajax({
        type : 'POST',
        url : 'server/user.php',
        data : {
            type : "getCompetitionTypes",
            data : ""
        },
        success : function(data) {
            var html ="";
            var result  = JSON.parse(data);
            console.log(result)
            for(var i in result){
                html += ` <input type="radio" id="competition_type-${result[i].id}" name="competition_type" value="${result[i].id}"/> 
                <label for="${result[i].competition_name}">${result[i].competition_name}</label>   <br>`
               
            }

            $("#competition_type > div").html(html);
        },
        error : function(data) {
            alert("Server Error please contact admin")
        }
    });




});



function loadCounties(){

    var state = $("#dd-state").val();

    var data = {  } ;
    data.state = state ;

    $.ajax({
        type : 'POST',
        url : 'server/user.php',
        data : {
            type : "loadCounties",
            data : data
        },
        success : function(data) {
            var html ="";
            var result  = JSON.parse(data);
            for(var i in result){
                html += '<option value="'+result[i].county+'"> '+result[i].county+' </option>';
            }

            $("#dd-county").html(html);
            loadOrganization();
            loadCity();

        },
        error : function(data) {
            alert("Server Error please contact admin")
        }
    });

}

function loadCity(){

    var county = $("#dd-county").val();

    var data = {  } ;
    data.county = county ;

    $.ajax({
        type : 'POST',
        url : 'server/user.php',
        data : {
            type : "loadCity",
            data : data
        },
        success : function(data) {
            var html ="";
            var result  = JSON.parse(data);
            for(var i in result){
                html += "<option value="+result[i].title+"> "+result[i].title+" </option>";
            }

            $("#dd-city").html(html);
            loadOrganization();

        },
        error : function(data) {
            alert("Server Error please contact admin")
        }
    });

}

$('#dd-county').on('change',function(){
    loadCity();
    loadOrganization();
});

$('#not-list-orgn').on('click',function(){
    var htmlinput =  '<input id="enterOrganisation" type="text" name="enter-orgn" value="" class="form-control input-lg" placeholder="Enter Your Organisation" />';
    $("#dd-org-div").html(htmlinput);
    
    $("#enterOrganisation").keyup(function(){
        var getidd_role = $("#dd-role").val();
        if(getidd_role == '1' || getidd_role == '2'){
            alert("STOP!! You may only register if your organization has already registered.  You should be able to select your school from the organization list.  If you do not see your school, ask your school or club administrator to sign up first");
            $("#enterOrganisation").val('');
        }
    });
});


 function loadMasterAccount(){
   // alert('gg');
    var data = {  } ;
    data.county = 's' ;

    $.ajax({
        type : 'POST',
        url : 'server/user.php',
        data : {
            type : "loadMasterAccount",
            data : data
        },
        success : function(data) {
        //alert(data);
            var html ="";
            var result  = JSON.parse(data);
            html +=  '<input id="enterOrganisation" type="text" name="enter-orgn" value="" class="form-control input-lg" placeholder="Enter Your Organisation" />';
            html += '<select id="dd-master" name="masteraccount" class="form-control input-lg" style="margin-top: 10px;">';
            html += "<option value=''> Select Master Account </option>";
            for(var i in result){
                html += "<option value="+result[i].id+"> "+result[i].master_account+" </option>";
            }
            html += "<option value='none'> None </option>";
            html += '</select>';
            
            $("#dd-org-div").html(html);
            
        },
        error : function(data) {
            alert("Server Error please contact admin")
        }
    });

}


function loadOrganization(){
    var county = $("#dd-county").val();
    var state = $("#dd-state").val();
    var data = { id:"-1" } ;
    data.state = state ;
    data.county = county;

    $.ajax({
        type : 'POST',
        url : 'server/user.php',
        data : {
            type : "loadOrganization",
            data : data
        },
        success : function(data) {
            var html ="";
            var result  = JSON.parse(data);
            html = '<select id="dd-org" name="organization" class="form-control input-lg">';
            for(var i in result){
                html += "<option value="+result[i].id+"> "+result[i].org_name+" </option>";
            }
            html += '</select>';
            if(result == ''){
                //alert('Organisation Not found on database, Please enter');
                var htmlinput =  '<input id="enterOrganisation" type="text" name="enter-orgn" value="" class="form-control input-lg" placeholder="Enter Your Organisation" />';

                $("#dd-org-div").html(htmlinput);
                
                
                //alert(getidd_role);
                //console.log(getidd_role);
                
                $("#enterOrganisation").keyup(function(){
                    var getidd_role = $("#dd-role").val();
                    if(getidd_role == '1' || getidd_role == '2'){
                        alert("STOP!! You may only register if your organization has already registered.  You should be able to select your school from the organization list.  If you do not see your school, ask your school or club administrator to sign up first");
                        $("#enterOrganisation").val('');
                    }
                });
                
                
            }else{
                $("#dd-org-div").html(html);
            }
        },
        error : function(data) {
            alert("Server Error please contact admin")
        }
    });

}


function saveCoachOrganization(id){

    var data = {userId:id , orgId:$("#dd-org").val() } ;
    $.ajax({
        type : 'POST',
        url : 'server/user.php',
        data : {

            type : "saveCoachOrganization",
            data : data
        },
        success : function(data) {

        },
        error : function(data) {
            alert("Server Error please contact admin")
        }
    });
}

function saveOrganization(name){

    var data = {orgname:name ,firstname:$("#fullName").val() ,lastname:$("#lastName").val() , orgemail:$("#email").val(), orgpass:$("#password").val(), orgcounty:$("#dd-county").val(), orgstate:$("#dd-state").val() } ;
    $.ajax({
        type : 'POST',
        url : 'server/user.php',
        data : {

            type : "saveOrganization",
            data : data
        },
        success : function(data) {
            alert(data);
            if(data == 987321){
                alert("Organisation already exist");
                return;
            }
        },
        error : function(data) {
            alert(data);
            alert("Server Error please contact admin");
            return;
        }
    });
}


function saveOrganization1(name){

    var data = {orgstate:$("#dd-state").val(), orgcounty:$("#dd-county").val(),zip:$("#zip").val(),school_type:$("#school_type").val(),orgname:name , firstname:$("#fullName").val() ,lastname:$("#lastName").val(),orgemail:$("#email").val(), orgpass:$("#password").val(),orgphoneno:$("#orgphoneno").val(),masteraccount:$("#dd-master").val()  } ;
    $.ajax({
        type : 'POST',
        url : 'server/user.php',
        data : {

            type : "saveOrganization",
            data : data
        },
        success : function(response) {
            //alert(data);
            console.log(response);
            if(response == 987321){
                alert("Organisation already exist");
                return;
            }
            if(response == 987322){
                alert("Organisation Email already exist");
                return;
            }
            else{
                window.location = "confirmation.html";
            }
        },
        error : function(data) {
            alert("Server Error please contact admin");
            return;
        }
    });
}

function saveMasterAccount(name){

    var data = {orgstate:$("#dd-state").val(), orgcounty:$("#dd-county").val(),zip:$("#zip").val(),school_type:$("#school_type").val(),orgname:name , firstname:$("#fullName").val() ,lastname:$("#lastName").val(),orgemail:$("#email").val(), orgpass:$("#password").val(),orgphoneno:$("#orgphoneno").val()  } ;
    $.ajax({
        type : 'POST',
        url : 'server/user.php',
        data : {

            type : "saveMasterAccount",
            data : data
        },
        success : function(data) {
            //alert(data);
            if(data == 987321){
                alert("Master account already exist");
                return;
            }else{
                window.location = "index.html";
            }
        },
        error : function(data) {
            alert("Server Error please contact admin");
            return;
        }
    });
}

function validateNumberInput(input) {
    if ($("#dd-role").val() != 2){
        if (/^\d+$/.test(input.value)) {
            $("#org-phoneno span").hide();

        } else {
            input.value = input.value.replace(/[^0-9]/g, '');
             $("#org-phoneno span").show();
        }
       
    }else{
        $("#org-phoneno span").hide();

    }

}



function register(){

    var data = {} ;
    var fullName = $("#fullName").val();
    if(fullName == ""){
        alert("Full name is missing");
        return ;
    }
    data.fullName = fullName ;

    var lastName = $("#lastName").val();
    if(lastName == ""){
        alert("Full name is missing");
        return ;
    }
    data.lastName = lastName ;

    var email = $("#email").val();
    //alert(email);
    if($("#dd-role").length > 0  && email == ""){
        alert("Email is missing");
        return ;
    }
    data.email = email ;
    
    var passwordcheck = $( "#password" ).val();
    var repeatpassword = $( "#repeatpassword" ).val();
    
    
    if(repeatpassword != passwordcheck && $("#dd-role").val() != 2){
        alert("Password does not match");
        return ;
    }
    

    $.session.set("sessemail",email);

    //alert($.session.get("compareLeftContent"));
    var yetVisited = localStorage['visited'];
    if (!yetVisited) {
        // open popup
        localStorage['visited'] = "yes";
    }

    var enterOrganisation = $("#enterOrganisation").val();
    if(enterOrganisation == ""){
        alert("Organisation is missing");
        return ;
    }
    
    var masteraccount = $("#dd-master").val();
    
    data.masteraccount = masteraccount ;

    
    
    //alert(enterOrganisation);
    $.session.set("sessorg",enterOrganisation);



    var password = $("#password").val();
    if(password == "" && $("#dd-role").val() != 2){
        alert("Password is missing");
        return ;
    }


    data.password = password ;

    var role_id = $("#dd-role").val();

    data.role_id = role_id;

    var state = $("#dd-state").val();

    data.state = state ;

    var county = $("#dd-county").val();
    data.county =  county ;
    var city = $("#dd-city").val();
    data.city =  city ;

    $.session.set("state",state);
    $.session.set("county",county);

    $.session.set("fullName",fullName);
    $.session.set("lastName",lastName);


    var zip = $("#zip").val();

    if(zip !=""){
        data.zip = zip;
    }

    var school_type = $("#school_type").val();
    if(school_type !=""){
        data.school_type = school_type;
    }
    var orgphoneno = $("#orgphoneno").val();
    if(orgphoneno !=""){
        data.orgphoneno = orgphoneno;
    } else {
        alert('Phone Number is required');
        return;
    }

    var feild = $("#feild").val();
    if(feild != ""){
        data.feild = feild;
    }

    var grade = $("#grade").val();
    if(grade != ""){
        data.grade = grade;
    }

    var grade = $("#grade").val();
    if(grade != ""){
        data.grade = grade;
    }

    var competition_type = Array.from($('input[name="competition_type"]:checked')).map(checkbox => checkbox.value).toString();
    if(competition_type != "" && competition_type){
        data.competition_type = competition_type;
    } else if ($('#competition_type').is(":visible")){
        alert("Competition type is required");
        return ;
    }

    var total_volunteer_hours = $('input[name="total-volunteer-hours"]').val();
    if(grade != ""){
        data.total_volunteer_hours = total_volunteer_hours;
    }

    var volunteer_progress_made = $('input[name="volunteer-progress-made"]').val();
    if(grade != ""){
        data.volunteer_progress_made = volunteer_progress_made;
    }

    var volunteer_weekly_availability = Array.from($('input[name="volunteer-weekly-availability"]:checked')).map(checkbox => checkbox.value).toString();
    if(volunteer_weekly_availability != "" && volunteer_weekly_availability){
        data.volunteer_weekly_availability = volunteer_weekly_availability;
    } else if ($('#volunteer-weekly-availability').is(":visible")){
        alert("General Weekly Availability is required");
        return ;
    }

    var parent_email = $("#parent_email").val();

    if(parent_email !=""){
        data.parent_email = parent_email;
    }

    if(document.getElementById('parent_consent_yes').checked){
        data.parent_consent = "1";
    }else{

        data.parent_consent = "0";
    }

    //if( $("#dd-role").val() == "3" ) {
    var orgval = $("#dd-org").val();
    //alert(orgval);
    var enterorg = $("#enterOrganisation").val();
    if(enterorg == null){
        //alert('not eneter');
        data.org_id =  $("#dd-org").val() ;
    }else{
        //alert('eneter');
        //alert(enterorg);
        //saveOrganization(enterorg);
        data.enterorg =  enterorg;
    }
    //alert(enterorg);

    //}
    if( $("#dd-role").val() == "4" ) {
        var enterorg = $("#enterOrganisation").val();
        
        saveOrganization1(enterorg);
        //alert("Successfully Register ");

        return;
    }
    if( $("#dd-role").val() == "6" ) {
        var entermaster = $("#enterMasterAccount").val();
        saveMasterAccount(entermaster);
        //alert("Successfully Register ");

        return;
    }
    
     var league = [];
        $.each($("input[name='league']:checked"), function(){            
            league.push($(this).val());
        });
        //alert("My favourite sports are: " + league.join(", "));
        data.league = league;
        
    $.ajax({
        type : 'POST',
        url : 'server/user.php',
        data : {
            type : "loadLeague",
            data : data
        },
        success : function(response) {


            var response = JSON.parse(response);
            data.league_id = response[0].id ;

            $.ajax({
                type : 'POST',
                url : 'server/user.php',
                data : {
                    type : "registerUser",
                    data : data
                },
                success : function(data1) {


                    //alert(data1);
                    console.log(data1);
                    try {
                        JSON.parse(data1);
                    } catch (e) {
                        alert(data1);
                        return false;
                    }

                    var data1 = JSON.parse(data1);

                    try {

                        if ($("#dd-role").val() == "1") {
                            saveCoachOrganization(data1[0].id)
                        }
                        alert("Successfully Register ");
                        if(role_id == 1 || role_id == 2 || role_id == 3 || role_id == 7){
                            window.location = "index.html";
                        }else{
                            window.location = "pay3.html";    
                        }
                        

                    } catch (e) {
                        alert("Email is already registered.");
                    }

                },
                error : function(data) {
                    alert("Server Error please contact admin")
                }
            });




        },
        error : function(data) {
            alert("Server Error please contact admin")
        }
    });






}

function registerNoSession(){
    roleChangeEvent()

    var data = {} ;
    var fullName = $("#fullName").val();
    if(fullName == ""){
        alert("Full name is missing");
        return ;
    }
    data.fullName = fullName ;

    var lastName = $("#lastName").val();
    if(lastName == ""){
        alert("Full name is missing");
        return ;
    }
    data.lastName = lastName ;

    var email = $("#email").val();
    //alert(email);
    if($("#dd-role").val() != 2  && email == ""){
        alert("Email is missing");
        return ;
    }
    data.email = email ;
    
    var passwordcheck = $( "#password" ).val();
    var repeatpassword = $( "#repeatpassword" ).val();
    
    
    if(repeatpassword != passwordcheck && $("#dd-role").val() != 2){
        alert("Password does not match");
        return ;
    }
    


    //alert($.session.get("compareLeftContent"));
    var yetVisited = localStorage['visited'];
    if (!yetVisited) {
        // open popup
        localStorage['visited'] = "yes";
    }

    var enterOrganisation = $("#enterOrganisation").val();
    if(enterOrganisation == ""){
        alert("Organisation is missing");
        return ;
    }
    
    var masteraccount = $("#dd-master").val();
    
    data.masteraccount = masteraccount ;

    
    
    //alert(enterOrganisation);



    var password = $("#password").val();
    if(password == "" && $("#dd-role").val() != 2){
        alert("Password is missing");
        return ;
    }


    data.password = password ;

    var role_id = $("#dd-role").val();

    data.role_id = role_id;

    var state = $("#dd-state").val();

    data.state = state ;

    var county = $("#dd-county").val();
    data.county =  county ;
    var city = $("#dd-city").val();
    data.city =  city ;




    var zip = $("#zip").val();

    if(zip !=""){
        data.zip = zip;
    }

    var school_type = $("#school_type").val();
    if(school_type !=""){
        data.school_type = school_type;
    }
    var orgphoneno = $("#orgphoneno").val();
    if(orgphoneno !=""){
        data.orgphoneno = orgphoneno;
    } else {
        alert('Phone Number is required');
        return;
    }

    var feild = $("#feild").val();
    if(feild != ""){
        data.feild = feild;
    }

    var grade = $("#grade").val();
    if(grade != ""){
        data.grade = grade;
    }

    var grade = $("#grade").val();
    if(grade != ""){
        data.grade = grade;
    }

    var competition_type = Array.from($('input[name="competition_type"]:checked')).map(checkbox => checkbox.value).toString();
    if(competition_type != "" && competition_type){
        data.competition_type = competition_type;
    } else if ($('#competition_type').is(":visible")){
        alert("Type of Judge is required");
        return ;
    }

    var total_volunteer_hours = $('input[name="total-volunteer-hours"]').val();
    if(grade != ""){
        data.total_volunteer_hours = total_volunteer_hours;
    }

    var volunteer_progress_made = $('input[name="volunteer-progress-made"]').val();
    if(grade != ""){
        data.volunteer_progress_made = volunteer_progress_made;
    }

    var volunteer_weekly_availability = Array.from($('input[name="volunteer-weekly-availability"]:checked')).map(checkbox => checkbox.value).toString();
    if(volunteer_weekly_availability != "" && volunteer_weekly_availability){
        data.volunteer_weekly_availability = volunteer_weekly_availability;
    } else if ($('#volunteer-weekly-availability').is(":visible")){
        alert("General Weekly Availability is required");
        return ;
    }

    var parent_email = $("#parent_email").val();

    if(parent_email !=""){
        data.parent_email = parent_email;
    }

    if(document.getElementById('parent_consent_yes')){
        data.parent_consent = "1";
        if(document.getElementById('parent_consent_yes').checked){
            data.parent_consent = "1";
        }
    }else{

        data.parent_consent = "0";
    }

    //if( $("#dd-role").val() == "3" ) {
    var orgval = $("#dd-org").val();
    //alert(orgval);
    var enterorg = $("#enterOrganisation").val();
    if(enterorg == null){
        //alert('not eneter');
        data.org_id =  $("#dd-org").val() ;
    }else{
        //alert('eneter');
        //alert(enterorg);
        //saveOrganization(enterorg);
        data.enterorg =  enterorg;
    }
    //alert(enterorg);

    //}
    if( $("#dd-role").val() == "4" ) {
        var enterorg = $("#enterOrganisation").val();
        
        saveOrganization1(enterorg);
        //alert("Successfully Register ");

        return;
    }
    if( $("#dd-role").val() == "6" ) {
        var entermaster = $("#enterMasterAccount").val();
        saveMasterAccount(entermaster);
        //alert("Successfully Register ");

        return;
    }
    
     var league = [];
        $.each($("input[name='league']:checked"), function(){            
            league.push($(this).val());
        });
        //alert("My favourite sports are: " + league.join(", "));
        data.league = league;
        
        for (const key in data) {
            if (data[key] === undefined) {
                data[key] = '';
            }
        }

        console.log(data)
        
    $.ajax({
        type : 'POST',
        url : 'server/user.php',
        data : {
            type : "loadLeague",
            data : data
        },
        success : function(response) {


            var response = JSON.parse(response);
            data.league_id = response[0].id ;

            $.ajax({
                type : 'POST',
                url : 'server/user.php',
                data : {
                    type : "registerUser",
                    data : data
                },
                success : function(data1) {


                    //alert(data1);
                    console.log(data1);
                    try {
                        JSON.parse(data1);
                    } catch (e) {
                        alert(data1);
                        return false;
                    }

                    var data1 = JSON.parse(data1);

                    try {

                        if ($("#dd-role").val() == "1") {
                            saveCoachOrganization(data1[0].id)
                        }
                        alert("Successfully Register ");
                        if(role_id == 1 || role_id == 2 || role_id == 3 || role_id == 7){
                            
                        }else{
                            window.location = "pay3.html";    
                        }
                        

                    } catch (e) {
                        alert("Email is already registered.");
                    }

                },
                error : function(data) {
                    alert("Server Error please contact admin")
                }
            });




        },
        error : function(data) {
            alert("Server Error please contact admin")
        }
    });






}

function roleChangeEvent() {

    var value = $("#dd-role").val();

    if (value == "1" ) {
        $("#school-type").hide();
        $("#parentDiv").hide();
        $("#org-pnl").show();

        $("#orgphoneno").attr('placeholder', "Phone No");
        $("#org-phoneno").show();
        $("#emailboxs").show();
        $("#competition_type").show();

        $("#password-input").show();
        $("#repeat-password-input").show();

        $("#total-volunteer-hours").hide();
        $("#volunteer-progress-made").hide();
        $("#volunteer-weekly-availability").hide();

        $("#org-phoneno span").hide();


    } else if(value == "2" ) {
        $("#school-type").hide();
        $("#parentDiv").hide();
        $("#org-pnl").show();

        $("#emailboxs").hide();
        $("#orgphoneno").attr('placeholder', "Parents Phone Number");
        $("#org-phoneno").show();
        $("#competition_type").hide();

        $("#password-input").hide();
        $("#repeat-password-input").hide();

        $("#total-volunteer-hours").hide();
        $("#volunteer-progress-made").hide();
        $("#volunteer-weekly-availability").hide();

        $("#org-phoneno span").hide();


    } else if(value == "3") {
        $("#school-type").hide();
        $("#parentDiv").hide();
        $("#org-pnl").show();

        $("#emailboxs").show();
        $("#orgphoneno").attr('placeholder', "Phone No");
        $("#org-phoneno").show();
        $("#competition_type").show();

        $("#password-input").show();
        $("#repeat-password-input").show();

        $("#total-volunteer-hours").hide();
        $("#volunteer-progress-made").hide();
        $("#volunteer-weekly-availability").hide();

        $("#org-phoneno span").hide();

    } else if(value == "4") {
        //alert('e');
        $("#school-type").hide();
        $("#parentDiv").show();
        $("#org-pnl").show();
        $("#email").show();
        
        loadMasterAccount();
        /*
        var htmlinput =  '<input id="enterOrganisation" type="text" name="enter-orgn" value="" class="form-control input-lg" placeholder="Enter Your Organisation" />';
        $("#dd-org-div").append(htmlinput);*/
        $("#email").show();
        $(".regiddfpo").html('Organization');
        //$("#dd-org-div").html(htmlinput);
        $("#not-list-orgn").hide();

        $("#org-phoneno").show();
        $("#orgphoneno").show();
    }else if(value == "6") {
        $("#school-type").hide();
        $("#parentDiv").hide();
        $("#org-pnl").show();
        var htmlinput =  '<input id="enterMasterAccount" type="text" name="enter-orgn" value="" class="form-control input-lg" placeholder="Enter Your Master Account" />';
        $("#dd-org-div").html(htmlinput);
        $(".regiddfpo").html('Master Account');
        
        $("#not-list-orgn").hide();

        $("#org-phoneno").show();
        $("#orgphoneno").show();
    } else if(value == "7") {
        $("#school-type").hide();
        $("#parentDiv").hide();
        $("#org-pnl").show();

        $("#emailboxs").show();
        $("#orgphoneno").attr('placeholder', "Phone No");
        $("#org-phoneno").show();
        $("#competition_type").show();

        $("#password-input").show();
        $("#repeat-password-input").show();

        $("#total-volunteer-hours").show();
        $("#volunteer-progress-made").show();
        $("#volunteer-weekly-availability").show();

        $("#org-phoneno span").hide();


    } else {
        $("#school-type").hide();
        $("#parentDiv").hide();
        $("#org-pnl").show();
        var htmlinput =  '<input id="enterOrganisation" type="text" name="enter-orgn" value="" class="form-control input-lg" placeholder="Enter Your Organisation" />';
        $("#dd-org-div").html(htmlinput);
        $("#not-list-orgn").hide();

        $("#org-phoneno").show();
        $("#orgphoneno").show();
        $("#org-phoneno span").hide();

    }

    if (value == "1" || value == "2" ) {

        //$("#org-pnl").show();
    } else {

    }


    if (value == "1" || value == "3" || value == "4"){
        $("#parentDiv").hide();
        $("#grade_div").hide();
    }
    if (value == "2"){
        
        //$("#pl_feild").show();
        $("#grade_div").show();
        $("#emailboxs").hide();

        var chars = 'abcdefghijklmnopqrstuvwxyz1234567890';
        var string = '';
        for(var ii=0; ii<15; ii++){
            string += chars[Math.floor(Math.random() * chars.length)];
        }

        var randemail = string + '@k12youthcode.com';        
        $("#email").val(randemail);
    }

    if(value == "1" || value == "2" || value == "4"){
        $("#not-list-orgn").hide();
    }
    if(value == "3"){
        $("#not-list-orgn").show();
    }
}