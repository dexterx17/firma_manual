@extends('base')

@section('css')
    <style type="text/css">
            
        .signature-pad {
          position: relative;
          display: -webkit-box;
          display: -ms-flexbox;
          display: flex;
          -webkit-box-orient: vertical;
          -webkit-box-direction: normal;
              -ms-flex-direction: column;
                  flex-direction: column;
          font-size: 10px;
          width: 100%;
          height: 100%;
          max-width: 700px;
          max-height: 460px;
          border: 1px solid #e8e8e8;
          background-color: #fff;
          box-shadow: 0 1px 4px rgba(0, 0, 0, 0.27), 0 0 40px rgba(0, 0, 0, 0.08) inset;
          border-radius: 4px;
          padding: 16px;
        }

        .signature-pad::before,
        .signature-pad::after {
          position: absolute;
          z-index: -1;
          content: "";
          width: 40%;
          height: 10px;
          bottom: 10px;
          background: transparent;
          box-shadow: 0 8px 12px rgba(0, 0, 0, 0.4);
        }

        .signature-pad::before {
          left: 20px;
          -webkit-transform: skew(-3deg) rotate(-3deg);
                  transform: skew(-3deg) rotate(-3deg);
        }

        .signature-pad::after {
          right: 20px;
          -webkit-transform: skew(3deg) rotate(3deg);
                  transform: skew(3deg) rotate(3deg);
        }

        .signature-pad--body {
          position: relative;
          -webkit-box-flex: 1;
              -ms-flex: 1;
                  flex: 1;
          border: 1px solid #f4f4f4;
        }

        .signature-pad--body
        canvas {
          position: absolute;
          left: 0;
          top: 80px;
          width: 900px;
          height: 400px;
          border: 2px solid red;
          border-radius: 4px;
          box-shadow: 0 0 5px rgba(0, 0, 0, 0.02) inset;
        }

        .signature-pad--footer {
          color: #C3C3C3;
          text-align: center;
          font-size: 1.2em;
          margin-top: 8px;
        }

        .signature-pad--actions {
          display: -webkit-box;
          display: -ms-flexbox;
          display: flex;
          -webkit-box-pack: justify;
              -ms-flex-pack: justify;
                  justify-content: space-between;
          margin-top: 8px;
        }
    </style>

@endsection

@section('content')        
        <div class="flex-center position-ref full-height">
            
            <div class="content">
                <div class="title m-b-md">
                    Firma manual
                </div>
                  <div id="signature-pad" class="signature-pad">
                    <div class="signature-pad--body">
                      <canvas></canvas>
                    </div>
                    <div class="signature-pad--footer">
                      <div class="description">Sign above</div>

                      <div class="signature-pad--actions">
                        <div>
                          <button type="button" class="button clear" data-action="clear">Clear</button>
                          <button type="button" class="button" data-action="change-color">Change color</button>
                          <button type="button" class="button" data-action="undo">Undo</button>

                        </div>
                        <div>
                          <button type="button" class="button save" data-action="save-png">Save as PNG</button>
                          <button type="button" class="button save" data-action="save-jpg">Save as JPG</button>
                          <button type="button" class="button save" data-action="save-svg">Save as SVG</button>
                        </div>
                      </div>
                    </div>
                  </div>
            </div>

        </div>
@endsection