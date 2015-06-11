<!-- Article title -->
		<div class="form-group {{{ $errors->has('article_title') ? 'error' : '' }}}">
		    <div class="col-md-5">
		    {!! Form::label('Article Title') !!}
		    {!! Form::text('article_title', Input::old('article_title', isset($article) ? $article->article_title : null), 
		    													array('class'=>'form-control', 'placeholder'=>'Name')) !!}
		    {!! $errors->first('article_title', '<span class="help-block">:message</span>') !!}
		    </div>
		</div>


		<!-- types -->
		<div class="form-group ">
		    <div class="col-md-5">
		{!! Form::label('Article Types') !!}
		{!!  FormCreator::typesForm(null, isset($article) ? $article->type : null) !!}
			</div>
		</div>

		<!-- classification -->
		<div class="form-group ">
		{!! Form::label('Classifications') !!}
		    <div class="col-md-4">		
				{!!  FormCreator::classificationForm(1, isset($article) ? $article->classification : null) !!}
			</div>
			<div class="col-md-4">		
				{!!  FormCreator::classificationForm(2, isset($article) ? $article->classification : null) !!}
			</div>
			<div class="col-md-3">		
				{!!  FormCreator::classificationForm(3, isset($article) ? $article->classification : null) !!}
			</div>
		</div>

		<!-- journal title -->
		<div class="form-group {{{ $errors->has('journal_title') ? 'error' : '' }}}">
		    <div class="col-md-5">
		    {!! Form::label('Journal Title') !!}
		    {!! Form::text('journal_title', Input::old('journal_title', isset($article) ? $article->journal_title : null), 
		    													array('class'=>'form-control', 'placeholder'=>'Name')) !!}
		    {!! $errors->first('journal_title', '<span class="help-block">:message</span>') !!}
		    </div>
		</div>

		<!-- key finding -->
		<div class="form-group {{{ $errors->has('key_finding') ? 'error' : '' }}}">
		    <div class="col-md-5">
		    {!! Form::label('Key Finding') !!}
		    {!! Form::text('key_finding', Input::old('key_finding', isset($article) ? $article->key_finding : null), 
		    													array('class'=>'form-control', 'placeholder'=>'Name')) !!}
		    {!! $errors->first('key_finding', '<span class="help-block">:message</span>') !!}
		    </div>
		</div>

<!-- Author -->
		<div class="form-group {{{ $errors->has('author') ? 'error' : '' }}}">
            <div class="col-md-5">
                <label class="" for="author">Author</label>
				<div class="col-md-7"> 
					{!! 
					Form::select('author', 
					array(null => 'Please select one option') + Helper::getAuthorList(),
					Input::old('author', isset($author) ? $author->id : null), 
					array('class'=>'form-control','style'=>''))
					!!} 

					{!! $errors->first('author', '<span class="help-block">:message</span>') !!}
				</div>
				<div class="col-md-1"> 
					<a href="{{ url('authors/create') }}" class="btn btn-success">New Author</a>
				</div>
			</div>
			
		</div>

		<!-- Year -->
		<div class="form-group {{{ $errors->has('year') ? 'error' : '' }}}">
		                <div class="col-md-5">

		    {!! Form::label('Year') !!}
		    {!! Form::text('year', Input::old('year', isset($article) ? $article->year : null), 
		    													array('class'=>'form-control', 'placeholder'=>'Year')) !!}
		    {!! $errors->first('year', '<span class="help-block">:message</span>') !!}
						</div>
		</div>

		<!-- Volume -->
		<div class="form-group {{{ $errors->has('volume') ? 'error' : '' }}}">
		                <div class="col-md-5">

		    {!! Form::label('Volume') !!}
		    {!! Form::text('volume', Input::old('volume', isset($article) ? $article->volume : null), 
		    													array('class'=>'form-control', 'placeholder'=>'Volume')) !!}
		    {!! $errors->first('volume', '<span class="help-block">:message</span>') !!}
						</div>
		</div>

		<!-- Issue -->
		<div class="form-group {{{ $errors->has('issue') ? 'error' : '' }}}">
		                <div class="col-md-5">

		    {!! Form::label('Issue') !!}
		    {!! Form::text('issue', Input::old('issue', isset($article) ? $article->issue : null), 
		    													array('class'=>'form-control', 'placeholder'=>'Issue')) !!}
		    {!! $errors->first('issue', '<span class="help-block">:message</span>') !!}
						</div>
		</div>

		<!-- Page Range -->
		<div class="form-group {{{ ($errors->has('page_range_min')||$errors->has('page_range_max') ) ? 'error' : '' }}}">
		                <div class="col-md-5">

		    {!! Form::label('Page Range') !!}
		    {!! Form::text('page_range_min', Input::old('page_range_min', isset($article) ? $article->page_range_min : null), 
		    													array('class'=>'form-control', 'placeholder'=>'Min')) !!}
		    {!! $errors->first('page_range_min', '<span class="help-block">:message</span>') !!}

		    {!! Form::text('page_range_max', Input::old('page_range_max', isset($article) ? $article->page_range_max : null), 
		    													array('class'=>'form-control', 'placeholder'=>'Max')) !!}
		    {!! $errors->first('page_range_max', '<span class="help-block">:message</span>') !!}
						</div>
		</div>

		<!-- _____________________________________________________________________ -->

		<!-- doi number -->
		<div class="form-group {{{ $errors->has('doi_number') ? 'error' : '' }}}">
		                <div class="col-md-5">

		    {!! Form::label('Doi Number') !!}
		    {!! Form::text('doi_number', Input::old('doi_number', isset($article) ? $article->doi_number : null), 
		    													array('class'=>'form-control', 'placeholder'=>'Name')) !!}
		    {!! $errors->first('doi_number', '<span class="help-block">:message</span>') !!}
						</div>
		</div>


		<!-- ref_link -->
		<div class="form-group {{{ $errors->has('ref_link') ? 'error' : '' }}}">
		                <div class="col-md-5">
		    {!! Form::label('Cross Ref Link') !!}
		    {!! Form::text('ref_link', Input::old('ref_link', isset($article) ? $article->crossref_link : null), 
		    													array('class'=>'form-control', 'placeholder'=>'Name')) !!}
		    {!! $errors->first('ref_link', '<span class="help-block">:message</span>') !!}
		    			</div>
		</div>


		{!! FormCreator::populationForm( $errors, isset($article) ? $article : null )!!}


		<!-- Gender -->
		<div class="form-group {{{ $errors->has('gender') ? 'error' : '' }}}">
            <div class="col-md-5">
                <label class="" for="gender">Gender</label>
					{!! 
					Form::select('gender', 
					array(null => 'Please select one option') + Helper::getGenderList(),
					Input::old('gender', isset($population) ? $population->gender_id : null), 
					array('class'=>'form-control','style'=>'')) 
					!!}				
				
				{!! $errors->first('gender', '<span class="help-block">:message</span>') !!}

			</div>			
		</div>

