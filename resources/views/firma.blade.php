@extends('base')

@section('css')
<style type="text/css" media="screen">
	canvas{
		border: 2px solid red;
        border-radius: 4px;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.02) inset;
        width: 900px;
        height: 400px;
	}
	@media (max-width: 380px){
		canvas {
			width: 250px;
			height: 300px;
		}
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
				</div>
			</div>			
		</div>
	</div>
</div>
@endsection