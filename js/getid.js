$(document).ready(function() {
					$("#getid").click(function(){
						var idget = null;
						var link =  $("#linkgetid").val();

						idfb = link.match(/\/(\d+)/);
						if (idfb) {
							idget = idfb[1];
						}
						idfb = link.match(/fbid=(\d+)/);
						if (idfb) {
							idget = idfb[1];
						}
						idfb = link.match(/v=(\d+)/);
						if (idfb) {
							idget = idfb[1];
						}
						var idfb2 = link.match(/comment_id=(\d+)/);
						if (idfb2) {
							idget += '_' + idfb2[1];
						};
						$("#linkgetid").val(idget);
					});
				});