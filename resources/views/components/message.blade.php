<div class="container-fuild">
	<div class="row">
		@if(session()->has('message'))
			<div class="col-md-12 mt-3 px-3"><div class="alert calltimer alert-success">{{ session()->get('message') }}</div></div>
		@endif
		@if(session()->has('error'))
			<div class="col-md-12 mt-3 px-3"><div class="alert calltimer alert-danger">{{ session()->get('error') }}</div></div>
		@endif
		@if ($errors->any())
		@foreach ($errors->all() as $error)
			<div class="col-md-12 mt-3 px-3"><div class="alert calltimer alert-danger">{{ $error }}</div></div>
		@endforeach
		@endif
	</div>
</div>
