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
  
  $('.singleMessage').on('click', function() {
  	$(this).toggleClass('singleMessageBiger');

  });

  // $('.messageContainerAnswer').on('click', function(){
  	
  // });
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
});