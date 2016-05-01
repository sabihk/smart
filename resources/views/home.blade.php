@extends('app')

@section('content')
<div class="container">
	@if($user_role === 1)
	<?php
		$count = 1;
		$options = array('User', 'Admin');
	?>
	<div class="row">
                <div class="col-md-12">
                        <!-- Display success / error message -->
                        @if(Session::has('success'))
                                <div class="alert alert-success">
                                        {{Session::get('success')}}
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                                                &times;
                                        </button>
                                </div>
                        @endif
                        @if(Session::has('error'))
                                <div class="alert alert-danger align-center">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                                                &times;
                                        </button>
                                        {{Session::get('error')}}
                                </div>
                        @endif
                </div>
        </div>
	<div class="row">
		<div class="col-md-6">
			<h3>User Details</h3>
		</div>
		<div class="col-md-6">
                        <!-- Show the message to user -->
			<div class="pull-right margin_top25">
				<span class="success"></span>
				<span class="error"></span>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<table class="table table-striped table-bordered" id="user_table">
				<thead>
					<tr>
						<th class="col-xs-1">
							Sl. No.
						</th>
						<th class="col-xs-3">
							Name
						</th>
						<th class="col-xs-3">
							Email
						</th>
						<th>
							User Role(H)
						</th>
						<th class="col-xs-2">
							User Role
						</th>
						<th class="col-xs-2">
							Actions
						</th>
					</tr>
				</thead>
				<tbody>
					@if(count($user_details) === 0)
					<tr>
						<td colspan="5" class="center">
							User details will be displayed here once user register!
						</td>
					</tr>
					@endif
					@foreach ($user_details as $user)
					<tr>
						<td>
							{{ $count }}<?php $count++; ?>
						</td>
						<td>
							{{ $user->first_name }} {{ $user->last_name }}
						</td>
						<td>
							{{ $user->email }}
						</td>
						<td>
							{{ (0 == $user->role) ? 'User' : 'Admin' }}
						</td>
						<td>
							<select class="form-control user_role"
							data-user_id="{{ $user->id }}" data-token="{{ csrf_token() }}">
							@foreach ($options as $key => $option)
								<option value='{{ $key }}'
									{{ ($key == $user->role) ? "selected" : "" }}
								>{{ $option }}</option>
							@endforeach
							</select>
						</td>
						<td>
							<button type="button" class="btn btn-primary btn-sm edit_user_details"
							data-user_id="{{ $user->id }}" data-token="{{ csrf_token() }}">
								Edit
							</button>
							<!-- Edit User Modal -->
							<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
								id="{{ $user->id }}_edit_user_details_modal">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
											<h4 class="modal-title" id="myModalLabel">Edit User Details</h4>
										</div>
										<div class="modal-body" id="{{ $user->id }}_edit_user_details_modal_body">

										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
											<button type="button" class="btn btn-primary save_user_details"
												data-user_id="{{ $user->id }}">
												Save changes
											</button>
										</div>
									</div>
								</div>
							</div>

							<button type="button" class="btn btn-danger btn-sm delete_user"
							data-user_id="{{ $user->id }}" data-token="{{ csrf_token() }}">
								Delete
							</button>
							<div class="indicator">
								<img src="{{ asset('/images/indicator.gif') }}" alt="Loading">
							</div>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
	@else
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Home</div>

				<div class="panel-body">
					You are logged in!
				</div>
			</div>
		</div>
	</div>
	@endif
</div>
@endsection
