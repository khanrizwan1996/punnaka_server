if(CKEDITOR.env.ie && CKEDITOR.env.version < 9 ) 
CKEDITOR.tools.enableHtml5Elements( document );

CKEDITOR.config.height = 400;
CKEDITOR.config.width = 'auto';

var initSample = ( function() {
	var wysiwygareaAvailable = isWysiwygareaAvailable(),
		isBBCodeBuiltIn = !!CKEDITOR.plugins.get( 'bbcode' );

	return function() {

		var editorElement = CKEDITOR.document.getById( 'editor' );
		if ( isBBCodeBuiltIn ) {
			editorElement.setHtml(
				'Hello world!\n\n' +
				'I\'m an instance of [url=https://ckeditor.com]CKEditor[/url].'
			);
		}

		if( wysiwygareaAvailable ) {
			CKEDITOR.replace( 'editor' );
		}else{
			editorElement.setAttribute( 'contenteditable', 'true' );
			CKEDITOR.inline( 'editor' );
		}




		var editorElement1 = CKEDITOR.document.getById( 'editor1' );
		if ( isBBCodeBuiltIn ) {
			editorElement1.setHtml(
				'Hello world!\n\n' +
				'I\'m an instance of [url=https://ckeditor.com]CKEditor[/url].'
			);
		}
		if ( wysiwygareaAvailable ) {
			CKEDITOR.replace( 'editor1' );
		} else {
			editorElement1.setAttribute( 'contenteditable', 'true' );
			CKEDITOR.inline( 'editor1' );
		}


		var editorElement2 = CKEDITOR.document.getById( 'editor2' );
		if ( isBBCodeBuiltIn ) {
			editorElement2.setHtml(
				'Hello world!\n\n' +
				'I\'m an instance of [url=https://ckeditor.com]CKEditor[/url].'
			);
		}
		if ( wysiwygareaAvailable ) {
			CKEDITOR.replace( 'editor2' );
		} else {
			editorElement2.setAttribute( 'contenteditable', 'true' );
			CKEDITOR.inline( 'editor2' );
		}

		var editorElement3 = CKEDITOR.document.getById('editor3');
		if ( isBBCodeBuiltIn ) {
			editorElement3.setHtml(
				'Hello world!\n\n' +
				'I\'m an instance of [url=https://ckeditor.com]CKEditor[/url].'
			);
		}
		if ( wysiwygareaAvailable ) {
			CKEDITOR.replace('editor3');
		} else {
			editorElement3.setAttribute( 'contenteditable', 'true' );
			CKEDITOR.inline('editor3');
		}

	};

	function isWysiwygareaAvailable(){
		if ( CKEDITOR.revision == ( '%RE' + 'V%' ) ) {
			return true;
		}

		return !!CKEDITOR.plugins.get( 'wysiwygarea' );
	}
} )();

