

</div>
<!-- Latest compiled JavaScript -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script type="text/javascript" src="{{url('court-design/assets/js/custom2.js')}}"></script>
<script type="text/javascript" src="{{url('court-design/assets/js/html2canvas.min.js')}}"></script>
<script src="{{url('court-design/js/lightbox.js')}}"></script>

<script>
    function toggleColorSection() {
        // Get the radio button elements
        const puCheckbox = document.getElementById("pu-colors-checkbox");
        const acrylicCheckbox = document.getElementById("acrylic-colors-checkbox");

        // Hide both PU and Acrylic sections (surface and border)
        document.getElementById("pu-surface-colors").style.display = 'none';
        document.getElementById("pu-border-colors").style.display = 'none';
        document.getElementById("acrylic-surface-colors").style.display = 'none';
        document.getElementById("acrylic-border-colors").style.display = 'none';

        // Show the corresponding sections based on the checked radio button
        if (puCheckbox.checked) {
            document.getElementById("pu-surface-colors").style.display = 'flex';
            document.getElementById("pu-border-colors").style.display = 'flex';
        } 
        if (acrylicCheckbox.checked) {
            document.getElementById("acrylic-surface-colors").style.display = 'flex';
            document.getElementById("acrylic-border-colors").style.display = 'flex';
        }
    }
</script>
        
<script>
    // Trigger the modal when the download button is clicked
    $("#download").on('click', function () {
        $("#downloadModal").modal('show');
    });
    $("#downloadModal").on("shown.bs.modal", function() {
        $(this).attr("aria-hidden", "false");
    });

    $("#confirm-download").on('click', function () {
    // Collect input values
    var userName = $("#userName").val().trim();
    var userEmail = $("#userEmail").val().trim();
    var userPhone = $("#userPhone").val().trim();
    var userRequirement = $("#userRequirement").val().trim();
    var userCity = $("#userCity").val().trim();
    var userMessage = $("#userMessage").val().trim();
    var userCourt = $("#userCourt").val();

    // Clear previous error messages
    $(".error-message").remove();

    // Define error flag
    let hasError = false;

    // Simple validation checks for each field
    if (userName === "") {
        $("#userName").after('<span class="error-message" style="color: red;">Name is required.</span>');
        hasError = true;
    }
    if (!/^\S+@\S+\.\S+$/.test(userEmail)) {
        $("#userEmail").after('<span class="error-message" style="color: red;">Enter a valid email.</span>');
        hasError = true;
    }
    if (!/^\d{10,12}$/.test(userPhone)) {
        $("#userPhone").after('<span class="error-message" style="color: red;">Enter a valid phone number (10-12 digits).</span>');
        hasError = true;
    }
    if (userCity === "") {
        $("#userCity").after('<span class="error-message" style="color: red;">City is required.</span>');
        hasError = true;
    }
    if (userRequirement === "") {
        $("#userRequirement").after('<span class="error-message" style="color: red;">Requirement is required.</span>');
        hasError = true;
    }
    if (userMessage === "") {
        $("#userMessage").after('<span class="error-message" style="color: red;">Message is required.</span>');
        hasError = true;
    }

    // If there's any error, stop further processing
    if (hasError) return;

    // Proceed with AJAX submission if all fields are valid
    $.ajax({
        url: '/design-court/download-court',
        method: 'POST',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            name: userName,
            email: userEmail,
            phone: userPhone,
            requirement: userRequirement,
            city: userCity,
            message: userMessage,
            court: userCourt
        },
        success: function(response) {
            if (response.success) {
                $('#watermark').text(`Name: ${userName}, City: ${userCity}`).show();
                html2canvas($("#main_div")[0]).then(function(canvas) {
                    var imgageData = canvas.toDataURL("image/png");
                    var newData = imgageData.replace(/^data:image\/png/, "data:application/octet-stream");
                    $("#btn-Convert-Html2Image")
                        .attr("download", "custom_image.png")
                        .attr("href", newData)[0].click();

                    $("#downloadModal").modal('hide');
                    $('#userDetailsForm')[0].reset();
                    $('#watermark').hide();
                });
            } else {
                alert("Failed to save data. Please try again.");
            }
        },
        error: function() {
            alert("An error occurred while saving data.");
        }
    });
});
</script>  
@stack('script')

</body>
</html>