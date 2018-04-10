@extends('base')

@section('css')

<style type="text/css" media="screen">
	canvas{
		width: 100%;
		height: 400px;
        border: 2px solid red;
        border-radius: 4px;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.02) inset;
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
						<button type="button" class="btn btn-default clear" data-action="clear">Clear</button>
						<button type="button" class="btn btn-default" data-action="change-color">Change color</button>
						<button type="button" class="btn btn-default" data-action="undo">Undo</button>
					</div>
					<div class="btn-group" role="group" aria-label="...">
	                    <button type="button" class="btn btn-default save" data-action="save-png">Save as PNG</button>
	                    <button type="button" class="btn btn-default save" data-action="save-jpg">Save as JPG</button>
	                    <button type="button" class="btn btn-default save" data-action="save-svg">Save as SVG</button>
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