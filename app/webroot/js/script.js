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
    $("#przycisk_do_komciow").bind('click', function(){
    	//alert('białe');
    	var values={};

		if($('#komcio').val() !=""){
	    	values.body=$('#komcio').val();
	    	values.book_id=book_id;

	    	$.ajax({
		        url: "/comments/ajax_add",
		        type: "post",
		        data: values,
		        success: function(response){

		        	console.log(response);

		        	$("#zbiornik_komciow").prepend(response);
		        	$('#komcio').val('');

		        },

		        error:function(){

		        }

		    });

	    } else{

	    	alert("The comment can't be empty!");
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
  
  // $('.singleMessage').on('mouseenter', function() {
  // 	$(this).toggleClass('singleMessageBiger',300);

  // });
  // $('.singleMessage').on('mouseleave', function() {
  // 	$(this).toggleClass('singleMessageBiger',300);

  // })

  
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

		
});