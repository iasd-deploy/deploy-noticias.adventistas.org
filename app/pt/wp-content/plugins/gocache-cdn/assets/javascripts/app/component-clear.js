MONKEY.ComponentWrapper( 'Clear', function(Clear) {

	Clear.fn.init = function() {
		this.addEventListener();
	};

	Clear.fn.addEventListener = function() {
		this.addEvent( 'click', 'all' );
		this.addEvent( 'click', 'by-url' );
	};

	Clear.fn._onClickAll = function(event) {
		this.send( 'mbuceP3nRNUqXzR5' );
	};

	Clear.fn._onClickByUrl = function(event) {
		this.send( 'VwtDUTW92c2B8Yjf' );
	};

	Clear.fn.beforeSend = function() {
		//this.elements.submit.attr( 'disabled', 'disabled' );
		//this.elements.submit.spinnerShow( 'after' );
	};

	Clear.fn.send = function(action) {
		var params = { 'action' : action };

		if ( action == 'VwtDUTW92c2B8Yjf' ) {
			params.urls = this.elements.textarea.val();
		}

		var ajax = jQuery.ajax({
			url       : MONKEY.Utils.getUrlAjax(),
			data      : params,
			dataType  : 'json',
			type      : 'POST'
		});

		this.beforeSend();
		ajax.done( this._done.bind( this ) );
		ajax.fail( this._fail.bind( this ) );
	};

	Clear.fn._done = function(response) {
		//this.elements.submit.removeAttr( 'disabled' );
		//this.elements.submit.spinnerHide();
		this.$el.messageShowBefore( 'updated', response.message, true );
	};

	Clear.fn._fail = function(throwError, status) {
		var response = ( throwError.responseJSON || {} );

		//this.elements.submit.removeAttr( 'disabled' );
		//this.elements.submit.spinnerHide();
		this.$el.messageShowBefore( 'error', response.message, true );
	};

});