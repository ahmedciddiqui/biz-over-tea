<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>New Contact Form Submission</title>
    <style>
        body,
        html {
            height: 100%;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            padding: 20px;
            color: #333;
            font-size: 14px;
        }

        .email-container{
            background: #f5f5f5;
            height: 100%;
            padding: 100px;
        }

        .email-container .logo {
            text-align: center;
        }

        .email-container .logo img {
            width: 100px;
        }

        .email-container .card-box {
            background: #fff;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            max-width: 600px;
            margin: 20px auto;
        }

        .email-container h2 {
            color: #000;
            margin-top: 0;
            margin-bottom: 20px;
            font-size: 16px;
        }

        p {
            margin-bottom: 10px;
            line-height: 1.5;
        }

        .label {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="logo">
            <a href="https://nuvantagroupltd.com/">
                <img src="https://nuvantagroupltd.com/includes/images/logo2.svg" alt="Nuvanta">
            </a>
        </div>

        <div class="card-box">

            <h2>New Contact Submission - Nuvanta Website</h2>

            <p><span class="label">First Name:</span> {{ $data['name'] }}</p>
            <p><span class="label">Email:</span> {{ $data['email'] }}</p>
            <p><span class="label">Phone:</span> {{ $data['isd_code'] }} {{ $data['phone'] }}</p>

            <hr style="margin: 30px 0; border: none; border-top: 1px solid #ddd;">

            <p>This message was submitted through the Nuvanta website contact form.</p>
        </div>
    </div>
</body>

</html>