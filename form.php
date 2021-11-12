<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Multiple Email with PHPMailer</title>
    <link rel="stylesheet" href="./includes/css/style.css">
</head>
<body>
    <div class="content-container">
        <div class="lesson-title">
            <h2>BulkSys<br>Marketing on the Go</h2>
        </div>

        <!-- LIST OF USERS -->
        <div class="user-list-container">
            <div class="lists-of-users">
                <div class="list-header">
                    <h3>Previously Imported Data</h3>
                </div>
                <?php 
                    require('./functions.php');

                    $conn = dbConnection();

                    $fetch_users_sql = "SELECT * FROM recipients";
                    $fetch_result = mysqli_query($conn, $fetch_users_sql);

                    while ($user = mysqli_fetch_assoc($fetch_result)) { ?>

                        <div class="user-details-container">
                            <div class="username"><?php echo $user['name']; ?></div>
                            <div class="userEmail"><?php echo $user['email']; ?></div>
                        </div>
                <?php } ?>
            </div>
        </div>

        <!-- MESSAGE CONTAINER -->
        <div class="message-container">
            <div class="message-inner-container">
                <div class="message-container-title">
                    <h3>Send Message to Users</h3>
                </div>
                <form id="message-form" method="post" role="form" class="php-email-form" enctype="multipart/form-data">
                    <div class="info-msg"></div>
                    <input type="text" name="subject" required value="attach">
                    <textarea name="email-message" id="email-message" 
                     placeholder="type a message to to be sent as email" cols="30" rows="10"></textarea>
                     <input class="form-control-file" name="upload[]" rows="5" multiple="multiple"
                     accept="image/png,image/jpeg" type="file" id="photo">
                                
                     <div class="btn-container">
                         <button>Send Email</button>
                     </div>
                </form>

            </div>
        </div>
    </div>

    <script src="./includes/vendor/jQuery/jquery-3.5.1.min.js"></script>
    <script src="./includes/js/app.js"></script>
</body>

</html>