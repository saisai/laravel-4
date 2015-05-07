$(document).ready(function(){

   $.ajaxSetup({
    headers: {
        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
    }
		});

    /*
    $( ".formJobsDb" ).click(function( event ) {
        event.preventDefault();
        var element = $(this);
        var Id = element.attr("id");

        console.log( $( '#hdLink'+Id ).val() );
    });
  */
    /*
    $( "form" ).on( "submit", function( event ) {
        event.preventDefault();
        console.log( $( 'form' ).serialize() );
    });*/

    $('.formJobsDb').click(function(event){
        event.preventDefault();

        var element = $(this);
        var Id = element.attr("id");

        var link = $('#link'+Id).val();
        var title = $('#title'+Id).val();
        var from_which_website = $('#from_which_website'+Id).val();
        var dataString = 'link='+ encodeURIComponent(link) + '&title=' + title + '&from_which_website='+from_which_website ;

        // Becareful with dataType:'json'. If don't add this , can not be used data.success. Take me 2 hours to find it. :)
        $.ajax({
            url:'add_job_db',
            method: 'post',
            data: dataString,
            dataType: 'json',
            success:function(data){
               if(data.success)
               {
                    alert("Exits");
               }
              else
              {
                     alert("Successfully added!");
              }

            },
            error : function(XMLHttpRequest, textStatus, errorThrown) {
                alert(textStatus);
              }
        });
        return false;
    });   


 //Job Thai
    $('form.formJobThai').submit(function(e){
        e.preventDefault();

        var values = $(this).serialize();
        // Becareful with dataType:'json'. If don't add this , can not be used data.success. Take me 2 hours to find it. :)
        $.ajax({
            url:'add_job_thai',
            method: 'post',
            data: values,
            dataType: 'json',
            success:function(data){
               if(data.success)
               {
                    alert("Exits");
               }
              else
              {
                     alert("Successfully added!");
              }

            },
						error : function(XMLHttpRequest, textStatus, errorThrown) {
                alert(textStatus);
                alert(errorThrown);
              }
        });

    });
		
		$("#btnDeleteAll").hide();
		
    $("#check_all").change(function() {
		
			
		
      var inputs  = $("input[type='checkbox']");
      if ( $(this).is(":checked") ) {
        inputs.prop( "checked", true );
        // inputs.attr( "checked", true ); // if its not working
				$("#btnDeleteAll").show();
      }
      else {
				$("#btnDeleteAll").hide();
        inputs.removeAttr( "checked" );
      }
    });
		
		   
		
	$("#frmcheckall").submit(function(e) {  // triggred submit
		e.preventDefault();		
		
		var count_checked = $("[name='data[]']:checked").length; // count the checked
		if(count_checked == 0) {
			alert("Please select a product(s) to delete.");
			return false;
		}
		
		
			var str = [];
			for(i = 1; i <= count_checked; i++)
			{
				var val = $("#data_"+i).val();
				str[i] = val;
			}
			
			str.shift(); // remove first null
			json_arr = JSON.stringify(str); //convert array to json
			var values = $(this).serialize();
			var dataString = values+'&link='+ json_arr ;
			
			 $.ajax({
						url: 'delete-all',
						type: 'post',
						data: dataString,
						dataType: 'json',
						success: function( dataString ) {
						
						if(dataString.success)
						{
							location.reload();
							$("#check_all").prop('checked', false);
							var inputs  = $("input[type='checkbox']");
							inputs.removeAttr( "checked" );
						}

						}
					});
		
		
	});
		
		
	
	

});		

//$('#firstShow').hide();
//$('#ajax-loading').hide();
/*
$(".pagination a").click(function()
{
    var myurl = $(this).attr('href');

    $.ajax(
    {
        url: myurl,
        type: "get",
        datatype: "html",
        beforeSend: function()
        {
            $('#ajax-loading').hide();
            $('#firstShow').hide();
        }
    })
    .done(function(data)
    {
        $('#ajax-loading').empty().show();
        $("#firstShow").html(data.html);
    })
    .fail(function(jqXHR, ajaxOptions, thrownError)
    {
          alert('No response from server');
    });
    return false;
});
/*

/*
$('#ajaxContent').load('http://localhost:5555/cn/public/job-thai');
$(".pagination a").click(function()
    {
        var myurl = $(this).attr('href');
        $.ajax(
        {
            url: myurl,
            type: "get",
            datatype: "html",
            beforeSend: function()
            {
                $('#ajax-loading').show();
            }
        })
        .done(function(data)
        {
            $('#ajax-loading').hide();
            $("#comments").empty().html(data.html);
        })
        .fail(function(jqXHR, ajaxOptions, thrownError)
        {
              alert('No response from server');
        });
        return false;
    });
*/






/*
$(document).ready(function() {
        $('form#ajaxform').submit(function() {
            $.ajax({
                type: 'post',
                cache: false,
                dataType: 'json',
                data: $('form#ajaxform').serialize(),
                beforeSend: function() { 
                    $("#validation-errors").hide().empty(); 
                },
                success: function(data) {
                    if(data.success == false)
                    {
                        var arr = data.errors;
                        $.each(arr, function(index, value)
                        {
                            if (value.length != 0)
                            {
                                $("#validation-errors").append('<div class="alert alert-error"><strong>'+ value +'</strong><div>');
                            }
                        });
                        $("#validation-errors").show();
                    } else {
                         location.reload();
                    }
                },
                error: function(xhr, textStatus, thrownError) {
                    alert('Something went to wrong.Please Try again later...');
                }
            });
            return false;
    });
});
*/

