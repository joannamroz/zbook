$(document).ready(function(){
 //console.log('tu jestem!');

    $("#rateBook").bind('rated', function (event, value) { 

    var values = {
    	'note':value,
    	'book_id':book_id// jak zmienna ze scritptu to bez dolarka

    	}
    	//console.log('klikniete'); 
	 $.ajax({
	        url: "/ratings/ajax_add",
	        type: "post",
	        data: values,
	        success: function(){

	        	console.log(values);
				$("#rateBook").rateit('readonly',true);
				$("#rateBook").before("<h3><strong> Ocena:"+value+"</strong></h3>");

	        },
	        error:function(){

	        }
	    });

 
    });
  
	$('#bodyComment').keypress(function (e) {
		var key = e.which;
	 	if(key == 13)  // the enter key code
	  	{
	  		var values={};
	  	if($('#bodyComment').val() !=""){
	    	values.body=$('#bodyComment').val();
	    	values.book_id=book_id;

	    	$.ajax({
		        url: "/comments/ajax_add",
		        type: "post",
		        data: values,
		        success: function(response){

		        	console.log(response);

		        	$("#commentsContainer").prepend(response);
		        	$('#bodyComment').val('');

		        },

		        error:function(){

		        }

		    });

	    } else{

	    	alert("The comment can't be empty!");
	    }
	    $('input[name = butAssignProd]').click();
	    	return false;  
	  	}

	});   



  	$("#heart").on('click', function(){

  		 var values = {
	    	'book_id':book_id
	    	}

  		 $.ajax({
	        url: "/ratings/ajax_favourite",
	        type: "post",
	        data: values,
	        success: function(response){
	        	//alert( response);
	        	if(response==1){
	        		$("#heart").addClass("highlight");
	        	} else {
	        		$("#heart").addClass("ordinary");
	        	}

	        },

	        error:function(){
	        	pr('Oh no!');

	        }
	    });


  	});

	//kazdemu elementowi o zadanej klasie uruchamiamy/selecta2
	  $(".use_select2").select2();
	  $('.notrrated').on('mouseover', function(){
	  $('.notrrated').attr('title', 'To rate this book ...');
	  });
	  
	  $('.singleMessage').on('mouseenter', function() {
	  	$(this).toggleClass('singleMessageBiger',300);

	  });
	  $('.singleMessage').on('mouseleave', function() {
	  	$(this).toggleClass('singleMessageBiger',300);

	  })

  	$('#messageSend').keypress(function (e) { 
		var key = e.which;
	 	if(key == 13)  // the enter key code
	  	{
	  		var values={};
	  	if($('#messageSend').val() !=""){
	    	values.body=$('#messageSend').val();
	    	values.recipient_id=$('#MessageRecipientId').val();
	    	
	    	$.ajax({
		        url: "/messages/ajax_send",
		        type: "post",
		        data: values,
		        success: function(response){

		        	console.log(response);
		        	$('#msgFormViewUser').append('<h5 class="enterSend">Your message has been send!</h5>');
		        	$('#messageSend').val('');


		        },

		        error:function(){

		        }

		    });

	    } else{

	    	alert("The message can't be empty!");
	    }
	    $('input[name = butAssignProd]').click();
	    	return false;  
	  	}

	});   


	$("#messageButton").bind('click', function(){
    	//alert('białe');
    	var values = {

    	}

		if($('#msgBodyInput').val() !=""){
	    	values.body=$('#msgBodyInput').val();
	    	values.recipient_id=$('#MessageRecipientId').val();
	    

	    	$.ajax({
		        url: "/messages/ajax_send",
		        type: "post",
		        data: values,
		        success: function(response){

		        	//console.log(response);
		        	$('#singleConversation').prepend(response);
		        	$('#msgBodyInput').val('');//wyczyszczenie pola cody po wysłaniu danych ajaxem

		        },

		        error:function(){

		        }

		    });

	    } else{

	    	alert('This message has no content!');
	    }

    });

    $('.singleMessage').on('click', function(){

    	
    	var values = {
    		'recipient_id':$(this).data('recipient-id')
 
    	}
    	$(this).removeClass('not_read');
    	$(this).find('.senderContent').pulse('destroy');
    	$('#MessageRecipientId').val($(this).data('recipient-id'));
    	$.ajax({
		        url: "/messages/ajax_view_conversation",
		        type: "post",
		        data: values,
		        success: function(response){

		        	//console.log(response);

		        	//uzupelnij element o id zbiornik_na_kontekt_z_ajaxa trescia z response...
		        	//http://api.jquery.com/html/  

		        	//Funkcja ta działa podobnie jak append i prepend z ta tylko roznica ze nie dodaje 
		        	//nowej tresci tylko zastepuje calkiem tresc ktora obecnie sie w danym elemencie znajodwala
		        	$('.messagesForm').show();
		        	 $('#zbiornik_na_kontent_z_ajaxa').html(response);
		        	 $('#msgBodyInput').val('');
		        	 //Dla testu mozesz to odkomentowac i zauwazyc jak twoja storna bedzie rosla :D
		        	 //$('#zbiornik_na_kontent_z_ajaxa').append(response);

		        },

		        error:function(){

		        }
    	});
	});
	//alert('aaa');
	var properties = {
        'color' : 'red',
        'font-weight' :800


    };


	$('.senderContent.not_read').pulse(properties, {pulses:-1 }); //-1 means that will never stop pulsing
	$('#author_more').hide();
	$('#showMore').on('click', function(){
		$('#author_more').show();
		$('#showMore').hide();
	});
	
	$('#isDead').on('click', function(){
		$('.form-group.died').toggle();
	});

	$('#newFriend').on('click', function(){
		var values = {
    		'recipient_id':$(this).data('recipient-id')
 
    	}
    	$.ajax({
		        url: "/friends/addFriend",
		        type: "post",
		        data: values,
		        success: function(response){
		        	$('#newFriend').text('Request sent');
		        },
		        error:function(){

		        }
		});
    });
    $('#invitations').on('click', function(){
    	$('#headerFriends').text('Invitations');
    	$('#friendsList').hide();
    	$('#invitationsList').show();
    });

    $('#friends').on('click', function(){
    	$('#headerFriends').text('Friends');
    	$('#invitationsList').hide();
    	$('#friendsList').show();
    	
    });

    $('#allFriends').on('click', function(){
    	$('#mutual').removeClass('redLink');
    	$(this).addClass('redLink');
    	$('#mutualFriends').hide();
    	$('#friendFriends').show();

    });
    
    $('#mutual').on('click', function(){
    	$('#allFriends').removeClass('redLink');
    	$(this).addClass('redLink');
    	$('#friendFriends').hide();
    	$('#mutualFriends').show();
    	
    });

    $('.deleteRequest').on('click', function(){
    	var values = {
	    	'sender_id':$(this).data('sender-id')
	    	}

	    	$.ajax({
	        url: "/friends/delete_request",
	        type: "post",
	        data: values,
	        success: function(response){
	        	//alert( response);
	        	$('#singleFriendInvitation').remove();
	        },

	        error:function(){
	        	pr('Oh no!');

	        }
    	});
	});

	$('.confirmFriend').on('click', function(){

		checkInvitations();

    	var values = {
	    	'sender_id':$(this).data('sender-id')
	    	}

	    	$.ajax({
	        url: "/friends/confirm",
	        type: "post",
	        data: values,
	        success: function(response){
	        	//alert( response);
	        	$('#singleFriendInvitation').remove();
	        	//tutaj
	        },

	        error:function(){
	        	pr('Oh no!');

	        }
    	});
	});

	$('.removeFriend').on('click', function(){
    	var values = {
	    	'sender_id':$(this).data('sender-id')
	    	}

	    	console.log('kliknięto');
	    	$.ajax({
	        url: "/friends/delete_friend",
	        type: "post",
	        data: values,
	        success: function(response){
	        	//alert( response);
	        	$('#singleFriendInfo').remove();
	        },

	        error:function(){
	        	pr('Oh no!');

	        }
    	});
	});

	//$('badgeFriend').on('click', function(){
	//	$('.fa-users').html('<i class="fa fa-users fa-lg"></i>');
	//});
	function checkInvitations(){
		var badges=$('#badgeFriend span').text();
		badges=parseInt(badges);
		badges=badges-1;
		console.log(badges);
		if(badges>0){
			$('#badgeFriend span').text(badges);
		}else{
			$('#badgeFriend span').remove();
		}
	


	}
	$('#badgeFriend').on('click', function(){
	
	});



});