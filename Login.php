
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

<body style="background: aquamarine">
 <div class="content">
     <h2>Login</h2>
     <form id='login_form' class="wrapper_border container">
         <div class='form-group'>
             <label for='email'>Email address</label>
             <input type='email' class='form-control' id='email' name='email' placeholder='Enter email'>
         </div>

         <div class='form-group'>
             <label for='password'>Password</label>
             <input type='password' class='form-control' id='password' name='password' placeholder='Password'>
         </div>
        <div class="col-md-12 text-center">
          <button type='submit' class='btn btn-primary align-self-end' style="margin-bottom: 15px;
          width: 30%;
          border-radius: 8px">Login</button>
        </div>
     </form>
 </div>
</body>
 <script>
     $(document).on('submit', '#login_form', function() {
         document.write("Harish");
         let form = $(this);
         let form_data;
         form_data = JSON.stringify(form.serializeObject());
         document.write(form_data);
         $.ajax({
             url: "json_login.php",
             type : "POST",
             contentType : 'application/json',
             data : form_data,
             success : function(result){
                 // store jwt to cookie
                window.location.href="signup_form.php";
                 // show home page & tell the user it was a successful login
                 document.write(form_data);
                 $('#response').html("<div class='alert alert-success'>Successful login.</div>");

             },
             // error response will be here
             error: function(xhr, resp, text){
                 // on error, tell the user login has failed & empty the input boxes
                 $('#response').html("<div class='alert alert-danger'>Login failed. Email or password is incorrect.</div>");
                 form.find('input').val('');
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
</html>
