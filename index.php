<html>
<head>
<title>Bond Web Service Demo</title>
<style>
body {font-family:georgia;}
  .place{
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

  .pic img{
	  max-width:100px;
    max-height:64px;
  }


  
</style>
<script src="https://code.jquery.com/jquery-latest.js" type="text/javascript"></script>

<script type="text/javascript">

function placeTemplate(place){
  return `<div class="place">
      <b>Name: </b> ${place.Name} <br/>
      <b>Location:  </b> ${place.Location} <br/>
      <b>Rating: </b> ${place.Rating} <br/>
      <b>Pros: </b> ${place.Pros} <br/>
      <div class="pic"><img src="thumbnails/${place.Image}" /></div>
    </div>`;
}



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
      // title on page 
      $("#placestitle").html(data.title);

      //clears the previous places
      $("#places").html("");

      //loops through places and adds to page
      $.each(data.places,function(key, value){
        let str = placeTemplate(value);
        $("<div></div>").html(str).appendTo("#places");
      });

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
  <h1>Cool Places Web Service</h1>
    <a href="rating" class="category">Cool Places By Rating</a><br />
    <a href="alpha" class="category">Cool Places By Alphabet</a>

    <h3>Website Description: </h3>
    <p>Hello! This website uses JSON to change data on a PHP page without having to go to a whole different HTML page</p>
    
    <h3 id="placestitle">Title Will Go Here</h3>
    <div id="places">
      <p>Places will go here</p>
    </div>
    
    <div id="output">Results go here</div>
    
  </body>
</html>