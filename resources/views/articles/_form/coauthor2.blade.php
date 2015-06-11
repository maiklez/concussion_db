
<div class="form-group ">
        <div class="col-md-8">
			<input type="button" onclick="addInput()" name="add" value="Add input field" />
			    
			<div id="text">
			</div>
		</div>
</div>

{{-- Scripts --}}
@section('scripts')
@parent
	<script>
	
fields = 0;
function addInput() {
if (fields != 10) {
document.getElementById('text').innerHTML += "<input id='mylist[]' name='mylist[]' class='form-control' type='text' value='' /><br />";
fields += 1;
} else {
document.getElementById('text').innerHTML += "<br />Only 10 upload fields allowed.";
document.form.add.disabled=true;
}
}


	</script>

@stop