$(document).ready(function(){
 console.log('tu jestem!');

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

//alert( $('#komcio').val()   );

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
	    	alert('uzupełnij tresc komcia debilu!!!!');
	    }
    });
  	$("#heart").on('click', function(){


  		 var values = {
	    	'book_id':book_id// jak zmienna ze scritptu to bez dolarka
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
	        	pr('nie udało się!');

	        }
	    });


  	});
});