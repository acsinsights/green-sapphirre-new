<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = htmlspecialchars($_POST['name']);
    $mobile = htmlspecialchars($_POST['mobile']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // $countryCode = htmlspecialchars($_POST['CountryCode']);
    // $source = htmlspecialchars($_POST['source']);
    // $brochure = htmlspecialchars($_POST['brochure']);
    // $plans = htmlspecialchars($_POST['plans']); // New field for plans PDF

    // Email configuration
    $to = "rahul20032490@gmail.com"; // Replace with your Gmail address
    $email_subject = "New Form Submission";
    $email_body = "
    <html>
        <head>
            <title>New Form Submission</title>
            <style>
                body { 
                    font-family: Arial, sans-serif; 
                    line-height: 1.6; 
                    color: #333; 
                    background-color: #f9f9f9;
                    padding: 20px;
                }
                .container { 
                    width: 100%; 
                    max-width: 600px; 
                    margin: 0 auto; 
                    padding: 20px; 
                    border: 1px solid #e0e0e0; 
                    border-radius: 10px; 
                    background-color: #fff; 
                    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                }
                h2 { 
                    color: #5ca505; 
                    border-bottom: 2px solid #f4d400;
                    padding-bottom: 10px;
                }
                p { 
                    font-size: 16px; 
                    margin-bottom: 15px;
                }
            </style>
        </head>
        <body>
        <div class='container'>
            <h2>Form Details: </h2>
            <p><strong>Name:</strong> $name</p>
            <p><strong>Mobile:</strong> $mobile</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Message:</strong> $message</p>
        </div>
        </body>
        </html>
    ";
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: no-reply@yourdomain.com" . "\r\n";
    $headers .= "Reply-To: $email" . "\r\n";

    // Send the email
    if (mail($to, $email_subject, $email_body, $headers)) {
        // Check for brochure download
        // if ($brochure == 1) {
        //     $brochureFile = 'img/brochure.pdf';
        //     if (file_exists($brochureFile)) {
        //         header('Content-Type: application/pdf');
        //         header('Content-Disposition: attachment; filename="brochure.pdf"');
        //         header('Content-Length: ' . filesize($brochureFile));
        //         readfile($brochureFile);
        //         exit();
        //     }
        // }

        // Check for plans PDF download
        // if ($plans == 1) {
        //     $plansFile = 'img/plans.pdf';
        //     if (file_exists($plansFile)) {
        //         header('Content-Type: application/pdf');
        //         header('Content-Disposition: attachment; filename="plans.pdf"');
        //         header('Content-Length: ' . filesize($plansFile));
        //         readfile($plansFile);
        //         exit();
        //     }
        // }

        // Redirect to a thank you page
        header('Location: thank-you.html');
    } else {
        echo "Error: Unable to send email.";
    }
} else {
    echo "Invalid request.";
}
