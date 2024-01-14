<!DOCTYPE html>
<html>
<head>
    <title>Image Email</title>
</head>
<body>
    <h1>Image Captured</h1>
    <p>Thank you for using our service. Here is the screenshot that you requested:</p>
    <!-- Use the image URL as an inline attachment -->
    <img src="{{ $message->embed($imageData) }}" alt="Screenshot">
    <p>If you have any questions, feel free to contact us.</p>
</body>
</html>