<!-- Design -->
		<div class="form-group  {{{ $errors->has('design')||$errors->has('summary') ? 'error' : '' }}}">
		
		    <div class="col-md-5">

		    {!! Form::label('Design') !!}
		    {!! Form::textarea('design', Input::old('design', isset($article) ? $article->design : null), 
		    													array('class'=>'form-control', 'placeholder'=>'Design')) !!}
		    {!! $errors->first('design', '<span class="help-block">:message</span>') !!}

		   	</div>


			<div class="col-md-5">
		<!-- DF Summary -->
		    {!! Form::label('DF Summary') !!}
		    {!! Form::textarea('summary', Input::old('summary', isset($article) ? $article->summary : null), 
		    													array('class'=>'form-control', 'placeholder'=>'DF Summary')) !!}
		    {!! $errors->first('summary', '<span class="help-block">:message</span>') !!}
			</div>
		</div>


		
		             


{{-- Scripts --}}
@section('scripts')
	
	<script type="text/javascript">
		var selectedBox = null;
		$(document).ready(function() {

		    $(".population_type").click(function() {
		        selectedBox = this.name;
		        value = this.checked;
		        $(".population_type").each(function() {
		            if ( this.name == selectedBox )
		            {
		                this.checked = value;
		            }
		            else
		            {
		                this.checked = false;
		            };        
		        });

		        var category = null;
		        if(this.checked){
		        	category = this.value;
		        }
		        //var category = this.value;//$("input[name='population_class']:checked").val();
	            var parametros = {
            		"population_type" : category
       			};
	            $.ajax({
			        data: parametros,
			        url: '{!! url('')!!}/lists/get_subpopulation_type'
			    }).done(function(subcategories) {
			        // subcategories is json, loop over it and populate the subcategory select

			        $("#type_class").html(subcategories);
			    });	
		    });

		    $(".population_class").click(function() {
		        selectedBox = this.name;
		        value = this.checked;
		        $(".population_class").each(function() {
		            if ( this.name == selectedBox )
		            {
		                this.checked = value;
		            }
		            else
		            {
		                this.checked = false;
		            };        
		        });

		        var category = null;
		        if(this.checked){
		        	category = this.value;
		        }
		        //var category = this.value;//$("input[name='population_class']:checked").val();
	            var parametros = {
            		"population_class" : category
       			};
	            $.ajax({
			        data: parametros,
			        url: '{!! url('')!!}/lists/get_subpopulation_class'
			    }).done(function(subcategories) {
			        // subcategories is json, loop over it and populate the subcategory select

			        $("#class_class").html(subcategories);
			    });	
		    });
		    
		});

	</script>

@stop