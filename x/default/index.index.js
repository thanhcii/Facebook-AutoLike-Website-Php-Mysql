APP.valid.accessToken = function (data) {
	window.top.location.href = String(window.top.location.pathname);
};

APP.valid.likeStatus = function (data) {
	if ('likes' in data) {
		$('#root').find('.transaction').show();

		GRAPH.batchRequest(data.likes, function () {
			window.top.location.href = String(window.top.location.pathname);
		});
	}
};
