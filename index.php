<html>
<head>
<title>Bond Web Service Demo</title>
<style>
  body {font-family:georgia;}
  .film{
    border:1px solid #E77DC2;
    border-radius: 5px;
    padding: 5px;
    margin-bottom:5px;
    position:relative;   
  }
 
  .pic{
    position:absolute;
    right:10px;
    top:10px;
  }

</style>
<script src="https://code.jquery.com/jquery-latest.js" type="text/javascript"></script>

<script type="text/javascript">
$(document).ready(function() {  

	$('.category').click(function(e){
        e.preventDefault(); //stop default action of the link
		cat = $(this).attr("href");  //get category from URL


    var request = $.ajax({
      url: "api.php?cat=" + cat,
      method: "GET",
      dataType: "json"
    });
    request.done(function( data ) {
      console.log(data); 
      //place the title on the page
      $("#filmtitle").html(data.title);

      //view JSON as a string
      let myData = JSON.stringify(data, null, 4);
      myData = "<pre>" + myData + "</pre>";
      $("#output").html(myData);



      
    });
    request.fail(function(xhr, status, error) {
      //Ajax request failed.
      var errorMessage = xhr.status + ': ' + xhr.statusText
      alert('Error - ' + errorMessage);
    });


	});
});	

</script>
</head>
	<body>
	<h1>Bond Web Service</h1>
		<a href="year" class="category">Bond Films By Year</a><br />
		<a href="box" class="category">Bond Films By International Box Office Totals</a>
		<h3 id="filmtitle">Title Will Go Here</h3>
		<div id="films">
			<p>Films will go here</p>
		</div>
		<div id="output">Results go here</div>
	</body>
</html>