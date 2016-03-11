@extends('admin')

@section('content')
	<section class="panel">
		<header class="panel-heading">Create New Curriculum</header>
		<div class="panel-body">
			<div class="validation-message"></div>
			<form class="form-horizontal tasi-form" id="create-curriculum-form">
				<div class="form-group">
					<label class="col-sm-2 col-sm-2 control-label">Course</label>
					<div class="col-sm-10">
						<select name="course" class="form-control" required>
							<option value=""><i>Select Course</i></option>
							@foreach( $courses as $course)
								<option value='{{ $course->course_guid }}'> {{ $course->name }} </option>
							@endForeach
						</select>
					</div>
				</div>
				<div id='major'></div>
				<div class="form-group">
					<label class="col-sm-2 col-sm-2 control-label">Effective SY</label>
					<div class="col-sm-4">
						<select name="effective-1" class="form-control" required>
							@for ($i = 2030; $i >= 1990; $i--)
								<option value='{{ $i }}'> {{ $i }} </option>
							@endFor
						</select>
					</div>
					<label class="col-sm-1 text-center"> - </label>
					<div class="col-sm-5">
						<select name="effective-2" class="form-control" required>
							@for ($i = 2030; $i >= 1990; $i--)
								<option value='{{ $i }}'> {{ $i }} </option>
							@endFor
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 col-sm-2 control-label">BOR Res No.</label>
					<div class="col-sm-10">
						<input type="text" name='bor_res' class="form-control" placeholder='Enter BOR Res Number' />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 col-sm-2 control-label">Years Will Take</label>
					<div class="col-sm-10">
						<select name="year" class="form-control" required>
							<option value="">Select Years</option>
							<option value="1">1 Year</option>
							<option value="2">2 Years</option>
							<option value="3">3 Years</option>
							<option value="4">4 Years</option>
							<option value="5">5 Years</option>
							<option value="6">6 Years</option>
							<option value="7">7 Years</option>
						</select>
					</div>
				</div>

				<div class="form-group text-center">
					<a href='/admin/curriculum' class="btn btn-md btn-danger">Cancel</a>
					<button type='submit' class="btn btn-md btn-primary">Save</button>
				</div>
			</form>
		</div>
	</section>
@stop

@section('script')
	<script type="text/javascript" src="{{ URL::asset('js/admin/create-curriculum.js') }}"></script>
@stop