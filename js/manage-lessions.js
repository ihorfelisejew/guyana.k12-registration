var user  = null ;
var userData = null;
var editLessionId = 0;

$(document).ready(function() {
    user = sessionStorage.getItem("user");
	user1 = sessionStorage.getItem("user1");

    if(user != undefined && user != ""){
        user = JSON.parse(user);
        userData = {...userData, user};
		user1 = JSON.parse(user1);
        $("#name").html(user.name);
		$("#last_name").html(user.last_name);
        $("#email").html(user.email);
        $("#league").html(user.league);
		$("#org_name").html(user.org_name_c);
		$("#coach_id").html(user.coach_name);
		
        if(user.role_id =="1"){
            $("#role").html("Coach");
        }
        if(user.role_id =="2"){
            $("#role").html("Player");
        }
        if(user.role_id =="3"){
            $("#role").html("Judge");
        }
        if(user.role_id =="4"){
            $("#role").html("Organization");
        }
        $("#user").val(user.id);
        $("#dp").attr("src","server/uploads/"+user.picUrl.trim());
    }

    $("#saveLessionBtn").click(function() {
        var lessionCategory = $("#lessionType").val();
        var lessionName = $("#lessionName").val();
        var lessionLink = $("#lessionLink").val();

        saveLession(lessionCategory, lessionName, lessionLink);

        editLessionId = 0;

        $.modal.close();
    });

    $(".close-modal").click(function() {
        $.modal.close();
    });
});


function openModalLession(typeModal, triggerElement){
    getModalCategories().then(function() {
        if(typeModal === 'edit') {
            var selectedText = $('#select_lesson option:selected').text();

            $("#lessionType option").each(function() {
                if ($(this).text() === selectedText) {
                    $(this).prop('selected', true);
                } else {
                    $(this).prop('selected', false);
                }
            });
        }
    });

    $("#myModal").modal({
        escapeClose: false,
        showClose: false
    });

    if(typeModal === 'edit'){
        $("#lession__title").text("Edit Lession");
        $("#saveLessionBtn").text("UPDATE");
        $("#lessionName").val($(triggerElement).closest("tr").find("td:eq(0)").text());
        $("#lessionLink").val($(triggerElement).closest("tr").find("td:eq(1) a").attr("href"));

        editLessionId = $(triggerElement).closest("tr").find("#lession_id").val();
    }
    else{
        $("#lession__title").text("Create New Lession");
        $("#saveLessionBtn").text("SUBMIT");
        $("#lessionName").val("");
        $("#lessionLink").val("");
    }
    $(".navbar").css("z-index", -1);
}

function getModalCategories(){
    return new Promise(function(resolve, reject) {
        $.ajax({
            type: 'POST',
            url: 'server/player.php',
            data: {
                type: "getLessonCategories",
                data: ''
            },
            success: function(response) {
                var res = JSON.parse(response);
                rankings = res;
                console.log(res);
                $('#lessionType').empty();
                res.forEach(l => {
                    $('#lessionType').append(`<option value="${l.category}">${l.category}</option>`)
                });
                resolve(); // Викликаємо resolve, щоб позначити завершення завантаження
            },
            error: function(data) {
                reject(data); // Викликаємо reject у випадку помилки
            }
        });
    });
}



function lessionsList(category = ''){
	user = sessionStorage.getItem("user");

    if(user != undefined && user != ""){
        user = JSON.parse(user);
    }
    var userid = user.id;
	var data = { userid: userid, round: 1, category } ;
    $.ajax({
        type : 'POST',
        url : 'server/player.php',
        data : {
            type : "lessionsList",
            data : data
        },
        success : function(response) {
			console.log('response: ' + response);
            $("#lessionsList").html("");

            if(response != ""){
                var links = JSON.parse(response);

                for(var i in links) {
                    $("#lessionsList").append(
                        "<tr style=\"font-size:13px; font-weight:700; background-color: #EEEEEE;\">" +
                        "<td style='width:250px; word-wrap: break-word; padding:25px 0px 25px 30px;'>" + links[i].title + "</td>" +
                        "<td style='width:300px; padding: 25px 50px;'><a style='display:block; width:300px; word-wrap: break-word; text-align: center; color:#333;' target='_blank' href='" + links[i].pdf + "'>" + links[i].pdf + "</a></td>" +
                        "<td><input id='lession-edit' class='lession-edit' type='button' value='Edit' onclick=\"openModalLession('edit', this)\"/><input type='hidden' id='lession_id' value='" + links[i].id + "' /></td>" +
                        "</tr>"
                    );
                }
            }

        },
        error : function(data) {
            alert("Server Error please contact admin")
        }
    });
}

function saveLession(category, title, pdf) {
    user = sessionStorage.getItem("user");

    user = sessionStorage.getItem("user");

    if(user != undefined && user != ""){
        user = JSON.parse(user);
    }
    var userid = user.id;


	var data = { id: editLessionId, title: title, pdf: pdf, round: 1, category: category };
    data.userid = userid;

    var typeRequest = editLessionId != 0 ? "editLession" : "addLession";

    $.ajax({
        type : 'POST',
        url : 'server/player.php',
        data : {
            type : typeRequest,
            data : data
        },
        success : function(response) {
			console.log('response: ' + response);
            lessionsList($('#select_lesson').val());
        },
        error : function(data) {
            alert("Server Error please contact admin")
        }
    });
}