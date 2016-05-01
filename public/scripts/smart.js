var email_regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
var phone_regex = /\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/;

// This code runs when DOM is "ready"
$(document).ready(function(){

        // Display datepicker for birthday while registering user
        $('.datepicker').datepicker();

        // Add DataTable for user details
        $('table#user_table').DataTable({
                "aoColumnDefs": [
                        {
                                // Hiding 3rd column
                                "bVisible": false,      // 3rd column is hidden
                                "aTargets": [3]
                        },
                        {
                                // Select column (4th column)
                                "iDataSort": 3,         // Sorting will be done on the basis of 3rd column
                                'bSearchable': false,   // Searching is disabled on this column
                                'aTargets': [4]
                        },
                        {
                                // Edit/Delete (5th column)
                                "iDataSort": false,     // Sorting is disabled
                                'bSearchable': false,   // Search is disabled
                                'aTargets': [5]
                        },
                ]
        });

        // Change user role
        $('.user_role').change(function(){
                $(".success").html("");
                $(".error").html("");

                // Show indicator
                var indicator = $(this).parent().next().find('.indicator');
                indicator.show();

                var user_id = $(this).data('user_id');
                var token = $(this).data('token');
                var user_role = $(this).val();

                $.ajax({
                        url : base + '/user-role',
                        type : 'POST',
                        data : {
                                user_id: user_id,
                                role: user_role,
                                _token: token
                        },
                        success: function(response) {
                                // Hide indicator and display message.
                                indicator.hide();
                                if (response == 1) {
                                        $(".success").html("User role changed successfully.");
                                } else {
                                        $(".error").html("Error occurred while updating role. Please try again.");
                                }
                        },
                        error: function(response) {
                                // Hide indicator and display error message.
                                indicator.hide();
                                $(".error").html("Error occurred. Please try again.");
                        }

                });
        });

        // Display modal with User details
        $('.edit_user_details').click(function() {
		var user_id = $(this).data('user_id');

		$.ajax({
			url: base + '/edit-user',
			type: "GET",
			data: {
                                user_id: user_id
                        },
			dataType: "html",
			success: function(data) {
				$('#' + user_id + '_edit_user_details_modal_body').html(data);
                                $('#' + user_id+ '_birthday').datepicker();
				$('#' + user_id + '_edit_user_details_modal').modal();
			}
		});
	});

        // Validation for Registration form
        $('.btn_register_user').click(function() {
                var flag = 1;

                var phone_number = new validateElementRegex(
                        '[name="phone_number"]', "#phone_number_error", "Please provide a valid phone number", phone_regex
                );
                var birthday = new validateElement('[name="birthday"]');
                var password_confirmation = new validateElement('[name="password_confirmation"]');
                var password = new validateElement('[name="password"]');
                var email = new validateElementRegex(
                        '[name="email"]', "#email_error", "Please provide a valid email", email_regex
                );

                var last_name = new validateElement('[name="last_name"]');
                var first_name = new validateElement('[name="first_name"]');

                if(
                        first_name.empty_flag === 0 ||
                        last_name.empty_flag === 0 ||
                        email.empty_flag === 0 ||
                        password.empty_flag === 0 ||
                        password_confirmation.empty_flag === 0 ||
                        birthday.empty_flag === 0 ||
                        phone_number.empty_flag === 0
                ) {

                        flag = 0;

                }

                if (flag === 1) {

                        $("form#register_user_form").submit();
                }
        });

        // Validate user details and save while Editing
        $('.save_user_details').click(function() {
                var flag = 1;
                var user_id = $(this).data('user_id');

                var phone_number = new validateElementRegex(
                        "#" + user_id +"_phone_number", "#" + user_id +"_phone_number_error", "Please provide a valid phone number", phone_regex
                );
                var birthday = new validateElement("#" + user_id +"_birthday");
                var email = new validateElementRegex(
                        "#" + user_id +"_email", "#" + user_id +"_email_error", "Please provide a valid email", email_regex
                );
                var last_name = new validateElement("#" + user_id +"_last_name");
                var first_name = new validateElement("#" + user_id +"_first_name");

                if(
                        first_name.empty_flag === 0 ||
                        last_name.empty_flag === 0 ||
                        email.empty_flag === 0 ||
                        birthday.empty_flag === 0 ||
                        phone_number.empty_flag === 0
                ) {

                        flag = 0;

                }

                if (flag === 1) {

                        // Check duplicate email
                        var email_id = $("#" + user_id +"_email").val();

                        // If no duplicate email, then save user details
                        $.ajax({
                                url: base + '/duplicate-email',
                                type: "GET",
                                data: {
                                        email: email_id,
                                        user_id: user_id
                                },
                                success: function(response) {
                                        if (response == 0) {
                                                $("form#" + user_id +"_edit_user_details_form").submit();
                                        } else {
                                                $("#" + user_id +"_email").focus();
                                                $("#" + user_id +"_email").addClass("txt_error");
                                                $("#" + user_id +"_email_error").css("display", "block");
                                                $("#" + user_id +"_email_error").html("Email already exist! Try something else.");
                                        }
                                }
                        });
                }

        });

        // Delete User
        $('.delete_user').click(function() {
                $(".success").html("");
                $(".error").html("");

                // Show indicator
                var indicator = $(this).parent().find('.indicator');
                indicator.show();

                var user_id = $(this).data('user_id');
                var token = $(this).data('token');
                var element = $(this);

                $.ajax({
                        url: base + '/delete-user',
                        type: "POST",
                        data: {
                                user_id: user_id,
                                _token: token
                        },
                        success: function(response) {
                                // Hide indicator and display message.
                                indicator.hide();
                                if (response == 1) {
                                        $(".success").html("User deleted successfully.");
                                        element.closest('tr').hide('slow');
                                } else {
                                        $(".error").html("Error occurred while deleting user. Please try again.");
                                }
                        },
                        error: function(response) {
                                // Hide indicator and display error message.
                                indicator.hide();
                                $(".error").html("Error occurred. Please try again.");
                        }
                });
        });
});

/**
 * The object contructor function
 * sets empty_flag to '0', if element value is empty / doesn't match regex.
 *
 * @param  string  element
 * @param  string  error_element
 * @param  string  error_msg
 * @param  string  regex
 * @return void
 */
function validateElementRegex(element, error_element, error_msg, regex) {

        this.empty_flag = 1;

        $(error_element).css("display", "none");
        $(error_element).html("");

	// element validation
	if($(element).val() === "") {

		$(element).focus();
                $(element).addClass("txt_error");
		this.empty_flag = 0;

	} else if(!regex.test($(element).val())) {

                $(element).focus();
                $(element).addClass("txt_error");
		$(error_element).css("display", "block");
		$(error_element).html(error_msg);
		this.empty_flag = 0;

        } else {

                $(element).removeClass("txt_error");

	}
}

/**
 * The object contructor function
 * sets empty_flag to '0', if element value is empty.
 *
 * @param  string  element
 * @return void
 */
function validateElement(element) {

        this.empty_flag = 1;

        // element validation
        if($(element).val() === "") {
                // Remove focus from datepicker to avoid opening of datepanel
                if (!$(element).hasClass('datepicker')) {
                        $(element).focus();
                }

                $(element).addClass("txt_error");
                this.empty_flag = 0;

        } else {

                $(element).removeClass("txt_error");

        }

}