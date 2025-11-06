<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize user input
    function cleanInput($data) {
        return htmlspecialchars(strip_tags(trim($data)));
    }

    $name = isset($_POST['name']) ? cleanInput($_POST['name']) : "";
    $phone = isset($_POST['phone']) ? cleanInput($_POST['phone']) : "";
    $email = isset($_POST['email']) ? cleanInput($_POST['email']) : "";
    // $source = isset($_POST['source']) ? cleanInput($_POST['source']) : "Enquiry Form";
    // $brochure = isset($_POST['brochure']) ? intval($_POST['brochure']) : 0;
    // $plans = isset($_POST['plans']) ? intval($_POST['plans']) : 0;

    // Validate required fields
    if (empty($name) || empty($phone) || empty($email)) {
        die("Error: All fields are required.");
    }

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Error: Invalid email format.");
    }

    // Email configuration
    $to = "rahul20032490@gmail.com"; // Replace with your Gmail address
    $email_subject = "New Form Submission";
    $email_body = "
    <html>
        <head>
            <title>New Form Submission</title>
            <style>
                body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; background-color: #f9f9f9; padding: 20px; }
                .container { width: 100%; max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #e0e0e0; border-radius: 10px; background-color: #fff; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); }
                h2 { color: #5ca505; border-bottom: 2px solid #f4d400; padding-bottom: 10px; }
                p { font-size: 16px; margin-bottom: 15px; }
            </style>
        </head>
        <body>
            <div class='container'>
                <h2>Form Details: </h2>
                <p><strong>Name:</strong> $name</p>
                <p><strong>Phone:</strong> $phone</p>
                <p><strong>Email:</strong> $email</p> 
            </div>
        </body>
    </html>
    ";

    // Email headers
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8\r\n";
    $headers .= "From: no-reply@yourdomain.com\r\n";
    $headers .= "Reply-To: $email\r\n";

    // Send the email
    if (mail($to, $email_subject, $email_body, $headers)) {
        // Handle brochure download
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

        // Handle plans PDF download
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

        // Redirect to a thank-you page
        header('Location: thank-you.html');
        exit();
    } else {
        die("Error: Unable to send email.");
    }
} else {
    die("Invalid request.");
}
?>
