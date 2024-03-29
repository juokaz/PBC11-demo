<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>LOLCats Demonstration</title>
	<style type="text/css">
		body{
			font-family: sans-serif;
			font-size: 0.8em;
		}
		#loading{
			background: #efefef;
			border: 1px dotted #333333;
			padding: 1em;
			display: none;
		}
	</style>
	<script type="text/javascript" src="jquery.js"></script>
	<script type="text/javascript">
		var generating = false;
		var lastImg = '';
		
		// set up fancy JS first	
		$(document).ready(function(){
			$('#lolcat').load(function(){
				$('#loading').html("LOLCat Generated!");
				setTimeout(function(){
					$('#loading').fadeOut(1000);
				},3000);
				generating = false;
			});
			$('#lolcat').error(function(){
				$('#loading').html("Error! You no get LOLCat. :(");
			});
		});
		
		function show_cat(){
			if (!generating){
				if ($("input[@name=text]").val() == ''){
					$('#loading').fadeIn(500);
					$('#loading').html("You should specify text to display!");
					return;
				}
				
				generating = true;
				$('#loading').fadeIn(500);
				$('#loading').html("Loading LOLCat...");
				
				var img = "img.php?align=" + $("select[@name=align]").val() + "&text=" + $("input[@name=text]").val() + "&img=" + $("input[@name=image]").val();
				if (lastImg != img){
					$('#lolcat').attr("src",img + '&seed=' + Math.floor(Math.random()*30000));
					
					// fix possible problems with caching.. 
					setTimeout(function(){
						generating = false
						},3000
					);
				}
			}
		}
	</script>
</head>
<body>
<p><img src="/pbc.png" /></p>
<h4>LOLCats Demonstration Page</h4>
<table>
	<tr><td>Text:</td><td><input type="text" name="text" size="50" value="" /></td></tr>
	<tr><td>Text Location:</td><td>
		<select name="align">
			<option value="tl">Top Left</option>
			<option value="tr">Top Right</option>
			<option value="bl">Bottom Left</option>
			<option value="br">Bottom Right</option>
		</select>
		</td></tr>
	<tr><td>(optional) URL of Image</td><td><input type="text" name="image" size="50" value="" /></td></tr>
	<tr><td></td><td><input type="button" onclick="show_cat()" value="Generate LOLCat" /></td></tr>
</table>
	<hr/>
	<div id="loading"></div>
	<p>
		<img id="lolcat" src="" />
	</p>
</body>
</html>