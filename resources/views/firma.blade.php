@extends('base')

@section('css')

<style type="text/css" media="screen">
	
	canvas{
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
		canvas {
			width: 350px;
			height: 200px;
		}
	}

	/* iPads (landscape) ----------- */
	@media only screen and (min-device-width : 768px) and (max-device-width : 1024px) and (orientation : landscape) {
		/* Styles */
		canvas {
			width: 350px;
			height: 220px;
		}
	}

	/* iPads (portrait) ----------- */
	@media only screen and (min-device-width : 768px) and (max-device-width : 1024px) and (orientation : portrait) {
		/* Styles */
		canvas {
			width: 250px;
			height: 140px;
		}
	}
	/**********
	iPad 3
	**********/
	@media only screen and (min-device-width : 768px) and (max-device-width : 1024px) and (orientation : landscape) and (-webkit-min-device-pixel-ratio : 2) {
		/* Styles */
		canvas {
			width: 350px;
			height: 200px;
		}
	}

	@media only screen and (min-device-width : 768px) and (max-device-width : 1024px) and (orientation : portrait) and (-webkit-min-device-pixel-ratio : 2) {
		/* Styles */
		canvas{
			width: 250px;
			height: 140px;
		}
	}
	/* Desktops and laptops ----------- */
	@media only screen  and (min-width : 1224px) {
		/* Styles */
		canvas{
			width: 400px;
        	height: 200px;
		}
	}

	/* Large screens ----------- */
	@media only screen  and (min-width : 1824px) {
		/* Styles */
		canvas{
			width: 400px;
        	height: 200px;
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

<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-primary" id="signature-pad">
				<div class="panel-heading">
					<h3 class="panel-title">Firma</h3>
					<div class="btn-group" role="group" aria-label="...">
						<button type="button" class="btn btn-default clear" data-action="clear">Limpiar</button>
						<button type="button" class="btn btn-default" data-action="undo">Deshacer</button>
					</div>
					<div class="btn-group" role="group" aria-label="...">
	                    <button type="button" class="btn btn-primary save" data-action="save-png">Finalizar</button>
					</div>
					<div class="panel-body">
						<div class="signature-pad">
		                    <div class="signature-pad--body">
		                      <canvas></canvas>
		                    </div>
		                </div>
					</div>
					<img src="{{ asset('uploads/img.png') }}" class="img-firma">
				</div>
			</div>			
		</div>
	</div>
</div>
@endsection