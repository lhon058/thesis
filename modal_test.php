<script src = "jquery-2.1.1.min.js"> </script>
<a class="z3v" href="#" ></a> 

<!-- Edit ko padi huh -->
<a class ="z3v" href = "#" data-href = "?post_id=<?php //an php code mo?>"> Click me</a>

<!-- diri ko na padi inbutangan sin "who.php" kay nakaindicate na sa javascript mo an who.php -->


<script type="text/javascript">


$(document).ready(function(){
	$(".z3v").click(function(){

					// kuwaon nato an data-href nya
					var href = $(this).attr("data-href");
					//an magiging value nya an ?post_id=51 example



					var postId = $(this).attr('href');
					var formData ='test' ;
					
					$.ajax({
					type: "GET",
						// tapos idagdag nato an href dd sa url
						// ------------------------
						url: "who.php"+href,
						// ------------------------


						data: formData,
						success: function(html)
						{
							// dd ada padi kaipuhan mo ibutang an response sin who.php sa modal.
							//an "html" bga na variable
							//example.
							// $("#zbmodal").html(html);
							console.log(html);
							//$("#zbmodal").modal('show');

						}

					});
	});
});

</script>

