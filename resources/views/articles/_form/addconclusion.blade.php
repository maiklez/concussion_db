


<div id="addconclusion" class="modalDialog">
	<div>
		<a href="#close" title="Close" class="close">X</a>
		<h2>Add a Conclusion</h2>
		
		<!-- Conclusion -->
		{!! Form::open(array('url'=>'articles/'.$article->id.'/addconclusion','class'=>'ajax form-horizontal', 'method'=> 'POST')) !!}
		<!-- CSRF Token-->
		<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
		<!-- ./ csrf token -->

		<div class="form-group {{{ $errors->has('conclusion') ? 'error' : '' }}}">
            
                <label class="" for="conclusion">Conclusion</label>
				
					{!! 
					Form::textarea('conclusion', Input::old('conclusion', isset($conclusio) ? $conclusio->conclussion : null), 
		    													array('class'=>'form-control', 'placeholder'=>'Conclusion'))
					!!} 
				
				    {!! Form::submit('Add Conclusion', array('class'=>'btn btn-success','id'=>'mdl_save_change'))!!}
			
				{!! $errors->first('conclusion', '<span class="help-block">:message</span>') !!}
		</div>
		{!! Form::close() !!}
	</div>
</div>




{{-- Scripts --}}
@section('scripts')
	
@stop

{{-- styles --}}
@section('styles')
<style type="text/css">
.modalDialog {
	position: fixed;
	font-family: Arial, Helvetica, sans-serif;
	top: 0;
	right: 0;
	bottom: 0;
	left: 0;
	background: rgba(0,0,0,0.8);
	z-index: 99999;
	opacity:0;
	-webkit-transition: opacity 400ms ease-in;
	-moz-transition: opacity 400ms ease-in;
	transition: opacity 400ms ease-in;
	pointer-events: none;
}

.modalDialog:target {
	opacity:1;
	pointer-events: auto;
}

.modalDialog > div {
	width: 400px;
	position: relative;
	margin: 10% auto;
	padding: 5px 20px 13px 20px;
	border-radius: 10px;
	background: #fff;
	background: -moz-linear-gradient(#fff, #999);
	background: -webkit-linear-gradient(#fff, #999);
	background: -o-linear-gradient(#fff, #999);
}
.close {
	background: #606061;
	color: #FFFFFF;
	line-height: 25px;
	position: absolute;
	right: -12px;
	text-align: center;
	top: -10px;
	width: 24px;
	text-decoration: none;
	font-weight: bold;
	-webkit-border-radius: 12px;
	-moz-border-radius: 12px;
	border-radius: 12px;
	-moz-box-shadow: 1px 1px 3px #000;
	-webkit-box-shadow: 1px 1px 3px #000;
	box-shadow: 1px 1px 3px #000;
}

.close:hover { background: #00d9ff; }
</style>
@stop

{{-- datatables --}}
@section('datatables')

@stop