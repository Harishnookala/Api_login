
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="styles.css">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" />
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>

<body>
<div class="content">
<h2>Sign Up</h2>
<form id='sign_up_form' class="wrapper_border container">
    <div class="container">
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" name="Username" id="username" required />
    </div>

    <div class="form-group">
        <label for="Phonenumber">Phonenumber</label>
        <input type="text" class="form-control" name="phonenumber" id="phonenumber" required />
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" name="email" id="email" required />
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="password" id="password" required />
    </div>
    <div class="col-md-12 text-center">
    <button type='submit ' class='btn btn-info' id = "signup_button"
    style="width: 75%">Sign Up</button>
    </div>
</form>
</div>
</div>
 <script>
     $(document).on('submit', '#sign_up_form', function() {
       let register = $(this);
         let form_data=JSON.stringify(register.serializeObject());
        ///document.write(form_data);
         $.ajax({
             url: 'register.php',
             type : "POST",
             contentType : 'application/json',
             data : form_data,
             success: function () {
                 // if response is a success, tell the user it was a successful sign up & empty the input boxes
                 $('#response').html("<div class='alert alert-success'>Successful sign up. Please login.</div>");
                 register.find('input').val('');
                 let success = true;
             },
             error: function(xhr, resp, text){
                 // on error, tell the user sign up failed
                 $('#response').html("<div class='alert alert-danger'>Unable to sign up. Please contact admin.</div>");
             }
         });
         return false;
     });
     $.fn.serializeObject = function(){
         let o = {};
         let a = this.serializeArray();
         $.each(a, function() {
             if (o[this.name] !== undefined) {
                 if (!o[this.name].push) {
                     o[this.name] = [o[this.name]];
                 }
                 o[this.name].push(this.value || '');
             } else {
                 o[this.name] = this.value || '';
             }
         });
         return o;
     };
 </script>
</body>