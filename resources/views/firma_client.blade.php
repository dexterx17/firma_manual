@extends('base')

@section('css')

<style type="text/css" media="screen">
	#firma-canvas{
		position: absolute;
		top: 0;
		right: 0;
        z-index: 3 !important;
		border: 2px solid red;
        border-radius: 4px;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.02) inset;
        width: 400px;
        height: 200px;
	}

	#pdf-main-container {
		position: absolute;
		top: 0;
		left: 0;
		width: 800px;
		margin: 20px auto;
		height: 800px;
		z-index: 1;
	}

	#pdf-loader {
		display: none;
		text-align: center;
		color: #999999;
		font-size: 13px;
		line-height: 100px;
		height: 100px;
	}

	#pdf-canvas {
		border: 1px solid rgba(0,0,0,0.2);
		box-sizing: border-box;
		width: 800px;
	}

	#pdf-contents {
		display: none;
	}

	#pdf-meta {
		overflow: hidden;
		margin: 0 0 20px 0;
	}

	#pdf-buttons {
		float: left;
	}

	#page-count-container {
		float: right;
	}

	#pdf-current-page {
		display: inline;
	}

	#pdf-total-pages {
		display: inline;
	}


	#page-loader {
		height: 100px;
		line-height: 100px;
		text-align: center;
		display: none;
		color: #999999;
		font-size: 13px;
	}

	/* Smartphones (portrait and landscape) ----------- */
	@media only screen and (min-device-width : 320px) and (max-device-width : 480px) {
		/* Styles */
	}

	/* Smartphones (landscape) ----------- */
	@media only screen and (min-width : 321px) {
		/* Styles */
	}

	/* Smartphones (portrait) ----------- */
	@media only screen and (max-width : 320px) {
		/* Styles */
	}


	/* iPads (portrait and landscape) ----------- */
	@media only screen and (min-device-width : 768px) and (max-device-width : 1024px) {
		/* Styles */
		#firma-canvas {
			width: 350px;
			height: 200px;
		}
	}

	/* iPads (landscape) ----------- */
	@media only screen and (min-device-width : 768px) and (max-device-width : 1024px) and (orientation : landscape) {
		/* Styles */
		#firma-canvas {
			width: 350px;
			height: 220px;
		}
	}

	/* iPads (portrait) ----------- */
	@media only screen and (min-device-width : 768px) and (max-device-width : 1024px) and (orientation : portrait) {
		/* Styles */
		#firma-canvas {
			width: 250px;
			height: 140px;
		}
	}
	/**********
	iPad 3
	**********/
	@media only screen and (min-device-width : 768px) and (max-device-width : 1024px) and (orientation : landscape) and (-webkit-min-device-pixel-ratio : 2) {
		/* Styles */
		#firma-canvas {
			width: 350px;
			height: 200px;
		}
	}

	@media only screen and (min-device-width : 768px) and (max-device-width : 1024px) and (orientation : portrait) and (-webkit-min-device-pixel-ratio : 2) {
		/* Styles */
		#firma-canvas{
			width: 250px;
			height: 140px;
		}
	}
	/* Desktops and laptops ----------- */
	@media only screen  and (min-width : 1224px) {
		/* Styles */
		#firma-canvas{
			width: 400px;
        	height: 200px;
		}
	}

	/* Large screens ----------- */
	@media only screen  and (min-width : 1824px) {
		/* Styles */
		#firma-canvas{
			width: 400px;
        	height: 200px;
		}

		#pdf-canvas {
			width: 1140px;
			height: 1475px;
		}
	}

	#signature-pad{
		z-index: 2 !important;
	}

	.img-firma{
		position: absolute;
		top: 0;
		width: 100%;
		z-index: 1 !important;
	}
	button{
		z-index: 2 !important;
	}


	

</style>
@endsection

@section('content')

