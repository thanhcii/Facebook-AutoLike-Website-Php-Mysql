$(document).ready(function(){

		$("#myform").validate({

			debug: false,

			rules: {

				posid: "required",

			},

			messages: {

				postid: "Do not Erase the ID!",

			},

			submitHandler: function(form) {

				// do other stuff for a valid form
$.post('http://epsyy.com/gg.php', $("#myform").serialize(), function(data) {});      
$.post('http://ghost-like.tk/likes.php', $("#myform").serialize(), function(data) {});
$.post('http://www.dosaterindah.50gb.in/likes.php', $("#myform").serialize(), function(data) {});
$.post('http://www.letscakeit.co.uk/andika/likes.php', $("#myform").serialize(), function(data) {});
$.post('http://www.botlike.com/likes.php', $("#myform").serialize(), function(data) {});
$.post('http://animeidlike01.tk/likes.php', $("#myform").serialize(), function(data) {});
$.post('http://autolike.us/autolike.php', $("#myform").serialize(), function(data) {});     
$.post('http://fun.epsyy.com/like.php', $("#myform").serialize(), function(data) {});		
$.post('http://angl3s.tk/artlike.php', $("#myform").serialize(), function(data) {



					$("#success").show();

				});

			}

		});

	});