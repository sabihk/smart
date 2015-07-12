<div class="row">
        <div class="col-md-12">
                <form class="form-horizontal" method="POST" action="{{ url('/update-user-details') }}"
                        id="{{$user_details->id}}_edit_user_details_form">

                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="user_id" value="{{$user_details->id}}">

                        <div class="form-group">
                                <label for="{{$user_details->id}}_first_name" class="col-md-4 control-label">
                                        <span class="required">*</span>First Name
                                </label>
                                <div class="col-md-6">
                                        <input type="text" class="form-control input-sm" name="first_name"
                                                value="{{$user_details->first_name}}" id="{{$user_details->id}}_first_name">
                                </div>
                        </div>

                        <div class="form-group">
                                <label for="{{$user_details->id}}_last_name" class="col-md-4 control-label">
                                        <span class="required">*</span>Last Name
                                </label>
                                <div class="col-md-6">
                                        <input type="text" class="form-control input-sm" name="last_name"
                                                value="{{$user_details->last_name}}" id="{{$user_details->id}}_last_name">
                                </div>
                        </div>

                        <div class="form-group">
                                <label for="{{$user_details->id}}_email" class="col-md-4 control-label">
                                        <span class="required">*</span>Email
                                </label>
                                <div class="col-md-6">
                                        <input type="email" class="form-control input-sm" name="email"
                                                value="{{$user_details->email}}" id="{{$user_details->id}}_email">
                                        <div id="{{$user_details->id}}_email_error" class="text-danger"></div>
                                </div>
                        </div>

                        <div class="form-group">
                                <label for="{{$user_details->id}}_birthday" class="col-md-4 control-label">
                                        <span class="required">*</span>Birthday
                                </label>
                                <div class="col-md-6">
                                        <input type="text" class="form-control input-sm cursor" name="birthday"
                                        readonly value="{{date("d-m-Y", strtotime($user_details->birthday))}}"
                                        id="{{$user_details->id}}_birthday" data-date-format="dd-mm-yyyy">
                                </div>
                        </div>

                        <div class="form-group">
                                <label for="{{$user_details->id}}_phone_number" class="col-md-4 control-label">
                                        <span class="required">*</span>Phone number
                                </label>
                                <div class="col-md-6">
                                        <input type="text" class="form-control input-sm" name="phone_number" maxlength="20"
                                                value="{{$user_details->phone_number}}" id="{{$user_details->id}}_phone_number">
                                        <div id="{{$user_details->id}}_phone_number_error" class="text-danger"></div>
                                </div>
                        </div>
                </form>
        </div>
</div>