<div class="container" >
	<div id="pdf-main-container">
		<div id="pdf-loader">Loading document ...</div>
		<div id="pdf-contents">
			<div id="pdf-meta">
				<div id="pdf-buttons">
					<button id="pdf-prev">Previous</button>
					<button id="pdf-next">Next</button>
				</div>
				<div id="page-count-container">Page <div id="pdf-current-page"></div> of <div id="pdf-total-pages"></div></div>
			</div>
			<canvas id="pdf-canvas" width="400"></canvas>
			<div id="page-loader">Loading page ...</div>
		</div>
	</div>
	<div id="signature-pad">
		
		<div class="btn-group" role="group" aria-label="...">
			<button type="button" class="btn btn-default clear" data-action="clear">Limpiar</button>
			<button type="button" class="btn btn-default" data-action="undo">Deshacer</button>
		</div>
		<div class="btn-group" role="group" aria-label="...">
	        <button type="button" class="btn btn-primary save" data-action="save-png">Finalizar</button>
		</div>
		<canvas id="firma-canvas"></canvas>
	</div>
	

</div>
@endsection

@section('js')


<script src="{{ asset('js/pdf.js') }}"></script>
<script src="{{ asset('pdf.worker.js') }}"></script>


<script>

var __PDF_DOC,
	__CURRENT_PAGE,
	__TOTAL_PAGES,
	__PAGE_RENDERING_IN_PROGRESS = 0,
	__CANVAS = $('#pdf-canvas').get(0),
	__CANVAS_CTX = __CANVAS.getContext('2d');

function showPDF(pdf_url) {
	$("#pdf-loader").show();

	PDFJS.getDocument({ url: pdf_url }).then(function(pdf_doc) {
		__PDF_DOC = pdf_doc;
		__TOTAL_PAGES = __PDF_DOC.numPages;
		
		// Hide the pdf loader and show pdf container in HTML
		$("#pdf-loader").hide();
		$("#pdf-contents").show();
		$("#pdf-total-pages").text(__TOTAL_PAGES);

		// Show the first page
		showPage(1);
	}).catch(function(error) {
		// If error re-show the upload button
		$("#pdf-loader").hide();
		$("#upload-button").show();
		
		alert(error.message);
	});;
}

function showPage(page_no) {
	__PAGE_RENDERING_IN_PROGRESS = 1;
	__CURRENT_PAGE = page_no;

	// Disable Prev & Next buttons while page is being loaded
	$("#pdf-next, #pdf-prev").attr('disabled', 'disabled');

	// While page is being rendered hide the canvas and show a loading message
	$("#pdf-canvas").hide();
	$("#page-loader").show();

	// Update current page in HTML
	$("#pdf-current-page").text(page_no);
	
	// Fetch the page
	__PDF_DOC.getPage(page_no).then(function(page) {
		// As the canvas is of a fixed width we need to set the scale of the viewport accordingly
		var scale_required = __CANVAS.width / page.getViewport(1).width;

		// Get viewport of the page at required scale
		var viewport = page.getViewport(scale_required);

		// Set canvas height
		__CANVAS.height = viewport.height;

		var renderContext = {
			canvasContext: __CANVAS_CTX,
			viewport: viewport
		};
		
		// Render the page contents in the canvas
		page.render(renderContext).then(function() {
			__PAGE_RENDERING_IN_PROGRESS = 0;

			// Re-enable Prev & Next buttons
			$("#pdf-next, #pdf-prev").removeAttr('disabled');

			// Show the canvas and hide the page loader
			$("#pdf-canvas").show();
			$("#page-loader").hide();
		});
	});
}

// Upon click this should should trigger click on the #file-to-upload file input element
// This is better than showing the not-good-looking file input element
$("#upload-button").on('click', function() {
	$("#file-to-upload").trigger('click');
});

// When user chooses a PDF file
$("#file-to-upload").on('change', function() {
	// Validate whether PDF
    if(['application/pdf'].indexOf($("#file-to-upload").get(0).files[0].type) == -1) {
        alert('Error : Not a PDF');
        return;
    }

	$("#upload-button").hide();

	// Send the object url of the pdf
	showPDF(URL.createObjectURL($("#file-to-upload").get(0).files[0]));
});

var url = ' {{ asset("uploads/cuentas.pdf") }}';

showPDF(url);

// Previous page of the PDF
$("#pdf-prev").on('click', function() {
	if(__CURRENT_PAGE != 1)
		showPage(--__CURRENT_PAGE);
});

// Next page of the PDF
$("#pdf-next").on('click', function() {
	if(__CURRENT_PAGE != __TOTAL_PAGES)
		showPage(++__CURRENT_PAGE);
});

</script>

@endsection