@extends('defaults/drake_lateral_navbar')


{{-- Web site Title --}}
@section('title')
Page A
@stop


<!-- breadcrumbs -->
@section('breadcrumbs')
	<ul class="breadcrumbs">
			<li><a href="{{ url('/') }}">Home</a> <span><i class="icon-right-open"></i></span></li>
			<li><a href="{{ url('admin/page_a') }}">Page A</a></li>
		</ul>
	
@stop
<!-- breadcrumbs -->


@section('content')
<div class="entry-content" itemprop="mainContentOfPage">
				<div class="section the_content"><div class="section_wrapper"><div class="the_content_wrapper"><p>The Drake Foundation was created in an effort to aid in participant safety across all contact sports. Based out of London, UK, our passionate team is highly focussed on the safety of all sports participants. Together we ensure that research is continued into sports-related concussion and that safety is improved for years to come.</p>
<hr />
<h4></h4>
<h4>James Drake, Chairman and Founder</h4>
<div style="margin-bottom: 100px;"  class="image_frame no_link scale-with-grid has_border alignleft notopmargin">
<div class="image_wrapper"><img class="scale-with-grid" title="James Drake, Chairman and Founder" src="http://www.drakefoundation.org/wp-content/uploads/2015/01/james-drake.jpg" alt="James Drake, Chairman and Founder" /></div>
</div>
<p>James Drake studied at the University of Leeds and received a BSc (Hons) in biochemistry. Upon completing his education, he began working at the BIBRA food toxicology research institute, was Commissioning Editor at Elsevier and Senior Editor at Academic Press. In the following years, he has held many highly respected positions throughout varying fields.</p>
<p>In 1987 James joined Current Drugs Ltd, where he developed the <em>Current Opinion</em> journals for pharmaceutical patents by extracting information from patent libraries and publishing these on a monthly basis in a range of medical areas, including neurology.</p>
<p>He continued to build up new ranges of peer-reviewed journals at Ashley Publications Ltd and Expert Reviews Ltd (which evaluates scientific research). In 2003 James set up and became Chairman of Future Medicine Ltd and Future Science Ltd, which encompass some of the most respected journals in medicine (including Nanomedicine, Regenerative Medicine, Pharmacogenomics, Bioanalysis and Epigenomics) and is pioneer in developing closed networks and digital platforms.</p>
<p>In 2014, James established The Drake Foundation, a not-for-profit company tackling the problem of concussion in sport head-on.</p>
<hr />
<h4>Peter Hughes, CEO</h4>
<div class="image_frame no_link scale-with-grid has_border alignleft notopmargin">
<div class="image_wrapper"><img class="scale-with-grid" title="Peter Hughes, CEO" src="http://www.drakefoundation.org/wp-content/uploads/2015/01/Peter-Hughes-DFO.jpg" alt="Peter Hughes, CEO" /></div>
</div>
<p>Peter Hughes graduated with an LLB (Hons) from the University of Bristol and subsequently qualified as a solicitor. On qualifying he became a partner of Corbould Rigby &amp; Co., which merged with Underwood &amp; Co. in 1998. He was managing partner of Underwood and Co. for 15 years until April 2014 combining the role with a busy case load for his clients.</p>
<p>Peter is a business lawyer who advises business clients from many different fields in relation to a wide range of commercial and corporate matters including business affairs, purchases and sales of companies and businesses, commercial leases and contracts. He has worked as an adviser to James Drake on many projects. Outside the office, Peter has a keen interest in any sport involving a ball, as well as in driving his classic Bristol car to distant places.</p>
<hr />
<h4>Velicia Bachtiar, Research Associate</h4>
<div class="image_frame no_link scale-with-grid has_border alignleft notopmargin">
<div class="image_wrapper"><img class="scale-with-grid" title="Velicia Bachtiar, Research Associate" src="http://www.drakefoundation.org/wp-content/uploads/2015/01/Velicia-Bachtiar.jpg" alt="Velicia Bachtiar, Research Associate" /></div>
</div>
<p>Velicia Bachtiar is a Research Associate at The Drake Foundation developing the concussion database. Velicia obtained a first class BSc (Hons) in Psychology from University College London before completing an MSc in Neuroscience and DPhil in Clinical Neuroscience at the University of Oxford. During her doctorate, Velicia used neuroimaging techniques to investigate how the brain changes with non-invasive brain stimulation. Outside the office, Velicia has a keen interest in sports and likes to spend her time rowing.</p>
</div></div></div>			</div>
@endsection