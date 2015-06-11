
 		<a href="{!!URL::to('articles/'.$article->id.'/inreply/select_article')!!}" class="btn btn-success iframe">Select Article Parent</a>
 		<br>
 		{!! FormCreator::inReplyAuthorsForm($article, $inreplyAuthors) !!}



 		<!-- Year -->
        <div class="form-group {{{ $errors->has('year') ? 'error' : '' }}}">
                        <div class="col-md-5">

            {!! Form::label('Year') !!}
            {!! Form::text('year', Input::old('year', isset($inreply) ? $inreply->year : null), 
                                                                array('class'=>'form-control', 'placeholder'=>'Year')) !!}
            {!! $errors->first('year', '<span class="help-block">:message</span>') !!}
                        </div>
        </div>

        <!-- Volume -->
        <div class="form-group {{{ $errors->has('volume') ? 'error' : '' }}}">
                        <div class="col-md-5">

            {!! Form::label('Volume') !!}
            {!! Form::text('volume', Input::old('volume', isset($inreply) ? $inreply->volume : null), 
                                                                array('class'=>'form-control', 'placeholder'=>'Volume')) !!}
            {!! $errors->first('volume', '<span class="help-block">:message</span>') !!}
                        </div>
        </div>

        <!-- Issue -->
        <div class="form-group {{{ $errors->has('issue') ? 'error' : '' }}}">
                        <div class="col-md-5">

            {!! Form::label('Issue') !!}
            {!! Form::text('issue', Input::old('issue', isset($inreply) ? $inreply->issue : null), 
                                                                array('class'=>'form-control', 'placeholder'=>'Issue')) !!}
            {!! $errors->first('issue', '<span class="help-block">:message</span>') !!}
                        </div>
        </div>

        <!-- Page Range -->
        <div class="form-group {{{ ($errors->has('page_range_min')||$errors->has('page_range_max') ) ? 'error' : '' }}}">
                        <div class="col-md-5">

            {!! Form::label('Page Range') !!}
            {!! Form::text('page_range_min', Input::old('page_range_min', isset($inreply) ? $inreply->page_range_min : null), 
                                                                array('class'=>'form-control', 'placeholder'=>'Min')) !!}
            {!! $errors->first('page_range_min', '<span class="help-block">:message</span>') !!}

            {!! Form::text('page_range_max', Input::old('page_range_max', isset($inreply) ? $inreply->page_range_max : null), 
                                                                array('class'=>'form-control', 'placeholder'=>'Max')) !!}
            {!! $errors->first('page_range_max', '<span class="help-block">:message</span>') !!}
                        </div>
        </div>

        <!-- _____________________________________________________________________ -->

        <!-- doi number -->
        <div class="form-group {{{ $errors->has('doi_number') ? 'error' : '' }}}">
                        <div class="col-md-5">

            {!! Form::label('Doi Number') !!}
            {!! Form::text('doi_number', Input::old('doi_number', isset($inreply) ? $inreply->doi_number : null), 
                                                                array('class'=>'form-control', 'placeholder'=>'Name')) !!}
            {!! $errors->first('doi_number', '<span class="help-block">:message</span>') !!}
                        </div>
        </div>

        

            <!-- classification -->
            <div class="form-group ">
            {!! Form::label('Classifications') !!}
                <div class="col-md-3">      
                    {!!  FormCreator::classificationForm(1, isset($inreply) ? $inreply->classification : null) !!}
                </div>
                <div class="col-md-3">      
                    {!!  FormCreator::classificationForm(2, isset($inreply) ? $inreply->classification : null) !!}
                </div>
                <div class="col-md-3">      
                    {!!  FormCreator::classificationForm(3, isset($inreply) ? $inreply->classification : null) !!}
                </div>
            </div>


		
		             


{{-- Scripts --}}
@section('scripts')
	
	

@stop